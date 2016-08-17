<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;
use DB;
class lb_voicemail_asterisk extends Model
{
    protected $connection = 'main';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'voicemail';

     public $timestamps = false;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uniqueid', 'context', 'mailbox', 'password', 'fullname', 'email', 'pager', 'attach', 'attachfmt', 'serveremail', 'LANGUAGE', 'tz', 'deletevoicemail', 'saycid', 'sendvoicemail', 'review', 'tempgreetwarn', 'operator', 'envelope', 'sayduration', 'saydurationm', 'forcename', 'forcegreetings', 'callback', 'dialout', 'exitcontext', 'maxmsg', 'volgain', 'imapuser', 'imappassword', 'imapsever', 'imapport', 'imapflags', 'stamp'];

    public function voicemailInsert($extension){
        
    return DB::connection('main')->table('voicemail')->insert([
           ['context'=>'default', 'mailbox'=>$extension, 'password'=>'1234'],
        ]);
  }

    public function delete_voicemail($id)
    {
       return DB::connection('main')->table('voicemail')->where('mailbox', '=', $id)->delete();

    }
}
