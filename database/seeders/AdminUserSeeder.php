<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'datos@escobar.gob.ar'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('8q1|0]Kx3xA;'),
            ]
        );
    }
}
