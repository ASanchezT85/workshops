<?php

use Illuminate\Database\Seeder;
use App\Models\Category\Category;
use Caffeinated\Shinobi\Models\Permission;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Category
        Permission::create([
            'name'          => 'Category:List', 
            'slug'          => 'categories.index', 
            'description'   => 'Listar categorías',
        ]);

        Permission::create([
            'name'          => 'Category:Create View', 
            'slug'          => 'categories.create', 
            'description'   => 'Ver el formulario que permite la creacion de las categorías', 
        ]);

        Permission::create([
            'name'          => 'Category:Store', 
            'slug'          => 'categories.store', 
            'description'   => 'Guardar una nuevo categoría en la base de datos',
        ]);

        Permission::create([
            'name'          => 'Category:Show', 
            'slug'          => 'categories.show', 
            'description'   => 'Ver el detalle de una categoría en especifico',
        ]);

        Permission::create([
            'name'          => 'Category:Edit View', 
            'slug'          => 'categories.edit', 
            'description'   => 'Ver el formulario que permite la edición de las categorías',
        ]);

        Permission::create([
            'name'          => 'Category:Update', 
            'slug'          => 'categories.update', 
            'description'   => 'Permite actualizar la informacion de una categoría en especifico',
        ]);

        Permission::create([
            'name'          => 'Category:Destroy', 
            'slug'          => 'categories.destroy', 
            'description'   => 'Eliminar una categoría de la base de datos.',
        ]);

        $category = Category::create([
            'name'          => 'SOFT SKILLS',
            'file'          => 'softskills.svg',
            'state'         => 'ACTIVE',
        ]);

        $category->category_langs()->create([
            'lang_id'       => 1,
            'description'   => 'Resources that stand out as profissionais profissionais.',
        ]);

        $category->category_langs()->create([
            'lang_id'       => 2,
            'description'   => 'Recursos que se destacam como profissionais profissionais.',
        ]);

        $category->category_langs()->create([
            'lang_id'       => 3,
            'description'   => 'Características que nos hacen destacar como buenos profesionales.',
        ]);

        $category = Category::create([
            'name'          => 'HARD SKILLS',
            'file'          => 'hardskills.svg',
            'state'         => 'ACTIVE',
        ]);

        $category->category_langs()->create([
            'lang_id'       => 1,
            'description'   => 'Techniques and knowledge to develop our professional activities.',
        ]);

        $category->category_langs()->create([
            'lang_id'       => 2,
            'description'   => 'Técnicas e conhecimentos para desenvolver nossas atividades profissionais.',
        ]);

        $category->category_langs()->create([
            'lang_id'       => 3,
            'description'   => 'Técnicas y conocimientos para desarrollar nuestras actividades profesionales.',
        ]);
        
    }
}
