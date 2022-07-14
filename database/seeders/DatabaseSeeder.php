<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(classification::class);
        $this->call(user::class);
// <<<<<<< HEAD
//         $this->call(expensesTableSeeder::class);

// =======
//         $this->call(expense::class);
// >>>>>>> fd87c975fc6f85e28e3db79af331afe77ef45ac5
    }
}
