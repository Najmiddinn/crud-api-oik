<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        // User::factory(2)->create();

        Category::factory(5)->create();
        Product::factory()
            ->count(10)
            ->state(new Sequence(fn ($sequence) => ['category_id' => Category::all()->random()]
        ))->create();
       
        $this->call(RoleSeeder::class);
        User::factory()
                ->count(5)
                ->state(new Sequence(
                    fn ($sequence) => ['role_id' => Role::all()->random()]
                ))->create();
    }
}
