<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('admin')) {
            return redirect()->to(site_url('admin'));
        }

        return view('auth/login', ['title' => 'Login Admin']);
    }

    public function attempt()
    {
        if (rate_limited('admin-login', 5, 300)) {
            return redirect()->back()->with('error', 'Terlalu banyak percobaan login. Coba lagi 5 menit lagi.');
        }

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Isi email dan password dengan benar.');
        }

        $user = (new UserModel())->where('email', $this->request->getPost('email'))->first();

        // hash pembanding supaya waktu respons sama, baik email terdaftar maupun tidak
        $hash = $user['password_hash'] ?? '$2y$10$a6sQJNSyYI8jFJzf9.UoT.A0tq3XpwqJXY9SttdpDMe7fz10ss9rm';
        $ok   = password_verify((string) $this->request->getPost('password'), $hash) && $user !== null;

        if (! $ok) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        session()->regenerate();
        session()->set('admin', ['id' => $user['id'], 'name' => $user['name']]);

        return redirect()->to(site_url('admin'));
    }

    public function logout()
    {
        session()->remove('admin');
        session()->regenerate(true);

        return redirect()->to(site_url('admin/login'))->with('success', 'Kamu sudah logout.');
    }
}
