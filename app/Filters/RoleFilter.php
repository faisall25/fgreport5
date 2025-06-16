<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $currentPath = $request->uri->getPath(); // misalnya "auth/login"

        // Bypass filter untuk halaman login dan unauthorized
        $bypassPaths = ['auth/login', 'auth', 'unauthorized'];

        if (in_array($currentPath, $bypassPaths)) {
            return; // Lanjut ke controller
        }
        // if (str_starts_with($currentPath, 'auth') || str_starts_with($currentPath, 'errors')) {
        //     return; // Lewatkan
        // }

        // Cek login
        if (!$session->has('role')) {
            return redirect()->to('auth/login');
        }
        if (!$session->get('logged_in')) {
            return redirect()->to('auth/login');
        }

        // Cek role
        if ($arguments && !in_array($session->get('role'), $arguments)) {
            return redirect()->to('errors/unauthorized');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak digunakan
    }
}
