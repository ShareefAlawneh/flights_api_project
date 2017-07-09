<?php 

namespace App\Services\v1;
use App\Flight;
use App\Airport;
use Validator;

class FlightService
{
      
     
     protected $rules=[
        'flight_number' => 'required|unique|min:4|max:4',
        'arrivalAirport_id' => 'required',
         'takeoffAirport_id' => 'required'
        


	];

	public function validateFlight($flight)
	{
		$validator = Validator::make($flight, $this->rules);
		$validator->validate();
	}

	public function createFlight($req)
	{
        $arrivalAirport = $req->input('arrivalAirport_id');
        $takeoffAirport = $req->input('takeoffAirport_id');

		$flight = new Flight();
		$flight->flight_number = $req->input('flight_number');
		$flight->arrival_time = $req->input('arrival_time');
		$flight->takeoff_time = $req->input('takeoff_time');
		$flight->arrival_airport = $arrivalAirport;
		$flight->takeoff_airport = $takeoffAirport;
		$flight->save();
		
		return $this->serializeFlight([$flight]);

	}

	public function getByAirport($data)
	{
		$airport_from =Airport::where('id',$data['from'])->first();

		$airport_to = Airport::where('id',$data['to'])->first();
		
		$flights_from = $airport_from->outFlight->toArray();
		$flights_to = $airport_to->inFlight->toArray();
         

		$flights = array_map("unserialize", array_intersect($this->serialize_array_values($flights_from),$this->serialize_array_values($flights_to)));
       
		return $this->serializeFlight([$flights[0]]); 
		

	}

	public function serializeFlight($flights)
	{
           $data = [];

           foreach($flights as $flight)
           {
           	$temp = [

           	'flight_number' => $flight[0],
           	'arrival_airport' =>$flight[1],
           	'takeoff_airport' => $flight[2],
           	'arrival_time' => $flight[4],
           	'takeoff_time' => $flight[7]

           	];

           	$data[] = $temp;
           }

           return $data;
	}

    function serialize_array_values($arr){
    foreach($arr as $key=>$val){
        sort($val);
        $arr[$key]=serialize($val);
    }

    return $arr;
}





}





