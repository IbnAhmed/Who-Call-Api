<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Block extends Model
{
	////////////////
	// Attributes //
	////////////////

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
   protected $fillable = ['number_id','blocked_by','reason'];

   /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'block';
   
   ///////////////////
   // Relationships //
   ///////////////////

   public function user()
   {
       return $this->belongsTo('App\Models\User','blocked_by');
   }
   public function number_list()
   {
       return $this->belongsTo('App\Models\NumberList','number_id');
   }
}