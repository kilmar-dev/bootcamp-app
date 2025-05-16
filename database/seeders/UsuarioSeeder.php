<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario::create([
        //     'nombre' => 'Karla',
        //     'apellido' => 'Miranda',
        //     'email' => 'karla@gmail.com',
        //     'password' => Hash::make('mirandaK25$'),
        //     'status' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        /*
        $usuarios = [
            [
                'nombre' => 'Stefani',
                'apellido' => 'Miranda',
                'email' => 'stefani@gmail.com',
                'password' => Hash::make('mejiastefaniK25$'),
                'status' => 1
            ],
            [
                'nombre' => 'Kendal',
                'apellido' => 'Sosa',
                'email' => 'kendal@gmail.com',
                'password' => Hash::make('kendalS25$'),
                'status' => 1
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Mejia',
                'email' => 'ana@gmail.com',
                'password' => Hash::make('anaitaM25$'),
                'status' => 1
            ],
            [
                'nombre' => 'Carlos',
                'apellido' => 'Torres',
                'email' => 'carlos@gmail.com',
                'password' => Hash::make('carlosT25$'),
                'status' => 1
            ],
        ];

        foreach($usuarios as $usuario){
            Usuario::create($usuario);
        }
        */

        DB::table('usuarios')->insert([
            [
                'nombre' => 'Chistian',
                'apellido' => 'Deleon',
                'email' => 'cristian@gmail.com',
                'password' => Hash::make('arrozconpapas2025$'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Kevin',
                'apellido' => 'Torres',
                'email' => 'kevin@gmail.com',
                'password' => Hash::make('kevinTC2$00'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
