<?php 

namespace App\Services\v1;
use App\Customer;
use Validator;

class CustomerService
{

	protected $rules=[
        'name' => 'required',
        'email' => 'required|unique:customers|email',

	];

	public function validateCustomer($customer)
	{
		$validator = Validator::make($customer, $this->rules);
		$validator->validate();
	}
	public function getAllCustomers()
     {
         $customers = Customer::all();
         return $this->serializeCustomer($customers);
         
     }
     public function createCustomer($req)
     {
     	$customer = new Customer();
     	$customer->name = $req->input('name');
     	$customer->email = $req->input('email');
     	$customer->save();
     	return $this->serializeCustomer([$customer]);
     }


     public function deleteCustomer($id)
     {
         $customer = Customer::where('email',$id)->firstOrFail();
         $customer->delete();
     }
     public function serializeCustomer($customers)
     {
     	$data = [];
        
     	foreach ($customers as $customer) {
     		
     		$temp = [

     		'name' => $customer->name,
     		'email' => $customer->email

     		];
     		$data[] = $temp;
     	}
     	return $data;
          
     }
}