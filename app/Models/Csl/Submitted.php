<?php

namespace App\Models\Csl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Submitted extends Model
{
    protected $table = "form";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /*
   *借用部门负责人审批已经提交表单信息展示
  */
    public static function aftershow1(){

        try {
            $a="借用部门负责人审批未通过";
            $b="借用管理员待审批";
            $res=self::join('form_type','form_type.type_id','form.type_id')
                ->join('form_status','form_status.status_id','form.status_id')
                ->join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                ->select('form.type_id','type_name','applicant_name','destine_start_time','form.status_id','status_name','destine_end_time','form.updated_at')
                ->where('status_name','=',$b)
                ->Orwhere('status_name','=',$a)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}


    /*
   *普通管理员审批已经提交表单信息展示
  */
    public static function aftershow2(){
        try {
            $a="借用管理员审批未通过";
            $b="中心主任待审批";
            $res=self::join('form_type','form_type.type_id','form.type_id')
                ->join('form_status','form_status.status_id','form.status_id')
                ->join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                ->select('form.type_id','type_name','applicant_name','destine_start_time','form.status_id','status_name','destine_end_time','form.updated_at')
                ->where('status_name','=',$b)
                ->Orwhere('status_name','=',$a)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}

    /*
  *中心主任审批已经提交表单信息展示
 */
    public static function aftershow3(){
        try {
            $a="中心主任审批未通过";
            $b="审批通过/表单完成";
            $res=self::join('form_type','form_type.type_id','form.type_id')
                ->join('form_status','form_status.status_id','form.status_id')
                ->join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                ->select('form.type_id','type_name','applicant_name','destine_start_time','form.status_id','status_name','destine_end_time','form.updated_at')
                ->where('status_name','=',$b)
                ->Orwhere('status_name','=',$a)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}

    /*
     * 根据申请人搜索
     */
    public static function search($applicant_name){
        try {
            $res=self::join('form_type','form_type.type_id','form.type_id')
                ->join('form_status','form_status.status_id','form.status_id')
                ->join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                ->select('form.type_id','type_name','applicant_name','destine_start_time','form.status_id','status_name','destine_end_time','form.updated_at')
                ->where('applicant_name','=',$applicant_name)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /*
     * 根据申请人搜索
     */
    public static function look($applicant_name){
        try {
            $res=self::join('form_type','form_type.type_id','form.type_id')

                ->where('applicant_name','=',$applicant_name)
                ->select('form.type_id','type_name','applicant_name','form.created_at','form_status')
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}



    public static function afterlook3($form_id){
        try {
            $a=self::where('form_id',$form_id)
                ->value('status_id');

            if ($a==3 || $a==5 || $a==11){
                $res['status_name']="同意";
            }
            if ($a==4 || $a==2 || $a==6){
                $res['status_name']="否决";
            }
            return $res?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}

//找到审批表对应的状态
    public static function afterchange($form_id){
        try {
            $res=self::where('form_id',$form_id)
                ->value('status_id');
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}




    public static function agree1($form_id,$form_status){
        try {
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

    public static function disagree1($form_id,$form_status){
        try {
            $a=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->value('number');
            $b=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->value('equipment_number');
            $c=$a+$b;

            $b=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->update([
                    'number'=>$c
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

    public static function agree2($form_id,$form_status){
        try {
            $a=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->value('number');
            $b=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->value('equipment_number');
            $c=$a-$b;

            $b=DB::table('equipment')
                ->join('equipment_borrow_checklist','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('form_id','=',$form_id)
                ->update([
                    'number'=>$c
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
        *审批为否决
        */
    public static function disagree2($form_id,$form_status){
        try {
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
