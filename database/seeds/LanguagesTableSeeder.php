<?php

use Illuminate\Database\Seeder;
use App\Models\Variables\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name'              => 'English',
            'acronym'           => 'en',
            'flag'              => 'uk.svg',
            'symbol_currency'   => '$',
            'state'             => 'ACTIVE',
        ]);

        Language::create([
            'name'              => 'Portuguese',
            'acronym'           => 'pt',
            'flag'              => 'pt.svg',
            'symbol_currency'   => 'R$',
            'state'             => 'ACTIVE',
        ]);

        Language::create([
            'name'              => 'Spanish',
            'acronym'           => 'es',
            'flag'              => 'sp.svg',
            'symbol_currency'   => 'S/',
            'state'             => 'ACTIVE',
        ]);
        
    }
}
