<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment_borrow_checklist extends Model
{

    protected $table = "equipment_borrow_checklist";
    public $timestamps = true;
    protected $primaryKey = "checlist_id";
    protected $guarded = [];

    /**
     * yjx
     * 查询设备归还记录
     * @param $checlist_id
     * @return false
     */
    public static function show($checklist_id){
        try {
            $res = self::where('checklist_id','=',$checklist_id)->get();
            return $res?
                $res:
                false;

        }catch (\Exception $e ){
            logError('查询错误', [$e->getMessage()]);}}

    /**
     * 设备借用表录入借用清单
     * @author oys
     * @param $form_id
     * @param $equipment_id
     * @param $equipment_number
     * @return false
     */
    public static function Addequipment_borrow_checklist($form_id,$equipment_id,$equipment_number)
    {
        try {
            //设备表成功
            $res=self::create(
                [
                    'form_id'=>$form_id,
                    'equipment_id'=>$equipment_id,
                    'equipment_number'=>$equipment_number,
                ]
            );
            return $res;
        }catch (\Exception $e){
            logError('设备清单录入成功',[$e->getMessage()]);

            return false;
        }
    }


    public static function shenpi(){}

    /**
     * 通过表名 查看设备调用清单
     * @author oys
     * @param $form_id
     * @return false
     */
    public static function SelectEtquipmenlist($form_id)
    {
        try {
            $res=self::where('form_id',$form_id)->get();
            return $res;
        }catch (\Exception $e){
            logError('查询所有设备成功',[$e->getMessage()]);
            return false;
        }
    }



}
