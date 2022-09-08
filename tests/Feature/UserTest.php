<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class UserTest extends TestCase
{    
    public function test_get_user()
    {
        $user = User::factory()->create();
        $response = $this->get('/user/'.$user->id);
        $response->assertStatus(200);

        $user->delete();
    }
    
    public function test_get_user_no_such_user()
    {
        $response = $this->get('/user/-1');
        $response->assertStatus(404);
    }

    public function test_post_user()
    {
        $user = User::factory()->create();

        $response = $this->json('POST','/user',[
            'id' => $user->id,
            'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB',
            'comments' => 'test post user'
        ]);
        $response->assertStatus(200);
        
        $user->delete();
    }

    public function test_post_user_invalid_password()
    {
        $user = User::factory()->create();

        $response = $this->json('POST','/user',[
            'id' => $user->id,
            'password' => 'invalid password',
            'comments' => 'test post user invalid password'
        ]);
        $response->assertStatus(401);
        
        $user->delete();
    }
    
    public function test_post_user_incomplete_fields()
    {
        $user = User::factory()->create();

        $response = $this->json('POST','/user',[
        ]);
        $response->assertStatus(422);
        
        $user->delete();
    }
}
