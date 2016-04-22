<?php

namespace linebacker;

use Crypt;
use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class lb_sip_asterisk extends Model
{

    protected $connection = 'asterisk';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sip';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','keyword','data','flags'];

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
        
    return DB::connection('asterisk')->table('sip')->insert([
            ['id' => $extension, 'keyword' => 'dial', 'data' => 'SIP/733', 'flags' =>26],
            ['id' => $extension, 'keyword' => 'trustrpid', 'data' => 'yes', 'flags' =>9],
            ['id' => $extension, 'keyword' => 'context', 'data' => 'from-internal', 'flags' =>7],
            ['id' => $extension, 'keyword' => 'mediaencryption', 'data' => 'no', 'flags' =>10],
            ['id' => $extension, 'keyword' => 'canreinvite', 'data' => 'no', 'flags' =>6],
            ['id' => $extension, 'keyword' => 'dtmfmode', 'data' => 'rfc2833', 'flags' =>5],
            ['id' => $extension, 'keyword' => 'secret', 'data' => $secret, 'flags' =>5],
            ['id' => $extension, 'keyword' => 'secret_origional', 'data' => $secret, 'flags' =>3],
            ['id' => $extension, 'keyword' => 'sipdriver', 'data' => 'chan_sip', 'flags' =>2],
            ['id' => $extension, 'keyword' => 'host', 'data' => 'dynamic', 'flags' =>2],
            ['id' => $extension, 'keyword' => 'permit', 'data' => '0.0.0.0/0.0.0.0', 'flags' =>30],
            ['id' => $extension, 'keyword' => 'pickupgroup', 'data' => '', 'flags' =>23],
            ['id' => $extension, 'keyword' => 'callgroup', 'data' => '', 'flags' =>22],
            ['id' => $extension, 'keyword' => 'encryption', 'data' => 'no', 'flags' =>21],
            ['id' => $extension, 'keyword' => 'icesupport', 'data' => 'no', 'flags' =>20],
            ['id' => $extension, 'keyword' => 'avpf', 'data' => 'no', 'flags' =>18],
            ['id' => $extension, 'keyword' => 'transport', 'data' => 'udp,tcp,tls', 'flags' =>17],
            ['id' => $extension, 'keyword' => 'qualifyfreq', 'data' => '60', 'flags' =>16],
            ['id' => $extension, 'keyword' => 'qualify', 'data' => 'yes', 'flags' =>15],
            ['id' => $extension, 'keyword' => 'port', 'data' => '5060', 'flags' =>14],
            ['id' => $extension, 'keyword' => 'nat', 'data' => 'yes', 'flags' =>13],
            ['id' => $extension, 'keyword' => 'type', 'data' => 'friend', 'flags' =>12],
            ['id' => $extension, 'keyword' => 'sendrpid', 'data' => 'pai', 'flags' =>11],
            ['id' => $extension, 'keyword' => 'disallow', 'data' => '', 'flags' =>24],
            ['id' => $extension, 'keyword' => 'accountcode', 'data' => '', 'flags' =>27],
            ['id' => $extension, 'keyword' => 'force_avp', 'data' => '', 'flags' =>19],
            ['id' => $extension, 'keyword' => 'callerid', 'data' => '<'.$extension.'>', 'flags' =>32],
            ['id' => $extension, 'keyword' => 'account', 'data' => $extension, 'flags' =>31],
            ['id' => $extension, 'keyword' => 'deny', 'data' => '0.0.0.0/0.0.0.0', 'flags' =>29],
            ['id' => $extension, 'keyword' => 'mailbox', 'data' => $extension.'@device', 'flags' =>28],
        ]);
      
    
  }
  
    public function delete_sip($id)
    {
       return DB::connection('asterisk')->table('sip')->where('id', '=', $id)->delete();

    }
}
