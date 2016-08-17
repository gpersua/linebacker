<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;

use DB;

class lb_extension extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lb_extension';
    
    protected $primaryKey = 'did_extension';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['did_extension', 'extension', 'server_url', 'userAcc', 'secret'];

    public static $new = array(
                'did_extension' => 'required|unique:lb_did,did_extension',
		'extension' => 'required|min:3',
		'userAcc' => 'required'
	);
    public function is_empty()
    {
        return lb_extension::select('extension')->count();
    }
    
}
