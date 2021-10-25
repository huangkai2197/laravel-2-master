<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentReturn extends Model
{
    protected $table = "equipment";
    public $timestamps = true;
    protected $primaryKey = "equipment_id";
    protected $guarded = [];


    /***
     * yjx
     * 归还改变状态
     * @param $equipment_id
     * @return false
     */
    public static function changestatus($equipment_id)
    {
        try {
            //dd($status);
            $res = EquipmentReturn::where('equipment_id', '=', $equipment_id)->update(
                [
                    'status' => 2
                ]
            );

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('改变错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * YJX
     * 查询设备
     * @param $equipment_id
     * @return false
     */
    public static function show($equipment_id)
    {
        try {
            $res = Student::where('equipment_id', $equipment_id)->get();
            return $res ?
                $res :
                false;

        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /****
     * @param $account
     * @return false
     */
    public static function showall($status)
    {
        try {
            $res = Student::where('status', $status)->get();
            return $res ?
                $res :
                false;

        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }


}
