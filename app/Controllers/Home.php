<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('patient/home', ['hide_sidebar' => true, 'title' => 'Home - Orion Clinic']);
    }
}
