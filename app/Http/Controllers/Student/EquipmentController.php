<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\student\AddEquipment_borrow_checklistRequest;
use App\Http\Requests\student\AddEquipmentRequest;
use App\Http\Requests\student\DeleteEquipmentRequest;
use App\Http\Requests\student\EquipmentBorrowRequest;
use App\Http\Requests\student\EquipmentBorrowUpdateRequest;
use App\Http\Requests\student\ReturnEquipmentRequest;
use App\Http\Requests\student\SelectEquipmenlistRequest;
use App\Http\Requests\student\SelectEquipment_borrowRequest;
use App\Http\Requests\student\SelectReturnEquipmentRequest;
use App\Http\Requests\student\UpdateEquipmentRequest;
use App\Models\Equipment;
use App\Models\Equipment_borrow;
use App\Models\Equipment_borrow_checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;





/*
 * 实验室设备表
 */
class EquipmentController extends Controller
{

    /**
     * 实验室仪器设备表借用
     * @author oys
     * @param EquipmentBorrowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function EquipmentBorrow(EquipmentBorrowRequest $request)
    {
        $form_id='t1'.date("ymjHis");
        $borrow_department=$request['borrow_department'];
        $borrow_application=$request['borrow_application'];
        $destine_start_time=$request['destine_start_time'];
        $destine_end_time=$request['destine_end_time'];
        $borrower_name=$request['borrower_name'];
        $borrower_phone=$request['borrower_phone'];
        $res = Equipment_borrow::oys_InsertEquipment_borrow($form_id,$borrow_department,$borrow_application,$destine_start_time,$destine_end_time,$borrower_name,$borrower_phone);
        return $res ?  //判断
            json_success("存入成功",$res,200):
            json_fail("存入失败",NULL,100);
    }


    /**
     * 设备的添加
     * @author oys
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AddEquipment(AddEquipmentRequest $request)
    {
        $equipment_name=$request['equipment_name'];
        $model=$request['model'];
        $number=$request['number'];
        $annex=$request['annex'];
        $res = Equipment::AddEquipment($equipment_name,$model,$number,$annex);
        return $res ?
            json_success("存入成功",$res,200):
            json_fail("存入失败",NULL,100);
    }

    /**
     * 设备的删除
     * @author oys
     * @param DeleteEquipmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function DeleteEquipment(DeleteEquipmentRequest $request)
    {
        $equipment_id=$request['equipment_id'];
        $res = Equipment::DeleteEquipment($equipment_id);
        return $res ?
            json_success("删除成功",$res,200):
            json_fail("删除失败",NULL,100);
    }



    /**
     * 设备的修改
     * @author oys
     * @param UpdateEquipmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateEquipment(UpdateEquipmentRequest $request)
    {
        $equipment_id=$request['equipment_id'];
        $equipment_name=$request['equipment_name'];
        $model=$request['model'];
        $number=$request['number'];
        $annex=$request['annex'];
        $res = Equipment::UpdateEquipment($equipment_id,$equipment_name,$model,$number,$annex);
        return $res ?
            json_success("修改成功",$res,200):
            json_fail("修改失败",NULL,100);
    }



    /**
     * 在添加完所有设备以后进行  设备清单表的添加
     * @author oys
     * @param AddEquipment_borrow_checklistRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AddEquipment_borrow_checklist(AddEquipment_borrow_checklistRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Equipment::AllEquipment();
        foreach($res as $v)
        {
            $equipment_id=$v->equipment_id;
            $equipment_number=$v->number;
            $res2=Equipment_borrow_checklist::Addequipment_borrow_checklist($form_id,$equipment_id,$equipment_number);
        }
        return $res ?
            json_success("存入成功",NULL,200):
            json_fail("存入失败",NULL,100);
    }



    /**
     * 查看设备借用表
     * @author oys
     * @param SelectEquipment_borrowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectEquipment_borrow(SelectEquipment_borrowRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Equipment_borrow::SelectEquipment_borrow($form_id);
        return $res ?
            json_success("查看成功",$res,200):
            json_fail("查看失败",NULL,100);
    }


    /**
     * 查看设备借用清单
     * @author oys
     * @param SelectEquipmenlistRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectEquipmenlist(SelectEquipmenlistRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Equipment_borrow_checklist::SelectEtquipmenlist($form_id); //找到这个需要查找的多个设备id
        $res1=array();
        foreach($res as $v)  //设备集id 遍历，封装新的设备清单，输出设备
        {
            $res2 =Equipment::SelectEquipment($v->equipment_id);  //查找设备信息
            array_push($res1,$res2);
        }
        return $res1 ?
            json_success("查看设备借用清单成功",$res1,200):
            json_fail("查看设备借用清单失败",NULL,100);
    }





    /**
     * 设备借用表信息的修改
     * @author oys
     * @param EquipmentBorrowUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function EquipmentBorrowUpdate(EquipmentBorrowUpdateRequest $request)
    {
        $form_id=$request['form_id'];
        $borrow_department=$request['borrow_department'];
        $borrow_application=$request['borrow_application'];
        $destine_start_time=$request['destine_start_time'];
        $destine_end_time=$request['destine_end_time'];
        $borrower_name=$request['borrower_name'];
        $borrower_phone=$request['borrower_phone'];
        $res = Equipment_borrow::EquipmentBorrowUpdate($form_id,$borrow_department,$borrow_application,$destine_start_time,$destine_end_time,$borrower_name,$borrower_phone);//找到这个需要查找的多个设备id
        return $res ?
            json_success("修改设备借用清单成功",$res,200):
            json_fail("修改设备借用清单失败",NULL,100);
    }



    /**
     * 归还设备信息查看
     * @author oys
     * @param
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectReturnEquipment(Request $request)
    {
        $res = Equipment::AllreturnEquipment();//设备的查看
        return $res ?
            json_success("查看归还设备成功",$res,200):
            json_fail("查看归还设备失败",NULL,100);
    }



    /**
     * 归还设备
     * @author oys
     * @param
     * @return \Illuminate\Http\JsonResponse
     */
    public function ReturnEquipment(ReturnEquipmentRequest $request)
    {
        $equipment_id=$request['equipment_id'];
        $info=$request['info'];
        $res = Equipment::ReturnEquipment($equipment_id,$info);//设备的归还
        return $res ?
            json_success("归还设备成功",$res,200):
            json_fail("归还设备失败",NULL,100);
    }


}
