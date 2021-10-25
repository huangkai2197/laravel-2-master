<?php

namespace App\Http\Controllers\Equipment;
use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentCangRequest;
use App\Http\Requests\EquipmentCangRequest1;
use Illuminate\Http\Request;
use App\Models\EquipmentCang;
class EquipmentCangController extends Controller
{
    /**
     * yjx
     * 增加实验器材
     * @param EquipmentCangRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(EquipmentCangRequest$request){
        $equipment_id = $request['equipment_id'];
        $equipment_name = $request['equipment_name'];
        $model = $request['model'];
        $number = $request['number'];
        //$annex = $request['annex'];
        //$status = $request['status'];
        //$info = $request['info'];

        $res = EquipmentCang::add(
            $equipment_id,
            $equipment_name,
            $model,
            $number
            //$annex,
            //$status,
            //$info
        );
        return $res?
            json_success("操作成功",$res,200):
            json_fail("操作失败",$res,100);

    }

    /***
     * yjx
     * 修改器材
     * @param EquipmentCangRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modify(EquipmentCangRequest $request){
        $equipment_id = $request['equipment_id'];
        $equipment_name = $request['equipment_name'];
        $model = $request['model'];
        $number = $request['number'];
        //$annex = $request['annex'];
        //$status = $request['status'];
        //$info = $request['info'];

        $res = EquipmentCang::modify(
            $equipment_id,
            $equipment_name,
            $model,
            $number
            //$annex,
            //$status,
            //$info
        );
        return $res?
            json_success("操作成功",$res,200):
            json_fail("操作失败",$res,100);

    }

    /***
     * yjx
     * 删除器材
     * @param EquipmentCangRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(EquipmentCangRequest1 $request)
    {
        $equipment_id = $request['equipment_id'];
        $res = EquipmentCang::delete1($equipment_id);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }

    /***
     * yjx
     * 查询器材
     * @param EquipmentCangRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(EquipmentCangRequest1 $request)
    {
        $equipment_id = $request['equipment_id'];
        $res = EquipmentCang::show($equipment_id);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }

    /***
     * yjx
     * 查询所有设备
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){
        $res = EquipmentCang::showall();
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);


    }


}
