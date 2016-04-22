<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;

class lb_membership extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lb_membership';

    protected $primaryKey = 'idlb_membership';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['description'];

    
}
