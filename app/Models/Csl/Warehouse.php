<?php

namespace App\Models\Csl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Warehouse extends Model
{
    protected $table = "equipment";
    public $timestamps = true;
    protected $guarded = [];

    /**设备信息展示
     * @return
     *
     */
    public static function eshow(){
        try {
            $res=self::select('equipment_id','equipment_name','model','number')->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}

    /**设备信息展示
     * @return
     *
     */
    public static function esearch($applicant_name){
        try {
            $res=DB::table('equipment_borrow_checklist')
                ->join('form','equipment_borrow_checklist.form_id','=','form.form_id')
                ->join('equipment','equipment_borrow_checklist.equipment_id','=','equipment.equipment_id')
                ->where('applicant_name','=',$applicant_name)
                ->select('equipment.equipment_id','equipment_name','model','number')
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}






















}
