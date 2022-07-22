<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Support\Str;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_category()
    {
        $response = $this->postJson('/api/v1/admin/category',[
            'name' => 'name uni test',
            'parent_category_id' => 'name uni test',
        ]);

        $response->assertStatus($response->status(),200);
    
    }

    

}
