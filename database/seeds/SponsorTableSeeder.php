<?php

use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class SponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Sponsor::class, 50)->create();
    }
}
