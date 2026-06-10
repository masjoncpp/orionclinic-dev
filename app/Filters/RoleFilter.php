<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $role = $session->get('role');

        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/auth/login')
                ->with('error', 'Silakan masuk terlebih dahulu untuk mengakses fitur layanan klinik.');
        }

        if ($arguments === null || $arguments === []) {
            return redirect()->to($this->defaultRouteForRole($role))
                ->with('error', 'Akses halaman tidak valid.');
        }

        if (! in_array($role, $arguments, true)) {
            return redirect()->to($this->defaultRouteForRole($role))
                ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

    private function defaultRouteForRole(?string $role): string
    {
        return $role === 'doctor' ? '/doctor' : '/patient';
    }
}
