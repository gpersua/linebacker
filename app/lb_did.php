<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;
use DB;

class lb_did extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lb_did';

    protected $primaryKey = 'did';
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['did', 'is_available, extension'];

    public function getDid()
    {
         $did = DB::table('lb_did')
                     ->select(DB::raw('did'))
                     ->where('is_available', '=', 1)
                     ->first();
             
          return (array)$did;
        
              
    } 
}
