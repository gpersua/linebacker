<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;
use DB;
class lb_findmefollow_asterisk extends Model
{
    protected $connection = 'asterisk';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'findmefollow';

     public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['grpnum', 'strategy', 'grptime', 'grppre', 'grplist', 'annmsg_id', 'postdest', 'dring', 'remotealert_id','needsconf', 'toolate_id','pre_ring','ringing' ];

     public function delete_follow($id)
    {
       return DB::connection('asterisk')->table('findmefollow')->where('grpnum', '=', $id)->delete();

    }
}
