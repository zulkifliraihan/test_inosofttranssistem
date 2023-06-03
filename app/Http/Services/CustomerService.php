<?php
namespace App\Http\Services;

use App\Http\Repository\CustomerRepository\CustomerInterface;
use App\Models\Customer;

class CustomerService {
    private $customerInterface;

    public function __construct(CustomerInterface $customerInterface)
    {
        $this->customerInterface = $customerInterface;
    }

    public function index(): array
    {

        $customer = $this->customerInterface->index();

        $return = [
            'status' => 'success',
            'response' => 'get',
            'data' => $customer
        ];

        return $return;
    }

    public function create($data): array
    {
        $return = [];

        $customer = $this->customerInterface->create($data);

        $return = [
            'status' => 'success',
            'response' => 'created',
            'data' => $customer
        ];

        return $return;


    }

    public function detail($id): array
    {
        $customer = $this->customerInterface->detail($id);

        if (!$customer) {
            $return = [
                'status' => 'failed'
            ];
        }
        else {
            $return = [
                'status' => 'success',
                'response' => 'get',
                'data' => $customer
            ];
        }

        return $return;
    }

    public function update($id, $data): array
    {

        $customerById = $this->customerInterface->detail($id);

        if (!$customerById) {
            $return = [
                'status' => 'failed'
            ];
        }
        else {
            $customer = $this->customerInterface->update($id, $data);

            $return = [
                'status' => 'success',
                'response' => 'updated',
                'data' => $customer
            ];
        }

        return $return;
    }

    public function delete($id): array
    {

        $customerById = $this->customerInterface->detail($id);

        if (!$customerById) {
            $return = [
                'status' => 'failed'
            ];
        }
        else {

            $customer = $this->customerInterface->delete($id);

            $return = [
                'status' => 'success',
                'response' => 'deleted',
                'data' => $customer
            ];
        }

        return $return;
    }


}
