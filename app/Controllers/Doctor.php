<?php namespace App\Controllers;

class Doctor extends BaseController
{
    public function index()        { return view('doctor/dashboard',    ['role' => 'doctor', 'title' => 'Dashboard Dokter']); }
    public function consultation() { return view('doctor/consultation', ['role' => 'doctor', 'title' => 'Jadwal Dokter']); }
    public function patients()     { return view('doctor/patients',     ['role' => 'doctor', 'title' => 'Data Pasien']); }
    public function profile()      { return view('doctor/profile',      ['role' => 'doctor', 'title' => 'Profil Dokter']); }
    public function chat()         { return view('doctor/chat',         ['role' => 'doctor', 'hide_sidebar' => true, 'title' => 'Chat Pasien']); }
}
