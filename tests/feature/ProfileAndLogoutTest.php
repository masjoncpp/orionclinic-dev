<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class ProfileAndLogoutTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'App';
    protected $refresh = false;

    public function testPatientProfilePageLoads(): void
    {
        $result = $this->withSession([
            'user_id'    => 10,
            'name'       => 'Pasien Uji',
            'email'      => 'pasien@example.com',
            'phone'      => '081234567890',
            'role'       => 'patient',
            'isLoggedIn' => true,
        ])->get('/patient/profile');

        $result->assertOK();
        $result->assertSee('Profil Saya');
    }

    public function testDoctorProfilePageLoads(): void
    {
        $userModel = new \App\Models\UserModel();
        $doctorModel = new \App\Models\DoctorModel();
        $existing = $userModel->where('email', 'dokter@example.com')->first();
        $userId = $existing ? $existing['id'] : $userModel->insert([
            'name' => 'Dokter Uji',
            'email' => 'dokter@example.com',
            'phone' => '081298765432',
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
            'name'       => 'Dokter Uji',
            'email'      => 'dokter@example.com',
            'phone'      => '081298765432',
            'role'       => 'doctor',
            'isLoggedIn' => true,
        ])->get('/doctor/profile');

        $result->assertOK();
        $result->assertSee('Informasi Kontak');
    }

    public function testLogoutRedirectsToLogin(): void
    {
        $result = $this->withSession([
            'user_id'    => 10,
            'role'       => 'patient',
            'isLoggedIn' => true,
        ])->get('/logout');

        $result->assertRedirectTo('/auth/login');
        $result->assertSessionHas('success');
    }
}
