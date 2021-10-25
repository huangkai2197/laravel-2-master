<?php

namespace App\Models\Csl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Form extends Model
{
    protected $table = "form";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function tjform(){
        try {
            $a=self::join('form_type','form.type_id','form_type.type_id')
                ->where('type_name','实验室借用申请表单')
                ->where('status_id',11)
                ->count();
            $b=self::join('form_type','form.type_id','form_type.type_id')
                ->where('type_name','实验室仪器设备借用单')
                ->where('status_id',11)
                ->count();
            $c=self::join('form_type','form.type_id','form_type.type_id')
                ->where('type_name','开放实验室使用申请单')
                ->where('status_id',11)
                ->count();
            $d=self::join('form_type','form.type_id','form_type.type_id')
                    ->where('type_name','实验室借用申请表单')
                    ->count()-$a;
            $e=self::join('form_type','form.type_id','form_type.type_id')
                    ->where('type_name','实验室仪器设备借用单')
                    ->count()-$b;
            $f=self::join('form_type','form.type_id','form_type.type_id')
                    ->where('type_name','开放实验室使用申请单')
                    ->count()-$c;
            $res=array($a,$b,$c,$e,$f,$d);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}


}
