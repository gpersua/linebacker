<?php

namespace linebacker;

use Ramsey\Uuid\Uuid;

use Illuminate\Database\Eloquent\Model;

class lb_contacts extends Model
{
    protected $connection= 'main';

    protected $primaryKey = 'id';

    /**
     * Ramsey.
     *
     * @var string
     */
    /*protected static function boot() {
	parent::boot();
	static::creating(function($model) {
		$model->{$model->getKeyName()} = (binary) $model->generateID();
	});
    }

    public function generateID() {
	return Uuid::uuid4();
    }*/

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lb_contacts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['userAcc', 'first_name', 'last_name', 'address', 'email', 'primary_phone', 'second_phone', 'third_phone'];

    public function  account() {
        return $this->belongsTo('lb_account');
    }
    
	public static $new = array(
		"first_name" => "required",
		"primary_phone" => "required"
	);
}
