<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Job::factory(10)->create();
        Tag::factory(10)->create();
        Employer::factory(10)->create();
        Post::factory(10)->create();
        Role::factory(4)->create();

        // User::factory()->create([
        //     'first_name' => 'John',
        //     'last_name' => 'Doe',
        //     'email' => 'test@example.com',
        // ]);
    }
}
