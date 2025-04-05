<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\PPDB;
use App\Models\User;
use App\Notifications\PPDBAcceptedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_ppdb_accepted_notification()
    {
        Notification::fake();

        $ppdb = PPDB::create([
            'registration_number' => 'REG' . rand(10000000, 99999999),
            'name' => 'Test Student',
            'nisn' => '1234567893',
            'email' => 'test4@example.com',
            'phone' => '081234567896',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',
            'gender' => 'male',
            'previous_school' => 'SMP Test',
            'parent_name' => 'Parent Test',
            'parent_phone' => '081234567897',
            'address' => 'Test Address',
            'status' => 'accepted'
        ]);

        $user = User::create([
            'name' => $ppdb->name,
            'email' => $ppdb->email,
            'password' => bcrypt('password'),
            'role' => 'student',
            'gender' => $ppdb->gender,
            'is_active' => true
        ]);

        $user->notify(new PPDBAcceptedNotification($ppdb));

        Notification::assertSentTo(
            $user,
            PPDBAcceptedNotification::class,
            function ($notification) use ($ppdb) {
                return $notification->getPpdb()->id === $ppdb->id;
            }
        );
    }
}