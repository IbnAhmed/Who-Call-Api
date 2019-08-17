<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class NumberReport extends Model
{
	////////////////
	// Attributes //
	////////////////

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
   protected $fillable = ['number_id','reported_by','reason','reason_description'];

   /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'report';
   
   ///////////////////
   // Relationships //
   ///////////////////

   public function user()
   {
       return $this->belongsTo('App\Models\User','reported_by');
   }
   public function number_list()
   {
       return $this->belongsTo('App\Models\NumberList','number_id');
   }
}