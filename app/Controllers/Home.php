<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function redirectByRole()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('auth/login');
        }

        switch ($session->get('role')) {
            case 'admin':
                return redirect()->to('admin/dashboard');
            case 'fgstock':
                return redirect()->to('fgstock/tambahfg');
            case 'kasie':
                return redirect()->to('kasie/setttarget');
            case 'monitor':
                return redirect()->to('monitor/view');
            default:
                return redirect()->to('errors/unauthorized');
        }
    }
}
