<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creation of a new address
     */
    public function test_can_create_address(): void
    {
        $address = Address::factory()->make();

        $response = $this->actingAs(User::findOrFail($address->user_id))
            ->postJson('/api/addresses', [
                'street' => $address->street,
                'number' => $address->number,
                'complement' => $address->complement,
                'neighborhood' => $address->neighborhood,
                'city' => $address->city,
                'state' => $address->state,
                'zip_code' => $address->zip_code,
                'user_id' => $address->user_id
            ]);

        $this->assertDatabaseHas('addresses', $address->toArray());

        $response->assertCreated();
    }

    /**
     * Test the creation of a new address without being logged in
     */
    public function test_cannot_create_address_without_being_logged_in(): void
    {
        $address = Address::factory()->make();

        $response = $this->postJson('/api/addresses', [
            'street' => $address->street,
            'number' => $address->number,
            'complement' => $address->complement,
            'neighborhood' => $address->neighborhood,
            'city' => $address->city,
            'state' => $address->state,
            'zip_code' => $address->zip_code,
            'user_id' => $address->user_id
        ]);

        $this->assertDatabaseMissing('addresses', $address->toArray());

        $response->assertUnauthorized();
    }

    /**
     * Test the update of an existing address
     */
    public function test_can_update_address(): void
    {
        $address = Address::factory()->create();

        $response = $this->actingAs(User::findOrFail($address->user_id))
            ->putJson("/api/addresses/{$address->id}", [
                'street' => $address->street,
                'number' => $address->number,
                'complement' => $address->complement,
                'neighborhood' => $address->neighborhood,
                'city' => $address->city,
                'state' => $address->state,
                'zip_code' => $address->zip_code,
                'user_id' => $address->user_id
            ]);

        $this
            ->assertDatabaseHas('addresses', $address->toArray())
            ->assertInstanceOf(Address::class, $address);

        $response->assertOk();
    }

    /**
     * Test the update of an existing address without being logged in
     */
    public function test_cannot_update_address_without_being_logged_in(): void
    {
        $address = Address::factory()->create();
        $newAddress = Address::factory()->make();

        $response = $this->putJson("/api/addresses/{$address->id}", [
            'street' => $newAddress->street,
            'number' => $newAddress->number,
            'complement' => $newAddress->complement,
            'neighborhood' => $newAddress->neighborhood,
            'city' => $newAddress->city,
            'state' => $newAddress->state,
            'zip_code' => $newAddress->zip_code,
            'user_id' => $newAddress->user_id
        ]);

        $this
            ->assertDatabaseHas('addresses', $address->toArray())
            ->assertDatabaseMissing('addresses', $newAddress->toArray());

        $response
            ->assertJsonStructure(['message'])
            ->assertUnauthorized();
    }
}
