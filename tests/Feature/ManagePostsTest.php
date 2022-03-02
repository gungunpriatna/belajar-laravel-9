<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_a_post()
    {
        // user buka halaman create post
        $this->visit('/post/create');

        // user isi `title`, `publish status ` dan content
        // lalu klik tombol save
        $this->submitForm('Save', [
            'title' => 'Belajar Laravel 9 at qadrLabs',
            'status' => 1, // publish
            'content' => 'Ini adalah content tutorial belajar laravel 9 di qadrLabs'
        ]);

        // lihat data post baru di database
        $this->seeInDatabase('posts', [
            'title' => 'Belajar Laravel 9 at qadrLabs',
            'status' => 1,
            'content' => 'Ini adalah content tutorial belajar laravel 9 di qadrLabs'
        ]);

        // ter-redirect ke halaman daftar post
        $this->seePageIs('post');

        // lihat post yang sudah diinput
        $this->see('Belajar Laravel 9 at qadrLabs');
        $this->see('Publish');
    }

    /** @test  */
    public function user_can_browse_posts_index_page()
    {
        // generate 2 record baru di table 'posts'
        $postOne = Post::create([
            'title' => 'Belajar Laravel 9 edisi 1',
            'content' => 'ini adalah tutorial belajar laravel 9',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-9-edisi-1'
        ]);

        $postOne = Post::create([
            'title' => 'Belajar Laravel 9 edisi 2',
            'content' => 'ini adalah tutorial belajar laravel 9',
            'status' => 0, // draft
            'slug' => 'belajar-laravel-9-edisi-2'
        ]);

        // user buka halaman daftar post
        $this->visit('post');

        $this->see('Belajar Laravel 9 edisi 1');
        $this->see('Publish');
        $this->see('Belajar Laravel 9 edisi 2');
        $this->see('Draft');
    }

    /** @test */
    public function user_can_edit_existing_post()
    {
        $this->assertTrue(true);
    }

    /** @test  */
    public function user_can_delete_existing_post()
    {
        $this->assertTrue(true);
    }
}
