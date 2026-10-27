<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            $role = $session->get('role');
            $routes = ['doctor' => '/doctor', 'farmasi' => '/pharmacy', 'admin' => '/admin'];
            return redirect()->to($routes[$role] ?? '/patient');
        }
        return view('landing');
    }

    public function mitra()
    {
        return view('mitra');
    }
}
