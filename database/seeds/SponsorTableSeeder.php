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
        //Sponsor
        Permission::create([
            'name'          => 'Sponsor:List', 
            'slug'          => 'sponsors.index', 
            'description'   => 'Listar patrocinadores',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Create View', 
            'slug'          => 'sponsors.create', 
            'description'   => 'Ver el formulario que permite la creacion de las patrocinadores', 
        ]);

        Permission::create([
            'name'          => 'Sponsor:Store', 
            'slug'          => 'sponsors.store', 
            'description'   => 'Guardar una nuevo patrocinador en la base de datos',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Show', 
            'slug'          => 'sponsors.show', 
            'description'   => 'Ver el detalle de una patrocinador en especifico',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Edit View', 
            'slug'          => 'sponsors.edit', 
            'description'   => 'Ver el formulario que permite la edición de las patrocinadores',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Update', 
            'slug'          => 'sponsors.update', 
            'description'   => 'Permite actualizar la informacion de una patrocinador en especifico',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Destroy', 
            'slug'          => 'sponsors.destroy', 
            'description'   => 'Eliminar una patrocinador de la base de datos.',
        ]);

        factory(Sponsor::class, 50)->create();
    }
}
