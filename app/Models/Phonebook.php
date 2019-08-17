<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Phonebook extends Model
{
	////////////////
	// Attributes //
	////////////////

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
   protected $fillable = ['number_id','save_by','name'];

   /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'phone_book';
   
   ///////////////////
   // Relationships //
   ///////////////////

   public function user()
   {
       return $this->belongsTo('App\Models\User','save_by');
   }
   public function number_list()
   {
       return $this->belongsTo('App\Models\NumberList','number_id');
   }
}