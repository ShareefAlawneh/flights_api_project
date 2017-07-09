<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;

use App\Services\v1\AirportService;
use App\Http\Controllers\Controller;


class AirportController extends Controller
{

    protected $airports;

    public function __construct(AirportService $airports)
    {
        $this->airports = $airports;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airports = $this->airports->getAllAirports();
        return response()->json($airports,200);
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
        $this->airports->validateAirport($request->all());
        try{
            $airport = $this->airports->createAirport($request);
            return response()->json($airport,201);
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
        $parameters = Input::get('id');
        dd(Input::get('id'));
        $parameters['airport_id'] = $id;
        $airports = $this->airports->getAirport($id);
        return response()->json($airports,200);
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
        //
    }
}
