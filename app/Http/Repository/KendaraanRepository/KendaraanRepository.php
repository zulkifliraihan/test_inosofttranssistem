<?php
namespace App\Http\Repository\KendaraanRepository;

use App\Models\Kendaraan;

class KendaraanRepository implements KendaraanInterface {
    private $kendaraan;

    public function __construct(Kendaraan $kendaraan)
    {
        $this->kendaraan = $kendaraan->with('kendaraanable', 'stok');
    }

    public function index(): ?object
    {
        $data = $this->kendaraan->get();

        return $data;
    }

    public function create($data): object
    {
        $data = $this->kendaraan->create($data);

        return $data;
    }

    public function createAttribute($latestCreated, $model, $data): object
    {
        $attribute = $model->create($data);

        $latestCreated->kendaraanable()->associate($attribute);
        $latestCreated->save();

        return $latestCreated;
    }

    public function detail($id): ?object
    {
        $data = $this->kendaraan->find($id);

        return $data;
    }

    public function update($id, $data): object
    {
        $update = $this->kendaraan->find($id);
        $update->update($data);

        return $update;
    }

    public function updateAttribute($latestKendaraan, $data): object
    {
        $update = $latestKendaraan->kendaraanable();
        $update->update($data);

        return $update;
    }

    public function delete($id): object
    {
        $delete = $this->kendaraan->find($id);
        $delete->delete();
        return $delete;
    }

    public function deleteAttribute($latestKendaraan): bool
    {
        $latestKendaraan->kendaraanable()->delete();

        return true;
    }
}
