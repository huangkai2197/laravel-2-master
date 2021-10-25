<?php

namespace App\Http\Controllers\Laboratory;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaboratoryRequest;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratroyController extends Controller
{
    /**
     * yjx
     * 查看实验室
     * @param LaboratoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(LaboratoryRequest $request){
        $laboratory_id = $request['laboratory_id'];
        /*$laboratory_name = $request['laboratory_name'];
        $place = $request['place'];
        $type = $request['type'];*/

        $res = Laboratory::show($laboratory_id);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }

    /***
     * yjx
     * 查询所有实验室
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){

        $res = Laboratory::showall();

        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);



    }
}
