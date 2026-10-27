<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_senior_regular_employee_payroll_values_are_correct(): void
    {
        $response = $this->postJson('/api/employment', [
            'employmentType' => 'regular',
            'positionTier' => 'senior',
            'daysAbsent' => 1,
            'minutesLate' => 30,
            'overtimeHours' => 10,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('overtimePay', 2840.91)
            ->assertJsonPath('lateDeduction', 113.64)
            ->assertJsonPath('grossPay', 40909.09);
    }
}
