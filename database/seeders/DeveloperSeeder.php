<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Developer::create(
            [
                'id'=> 1,
                'name'=>"Developer1",
                'project_id'=>1, 
            ],
        );
        Developer::create(
        [
            'id'=> 2,
            'name'=>"Developer2",
            'project_id'=>2, 
        ],
        );
        Developer::create(
        [
            'id'=> 3,
            'name'=>"Developer3",
            'project_id'=>3, 
        ],
         );
    }
}
