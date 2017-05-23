<?php

class CreatePostsTest extends FeatureTestCase
{

	public function test_a_user_create_a_post()
	{
		
        //having
		$this->actingAs($user=$this->defaultUser());

        //when
		$this->visit(route('posts.create'))
		     ->type('Esta es una pregunta', 'title')
		     ->type('Este es el contenido', 'content')
		     ->press('Publicar');

		//then     

		$this->seeInDatabase('posts', [
            'title' => 'Esta es una pregunta',
            'content'=>'Este es el contenido',
            'pending'=>true,
            'user_id'=>$user->id,
            'slug'=>'esta-es-una-pregunta',

			]);

		$this->see('Esta es una pregunta');
		//$this->seeInElement('h1', 'Esta es una pregunta');
	}

	public function test_creating_a_post_requires_authentication()
	{
		
        

        //when
		$this->visit(route('posts.create'));

		//then     

		

		$this->seePageIs(route('login'));
		//$this->seeInElement('h1', 'Esta es una pregunta');
	}

	function test_create_post_form_validation(){
		$this->actingAs($this->defaultUser())
		     ->visit(route('posts.create'))
		     ->press('Publicar')
		     ->seePageIs(route('posts.create'))

		     ->seeErrors([
		     	'title' => 'El campo título es obligatorio',
		     	'content'=>'El campo contenido es obligatorio'

		     	])

		     /*
		     ->seeInElement('#field_title.has-error .help-block', 'El campo título es obligatorio')
		     ->seeInElement('#field_content.has-error .help-block', 'El campo contenido es obligatorio')

		     */

		     ;

	}
}