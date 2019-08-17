<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Review extends Model
{
	////////////////
	// Attributes //
	////////////////

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
   protected $fillable = ['number_id','reviewed_by','review','rating'];

   /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'review';
   
   ///////////////////
   // Relationships //
   ///////////////////

   public function user()
   {
       return $this->belongsTo('App\Models\User','reviewed_by');
   }
   public function number_list()
   {
       return $this->belongsTo('App\Models\NumberList','number_id');
   }
}