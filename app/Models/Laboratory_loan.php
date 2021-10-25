<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratory_loan extends Model
{
    protected $table='laboratory_loan';
    protected $primaryKey='form_id';
    public  $timestamps=true;
    protected $guarded = [];


    /**
     * 添加实验申请表
     * @author oys
     * @param $form_id
     * @param $laboratory_id
     * @param $course_name
     * @param $class_id
     * @param $number
     * @param $purpose
     * @param $start_time
     * @param $end_time
     * @param $start_class
     * @param $end_class
     * @param $phone
     * @return false
     */
    public static function LabBorrow($form_id,$laboratory_id,$course_name,$class_id,$number,$purpose,$start_time,$end_time,$start_class,$end_class,$phone)
    {
        try {
            //实验室申请
            $res=self::create(
                [
                    'form_id'=>$form_id,
                    'laboratory_id'=>$laboratory_id,
                    'course_name'=>$course_name,
                    'class_id'=>$class_id,
                    'number'=>$number,
                    'purpose'=>$purpose,
                    'start_time'=>$start_time,
                    'end_time'=>$end_time,
                    'start_class'=>$start_class,
                    'end_class'=>$end_class,
                    'phone'=>$phone,
                ]
            );
            return $res;
        }catch (\Exception $e){
            logError('实验室申请表录入成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 查看实验室借用表单
     * @author oys
     * @param $form_id
     * @return false
     */
    public static function SelectLabloan($form_id)
    {
        try {
            //实验室申请
            $res=self::where('form_id',$form_id)->first();
            return $res;
        }catch (\Exception $e){
            logError('实验室申请表查看成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 修改实验室申请表单
     * @author oys
     * @param $form_id
     * @param $laboratory_id
     * @param $course_name
     * @param $class_id
     * @param $number
     * @param $purpose
     * @param $start_time
     * @param $end_time
     * @param $start_class
     * @param $end_class
     * @param $phone
     * @return false
     */
    public static function UpdateLabloan($form_id,$laboratory_id,$course_name,$class_id,$number,$purpose,$start_time,$end_time,$start_class,$end_class,$phone)
    {
        try {
            //实验室申请
            $res=self::where('form_id',$form_id)->update([
                'laboratory_id'=>$laboratory_id,
                'course_name'=>$course_name,
                'class_id'=>$class_id,
                'number'=>$number,
                'purpose'=>$purpose,
                'start_time'=>$start_time,
                'end_time'=>$end_time,
                'start_class'=>$start_class,
                'end_class'=>$end_class,
                'phone'=>$phone,
            ]);
            return $res;
        }catch (\Exception $e){
            logError('实验室申请表查看成功',[$e->getMessage()]);
            return false;
        }
    }


}
