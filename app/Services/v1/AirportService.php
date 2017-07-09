<?php 

namespace App\Services\v1;
use Validator;
use App\Airport;
class AirportService
{
	
	protected $rules = [

	'name' => 'required',
    'city' => 'required'

	];

	public function validateAirport($airport)
	{
		$validator = Validator::make($airport, $this->rules);
		$validator->validate();
	}

	public function getAllAirports()
	{
		$airports = Airport::all();
		return $this->airportSerializer($airports);
	}



	public function createAirport($req)
     {
         $airport = new Airport();
         $airport->name = $req->input('name');
         $airport->city = $req->input('city');
         $airport->save();
         return $this->airportSerializer([$airport]);

         
     }

     public function getAirport($id)
     {

         $airport = Airport::where('id',$id)->first();
         return $airport;
     }

     public function airportSerializer($airports, $key = [])
	{
       $data = [];
       
       foreach ($airports as $airport) 
       {
       	
       	$temp = [
       	'name' => $airport->name,
       	'city' => $airport->city
       	];

       	

          $data[] = $temp;
       }

       
       return $data;

	
}

}