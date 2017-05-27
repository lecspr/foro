<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends FeatureTestCase
{
    function test_a_user_can_see_the_post_details()
    {

    	$user = $this->defaultUser([
    		'name' => 'Lorena']);

    	//having
    	$post = $this->createPost([
    		'title' => 'Este es el titulo del post',
    		'content' => 'Este es el contenido del post',
            'user_id' => $user->id,
    		]);

    	

    	//when
    	$this->visit($post->url)
    	->seeInElement('h1', $post->title)
    	->see($post->content)
    	->see($user->name);


    }

    function test_old_urls_are_redirected(){
       

        $post = $this->createPost([
            'title' => 'Old title',

            ]);

        //$user->posts()->save($post);

        $url = $post->url;

        $post->title = 'New title';

        $post->save();

        $this->visit($url)
        ->seePageIs($post->url);
    }


   /* function test_post_url_with_wrong_slugs_still_work(){
    	$user = $this->defaultUser();

    	$post = factory(App\Post::class)->make([
    		'title' => 'Old title',

    		]);

    	$user->posts()->save($post);

    	$url = $post->url;

    	$post->title = 'New title';

    	$post->save();

    	//$this->get($url) //visit($url)
        //  ->assertResponseStatus(404);
        $this->visit($url)        
    	->assertResponseStatus(200)
    	->see('New title');


    }*/
}
