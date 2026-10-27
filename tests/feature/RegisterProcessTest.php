<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class RegisterProcessTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'App';
    protected $basePath = APPPATH . 'Database';
    protected $refresh = false;

    public function testRegisterCreatesPatientAccount(): void
    {
        $email = 'test-pasien-' . uniqid() . '@example.com';
        $result = $this->post('/auth/register', [
            'name'     => 'Test Pasien',
            'email'    => $email,
            'phone'    => '081234567890',
            'password' => 'rahasia123',
        ]);

        $result->assertRedirectTo('/auth/login');
        $result->assertSessionHas('success');

        $this->seeInDatabase('users', [
            'name'  => 'Test Pasien',
            'email' => $email,
            'role'  => 'patient',
            'phone' => '081234567890',
        ]);
    }
}
