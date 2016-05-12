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

     public function delete_follow($extension)
    {
       return DB::connection('main')->table('extensions')->where('exten', '=', $extension)->delete();

    }
}
