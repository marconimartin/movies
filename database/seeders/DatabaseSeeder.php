<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Delete folders (if exists) to clear old files.
        Storage::deleteDirectory('imports');

        // Make sure the folders exists.
        Storage::makeDirectory('imports');      // Create : storage/app/public/imports

        $this->call(RoleSeeder::class);

        // Seed tables.
        $this->call(UserSeeder::class);         // Special seeder.

        \App\Models\Movie::factory(10)->create();

    }
}
