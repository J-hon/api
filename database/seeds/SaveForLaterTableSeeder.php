<?php

use Illuminate\Database\Seeder;

class SaveForLaterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SaveForLater::class, 30)->create();
    }
}
