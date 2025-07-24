<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\HomeDetail;
use App\Models\WaitingList;
use App\Models\Payment;

class HistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_their_transaction_history()
    {
        $user = User::find(1);
        $homestay = HomeDetail::factory()->create();

        // Waiting list yang dimiliki user
        $waitingList = WaitingList::factory()
            ->hasAttached($user)
            ->for($homestay)
            ->create();

        // Payment milik user
        $payment = Payment::factory()->create([
            'wlid' => $waitingList->id,
            'user_id' => $user->id,
            'price' => 15,
            'deadline' => '11:03:30',
            'paid' => false,
        ]);

         $response = $this->actingAs($user)->get('/history');

        $response->assertStatus(200);
        $response->assertSee((string) $homestay->name);
        $response->assertSee('1500000');
    }

    public function test_user_cannot_see_others_transaction_history()
{
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $homestay = HomeDetail::factory()->create();

    $waitingList = WaitingList::factory()
        ->hasAttached($user2)
        ->for($homestay)
        ->create();

    $payment = Payment::factory()->create([
        'waiting_list_id' => $waitingList->id,
        'user_id' => $user2->id,
        'amount' => 999999
    ]);

    $response = $this->actingAs($user1)->get('/history');

    $response->assertStatus(200);
    $response->assertDontSee('999999');
    $response->assertDontSee($homestay->name);
}
}
