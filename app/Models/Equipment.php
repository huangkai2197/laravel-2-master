<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//设备表
class Equipment extends Model
{
    protected $table='equipment';
    protected $primaryKey='equipment_id';
    public  $timestamps=true;
    protected $guarded = [];


    /**
     * 设备的增加
     * @author oys
     * @param $equipment_name
     * @param $model
     * @param $number
     * @param $annex
     * @return false
     */
    public static function AddEquipment($equipment_name,$model,$number,$annex)
    {
        try {
            //设备表成功
            $res=self::create(
                [
                    'equipment_name'=>$equipment_name,
                    'model'=>$model,
                    'number'=>$number,
                    'annex'=>$annex,
                ]
            );
            return $res;
        }catch (\Exception $e){
            logError('设备录入成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 设备的删除
     * @author oys
     * @param $equipment_id
     * @return false
     */
    public static function DeleteEquipment($equipment_id)
    {
        try {
            $res=self::where('equipment_id',$equipment_id)->delete();
            return $res;
        }catch (\Exception $e){
            logError('设备删除成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 设备的修改
     * @author oys
     * @param $equipment_id
     * @param $equipment_name
     * @param $model
     * @param $number
     * @param $annex
     * @return false
     */
    public static function UpdateEquipment($equipment_id,$equipment_name,$model,$number,$annex)
    {
        try {
            $res=self::where('equipment_id',$equipment_id)->
            update([
                'equipment_name'=>$equipment_name,
                'model'=>$model,
                'number'=>$number,
                'annex'=>$annex,
            ]);
            return $res;
        }catch (\Exception $e){
            logError('设备修改成功',[$e->getMessage()]);
            return false;
        }
    }

    /**
     * 查看所有设备
     * @author oys
     * @return false
     */
    public static function AllEquipment()
    {
        try {
            //设备查看成功
            $res=self::get();
            return $res;
        }catch (\Exception $e){
            logError('设备录入成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 在设备归还 中查看所有设备的信息
     * @author oys
     * @return false
     */
    public static function AllreturnEquipment()
    {
        try {
            //设备查看成功
            $res=self::select('equipment.equipment_id','equipment.equipment_name','equipment.number','equipment.annex','equipment.updated_at','equipment_borrow_checklist.form_id','equipment_borrow.borrower_name','equipment.status')
                ->leftJoin('equipment_borrow_checklist','equipment.equipment_id','equipment_borrow_checklist.equipment_id')  //右连equipment_borrow_checklist表找from id
                ->leftJoin('equipment_borrow','equipment_borrow_checklist.form_id','equipment_borrow.form_id')  //右连equipment_borrow_checklist表找from id
                ->distinct('equipment.equipment_id')  //去重
                ->where('equipment.status','1')     //查询被借的设备
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('设备录入成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 查看单个的设备
     * @author oys
     * @param $equipment_id
     * @return false
     */
    public static function SelectEquipment($equipment_id)
    {
        try {
            //设备查看成功
            $res=self::where('equipment_id',$equipment_id)->first();
            return $res;
        }catch (\Exception $e){
            logError('设备录入成功',[$e->getMessage()]);
            return false;
        }
    }

    /*
     *设备的归还
     */
    public static function ReturnEquipment($equipment_id,$info)
    {
        try {
            //设备的归还
            $res=self::where('equipment_id',$equipment_id)->
            update([
                'status'=>2,
                'info'=>$info,
            ]);
            return $res;
        }catch (\Exception $e){
            logError('设备归还成功',[$e->getMessage()]);
            return false;
        }
    }


}
