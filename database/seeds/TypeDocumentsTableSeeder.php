<?php

use Illuminate\Database\Seeder;
use App\Models\Variables\Language;
use App\Models\Variables\TypeDocument;

class TypeDocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lang = Language::where('acronym', 'es')->first();

        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'Doc Trib No Dom Sin Ruc',
            'acronym'   => 'DTNDSR',
        ]);
        
        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'Documento Nacional De Identidade',
            'acronym'   => 'DNI',
            'state'     => 'ACTIVE'
        ]);

        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'ID Estrangeira',
            'acronym'   => 'IDE',
            'state'     => 'ACTIVE'
        ]);

        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'Cedula Estrangeira',
            'acronym'   => 'CE',
            'state'     => 'ACTIVE'
        ]);

        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'Registro Único de Contribuyentes',
            'acronym'   => 'RUC',
            'state'     => 'ACTIVE'
        ]);

        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'Pasaporte',
            'acronym'   => 'PASS',
            'state'     => 'ACTIVE'
        ]);

        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'Cedula Diplomática de identidad',
            'acronym'   => 'CDI',
            'state'     => 'ACTIVE'
        ]);

        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'Documento identidad país residencia',
            'acronym'   => 'DI-PR',
            'state'     => 'ACTIVE'
        ]);

        TypeDocument::create([
            'lang_id'   => $lang->id,
            'name'      => 'Tarjeta Andina de Migración',
            'acronym'   => 'TAM',
            'state'     => 'ACTIVE'
        ]);
    }
}
