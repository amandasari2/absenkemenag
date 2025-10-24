<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika belum login
        if (!session()->get('log')) {
            session()->setFlashdata('pesan', 'Anda Belum Login');
            return redirect()->to(base_url('login'));
        }
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Jika sudah login dan coba akses login lagi, redirect ke dashboard
        if (session()->get('log')) {
            return redirect()->to(base_url('dashboard'));
        }
    }
}
