<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') == 'local') {
            \App\Models\Shop::factory(10)->create();
        }
        // \App\Models\User::factory(10)->create();
    }
}
