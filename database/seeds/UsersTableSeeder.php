<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'name'              => 'Alexander J Sánchez T',
            'email'             => 'ajstalito@gmail.com',
            'email_verified_at' => now(),
            'password'          => 'password', // password
            'type'              => User::ROOT,
        ])->assignRoles('root');

        User::create([
            'name'              => 'Eric Mogollón',
            'email'             => 'yhemogollon@gmail.com',
            'email_verified_at' => now(),
            'password'          => 'password', // password
            'type'              => User::ROOT,
        ])->assignRoles('root');

        factory(User::class, 100)->create();
    }
}
