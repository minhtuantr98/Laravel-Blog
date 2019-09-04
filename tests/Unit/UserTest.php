<?php

namespace Tests\Unit;

use App\User;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testOnlyAdminCanSeeCategoryList()
    {
        $this->get('/admin/category')->assertRedirect('/admin');
    }
    
    public function testLogin()
    {
        $this->post('/admin', [
            'email' => 'tuan@123.com',
            'password' => 'abcd1234'
        ]);
        
        $this->assertAuthenticated();
    }

    public function testLogout()
    {
        $this->actingAs(User::first())
            ->get('/admin/logout');
        
        $this->assertGuest();
    }

    public function testInsertCategoryToDatabase()
    {
        $this->actingAs(User::first())
            ->post('/admin/category', ['name' => 'Bong Ro']);

        $this->assertDatabaseHas('categories', ['name' => 'Bong Ro']);
    }

    public function testEditCategoryToDatabase()
    {
        $this->actingAs(User::first())
            ->put('/admin/category/bong-ro', ['name' => 'Bong Basketball']);

        $this->assertDatabaseHas('categories', ['name' => 'Bong Basketball']);
    }

    
    public function testDeleteCategoryToDatabase()
    {
        $this->actingAs(User::first())
            ->delete('/admin/category/bong-basketball');

        $this->assertDatabaseMissing('categories', ['name' => 'Bong Basketball']);
    }

    public function testInsertPostToDatabase()
    {
        $this->actingAs(User::first())
            ->post('/admin/post', [
                'title' => 'abc',
                'content' => 'AAAA',
                'category' => '3', 
                'active' => '1'
            ]);

        $this->assertDatabaseHas('posts', ['title' => 'abc']);
    }

    public function testEditPostToDatabase()
    {
        $this->actingAs(User::first())
            ->put('/admin/post/abc', [
                'title' => 'Xin Chao',
                'content' => 'Hello',
                'category' => '2', 
                'active' => '0'
            ]);

        $this->assertDatabaseHas('posts', ['title' => 'Xin Chao']);
    }

    public function testDeletePostToDatabase()
    {
        $this->actingAs(User::first())
            ->delete('/admin/post/xin-chao');

        $this->assertDatabaseMissing('posts', ['title' => 'Xin Chao']);
    }

}
