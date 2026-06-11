<?php

namespace App\Controllers;

use App\Models\UserModel;
use Throwable;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            $role = session()->get('role');
            return ($role === 'doctor')
                ? redirect()->to('/doctor')
                : redirect()->to('/patient');
        }
        return view('auth/login', ['hide_sidebar' => true, 'title' => 'Masuk - Orion Clinic']);
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            $role = session()->get('role');

            return $role === 'doctor'
                ? redirect()->to('/doctor')
                : redirect()->to('/patient');
        }

        return view('auth/register', ['hide_sidebar' => true, 'title' => 'Daftar Akun - Orion Clinic']);
    }

    public function processRegister()
    {
        $model = new UserModel();

        $data = [
            'name'     => trim((string) $this->request->getPost('name')),
            'email'    => trim((string) $this->request->getPost('email')),
            'phone'    => trim((string) $this->request->getPost('phone')),
            'password' => (string) $this->request->getPost('password'),
            'role'     => 'patient',
        ];

        try {
            $saved = $model->save($data);
        } catch (Throwable $exception) {
            log_message('error', 'Register failed because the user store is unavailable: {message}', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Pendaftaran belum dapat diproses karena koneksi database belum tersedia.');
        }

        if (! $saved) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $model->errors());
        }

        // Create Patient Profile
        $userId = $model->getInsertID();
        $patientModel = new \App\Models\PatientModel();
        $patientModel->save([
            'user_id' => $userId,
            'gender'  => 'male', // default
        ]);

        return redirect()->to('/auth/login')->with('success', 'Pendaftaran Akun berhasil. Silahkan masuk dengan akun baru Anda!');
    }

    public function processLogin()
    {
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email dan kata sandi wajib diisi.');
        }

        $model = new UserModel();
        try {
            $user = $model->where('email', $email)->first();
        } catch (Throwable $exception) {
            log_message('error', 'Login failed because the user store is unavailable: {message}', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Login belum dapat diproses karena koneksi database belum tersedia.');
        }

        if ($user && password_verify($password, $user['password'])) {
            session()->regenerate();

            session()->set([
                'user_id'    => $user['id'],
                'name'       => $user['name'],
                'email'      => $user['email'],
                'phone'      => $user['phone'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ]);

            return $user['role'] === 'doctor'
                ? redirect()->to('/doctor')
                : redirect()->to('/patient');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Email atau kata sandi yang Anda masukkan salah!');
    }

    public function logout()
    {
        if (session()->get('isLoggedIn')) {
            session()->destroy();
        }

        return redirect()->to('/auth/login')->with('success', 'Anda berhasil logout!');
    }
}
