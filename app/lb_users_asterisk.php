<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;
use DB;
class lb_users_asterisk extends Model
{
    protected $connection = 'asterisk';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

     public $timestamps = false;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['extension','password','name','voicemail','ringtimer','noanswer','recording','outboundcid','sipname','noanswer_cid','busy_cid','chanunavail_cid','noanswer_dest','busy_dest','chanunavail_dest'];


    public function delete_user($id)
    {
       return DB::connection('asterisk')->table('users')->where('extension', '=', $id)->delete();

    }
}
