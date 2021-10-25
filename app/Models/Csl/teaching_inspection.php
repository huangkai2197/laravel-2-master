<?php

namespace App\Models\Csl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class teaching_inspection extends Model
{
    protected $table = "teaching_inspection";
    public $timestamps = true;
    protected $guarded = [];

    /*
          *审批为否决的原因存入
          */
    public static function approve5($form_id,$reason){
        try {
            $res=self::where('form_id',$form_id)
                ->update([
                        'reason'=>$reason
                    ]
                );
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}


    /*
      * 期末实验教学检查记录信息展示
      */
    public static function jlshow1($name,$form_id){
        try {

            $a=DB::table('teaching_inspection_info')
                ->update(['form_id'=>$form_id]);
            $res=self::create([
                'name'=>$name,
                'form_id'=>$form_id
            ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}






}
