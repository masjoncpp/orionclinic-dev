<?php namespace App\Controllers;

class Patient extends BaseController
{
    public function index()        { return view('patient/home',         ['title' => 'Beranda - Orion Clinic']); }
    public function consultation() { return view('patient/consultation', ['title' => 'Konsultasi - Orion Clinic']); }
    public function prescription() { return view('patient/prescription', ['title' => 'Resep Obat - Orion Clinic']); }
    public function history()      { return view('patient/history',      ['title' => 'Riwayat - Orion Clinic']); }
    public function profile()      { return view('patient/profile',      ['title' => 'Profil - Orion Clinic']); }
    public function chat()         { return view('patient/chat',         ['title' => 'Chat Dokter - Orion Clinic', 'hide_sidebar' => true]); }
    public function wellness()     { return view('patient/wellness',     ['title' => 'Wellness - Orion Clinic']); }
}
