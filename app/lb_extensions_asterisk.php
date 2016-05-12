<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;
use DB;
class lb_extensions_asterisk extends Model
{
    protected $connection = 'main';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'extensions';

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
    protected $fillable = ['id','context','exten','priority','app','appdata'];

    public function extensionInsert($extension,$did){
        
        return DB::connection('main')->table('extensions')->insert([
           ['context'=>'from-sip', 'exten'=>$did,'priority'=>1,'app'=>'ExecIf', 'appdata'=>'$[ "${CALLERID(name)}" = "" ] ?Set(CALLERID(name)=${CALLERID(num)})'],
           ['context'=>'from-sip', 'exten'=>$did,'priority'=>2,'app'=>'Macro', 'appdata'=>'custom-screen,'.$extension],
        ]);
    }
  
     public function delete_extension($did)
    {
       return DB::connection('main')->table('extensions')->where('exten', '=',$did)->delete();

    }
}
