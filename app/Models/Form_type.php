<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_type extends Model
{

    protected $table='form_type';
    public  $timestamps=true;
    protected $guarded = [];

    /**
     * 查看表单种类
     * @author oys
     * @param $type_id
     * @return false
     */
    public static function SelectFormtype($type_id)
    {
        try {
            $res=self::where('type_id',$type_id)->value('type_name');
            return $res;
        }catch (\Exception $e){
            logError('表单种类查看成功',[$e->getMessage()]);
            return false;
        }
    }
}
