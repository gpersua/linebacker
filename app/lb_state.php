<?php

namespace linebacker;

use Illuminate\Database\Eloquent\Model;

class lb_state extends Model
{
	//Nombre de la conexion que utitlizara este modelo
	protected $connection= 'main';

	//Todos los modelos deben extender la clase Eloquent
	protected $table = 'lb_state';
}
