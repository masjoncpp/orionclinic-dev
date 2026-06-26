<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $db->table('doctors')->update(['status' => 'offline']);

        $session = session();
        if ($session->has('user_id')) {
            $role = $session->get('role');
            return redirect()->to($role === 'doctor' ? '/doctor' : '/patient');
        }
        return view('landing');
    }

    public function mitra()
    {
        return view('mitra');
    }
}
