<?php

namespace Database\Seeders;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create(
            [
                'id'=> 1,
                'name'=>"Project1",
            ],
        );
        Project::create(
        [
            'id'=> 2,
            'name'=>"Project2",
        ],
        );
        Project::create(
        [
            'id'=> 3,
            'name'=>"Project3",
        ],
         );
    }
}
