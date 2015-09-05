<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(){
        Eloquent::unguard();
        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');
    }
}

class UserTableSeeder extends Seeder
{
    public function run() {
        User::create(array(
            'email'    => 'yl@open.by',
            'name'     => 'Aros',
            'password' => Hash::make('122334qQ')
        ));
    }

}
