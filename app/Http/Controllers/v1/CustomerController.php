<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Services\v1\CustomerService;
use App\Http\Controllers\Controller;


class CustomerController extends Controller
{


     protected $customers;

    public function __construct(CustomerService $customers)
    {
       $this->customers = $customers;   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $customers = $this->customers->getAllCustomers();
        return response()->json($customers,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->customers->validateCustomer($request->all());

        try{

            $customer = $this->customers->createCustomer($request);
            return response()->json($customer,201);

        }catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $this->customers->deleteCustomer($id);
            return response()->make('', 204);

        }catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
