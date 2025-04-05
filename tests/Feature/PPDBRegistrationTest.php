<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\PPDB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PPDBRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_ppdb_registration_form()
    {
        $response = $this->get('/ppdb/register');
        $response->assertStatus(200);
    }

    public function test_guest_can_submit_ppdb_registration()
    {
        $response = $this->post('/ppdb/register', [
            'name' => 'Test Student',
            'nisn' => '1234567890',
            'email' => 'student@test.com',
            'phone' => '081234567890',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',
            'gender' => 'male',
            'previous_school' => 'SMP Test',
            'parent_name' => 'Parent Test',
            'parent_phone' => '081234567891',
            'address' => 'Test Address'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('ppdb', [
            'name' => 'Test Student',
            'nisn' => '1234567890',
            'email' => 'student@test.com'
        ]);
    }
}