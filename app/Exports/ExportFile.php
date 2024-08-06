<?php
namespace App\Exports;

use App\Models\AgendaMasukDetail;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportFile implements FromArray, WithHeadings, WithEvents
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
        $allColumns = Schema::getColumnListing('agenda_masuk_details');
        $columnsToSelect = array_diff($allColumns, $this->excludeColumns);

        $query = AgendaMasukDetail::select($columnsToSelect)
            ->orderBy('kode_barang', 'asc');

        // Apply filters with substring matching
        if (isset($this->filters['nama_barang']) && !empty($this->filters['nama_barang'])) {
            $query->where('nama_barang', 'like', '%' . $this->filters['nama_barang'] . '%');
        }

        if (isset($this->filters['tahun_beli']) && !empty($this->filters['tahun_beli'])) {
            $query->where('tahun_beli', 'like', '%' . $this->filters['tahun_beli'] . '%');
        }

        if (isset($this->filters['kondisi']) && !empty($this->filters['kondisi'])) {
            $query->where('kondisi', 'like', '%' . $this->filters['kondisi'] . '%');
        }

        $data = $query->get()->toArray();

        // Map the data to the new column names
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
        $allColumns = Schema::getColumnListing('agenda_masuk_details');
        $columnsToSelect = array_diff($allColumns, $this->excludeColumns);

        // Map the headings to the new column names
        return array_map(function($column) {
            return $this->columnMappings[$column] ?? $column;
        }, $columnsToSelect);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $row = $sheet->getHighestRow() + 2;

                // Left side
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
