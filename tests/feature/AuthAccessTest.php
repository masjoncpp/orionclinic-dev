<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class AuthAccessTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'App';
    protected $refresh = false;

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
        $userModel = new \App\Models\UserModel();
        $doctorModel = new \App\Models\DoctorModel();
        $existing = $userModel->where('email', 'doc-access@example.com')->first();
        $userId = $existing ? $existing['id'] : $userModel->insert([
            'name' => 'Dr. Test',
            'email' => 'doc-access@example.com',
            'phone' => '081234567899',
            'password' => 'secret123',
            'role' => 'doctor',
        ]);
        if (!$doctorModel->where('user_id', $userId)->first()) {
            $doctorModel->insert([
                'user_id' => $userId,
                'specialization' => 'Umum',
                'is_verified' => 1,
                'status' => 'online',
            ]);
        }

        $result = $this->withSession([
            'user_id'    => $userId,
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

    public function testChatUpdatesBlocksUnauthorizedUser(): void
    {
        $result = $this->withSession([
            'user_id'    => 99999,
            'role'       => 'patient',
            'isLoggedIn' => true,
        ])->get('/chat/updates?consultation_id=1');

        $result->assertOK();
        $this->assertSame('[]', $result->getJSON());
    }
}
