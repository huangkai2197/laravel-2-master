<?php

namespace App\Models\Csl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shenpi extends Model
{
    protected $table = "form";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    //


    /*
*审批表单信息展示
*/
    public static function spshow($id){
        try {
            $a=DB::table('admin')
                ->where('id','=',$id)
                ->value('type');

            if ($a==1){
                $res=self::join('form_type','form_type.type_id','form.type_id')
                    ->join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                    ->where('status_id','=','1')
                    ->select('form.type_id','type_name','applicant_name','destine_start_time','destine_end_time')
                    ->get();}
            if ($a==2){
                $res=self::join('form_type','form_type.type_id','form.type_id')
                    ->join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                    ->where('status_id','=','3')
                    ->select('form.type_id','type_name','applicant_name','destine_start_time','destine_end_time')
                    ->get();}
            if ($a==3){
                $res=self::join('form_type','form_type.type_id','form.type_id')
                    ->join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                    ->where('status_id','=','5')
                    ->select('form.type_id','type_name','applicant_name','destine_start_time','destine_end_time')
                    ->get();}
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /*
     *根据生情人搜索搜索
     */
    public static function search($applicant_name){
        try {
            $res=self::join('form_type','form_type.type_id','form.type_id')
                ->join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                ->where('applicant_name','=',$applicant_name)
                ->select('form.type_id','type_name','applicant_name','destine_start_time','destine_end_time')
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /*
    *审批设备借用
    */
    public static function approve1($form_id){
        try {
            $res=DB::table('equipment_borrow')
                ->where('form_id','=',$form_id)
                ->select('borrow_department','borrow_application','destine_start_time','borrower_name','borrower_phone','destine_end_time')
                ->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /*
    *审批设备借用清单
    */
    public static function approve2($form_id){
        try {
            $res=DB::table('equipment_borrow_checklist')
                ->join('equipment','equipment.equipment_id','=','equipment_borrow_checklist.equipment_id')
                ->where('form_id','=',$form_id)
                ->select('equipment_name','equipment_number','model','annex')
                ->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /*
        *借用部门负责人审批为同意
        */
    public static function approve3($form_id,$form_status,$name){
        try {
            $a=DB::table('approve')
                ->where('form_id',$form_id)
                ->update([
                    'borrowing_department_name'=>$name
                ]);

            $res=self::where('form_id',$form_id)
                ->update([
                    'status_id'=>$form_status
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}


    /*
        *借用部门负责人审批为否决
        */
    public static function approve4($form_id,$form_status,$name){
        try {
            $a=DB::table('approve')
                ->where('form_id',$form_id)
                ->update([
                    'borrowing_department_name'=>$name
                ]);
            $res=self::where('form_id',$form_id)
                ->update([
                    'status_id'=>$form_status
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /*
            *普通管理员负责人审批为同意
            */
    public static function approve5($form_id,$form_status,$name){
        try {
            $a=DB::table('approve')
                ->where('form_id',$form_id)
                ->update([
                    'borrowing_manager_name'=>$name
                ]);

            $res=self::where('form_id',$form_id)
                ->update([
                    'status_id'=>$form_status
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}


    /*
        *普通管理员审批为否决
        */
    public static function approve6($form_id,$form_status,$name){
        try {
            $a=DB::table('approve')
                ->where('form_id',$form_id)
                ->update([
                    'borrowing_manager_name'=>$name
                ]);
            $res=self::where('form_id',$form_id)
                ->update([
                    'status_id'=>$form_status
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}


    /*
           *中心主任审批为同意
           */
    public static function approve7($form_id,$form_status,$name){
        try {
            $res=DB::table('approve')
                ->where('form_id',$form_id)
                ->update([
                    'status_id'=>$form_status
                ]);
            $e=self::where('form_id',$form_id)
                ->update([
                    'center_director_name'=>$name
                ]);

            $a=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->value('number');
            $b=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->value('equipment_number');
            $c=$a-$b;
            $D=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->update([
                    'number'=>$c
                ]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}


    public static function approve8($form_id,$form_status,$name){
        try {
            $a=DB::table('approve')
                ->where('form_id',$form_id)
                ->update([
                    'center_director_name'=>$name
                ]);
            $res=self::where('form_id',$form_id)
                ->update([
                    'status_id'=>$form_status
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}





}
