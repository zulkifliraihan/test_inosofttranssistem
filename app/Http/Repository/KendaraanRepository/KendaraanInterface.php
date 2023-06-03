<?php
namespace App\Http\Repository\KendaraanRepository;

interface KendaraanInterface {
    public function index(): ?object;
    public function create($data): object;
    public function createAttribute($latestCreated, $model, $data): object;
    public function detail($id): ?object;
    public function update($id, $data): object;
    public function updateAttribute($latestKendaraan, $data): object;
    public function delete($id): object;
    public function deleteAttribute($latestKendaraan): bool;
}
