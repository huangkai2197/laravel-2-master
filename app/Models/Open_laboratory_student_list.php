<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Open_laboratory_student_list extends Model
{
    protected $table='open_laboratory_student_list';
    protected $primaryKey='list_id';
    public  $timestamps=true;
    protected $guarded = [];


    /**
     * 学生的增加
     * @author oys
     * @param $form_id
     * @param $student_name
     * @param $student_id
     * @param $phone
     * @param $work
     * @return false
     */
    public static function AddStudent($form_id,$student_name,$student_id,$phone,$work)
    {
        try {
            //学生成功
            $res=self::create(
                [
                    'form_id'=>$form_id,
                    'student_name'=>$student_name,
                    'student_id'=>$student_id,
                    'phone'=>$phone,
                    'work'=>$work,
                ]
            );
            return $res;
        }catch (\Exception $e){
            logError('学生录入成功',[$e->getMessage()]);
            return false;
        }
    }



    /**
     * 学生的删除
     * @author oys
     * @param $list_id
     * @return false
     */
    public static function DeleteStudent($list_id)
    {
        try {
            $res=self::where('list_id',$list_id)->delete();
            return $res;
        }catch (\Exception $e){
            logError('学生删除成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 学生的修改
     * @author oys
     * @param $list_id
     * @param $student_name
     * @param $student_id
     * @param $phone
     * @param $work
     * @return false
     */
    public static function UpdateStudent($list_id,$student_name,$student_id,$phone,$work)
    {
        try {
            $res=self::where('list_id',$list_id)->
            update([
                'student_name'=>$student_name,
                'student_id'=>$student_id,
                'phone'=>$phone,
                'work'=>$work,
            ]);
            return $res;
        }catch (\Exception $e){
            logError('学生修改成功',[$e->getMessage()]);
            return false;
        }
    }



    /**
     * 学生的查看
     * @author oys
     * @param $form_id
     * @return false
     */
    public static function SelectStudent($form_id)
    {
        try {
            $res=self::where('form_id',$form_id)->get();
            return $res;
        }catch (\Exception $e){
            logError('学生查看成功',[$e->getMessage()]);
            return false;
        }
    }


}
