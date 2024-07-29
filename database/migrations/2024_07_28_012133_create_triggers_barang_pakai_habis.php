<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Trigger untuk barang_habis_terima
        DB::unprepared('
            CREATE TRIGGER after_barang_habis_terima_insert
            AFTER INSERT ON barang_habis_terimas
            FOR EACH ROW
            BEGIN
                UPDATE barang_pakai_habis
                SET stok = stok + NEW.banyak_barang
                WHERE id = NEW.id_barang;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_barang_habis_terima_update
            AFTER UPDATE ON barang_habis_terimas
            FOR EACH ROW
            BEGIN
                DECLARE diff INT;
                SET diff = NEW.banyak_barang - OLD.banyak_barang;
                UPDATE barang_pakai_habis
                SET stok = stok + diff
                WHERE id = NEW.id_barang;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_barang_habis_terima_delete
            AFTER DELETE ON barang_habis_terimas
            FOR EACH ROW
            BEGIN
                UPDATE barang_pakai_habis
                SET stok = stok - OLD.banyak_barang
                WHERE id = OLD.id_barang;
            END
        ');

        // Trigger untuk barang_habis_keluars
        DB::unprepared('
            CREATE TRIGGER after_barang_habis_keluar_insert
            AFTER INSERT ON barang_habis_keluars
            FOR EACH ROW
            BEGIN
                UPDATE barang_pakai_habis
                SET stok = stok - NEW.banyak_barang
                WHERE id = NEW.id_barang;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_barang_habis_keluar_update
            AFTER UPDATE ON barang_habis_keluars
            FOR EACH ROW
            BEGIN
                DECLARE diff INT;
                SET diff = NEW.banyak_barang - OLD.banyak_barang;
                UPDATE barang_pakai_habis
                SET stok = stok - diff
                WHERE id = NEW.id_barang;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_barang_habis_keluar_delete
            AFTER DELETE ON barang_habis_keluars
            FOR EACH ROW
            BEGIN
                UPDATE barang_pakai_habis
                SET stok = stok + OLD.banyak_barang
                WHERE id = OLD.id_barang;
            END
        ');
    }

    public function down()
    {
        // Hapus trigger jika diperlukan
        DB::unprepared('DROP TRIGGER IF EXISTS after_barang_habis_terima_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_barang_habis_terima_update');
        DB::unprepared('DROP TRIGGER IF EXISTS after_barang_habis_terima_delete');
        DB::unprepared('DROP TRIGGER IF EXISTS after_barang_habis_keluar_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_barang_habis_keluar_update');
        DB::unprepared('DROP TRIGGER IF EXISTS after_barang_habis_keluar_delete');
    }
};
