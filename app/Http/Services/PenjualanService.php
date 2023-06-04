<?php
namespace App\Http\Services;

use App\Http\Repository\KendaraanRepository\KendaraanInterface;
use App\Http\Repository\PenjualanRepository\PenjualanInterface;
use App\Http\Repository\StokRepository\StokInterface;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

class PenjualanService {
    private $penjualanInterface;
    private $kendaraanInterface;
    private $stokInterface;

    public function __construct(
        PenjualanInterface $penjualanInterface,
        KendaraanInterface $kendaraanInterface,
        StokInterface $stokInterface
    )
    {
        $this->penjualanInterface = $penjualanInterface;
        $this->kendaraanInterface = $kendaraanInterface;
        $this->stokInterface = $stokInterface;
    }

    public function index(): array
    {

        $penjualan = $this->penjualanInterface->index();

        $return = [
            'status' => 'success',
            'response' => 'get',
            'data' => $penjualan
        ];

        return $return;
    }

    public function create($data): array
    {
        $return = [];

        $penjualan = $this->penjualanInterface->create($data);

        $recentStok = (int) $penjualan->kendaraan->stok->stok - (int) $data['jumlah_terjual'];

        $updateStok = $this->stokInterface->update($penjualan->kendaraan->stok->id, ['stok' => $recentStok]);

        $return = [
            'status' => 'success',
            'response' => 'created',
            'data' => $penjualan->load(['kendaraan.kendaraanable', 'kendaraan.stok', 'customer'])
        ];

        return $return;


    }

    public function detail($id): array
    {
        $penjualan = $this->penjualanInterface->detail($id);

        if (!$penjualan) {
            $return = [
                'status' => 'failed'
            ];
        }
        else {
            $return = [
                'status' => 'success',
                'response' => 'get',
                'data' => $penjualan
            ];
        }

        return $return;
    }

    public function update($id, $data): array
    {

        $penjualanById = $this->penjualanInterface->detail($id);

        if (!$penjualanById) {
            $return = [
                'status' => 'failed'
            ];
        }
        else {
            if (array_key_exists("jumlah_terjual", $data)) {
                $lastStok = $penjualanById->kendaraan->stok->stok;
                $lastJumlahTerjuan = $penjualanById->jumlah_terjual;

                $stok = $lastStok + $lastJumlahTerjuan;
                $recentStok = $stok - $data['jumlah_terjual'];

                $updateStok = $this->stokInterface->update($penjualanById->kendaraan->stok->id, ['stok' => $recentStok]);
            }

            $penjualan = $this->penjualanInterface->update($id, $data);

            $return = [
                'status' => 'success',
                'response' => 'updated',
                'data' => $penjualan
            ];
        }

        return $return;
    }

    public function delete($id): array
    {

        $penjualanById = $this->penjualanInterface->detail($id);

        if (!$penjualanById) {
            $return = [
                'status' => 'failed'
            ];
        }
        else {
            $lastStok = $penjualanById->kendaraan->stok->stok;
                $lastJumlahTerjuan = $penjualanById->jumlah_terjual;

                $recentStok = $lastStok + $lastJumlahTerjuan;

                $updateStok = $this->stokInterface->update($penjualanById->kendaraan->stok->id, ['stok' => $recentStok]);


            $penjualan = $this->penjualanInterface->delete($id);

            $return = [
                'status' => 'success',
                'response' => 'deleted',
                'data' => $penjualan
            ];
        }

        return $return;
    }

    public function laporan($data)
    {
        $tahun = Carbon::now()->format('Y');

        $laporan = $this->penjualanInterface->raw();
        if (array_key_exists("kendaraan", $data) ) {
            $laporan->where('kendaraan_id', $data['kendaraan']);
        }

        if (array_key_exists("tahun", $data)) {
            $tahun = (int) $data['tahun'];

            $startDate = new UTCDateTime(strtotime("$tahun-01-01") * 1000);
            $endDate = new UTCDateTime(strtotime("$tahun-12-31 +1 day") * 1000);
            $laporan->where('tanggal', '>=', $startDate)->where('tanggal', '<', $endDate);
        }

        if (array_key_exists("bulan", $data) ) {
            $bulan = $data['bulan'];

            $startDate = new UTCDateTime(strtotime("$tahun-$bulan-01") * 1000);
            $endDate = new UTCDateTime(strtotime("$tahun-$bulan-01 +1 month -1 day") * 1000);
            $laporan->where('tanggal', '>=', $startDate)->where('tanggal', '<=', $endDate);
        }

        $return = [
            'status' => 'success',
            'response' => 'get',
            'data' => $laporan->get()
        ];

        return $return;
    }


}
