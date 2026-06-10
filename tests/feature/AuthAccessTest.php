<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class AuthAccessTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testGuestIsRedirectedToLoginWhenOpeningPatientArea(): void
    {
        $result = $this->get('/patient');

        $result->assertRedirectTo('/auth/login');
    }

    public function testPatientCannotOpenDoctorArea(): void
    {
        $result = $this->withSession([
            'user_id'    => 10,
            'role'       => 'patient',
            'isLoggedIn' => true,
        ])->get('/doctor');

        $result->assertRedirectTo('/patient');
    }

    public function testDoctorCannotOpenPatientArea(): void
    {
        $result = $this->withSession([
            'user_id'    => 20,
            'role'       => 'doctor',
            'isLoggedIn' => true,
        ])->get('/patient');

        $result->assertRedirectTo('/doctor');
    }

    public function testDoctorCanOpenDoctorArea(): void
    {
        $result = $this->withSession([
            'user_id'    => 20,
            'role'       => 'doctor',
            'isLoggedIn' => true,
        ])->get('/doctor');

        $result->assertOK();
    }

    public function testPatientCanOpenPatientArea(): void
    {
        $result = $this->withSession([
            'user_id'    => 10,
            'role'       => 'patient',
            'isLoggedIn' => true,
        ])->get('/patient');

        $result->assertOK();
    }
}
