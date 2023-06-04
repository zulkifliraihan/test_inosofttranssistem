<?php
namespace App\Http\Repository\PenjualanRepository;

use App\Models\Penjualan;

class PenjualanRepository implements PenjualanInterface {
    private $penjualan;

    public function __construct(Penjualan $penjualan)
    {
        $this->penjualan = $penjualan->with('kendaraan.kendaraanable', 'kendaraan.stok', 'customer');
    }

    public function raw(): object
    {
        return $this->penjualan;
    }

    public function index(): ?object
    {
        $penjualan = $this->penjualan->get();

        return $penjualan;
    }

    public function create($data): object
    {
        $return = [];

        $penjualan = $this->penjualan->firstOrCreate($data);

        return $penjualan;

    }

    public function detail($id): ?object
    {
        $penjualan = $this->penjualan->find($id);

        return $penjualan;
    }

    public function update($id, $data): object
    {
        $penjualan = $this->penjualan->find($id);

        $penjualan->update($data);

        return $penjualan;
    }

    public function delete($id): object
    {
        $penjualan = $this->penjualan->find($id);

        $penjualan->delete();

        return $penjualan;
    }


}
