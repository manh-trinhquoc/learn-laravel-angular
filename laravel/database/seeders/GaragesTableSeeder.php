<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Garage;
use DB;
use File;

class GaragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('garages')->delete();
        $json = File::get('database/data-sample/garages.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Garage::create([
                'id' => $obj->id,
                'name' => $obj->name,
                'customer_level' => $obj->customer_level
            ]);
        }
    }
}
