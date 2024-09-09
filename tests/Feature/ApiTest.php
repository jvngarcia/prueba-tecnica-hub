<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_status_200(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    public function test_hotelId_required(): void
    {
        $response = $this->post('/api/search', [
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkIn_required(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkOut_required(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_numberOfGuests_required(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_numberOfRooms_required(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_currency_required(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_currency_invalid(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'US',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkIn_invalid(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10 10:00:00',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkOut_invalid(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11 10:00:00',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_numberOfGuests_invalid(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 'a',
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_numberOfRooms_invalid(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 'a',
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_hotelId_integer(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 'a',
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_numberOfGuests_integer(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 'a',
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_numberOfRooms_integer(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 'a',
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkIn_before_checkOut(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-11',
            'checkOut' => '2024-09-10',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkIn_after_today(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => date('Y-m-d', strtotime('+1 day')),
            'checkOut' => '2024-09-10',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkOut_after_checkIn(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-10',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkOut_after_today(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => date('Y-m-d', strtotime('+1 day')),
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_currency_in_array(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'US',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkIn_format(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024/09/10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_checkOut_format(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024/09/11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 'USD',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    public function test_currency_format(): void
    {
        $response = $this->post('/api/search', [
            'hotelId' => 1,
            'checkIn' => '2024-09-10',
            'checkOut' => '2024-09-11',
            'numberOfGuests' => 1,
            'numberOfRooms' => 1,
            'currency' => 1,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }
}
