<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment_borrowRequest;
use App\Models\Equipment_borrow;
use Illuminate\Http\Request;

class Equipment_borrowController extends Controller
{

    /****
     * yjx
     * 查询借出设备
     * @param Equipment_borrowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Equipment_borrowRequest $request){
        $form_id = $request['form_id'];
        $res = Equipment_borrow::show($form_id);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);
    }

    /***
     * yjx
     * 查询所有设备借出
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){

        $res = Equipment_borrow::showall();

        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);



    }
}
