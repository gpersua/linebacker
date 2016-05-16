<?php

namespace linebacker;

use Crypt;
use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class lb_sip_asterisk extends Model
{

    protected $connection = 'main';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sipusers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'callerid', 'defaultuser', 'regexten', 'secret', 'mailbox', 'accountcode', 'context', 'amaflags', 'callgroup', 'canreinvite', 'defaultip', 'dtmfmode', 'fromuser', 'fromdomain', 'fullcontact', 'host', 'insecure', 'language', 'md5secret', 'nat', 'deny', 'permit', 'mask', 'pickupgroup', 'port', 'qualify', 'restrictcid', 'rtptimeout', 'rtpholdtimeout', 'type', 'disallow', 'allow', 'musiconhold', 'regseconds', 'ipaddr', 'cancallforward', 'lastms', 'useragent', 'regserver'];

    public function genRandomString()
    {
    $length = 32;
    $string='';
    $characters = "0123456789abcdef";
    for ($p = 0; $p < $length ; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)]; 
    }
    return $string;
    }
    
    public function secret()
    {
        $string= $this->genRandomString();
        //$secret = Crypt::encrypt($string);
        return $string;
    }
    
    public function sipInsert($extension, $secret){
        
    return DB::connection('main')->table('sipusers')->insert([
           ['name'=>$extension, 'defaultuser'=>$extension, 'port'=>5060, 'secret'=>$secret, 'context'=>'from-sip','HOST'=>'dynamic','nat'=>'force_rport,comedia','qualify'=>'no','TYPE'=>'friend','transport'=>'udp','dtmfmode'=>'rfc2833','directmedia'=>'no','callerid'=>$extension,'mailbox'=>$extension,'fromdomain'=>'voip.mylinebacker.net','fromuser'=>$extension,'qualify'=>'yes','qualifyfreq'=>60,'sippasswd'=>$secret],
        ]);
  }
  
    public function delete_sip($extension)
    {
       return DB::connection('main')->table('sipusers')->where('name', '=', $extension)->delete();
    }
}
