<?php



class ExampleTest extends FeatureTestCase
{
    
    /**
     * A basic functional test example.
     *
     * @return void
     */
    function test_basic_example()
    {


        $user = factory(App\User::class)->create(['name'=>'Lore', 'email' => 'admin@styde.net']);

        $this->actingAs($user,'api')


        ->visit('api/user')
             ->see('Lore')
             ->see('admin@styde.net');
    }
}
