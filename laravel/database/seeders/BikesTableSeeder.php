<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bike;
use DB;
use File;

class BikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bikes')->delete();
        $path = 'database/data-sample/bikes.json';
        $json = File::get($path);
        $data = json_decode($json);
        foreach ($data as $obj) {
            Bike::create([
                'id' => $obj->id,
                'make' => $obj->make,
                'model' => $obj->model,
                'year' => $obj->year,
                'mods' => $obj->mods,
                'picture' => $obj->picture
            ]);
        }
    }
}
