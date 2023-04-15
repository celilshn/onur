<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorOperationUserModel extends Model
{
    use HasFactory;

    protected $fillable = ['sector_operation_id', 'surgeon_id', 'created_at', 'updated_at'];

    public static function getSurgeonsWithSectorOperationId(mixed $sector_operation_id)
    {
        return self::where('sector_operation_id', $sector_operation_id)->with('getSurgeon')->get()->map(function ($model){
            return ['id'=>$model->id,'surgeon'=>$model->getSurgeon->name,'date'=>Carbon::make($model->created_at)->toDate()];
        });
    }

    function getSurgeon()
    {
        return $this->hasOne(SurgeonModel::class, 'id', 'surgeon_id');
    }

    function getSectorOperation()
    {
        return $this->hasOne(SectorOperationModel::class, 'id', 'sector_operation_id');
    }
}
