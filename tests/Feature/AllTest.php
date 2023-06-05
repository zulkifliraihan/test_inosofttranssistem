<?php

namespace Tests\Feature;

use App\Helpers\Generate;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AllTest extends TestCase
{
    /**
     * A kendaraan feature test get all.
     *
     * @return void
     */
    public function test_GetAllKendaraan()
    {
        $response = $this->get('/api/kendaraan');

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A kendaraan feature test create.
     *
     * @return void
     */
    public function test_CreateKendaraan()
    {
        $data = [
            "tahun_keluaran"=> "2023",
            "warna"=> "Hitam",
            "harga"=> 700000000,
            "jenis"=> "mobil",
            "attribute"=> [
                "kapasitas_penumpang"=> 5,
                "mesin"=> "2000cc",
                "tipe" => "Matic"
            ],
            "stok" => 100
        ];

        $response = $this->post('/api/kendaraan', $data);

        $response->assertStatus(201);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);

        // $dataRespons
        $dataCreate = $responseData['data'];

        return $dataCreate;
    }

    /**
     * A kendaraan feature test detail.
     *
     * @return void
     */
    public function test_DetailKendaraan()
    {
        $kendaraan = $this->test_CreateKendaraan();

        $response = $this->get('/api/kendaraan/' . $kendaraan['_id']);

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A kendaraan feature test update.
     *
     * @return void
     */
    public function test_UpdateKendaraan()
    {
        $kendaraan = $this->test_CreateKendaraan();

        $data = [
            "tahun_keluaran"=> "2022",
            "warna"=> "Pink",
            "harga"=> 70000000,
        ];

        $response = $this->put('/api/kendaraan/' . $kendaraan['_id'], $data);

        $response->assertStatus(201);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A kendaraan feature test delete.
     *
     * @return void
     */
    public function test_DeleteKendaraan()
    {
        $kendaraan = $this->test_CreateKendaraan();

        $response = $this->delete('/api/kendaraan/' . $kendaraan['_id']);

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A customer feature test get all.
     *
     * @return void
     */
    public function test_GetAllCustomer()
    {
        $response = $this->get('/api/customer');

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A customer feature test create.
     *
     * @return void
     */
    public function test_CreateCustomer()
    {
        $data = [
            "name" => "Fadhil D Maulana",
            "address" => "Jakarta",
            "phone" => "6285155030102"
        ];

        $response = $this->post('/api/customer', $data);

        $response->assertStatus(201);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);

        $createId = $responseData['data'];

        return $createId;
    }

    /**
     * A customer feature test detail.
     *
     * @return void
     */
    public function test_DetailCustomer()
    {

        $customer = $this->test_CreateCustomer();

        $response = $this->get('/api/customer/' . $customer['_id']);

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A customer feature test update.
     *
     * @return void
     */
    public function test_UpdateCustomer()
    {
        $customer = $this->test_CreateCustomer();

        $data = [
            "name" => "Zulkifli Raihan",
            "address" => "Jakarta",
            "phone" => "6285155030102"
        ];

        $response = $this->put('/api/customer/' . $customer['_id'], $data);

        $response->assertStatus(201);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A customer feature test delete.
     *
     * @return void
     */
    public function test_DeleteCustomer()
    {
        $customer = $this->test_CreateCustomer();

        $response = $this->delete('/api/customer/' . $customer['_id']);

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A penjualan feature test get all.
     *
     * @return void
     */
    public function test_GetAllPenjualan()
    {
        $response = $this->get('/api/penjualan');

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A penjualan feature test create.
     *
     * @return void
     */
    public function test_CreatePenjualan()
    {
        $kendaraan = $this->test_CreateKendaraan();
        $customer = $this->test_CreateCustomer();
        $tipePembayaran = Generate::tipePembayaran();

        $data = [
            "kendaraan_id" => $kendaraan['_id'],
            "customer_id" => $customer['_id'],
            "tanggal" => Carbon::now()->format('Y/m/d'),
            "jumlah_terjual" => rand(1,20),
            "tipe_pembayaran" => $tipePembayaran
        ];

        $response = $this->post('/api/penjualan', $data);

        $response->assertStatus(201);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);

        $createId = $responseData['data'];

        return $createId;
    }

    /**
     * A penjualan feature test detail.
     *
     * @return void
     */
    public function test_DetailPenjualan()
    {

        $penjualan = $this->test_CreatePenjualan();

        $response = $this->get('/api/penjualan/' . $penjualan['_id']);

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A penjualan feature test update.
     *
     * @return void
     */
    public function test_UpdatePenjualan()
    {
        $penjualan = $this->test_CreatePenjualan();

        $data = [
            "jumlah_terjual" => 1,
        ];

        $response = $this->put('/api/penjualan/' . $penjualan['_id'], $data);

        $response->assertStatus(201);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A penjualan feature test delete.
     *
     * @return void
     */
    public function test_DeletePenjualan()
    {
        $penjualan = $this->test_CreatePenjualan();

        $response = $this->delete('/api/penjualan/' . $penjualan['_id']);

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    /**
     * A penjualan feature test laporan.
     *
     * @return void
     */
    public function test_LaporanPenjualan()
    {
        $tahun = Carbon::now()->format('Y');
        $response = $this->get('/api/penjualan/laporan' . "?tahun={$tahun}");

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

}
