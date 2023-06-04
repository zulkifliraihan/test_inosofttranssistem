<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenjualanRequest;
use App\Http\Services\PenjualanService;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{

    private $penjualanService;

    public function __construct(PenjualanService $penjualanService)
    {
        $this->penjualanService = $penjualanService;
    }

    public function index()
    {
        try {
            $penjualanService = $this->penjualanService->index();

            return $this->success(
                $penjualanService['response'],
                $penjualanService['data'],
            );

        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());

        }
    }

    public function create(PenjualanRequest $penjualanRequest)
    {
        try {
            $penjualanService = $this->penjualanService->create($penjualanRequest->all());

            return $this->success(
                $penjualanService['response'],
                $penjualanService['data'],
            );

        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());

        }
    }

    public function detail($id)
    {
        try {
            $penjualanService = $this->penjualanService->detail($id);

            if ($penjualanService['status'] == "failed") {
                return $this->errorvalidator(null, "ID Not Found", 400);
            }
            return $this->success(
                $penjualanService['response'],
                $penjualanService['data'],
            );

        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());

        }
    }

    public function update($id, PenjualanRequest $penjualanRequest)
    {
        try {
            $penjualanService = $this->penjualanService->update($id, $penjualanRequest->all());

            if ($penjualanService['status'] == "failed") {
                return $this->errorvalidator(null, "ID Not Found", 400);
            }

            return $this->success(
                $penjualanService['response'],
                $penjualanService['data'],
            );

        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());

        }
    }

    public function delete($id)
    {
        try {
            $penjualanService = $this->penjualanService->delete($id);

            if ($penjualanService['status'] == "failed") {
                return $this->errorvalidator(null, "ID Not Found", 400);
            }

            return $this->success(
                $penjualanService['response'],
                $penjualanService['data'],
            );

        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());

        }
    }

    public function laporan(Request $request)
    {
        try {
            $penjualanService = $this->penjualanService->laporan($request->all());

            return $this->success(
                $penjualanService['response'],
                $penjualanService['data'],
            );

        } catch (\Throwable $th) {
            return $this->errorServer($th->getMessage());

        }
    }

}
