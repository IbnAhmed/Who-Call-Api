<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class NumberList extends Model
{
	////////////////
	// Attributes //
	////////////////

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
   protected $fillable = ['number'];

   /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'number_list';
   
   ///////////////////
   // Relationships //
   ///////////////////

   
   public function review()
   {
       return $this->hasMany('App\Models\Review','number_id');
   }
   public function report()
   {
       return $this->hasMany('App\Models\Report','number_id');
   }
   public function block()
   {
       return $this->hasMany('App\Models\Block','number_id');
   }
   public function phonebook()
   {
       return $this->hasMany('App\Models\Phonebook','number_id');
   }

}