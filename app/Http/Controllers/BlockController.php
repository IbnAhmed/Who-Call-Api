<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NumberList;
use App\Models\Block;
use Auth;
class BlockController extends Controller
{
	  public function __construct(){
	     //  $this->middleware('auth:api');
	  }

     /**
      * block a phone-number
      *
      * Maximum Parameter List : phone (string or number), reason
      *
      * @return json array
      */
    public function store(Request $request){
  	   	$this->validate($request, [
  	   	 'phone'    => 'required',
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

   	   	$block = new Block();
   	   	$block->number_id = $number_id;
   	   	$block->blocked_by = Auth::id();

   	   	/*Reason*/
   	   		if($request->reason){
   		   		$block->reason = $request->reason;
   	   		}
   	   	/*Reason*/

  		$block->save();


  	   	$return_data = [
  	   		'status' 	=> 'success',
  	   		'message' 	=> 'You block the number '.$request->phone
  	   	];

  	   	return response()->json($return_data);
    }
}    