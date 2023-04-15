<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorOperationModel extends Model
{
    use HasFactory;

    function getSector()
    {
        return $this->hasOne('App\Models\SectorModel', 'id', 'sector_id');
    }

    function getOperation()
    {
        return $this->hasOne('App\Models\OperationModel', 'id', 'operation_id');
    }

    function getSurgeons()
    {
        return $this->hasMany('App\Models\SectorOperationUserModel', 'sector_operation_id', 'id');
    }

    public static function getWithSurgeons()
    {
        return self::with(['getSurgeons' => function ($query) {
            $query->with('getSurgeon');
        }])->with('getSector')->with('getOperation')->get();
    }
}
