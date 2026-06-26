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

    public function testRegisterCreatesPatientAccount(): void
    {
        $result = $this->post('/auth/register', [
            'name'     => 'Test Pasien',
            'email'    => 'test-pasien@example.com',
            'phone'    => '081234567890',
            'password' => 'rahasia123',
        ]);

        $result->assertRedirectTo('/auth/login');
        $result->assertSessionHas('success');

        $this->seeInDatabase('users', [
            'name'  => 'Test Pasien',
            'email' => 'test-pasien@example.com',
            'role'  => 'patient',
            'phone' => '081234567890',
        ]);
    }
}
