<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/users');
        Storage::makeDirectory('public/users');

        Storage::deleteDirectory('public/courses');
        Storage::makeDirectory('public/courses');

        Storage::deleteDirectory('public/sponsors');
        Storage::makeDirectory('public/sponsors');
        
        $this->call([
            LanguagesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            TypeDocumentsTableSeeder::class,
            CategoryTableSeeder::class,
            SponsorTableSeeder::class,
        ]);
        
        $this->call([
            UsersTableSeeder::class,
            CoursesTableSeeder::class
        ]);

        $this->call(AdministratorUserSeeder::class);
    }
}
