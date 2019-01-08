<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu;
        $menu->insert([
            [
                'name' => 'adat istiadat',
                'link' => 'test',
                'created_by' => 3,
                'type' => 1
            ],
            [
                'name' => 'direktori usaha',
                'link' => 'test',
                'created_by' => 3,
                'type' => 1
            ],
            [
                'name' => 'info jabar',
                'link' => 'test',
                'created_by' => 3,
                'type' => 1
            ],
            [
                'name' => 'kuliner',
                'link' => 'test',
                'created_by' => 3,
                'type' => 1
            ],
            [
                'name' => 'museum',
                'link' => 'test',
                'created_by' => 3,
                'type' => 1
            ],
            [
                'name' => 'pariwisata',
                'link' => 'test',
                'created_by' => 3,
                'type' => 1
            ],
            [
                'name' => 'sanggar dan organisasi',
                'link' => 'test',
                'created_by' => 3,
                'type' => 1
            ],
            [
                'name' => 'seni budaya',
                'link' => 'test',
                'created_by' => 3,
                'type' => 1
            ],
        ]);
    }
}
