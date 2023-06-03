<?php
namespace App\Http\Repository\StokRepository;

use App\Models\Stok;

class StokRepository implements StokInterface {
    private $stok;

    public function __construct(Stok $stok)
    {
        $this->stok = $stok;
    }

    public function index(): ?object
    {
        $data = $this->stok->get();

        return $data;
    }

    public function create($data): object
    {
        $create = $this->stok->create($data);

        return $create;
    }

    public function detail($id): ?object
    {
        $data = $this->stok->find($id);

        return $data;
    }

    public function update($id, $data): object
    {
        $update = $this->stok->find($id);
        $update->update($data);

        return $update;
    }

    public function delete($id): object
    {
        $delete = $this->stok->find($id);
        $delete->delete();
        return $delete;
    }
}
