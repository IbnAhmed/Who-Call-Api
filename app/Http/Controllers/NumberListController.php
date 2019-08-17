<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NumberList;
class NumberListController extends Controller
{
   public function __construct(){
     //  $this->middleware('auth:api');
   }
}     