<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use DB;
use File;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->delete();
        $json = File::get('database/data-sample/items.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Item::create([
                'id' => $obj->id,
                'type' => $obj->type,
                'name' => $obj->name,
                'company' => $obj->company,
                'bike_id' => $obj->bike_id
            ]);
        }
    }
}
