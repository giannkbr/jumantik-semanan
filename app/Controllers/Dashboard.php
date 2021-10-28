<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }
        $staf = $this->staf->selectCount('staf_id')->first();
        $gallery = $this->gallery->selectCount('gallery_id')->first();
        $berita = $this->berita->selectCount('berita_id')->first();
        $data = [
            'title' => 'Admin - Dashboard',
            'staf' => $staf,
            'gallery' => $gallery,
            'berita' => $berita
        ];
        return view('auth/dashboard', $data);
    }
}
