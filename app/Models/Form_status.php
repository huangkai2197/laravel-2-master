<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_status extends Model
{
    protected $table='form_status';
    public  $timestamps=true;
    protected $guarded = [];

    /**
     * 查看表单的状态
     * @author oys
     * @param $status_id
     * @return false
     */
    public static function SelectFormstatus($status_id)
    {
        try {
            $res=self::where('status_id',$status_id)->value('status_name');
            return $res;
        }catch (\Exception $e){
            logError('表单状态查看成功',[$e->getMessage()]);
            return false;
        }
    }
}
