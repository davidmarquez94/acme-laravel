<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'name' => 'Renault'
            ],
            [
                'name' => 'Chevrolet'
            ],
            [
                'name' => 'Mazda'
            ],
            [
                'name' => 'Honda'
            ],
            [
                'name' => 'Nissan'
            ],
            [
                'name' => 'Mitsubishi'
            ],
            [
                'name' => 'Ford'
            ],
            [
                'name' => 'Wolkswagen'
            ],
            [
                'name' => 'BMW'
            ],
        ]);
    }
}
