<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $format = 'json';

    /**
     * POST /api/register
     */
    public function register()
    {
        // Ambil data JSON dari body
        $input = $this->request->getJSON(true);
        // Alternatif: $this->request->getPost() jika form-data

        // Validasi
        $rules = [
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[4]',
        ];

        if (! $this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Hash password
        $passwordHash = password_hash($input['password'], PASSWORD_DEFAULT);

        // Simpan user
        $userModel = new UserModel();
        $userModel->insert([
            'username'      => $input['username'],
            'password_hash' => $passwordHash,
        ]);

        return $this->respondCreated([
            'status'  => 201,
            'message' => 'User registered successfully'
        ]);
    }

    /**
     * POST /api/login
     */
    public function login()
    {
        $input = $this->request->getJSON(true);

        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $username = $input['username'];
        $password = $input['password'];

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        // Cek user
        if (! $user) {
            return $this->failNotFound('User not found');
        }

        // Verifikasi password
        if (! password_verify($password, $user['password_hash'])) {
            return $this->failUnauthorized('Invalid password');
        }

        // Set session
        session()->set([
            'logged_in' => true,
            'user_id'   => $user['id'],
            'username'  => $user['username'],
        ]);

        return $this->respond([
            'status'  => 200,
            'message' => 'Login successful',
            'user'    => [
                'id'       => $user['id'],
                'username' => $user['username'],
            ],
        ]);
    }

    /**
     * GET /api/logout
     */
    public function logout()
    {
        session()->destroy();
        return $this->respond([
            'status'  => 200,
            'message' => 'Logged out successfully'
        ]);
    }
}
