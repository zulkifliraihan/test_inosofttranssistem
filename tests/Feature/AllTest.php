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
     * A auth feature test login.
     *
     * @return void
     */
    public function test_AuthLogin()
    {
        $data = [
            "email" => "zuran2907@gmail.com",
            "password" => "123123123"
        ];

        $response = $this->post('/api/auth/login', $data);

        $response->assertStatus(201);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);

        $token = $responseData['data']['authorization']['token'];

        return $token;
    }

    /**
     * A kendaraan feature test get all.
     *
     * @return void
     */
    public function test_GetAllKendaraan()
    {
        $token = $this->test_AuthLogin();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/kendaraan');

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
        $token = $this->test_AuthLogin();
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

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/kendaraan', $data);

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
        $token = $this->test_AuthLogin();
        $kendaraan = $this->test_CreateKendaraan();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/kendaraan/' . $kendaraan['_id']);

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
        $token = $this->test_AuthLogin();
        $kendaraan = $this->test_CreateKendaraan();

        $data = [
            "tahun_keluaran"=> "2022",
            "warna"=> "Pink",
            "harga"=> 70000000,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/kendaraan/' . $kendaraan['_id'], $data);

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
        $token = $this->test_AuthLogin();
        $kendaraan = $this->test_CreateKendaraan();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/kendaraan/' . $kendaraan['_id']);

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
        $token = $this->test_AuthLogin();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/customer');

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
        $token = $this->test_AuthLogin();
        $data = [
            "name" => "Fadhil D Maulana",
            "address" => "Jakarta",
            "phone" => "6285155030102"
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/customer', $data);

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
        $token = $this->test_AuthLogin();

        $customer = $this->test_CreateCustomer();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/customer/' . $customer['_id']);

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
        $token = $this->test_AuthLogin();
        $customer = $this->test_CreateCustomer();

        $data = [
            "name" => "Zulkifli Raihan",
            "address" => "Jakarta",
            "phone" => "6285155030102"
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/customer/' . $customer['_id'], $data);

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
        $token = $this->test_AuthLogin();
        $customer = $this->test_CreateCustomer();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/customer/' . $customer['_id']);

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
        $token = $this->test_AuthLogin();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/penjualan');

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
        $token = $this->test_AuthLogin();
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

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/penjualan', $data);

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
        $token = $this->test_AuthLogin();

        $penjualan = $this->test_CreatePenjualan();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/penjualan/' . $penjualan['_id']);

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
        $token = $this->test_AuthLogin();
        $penjualan = $this->test_CreatePenjualan();

        $data = [
            "jumlah_terjual" => 1,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/penjualan/' . $penjualan['_id'], $data);

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
        $token = $this->test_AuthLogin();
        $penjualan = $this->test_CreatePenjualan();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/penjualan/' . $penjualan['_id']);

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
        $token = $this->test_AuthLogin();
        $tahun = Carbon::now()->format('Y');
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/penjualan/laporan' . "?tahun={$tahun}");

        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertArrayHasKey('response_code', $responseData);
        $this->assertArrayHasKey('response_status', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

}
