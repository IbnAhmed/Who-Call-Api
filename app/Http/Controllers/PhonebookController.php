<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NumberList;
use App\Models\Phonebook;
use Auth;
class PhonebookController extends Controller
{
   public function __construct(){
     //  $this->middleware('auth:api');
   }



   /**
    * get info by phone number
    *
    * Maximum Parameter List : number (number or string)
    *
    * @return json array
    */
   public function show($number,Request $request){
	   	$first_attempt = User::where('phone',$number)->first();

	   	if($first_attempt){	   		
	   		$return_data = [
	   			'status' 	=> 'success',
	   			'message' 	=> 'Number info found successfully!',
	   			'info'		=> [
	   				'name' => $first_attempt->first_name . ' ' . $first_attempt->last_name
	   			]
	   		];
	   	} else {
	   		$number = NumberList::where('number',$number)->first();
	   		if($number){
	   			$return_data = [
	   				'status' 	=> 'success',
	   				'message' 	=> 'Number info found successfully!',
	   				'info'		=> [
	   					'name' => $number->phonebook->sortByDesc('id')->first()->name
	   				]
	   			];
	   		} else {
	   			$return_data = [
	   				'status' 	=> 'error',
	   				'message' 	=> 'Number not found!',
	   			];
	   		}
	   	}

	   	return response()->json($return_data);
   }

   /**
    * saving numbers
    *
    * Maximum Parameter List : numbers (json array)
    *
    * @return json array
    */
   public function store(Request $request){
	   	$this->validate($request, [
	   	 'numbers'    => 'required'
	   	]);

	   	$numbers = json_decode($request->numbers);

	   	foreach ($numbers as $number) {
	   		
	   		$number_list = NumberList::where('number', $number->phone)->first();
				
			// if number is not saved in DB, save it now
	   		if(!$number_list){
				$number_list 			= new NumberList();
				$number_list->number 	= $number->phone;
				$number_list->save();	   			
	   		}


	   		// saving number to table phonebook by this name
	   		$phonebook 				= new Phonebook();
	   		$phonebook->number_id 	= $number_list->id;
	   		$phonebook->name 		= $number->name;
	   		$phonebook->save_by 	= Auth::id();
	   		$phonebook->save();
	   	}


	   	$return_data = [
	   		'status' 	=> 'success',
	   		'message' 	=> 'Numbers has been saved.'
	   	];

	   	return response()->json($return_data);
   }



}    