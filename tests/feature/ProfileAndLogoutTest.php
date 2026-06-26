<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class ProfileAndLogoutTest extends CIUnitTestCase
{
    use FeatureTestTrait;

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
        $result = $this->withSession([
            'user_id'    => 20,
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
