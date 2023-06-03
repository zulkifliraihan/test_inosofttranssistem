<?php
namespace App\Http\Services;

use App\Http\Repository\KendaraanRepository\KendaraanInterface;
use App\Http\Repository\StokRepository\StokInterface;
use App\Models\Mobil;
use App\Models\Motor;

class KendaraanService {
    private $kendaraanInterface;
    private $stokInterface;

    public function __construct(
        KendaraanInterface $kendaraanInterface,
        StokInterface $stokInterface,
    )
    {
        $this->kendaraanInterface = $kendaraanInterface;
        $this->stokInterface = $stokInterface;
    }

    public function index(): array
    {
        $kendaraan = $this->kendaraanInterface->index();

        $return = [
            'status' => true,
            'response' => 'get',
            'data' => $kendaraan
        ];

        return $return;
    }

    public function create($data): array
    {
        $return = [];
        $create = $this->kendaraanInterface->create($data);

        $model = null;

        if ($data['jenis'] == 'motor') {
            $model = new Motor();
        }
        elseif ($data['jenis'] === 'mobil') {
            $model = new Mobil();
        }

        $attribute = $this->kendaraanInterface->createAttribute($create, $model, $data['attribute']);

        $dataStok = [
            'kendaraan_id' => $create->_id,
            'stok' => $data['stok'],
        ];

        $stok = $this->stokInterface->create($dataStok);

        $return = [
            'status' => true,
            'response' => 'created',
            'data' => $create
        ];

        return $return;
    }

    public function detail($id): array
    {
        $kendaraan = $this->kendaraanInterface->detail($id);

        if (!$kendaraan) {
            $return = [
                'status' => false
            ];
        }
        else {
            $return = [
                'status' => true,
                'response' => 'get',
                'data' => $kendaraan
            ];
        }

        return $return;
    }

    public function update($id, $data): array
    {
        $return = [];

        $kendaraan = $this->kendaraanInterface->detail($id);
        if (array_key_exists("jenis", $data)) {

            if ($data['jenis'] != $kendaraan->jenis) {
                $deleteAttribute = $this->kendaraanInterface->deleteAttribute($kendaraan);

                if ($data['jenis'] == 'motor') {
                    $model = new Motor();
                }
                elseif ($data['jenis'] === 'mobil') {
                    $model = new Mobil();
                }

                $attribute = $this->kendaraanInterface->createAttribute($kendaraan, $model, $data['attribute']);
            }
            else {
                $deleteAttribute = $this->kendaraanInterface->updateAttribute($kendaraan, $data['attribute']);
            }
        }

        if (array_key_exists("stok", $data)) {
            $this->stokInterface->update($kendaraan->stok->id, ['stok' => $data['stok']]);
        }
        $update = $this->kendaraanInterface->update($id, $data);

        $return = [
            'status' => true,
            'response' => 'updated',
            'data' => $update
        ];

        return $return;
    }

    public function delete($id): array
    {
        $kendaraan = $this->kendaraanInterface->detail($id);
        $deleteAttribute = $this->kendaraanInterface->deleteAttribute($kendaraan);
        $deleteStok = $this->stokInterface->delete($kendaraan->stok->id);

        $delete = $this->kendaraanInterface->delete($id);

        $return = [
            'status' => true,
            'response' => 'deleted',
            'data' => $delete
        ];

        return $return;
    }

}
