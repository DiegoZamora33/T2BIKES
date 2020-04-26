<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $fillable = ['nombreCarrera', 'descripcion', 'idCompetencia', 'idTipoCarrera'];

    public function tipoCarrera(){
        return $this->belongsTo('App\TipoCarrera', 'idTipoCarrera', 'idTipoCarrera');
    }

    public function competencia()
    {
        return $this->belongsTo('App\Competencia', 'idCompetencia', 'idCompetencia');
    }
}
