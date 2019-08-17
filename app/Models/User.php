<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class User extends Model implements Authenticatable
{
   use AuthenticableTrait;
   protected $fillable = ['first_name','last_name','phone','password'];
   protected $hidden = ['password'];
   
   
   ///////////////////
   // Relationships //
   ///////////////////

   public function review()
   {
       return $this->hasMany('App\Models\Review','reviewed_by');
   }
   public function phonebook()
   {
       return $this->hasMany('App\Models\Phonebook','save_by','id');
   }
   public function report()
   {
       return $this->hasMany('App\Models\Report','reported_by');
   }
   public function block()
   {
       return $this->hasMany('App\Models\Block','blocked_by');
   }
}