<?php

use Illuminate\Database\Seeder;
use App\Models\Direction;

class DirectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Direction::class, 15)->create();
    }
}
