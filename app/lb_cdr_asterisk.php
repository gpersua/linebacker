<?php

namespace linebacker;

use Crypt;
use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class lb_cdr_asterisk extends Model
{

    protected $connection = 'main';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cdr';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['calldate', 'clid', 'src', 'dst', 'dcontext', 'channel', 'dstchannel', 'lastapp', 'lastdata', 'duration', 'billsec', 'disposition', 'amaflags', 'accountcode', 'uniqueid', 'userfield', 'did', 'recordingfile', 'user_id', 'is_contact', 'sent'];

}
