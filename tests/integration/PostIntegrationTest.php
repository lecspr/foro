<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    function test_a_slug_is_generated_and_saved_to_the_database()
    {

    	$user = $this->defaultUser();

        $post = factory(Post::class)->make([
        	'title' => 'Como instalar laravel']);

        $user->posts()->save($post);

        $this->seeInDatabase('posts', [
        	'slug' => 'como-instalar-laravel'

        	]);

        $this->assertSame('como-instalar-laravel', $post->slug);
        $this->assertSame('como-instalar-laravel', $post->fresh()->slug);
    }
}
