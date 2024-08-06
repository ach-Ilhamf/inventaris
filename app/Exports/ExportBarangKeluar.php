<?php
namespace App\Exports;

use App\Models\BarangHabisKeluar;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportBarangKeluar implements FromArray, WithHeadings, WithEvents
{
    protected $excludeColumns;
    protected $filters;
    protected $columnMappings;
    protected $approvalDetails;

    public function __construct(array $excludeColumns, array $filters = [], array $columnMappings = [], array $approvalDetails = [])
    {
        $this->excludeColumns = $excludeColumns;
        $this->filters = $filters;
        $this->columnMappings = $columnMappings;
        $this->approvalDetails = $approvalDetails;
    }

    public function array(): array
    {
        $columnsToSelect = ['barang_habis_keluars.kode_barang', 'barang_pakai_habis.jenis_barang'];

        $allColumns = Schema::getColumnListing('barang_habis_keluars');
        $remainingColumns = array_diff($allColumns, $this->excludeColumns, ['kode_barang']);

        foreach ($remainingColumns as $column) {
            $columnsToSelect[] = "barang_habis_keluars.$column";
        }

        $query = BarangHabisKeluar::with('barangpakaihabis')
            ->select($columnsToSelect)
            ->leftJoin('barang_pakai_habis', 'barang_habis_keluars.id_barang', '=', 'barang_pakai_habis.id')
            ->orderBy('barang_habis_keluars.tgl_keluar', 'asc');

        if (isset($this->filters['jenis_barang']) && !empty($this->filters['jenis_barang'])) {
            $query->whereHas('barangpakaihabis', function($q) {
                $q->where('barang_pakai_habis.jenis_barang', 'like', '%' . $this->filters['jenis_barang'] . '%');
            });
        }

        if (isset($this->filters['tgl_keluar']) && !empty($this->filters['tgl_keluar'])) {
            $query->where('barang_habis_keluars.tgl_keluar', 'like', '%' . $this->filters['tgl_keluar'] . '%');
        }

        $data = $query->get()->toArray();

        $mappedData = array_map(function($item) {
            $mappedItem = [];
            foreach ($item as $key => $value) {
                $newKey = $this->columnMappings[$key] ?? $key;
                $mappedItem[$newKey] = $value;
            }
            return $mappedItem;
        }, $data);

        return $mappedData;
    }

    public function headings(): array
    {
        $headings = ['kode_barang', 'jenis_barang'];

        $allColumns = Schema::getColumnListing('barang_habis_keluars');
        $remainingColumns = array_diff($allColumns, $this->excludeColumns, ['kode_barang']);

        foreach ($remainingColumns as $column) {
            $headings[] = $column;
        }

        return array_map(function($column) {
            return $this->columnMappings[$column] ?? $column;
        }, $headings);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $row = $sheet->getHighestRow() + 2;

                $sheet->mergeCells("A$row:C$row");
                $sheet->setCellValue("A$row", $this->approvalDetails['date']);
                $row++;

                $sheet->mergeCells("A$row:C$row");
                $sheet->setCellValue("A$row", $this->approvalDetails['left']['position']);
                $sheet->mergeCells("D$row:F$row");
                $sheet->setCellValue("D$row", $this->approvalDetails['right']['position']);
                $row += 4;

                $sheet->mergeCells("A$row:C$row");
                $sheet->setCellValue("A$row", $this->approvalDetails['left']['name']);
                $sheet->mergeCells("D$row:F$row");
                $sheet->setCellValue("D$row", $this->approvalDetails['right']['name']);
                $row++;

                $sheet->mergeCells("A$row:C$row");
                $sheet->setCellValue("A$row", 'NIP. ' . $this->approvalDetails['left']['nip']);
                $sheet->mergeCells("D$row:F$row");
                $sheet->setCellValue("D$row", 'NIP. ' . $this->approvalDetails['right']['nip']);
            },
        ];
    }
}
