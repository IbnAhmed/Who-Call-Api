<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\NumberList;
use Auth;
class ReviewController extends Controller
{
   public function __construct(){
     //  $this->middleware('auth:api');
   }


      /**
       * show review by phone number
       *
       * Maximum Parameter List : number (number or string)
       *
       * @return json array
       */
      public function show($number,Request $request){
   	   	$number = NumberList::where('number',$number)->first();
   	   	if($number){
   	   		$review_list = [];
   	   		foreach ($number->review as $review) {
   	   			$temp_review   = [];
   	   			$temp_review['reviewed_by'] = $review->user->first_name .' '. $review->user->last_name;
   	   			$temp_review['review'] = $review->review;
   	   			$temp_review['rating'] = $review->rating;

   	   			$review_list[] = $temp_review;
   	   		}
   	   		$return_data = [
   	   			'status' 	=> 'success',
   	   			'message' 	=> 'Review found successfully!',
   	   			'total'		=> $number->review->count(),
   	   			'number'	=> $number->number,
   	   			'review'	=> $review_list
   	   		];
   	   	} else {
   	   		$return_data = [
   	   			'status' 	=> 'error',
   	   			'message' 	=> 'Number not found!',
   	   		];
   	   	}
   	   	return response()->json($return_data);
      }

      /**
       * saving review for phone-number
       *
       * Maximum Parameter List : phone (string or number), review, rating
       *
       * @return json array
       */
      public function store(Request $request){
   	   	$this->validate($request, [
   	   	 'phone'    => 'required',
   	   	 'rating'    => 'required',
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

	   	$review = new Review();
	   	$review->number_id = $number_id;
	   	$review->reviewed_by = Auth::id();

	   	/*Review*/
	   		if($request->review){
		   		$review->review = $request->review;
	   		}
	   	/*Review*/

	   	/*Rating*/
	   		if($request->rating){
	   			$rat = (int) $request->rating ;
	   			$max_rat = 5;
	   			$min_rat = 0;
		   		$review->rating = ($rat > $max_rat) ? $max_rat : ($rat < $min_rat) ? $min_rat : $rat ;
	   		}
	   	/*Rating*/

   		$review->save();


   	   	$return_data = [
   	   		'status' 	=> 'success',
   	   		'message' 	=> 'Review has been saved.'
   	   	];

   	   	return response()->json($return_data);
      }

}    