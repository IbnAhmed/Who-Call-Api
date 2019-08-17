<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NumberList;
use App\Models\NumberReport as Report;
use Auth;
class ReportController extends Controller
{
   public function __construct(){
     //  $this->middleware('auth:api');
   }

   /**
    * block a phone-number
    *
    * Maximum Parameter List : phone (string or number), reason, reason_description
    *
    * @return json array
    */
  	public function store(Request $request){
	   	$this->validate($request, [
	   	 'phone'    => 'required',
	   	 'reason'    => 'required',
	   	]);

	   	/*Number id*/
 	   	   	$number_list = NumberList::where('number', $request->phone)->first();
 					
 			// if number is not saved in DB, save it now
 	   		if(!$number_list){
 				$number_list 			= new NumberList();
 				$number_list->number 	= $request->phone;
 				$number_list->save();	   			
 	   		}

 	   		$number_id = $number_list->id;
 	   	/*Number id*/

 	   	$report = new Report();
 	   	$report->number_id = $number_id;
 	   	$report->reported_by = Auth::id();

 	   	/*Reason*/
 	   		if($request->reason){
 		   		$report->reason = $request->reason;
 	   		}
 	   		if($request->reason_description){
 		   		$report->reason_description = $request->reason_description;
 	   		}
 	   	/*Reason*/

		$report->save();


	   	$return_data = [
	   		'status' 	=> 'success',
	   		'message' 	=> 'You submitted a report for this number '.$request->phone
	   	];

	   	return response()->json($return_data);
  	}
}    