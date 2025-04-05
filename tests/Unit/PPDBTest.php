<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\PPDB;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PPDBTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_ppdb_application()
    {
        $ppdbData = [
            'registration_number' => 'REG' . rand(10000000, 99999999),
            'name' => 'Test Student',
            'nisn' => '1234567890',
            'email' => 'test@example.com',
            'phone' => '081234567890',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',
            'gender' => 'male',
            'previous_school' => 'SMP Test',
            'parent_name' => 'Parent Test',
            'parent_phone' => '081234567891',
            'address' => 'Test Address',
            'status' => 'pending'
        ];

        $ppdb = PPDB::create($ppdbData);

        $this->assertDatabaseHas('ppdb', [
            'name' => 'Test Student',
            'nisn' => '1234567890'
        ]);
    }

    public function test_ppdb_status_is_pending_by_default()
    {
        $ppdb = PPDB::create([
            'registration_number' => 'REG' . rand(10000000, 99999999),
            'name' => 'Test Student',
            'nisn' => '1234567891',
            'email' => 'test2@example.com',
            'phone' => '081234567892',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',
            'gender' => 'male',
            'previous_school' => 'SMP Test',
            'parent_name' => 'Parent Test',
            'parent_phone' => '081234567893',
            'address' => 'Test Address'
        ]);

        $this->assertEquals('pending', $ppdb->status);
    }

    public function test_can_update_ppdb_status()
    {
        $ppdb = PPDB::create([
            'registration_number' => 'REG' . rand(10000000, 99999999),
            'name' => 'Test Student',
            'nisn' => '1234567892',
            'email' => 'test3@example.com',
            'phone' => '081234567894',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',
            'gender' => 'male',
            'previous_school' => 'SMP Test',
            'parent_name' => 'Parent Test',
            'parent_phone' => '081234567895',
            'address' => 'Test Address',
            'status' => 'pending'
        ]);

        $ppdb->update(['status' => 'accepted']);
        $this->assertEquals('accepted', $ppdb->status);
    }
}
