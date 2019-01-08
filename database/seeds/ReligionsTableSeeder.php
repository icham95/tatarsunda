<?php

use Illuminate\Database\Seeder;

use App\Models\Religion;

class ReligionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $religion = new Religion;
        $religion->insert([
            ['name' => 'islam'],
            ['name' => 'kristen'],
            ['name' => 'katolik'],
            ['name' => 'hindu'],
            ['name' => 'budha'],
        ]);
    }
}
