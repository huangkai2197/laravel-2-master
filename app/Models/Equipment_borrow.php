<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment_borrow extends Model
{

    protected $table = "equipment_borrow";
    public $timestamps = true;
    protected $primaryKey = "form_id";
    protected $guarded = [];

    /***
     * yjx
     * 查询借出记录
     * @param $form_id
     * @return false
     */
    public static function show($form_id)
    {
        try {

            $res = self::join('equipment_borrow_checklist', 'equipment_borrow_checklist.form_id', 'equipment_borrow.form_id')
                ->join('equipment', 'equipment.equipment_id', 'equipment_borrow_checklist.equipment_id')
                ->where('status', 1)
                ->select('equipment_borrow_checklist.form_id','equipment_borrow_checklist.equipment_id', 'equipment_number', 'borrower_name', 'model','equipment_name','status','info')
                ->where('equipment_borrow_checklist.form_id','=',$form_id)
                ->get();

            return $res ?
                $res :
                false;

        } catch (\Exception $e) {
            logError('查询错误', [$e->getMessage()]);
        }
    }


    /***
     * yjx
     * 查询所有设备借出*************************************************
     * @return false
     */
    public static function showall()
    {
        try {
            $res = self::join('equipment_borrow_checklist', 'equipment_borrow_checklist.form_id', 'equipment_borrow.form_id')
                ->join('equipment', 'equipment.equipment_id', 'equipment_borrow_checklist.equipment_id')
                ->where('status', 1)
                ->select('equipment_borrow_checklist.equipment_id', 'equipment_number', 'borrower_name', 'model','equipment_name','status','info')
                ->get();
            return $res ?
                $res :
                false;

            /* $res=self::get();
             return $res;*/
        } catch (\Exception $e) {
            logError('搜索错误！', [$e->getMessage()]);
            return false;
        }

    }


    /**
     * 学生填写设备借用表
     * @param $borrow_department
     * @param $borrow_application
     * @param $destine_start_time
     * @param $destine_end_time
     * @param $borrower_name
     * @param $borrower_phone
     * @return false
     * @author oys
     */
    public static function oys_InsertEquipment_borrow($form_id, $borrow_department, $borrow_application, $destine_start_time, $destine_end_time, $borrower_name, $borrower_phone)
    {
        try {
            //录入设备借用表数据
            $res = self::create(
                [
                    'form_id' => $form_id,
                    'borrow_department' => $borrow_department,
                    'borrow_application' => $borrow_application,
                    'destine_start_time' => $destine_start_time,
                    'destine_end_time' => $destine_end_time,
                    'borrower_name' => $borrower_name,
                    'borrower_phone' => $borrower_phone
                ]
            );
            return $res;
        } catch (\Exception $e) {
            logError('实验仪器设备借用表录入成功', [$e->getMessage()]);
            return false;
        }
    }


    /**
     * 学生查看设备借用表
     * @param $form_id
     * @return false
     * @author oys
     */
    public static function SelectEquipment_borrow($form_id)
    {
        try {
            //录入设备借用表数据
            $res = self::where('form_id', $form_id)->first();
            return $res;
        } catch (\Exception $e) {
            logError('设备借用表查看成功', [$e->getMessage()]);

            return false;
        }
    }


    /**
     * 修改设备借用表
     * @param $form_id
     * @param $borrow_department
     * @param $borrow_application
     * @param $destine_start_time
     * @param $destine_end_time
     * @param $borrower_name
     * @param $borrower_phone
     * @return false
     * @author oys
     */
    public static function EquipmentBorrowUpdate($form_id, $borrow_department, $borrow_application, $destine_start_time, $destine_end_time, $borrower_name, $borrower_phone)
    {
        try {
            //修改设备借用表数据
            $res = self::where('form_id', $form_id)->update([
                'borrow_department' => $borrow_department,
                'borrow_application' => $borrow_application,
                'destine_start_time' => $destine_start_time,
                'destine_end_time' => $destine_end_time,
                'borrower_name' => $borrower_name,
                'borrower_phone' => $borrower_phone,
            ]);
            return $res;
        } catch (\Exception $e) {
            logError('设备借用表修改成功', [$e->getMessage()]);
            return false;
        }
    }

}
