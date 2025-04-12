<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\API\ResponseTrait; // Tambahkan ini

class AuthFilter implements FilterInterface
{
    use ResponseTrait; // Tambahkan ini

    protected $response; // Tambahkan ini

    public function __construct()
    {
        $this->response = service('response'); // Inisialisasi response
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->has('user_id')) { // Cek apakah user sudah login atau belum
            return $this->respond([
                'status' => 401,
                'error' => 401,
                'messages' => [
                    'error' => 'Unauthorized',
                ]
            ], 401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu mengubah apa pun di sini
    }
}
