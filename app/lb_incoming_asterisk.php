<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;

use DB;
class lb_incoming_asterisk extends Model
{

    protected $connection = 'asterisk';
    
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'incoming';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cidnum','extension','destination','faxexten','faxemail ','answer','wait','privacyman','alertinfo','ringing','mohclass','description','grppre','delay_answer','pricid','pmmaxretries','pmminlength','reversal'];

     public function delete_incoming($id)
    {
       return DB::connection('asterisk')->table('incoming')->where('extension', '=', $id)->delete();

    }
}
