<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_session()
    {
        $user = User::factory()->create();
        
        $session = Session::create([
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit Test',
            'payload' => ['test' => 'data'],
            'last_activity' => time()
        ]);

        $this->assertDatabaseHas('sessions', [
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1'
        ]);
    }

    public function test_session_belongs_to_user()
    {
        $user = User::factory()->create();
        $session = Session::create([
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'last_activity' => time(),
            'payload' => json_encode(['key' => 'value']),
            'user_agent' => 'PHPUnit Test'
        ]);

        $this->assertEquals($user->id, $session->user->id);
    }
}