<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Database\Seeders\DatabaseSeeder
 *
 * @Class DatabaseSeeder Начальное наполнение базы данных.
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(
            [
                CategorySeeder::class
            ]
        );
    }
}
