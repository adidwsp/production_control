<?php

namespace App\Controllers;

use App\Models\PartListModel;
use CodeIgniter\RESTful\ResourceController;

class PartListController extends ResourceController
{
    protected $modelName = PartListModel::class;
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
            'part_no'   => 'required',
            'part_name' => 'required'
            // Tambahkan validasi lain jika perlu
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Simpan data
        $this->model->insert($input);

        return $this->respondCreated([
            'status'  => 201,
            'message' => 'PartList created successfully',
            'data'    => $input
        ]);
    }

    /**
     * Menampilkan detail satu part (GET /partlists/{part_no})
     */
    public function show($partNo = null)
    {
        $data = $this->model->find($partNo);
        if (!$data) {
            return $this->failNotFound("PartList with part_no $partNo not found");
        }
        return $this->respond($data);
    }

    /**
     * Update data (PUT or PATCH /partlists/{part_no})
     */
    public function update($partNo = null)
    {
        $input = $this->request->getJSON(true);
        // Cek apakah data ada
        $existing = $this->model->find($partNo);
        if (!$existing) {
            return $this->failNotFound("PartList with part_no $partNo not found");
        }

        // Lakukan update
        $this->model->update($partNo, $input);

        return $this->respond([
            'status'  => 200,
            'message' => 'PartList updated successfully',
            'data'    => $input
        ]);
    }

    /**
     * Hapus data (DELETE /partlists/{part_no})
     */
    public function delete($partNo = null)
    {
        $existing = $this->model->find($partNo);
        if (!$existing) {
            return $this->failNotFound("PartList with part_no $partNo not found");
        }

        $this->model->delete($partNo);
        return $this->respondDeleted([
            'status'  => 200,
            'message' => "PartList with part_no $partNo deleted successfully"
        ]);
    }
}
