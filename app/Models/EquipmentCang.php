<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentCang extends Model

{
    protected $table = "equipment";
    public $timestamps = true;
    protected $primaryKey = "equipment_id";
    protected $fillable = ['equipment_id','equipemnt_name','model','number','annex','status','info'];
    protected $guarded = [];


    /***
     * yjx
     * 增加实验器材
     * @param $equipment_id
     * @param $equipment_name
     * @param $model
     * @param $number
     * @return false
     */
    public static function add(
        $equipment_id,
        $equipment_name,
        $model,
        $number
        //$annex,
       //$status,
        //$info
    ){
        try {
            if ($number < 0) {
                return 0;
            } else {
                $res = self::insert(
                    [
                        'equipment_id' => $equipment_id,
                        'equipment_name' => $equipment_name,
                        'model' => $model,
                        'number' => $number,
                        //'annex' => $annex,
                        //'status' => $status,
                        //'info' => $info
                    ]
                );
                return $res ?
                    $res :
                    false;
            }
        } catch(\Exception $e ){
                logError('添加错误', [$e->getMessage()]);
                return false;
            }

     }

    /**
     * yjx
     *修改器材
     * @param $equipment_id
     * @param $equipment_name
     * @param $model
     * @param $number
     * @return false
     */
    public static function modify($equipment_id,
                                  $equipment_name,
                                  $model,
                                  $number
                                  //$annex,
                                  //$status,
                                  //$info
        ){
        try {
            if ($number < 0) {
                return 0;
            } else {
                $res = EquipmentCang::where('equipment_id', '=', $equipment_id)->update(
                    [

                        'equipment_id' => $equipment_id,
                        'equipment_name' => $equipment_name,
                        'model' => $model,
                        'number' => $number,
                        //'annex'=>$annex,
                        //'status'=>$status,
                        //'info'=>$info
                    ]
                );
                return $res ?
                    $res :
                    false;
            }
        }catch (\Exception $e ){
            logError('改变错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 删除器材
     * @param $equipment_id
     * @return false
     */
    public static function delete1($equipment_id){
        try {
            //dd($equipment_id);
            $res = EquipmentCang::where('equipment_id','=',$equipment_id)->delete();
            return $res ?
                $res :
                false;

        }catch (\Exception $e){
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx
     * 查询器材
     * @param $equipment_id
     * @return false
     */
    public static function show($equipment_id){
        try {
            $res = EquipmentCang::where('equipment_id','=',$equipment_id)->get();
            return $res ?
                $res :
                false;

        }catch (\Exception $e){
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx‘
     * 查询所有设备
     * @return false
     */
    public static function showall(){
        try {
            $res=self::get();
            return $res;
        } catch (\Exception $e) {
            logError('搜索错误！', [$e->getMessage()]);
            return false;
        }

    }
}
