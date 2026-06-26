<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class AuthPageTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testLoginPageLoads(): void
    {
        $result = $this->get('/auth/login');

        $result->assertOK();
        $result->assertSee('Masuk ke akun Orion Clinic Anda');
    }

    public function testRegisterPageLoads(): void
    {
        $result = $this->get('/auth/register');

        $result->assertOK();
        $result->assertSee('Daftar untuk mulai menggunakan Orion Clinic');
    }

    public function testLoginRejectsEmptyCredentials(): void
    {
        $result = $this->post('/auth/login', [
            'email'    => '',
            'password' => '',
        ]);

        $result->assertRedirect();
        $result->assertSessionHas('error');
    }

    public function testRegisterRejectsInvalidPayload(): void
    {
        $result = $this->post('/auth/register', [
            'name'     => '',
            'email'    => '',
            'phone'    => '',
            'password' => '',
        ]);

        $result->assertRedirect();
        $result->assertSessionHas('errors');
    }
}
