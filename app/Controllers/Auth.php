<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }
        return view('auth/login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'username' => $user['username'],
                'role'     => $user['role'],
                'logged_in' => true
            ]);

            // Redirect by role
            switch ($user['role']) {
                case 'admin':
                    return redirect()->to('admin/dashboard');
                case 'fgstock':
                    return redirect()->to('fgstock/valpc');
                case 'kasie':
                    return redirect()->to('kasie/setttarget');
                case 'monitor':
                    return redirect()->to('monitor/view');
                default:
                    return redirect()->to('errors/unauthorized');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }
    public function unauthorized()
    {
        return view('errors/unauthorized');
    }
}
