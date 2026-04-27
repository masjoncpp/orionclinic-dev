<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register', ['hide_sidebar' => true, 'title' => 'Daftar Akun - Orion Clinic']);
    }

    public function processRegister()
    {
        $model = new UserModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'password' => $this->request->getPost('password'),
            'role'     => 'patient',
        ];

        if (!$model->save($data)) {
            return view('auth/register', [
                'hide_sidebar' => true,
                'title'        => 'Daftar Akun - Orion Clinic',
                'validation'   => $model->errors()
            ]);
        }

        // Simpan notifikasi sukses di session agar muncul saat dialihkan
        return redirect()->to('auth/login')->with('success', 'Pendaftaran berhasil. Silakan coba masuk dengan akun baru Anda!');
    }

    public function processLogin()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'user_id'    => $user['id'],
                'name'       => $user['name'],
                'email'      => $user['email'],
                'phone'      => $user['phone'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ];
            session()->set($sessionData);
            
            if ($user['role'] == 'doctor') {
                return redirect()->to('/doctor');
            }
            return redirect()->to('/patient');
        }

        return redirect()->to('auth/login')->with('error', 'Email atau kata sandi yang Anda masukkan salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login')->with('success', 'Anda telah berhasil keluar.');
    }
}
