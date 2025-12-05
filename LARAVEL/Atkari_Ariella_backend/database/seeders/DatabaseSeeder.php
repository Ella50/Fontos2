<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Kategoria;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $kategoria = ['Ház', 'Lakás', 'Építési telek', 'Garázs', 'Mezőgazsasági terület', 'Ipari ingatlan'];

        foreach ($kategoria as $key => $value) {
            Kategoria::create(['nev' => $value]);
        }
    }
}
