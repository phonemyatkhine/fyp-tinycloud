<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'name' => "Basic Package",
            'details' => "Add 10 Gigabytes of data to your storage, pay monthly. Recommended for personal uses.",
            'price' => "4.99",     
            "additional_space" => "10737418240",
        ]);
        DB::table('packages')->insert([
            'name' => "Eco Package",
            'details' => "Add 20 Gigabytes of data to your storage, pay monthly. Recommended for Small to Medium Businesses.",
            'price' => "8.99",
            "additional_space" => "21474836480",
        ]);
        DB::table('packages')->insert([
            'name' => "Enterprise Package",
            'details' => "Add 100 Gigabytes of data to your storage, pay monthly. Recommended for Large Enterprieses.",
            'price' => "34.99",
            "additional_space" => "107374182400",
        ]);
    }
}
