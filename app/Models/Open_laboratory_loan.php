<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Open_laboratory_loan extends Model
{
    protected $table='open_laboratory_loan';
    protected $primaryKey='form_id';
    public  $timestamps=true;
    protected $guarded = [];


    /**
     * 填写申请表
     * @author oys
     * @param $form_id
     * @param $reason_use
     * @param $porject_name
     * @param $start_time
     * @param $end_time
     * @return false
     */
    public static function Openlab_borrow($form_id,$reason_use,$porject_name,$start_time,$end_time)
    {
        try {
            //设备表成功
            $res=self::create(
                [
                    'form_id'=>$form_id,
                    'reason_use'=>$reason_use,
                    'porject_name'=>$porject_name,
                    'start_time'=>$start_time,
                    'end_time'=>$end_time,
                ]
            );
            return $res;
        }catch (\Exception $e){
            logError('开放申请录入成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 查看开放实验室表信息
     * @oys
     * @param $form_id
     * @return false
     */
    public static function OpenlabSelect($form_id)
    {
        try {
            //设备表成功
            $res=self::where('form_id',$form_id)->get();
            return $res;
        }catch (\Exception $e){
            logError('开放申请查看成功',[$e->getMessage()]);
            return false;
        }
    }

}
