<?php

namespace linebacker;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use linebacker\lb_membership;
use linebacker\lb_city;
use linebacker\lb_users;
use DB;

class lb_account extends Model
{
    protected $table = 'lb_account';
    protected $primaryKey = 'userAcc';
    protected $fillable = ['id', 'userAcc', 'id_membership', 'id_city', 'city', 'first_name', 'last_name', 'address', 'birthday', 'phone_number', 'second_phone'];
    
    protected static function boot() {
		parent::boot();
		static::creating(function($model) {
			$model->{$model->getKeyName()} = (binary) $model->generateID();
		});
	}

	public function generateID() {
		return Uuid::uuid4();
	}
    
    public function  user() {
        return $this->belongsTo('lb_users');
    }
    
    public function  city() {
        return $this->belongsTo('lb_city');
    }
    
    public function  membership () {
        return $this->belongsTo('lb_membership');
    }
   
	public static $new = array(
                'id' => 'required|unique:lb_account,id',
		'first_name' => 'required|min:2',
		'last_name' => 'required',
		'phone_number' => 'required|min:6|max:30',
                'birthday' => 'required|date',
                'id_city' => 'required|exists:lb_city,zip_code:min:6'
	);
    
    public function getUserId()
    {
        return $this->id;
    } 
    
    public function getUserAcc()
    {
        return $this->userAcc;
    } 
    
    public function delete_contacts($userAcc)
    {
       return DB::connection('main')->table('lb_contacts')->where('userAcc', '=', $userAcc)->delete();
    }
    
}
