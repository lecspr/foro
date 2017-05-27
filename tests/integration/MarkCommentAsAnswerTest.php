<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class MarkCommentAsAnswerTest extends TestCase
{
	use DatabaseTransactions;
   

    public function test_a_post_can_be_answered()
    {
        $post = $this->createPost();

         $comment = factory(App\Comment::class)->create([
        	'post_id' => $post->id

        	]);

       $comment->markAsAnswer();

        $this->assertTrue($comment->fresh()->answer);

        $this->assertFalse($post->fresh()->pending);
    }

    function test_a_post_can_only_have_one_answer(){

    	 $post = $this->createPost();

         $comments = factory(App\Comment::class)->times(2)->create([
        	'post_id' => $post->id

        	]);

         $comments->first()->markAsAnswer();

         $comments->last()->markAsAnswer();

         $this->assertFalse($comments->first()->fresh()->answer);

         $this->assertTrue($comments->last()->fresh()->answer);


    }
}
