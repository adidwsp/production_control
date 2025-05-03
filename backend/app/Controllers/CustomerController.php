<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\RESTful\ResourceController;

class CustomerController extends ResourceController
{
    protected $modelName = CustomerModel::class;
    protected $format    = 'json';

    /**
     * Menampilkan semua part_lists (GET /partlists)
     */
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    /**
     * Menyimpan data baru (POST /partlists)
     */
    public function create()
    {
        $input = $this->request->getJSON(true);
        // Atau $this->request->getPost() jika form-data

        if (!$this->validate([
            'customer_name'   => 'required'
            // Tambahkan validasi lain jika perlu
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Simpan data
        $this->model->insert($input);

        return $this->respondCreated([
            'status'  => 201,
            'message' => 'Customer created successfully',
            'data'    => $input
        ]);
    }

    /**
     * Menampilkan detail satu part (GET /partlists/{part_no})
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound("Customer with id $id not found");
        }
        return $this->respond($data);
    }

    /**
     * Update data (PUT or PATCH /partlists/{part_no})
     */
    public function update($id = null)
    {
        $input = $this->request->getJSON(true);
        // Cek apakah data ada
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->failNotFound("Customer with id $id not found");
        }

        // Lakukan update
        $this->model->update($id, $input);

        return $this->respond([
            'status'  => 200,
            'message' => 'PartList updated successfully',
            'data'    => $input
        ]);
    }

    /**
     * Hapus data (DELETE /partlists/{part_no})
     */
    public function delete($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->failNotFound("Customer with id $id not found");
        }

        $this->model->delete($id);
        return $this->respondDeleted([
            'status'  => 200,
            'message' => "Customer with id $id deleted successfully"
        ]);
    }
}
