<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use  Auth;
class UserController extends Controller
{
   public function __construct(){
     //  $this->middleware('auth:api');
   }

   /**
    * Login  
    *
    * Maximum Parameter List : phone, password
    *
    * @return json array
    */
   public function authenticate(Request $request) {
      $this->validate($request, [
       'phone'    => 'required',
       'password' => 'required'
      ]);

      $user = User::where('phone', $request->phone)->first();

      if($user && Hash::check($request->password, $user->password)){
          $apikey = base64_encode(str_random(40));
          User::where('phone', $request->phone)->update(['api_token' => "$apikey"]);
          $return_data = ['status' => 'success','message' => 'Successfully Logged in!','api_token' => $apikey];
      } else{
          $return_data = ['status' => 'error','message' => 'Phone or Password did not match!'];
      }

      return response()->json($return_data);
   }

   /**
    * Register  
    *
    * Maximum Parameter List : first_name, last_name, phone, password
    *
    * @return json array
    */
   public function register(Request $request) {
      $this->validate($request, [
       'first_name' => 'required',
       'last_name'  => 'required',
       'phone'      => 'required',
       'password'   => 'required'
      ]);

      $user = User::where('phone', $request->phone)->first();

      if($user){
        $return_data = ['status' => 'error','message' => 'User already exist with this phone number!'];
      } else {
        User::create([
          'first_name'  => $request->first_name,
          'last_name'   => $request->last_name,
          'phone'       => $request->phone,
          'password'    => Hash::make($request->password)
        ]);
        $return_data = ['status' => 'success','message' => 'Your account created successfully, Now logged in to step forward.'];
      }
      return response()->json($return_data);
      
   }


   /**
    * current_user  
    *
    * Maximum Parameter List : first_name, last_name, phone, password
    *
    * @return json array
    */
   public function current_user(Request $request) {
      $return_data = ['status' => 'success', 'message' => 'Current User', 'user' => Auth::user()];
      return response()->json($return_data);
   }
}    