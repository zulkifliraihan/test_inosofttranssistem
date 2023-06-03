<?php

namespace App\Http\Controllers;

use App\Http\Requests\KendaraanRequest;
use App\Http\Services\KendaraanService;
use App\Models\Kendaraan;
use App\Models\Mobil;
use App\Models\Motor;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    private $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }

    public function index()
    {
        try {
            $kendaraanService = $this->kendaraanService->index();

            return $this->success(
                $kendaraanService['response'],
                $kendaraanService['data'],
            );
        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());
        }
    }

    public function create(KendaraanRequest $request)
    {
        try {
            $kendaraanService = $this->kendaraanService->create($request->all());

            return $this->success(
                $kendaraanService['response'],
                $kendaraanService['data'],
            );
        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());
        }

    }

    public function detail($id)
    {
        try {
            $kendaraanService = $this->kendaraanService->detail($id);

            if (!$kendaraanService['status']) {
                return $this->errorvalidator(null, "ID Not Found", 400);
            }
            return $this->success(
                $kendaraanService['response'],
                $kendaraanService['data'],
            );

        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());

        }
    }

    public function update(KendaraanRequest $request, $id)
    {
        $kendaraanService = $this->kendaraanService->detail($id);

        if (!$kendaraanService['status']) {
            return $this->errorvalidator(null, "ID Not Found", 400);
        }

        try {
            $kendaraanService = $this->kendaraanService->update($id, $request->all());

            return $this->success(
                $kendaraanService['response'],
                $kendaraanService['data'],
            );
        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());
        }

    }

    public function delete($id)
    {
        $kendaraanService = $this->kendaraanService->detail($id);

        if (!$kendaraanService['status']) {
            return $this->errorvalidator(null, "ID Not Found", 400);
        }

        try {
            $kendaraanService = $this->kendaraanService->delete($id);

            return $this->success(
                $kendaraanService['response'],
                $kendaraanService['data'],
            );
        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());
        }

    }

}
