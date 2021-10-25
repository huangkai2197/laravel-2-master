<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\student\AddLabrunRequest;
use App\Http\Requests\student\DeleteLabrunRequest;
use App\Http\Requests\student\SelectLabrunRequest;
use App\Http\Requests\student\UpdateLabrunRequest;
use App\Models\Laboratory_operation_records;
use Illuminate\Http\Request;

class LabrunController extends Controller
{


    /**
     * 运行记录的添加
     * @author oys
     * @param AddLabrunRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AddLabrun(AddLabrunRequest $request)
    {
        $form_id='t3'.date("ymjHis");
        $laboratory_id=$request['laboratory_id'];
        $week=$request['week'];
        $time=$request['time'];
        $class_id=$request['class_id'];
        $number=$request['number'];
        $class_name=$request['class_name'];
        $class_type=$request['class_type'];
        $teacher=$request['teacher'];
        $situation=$request['situation'];
        $remark=$request['remark'];
        $res = Laboratory_operation_records::AddLabrun($form_id,$laboratory_id,$week,$time,$class_id,$number,$class_name,$class_type,$teacher,$situation,$remark);
        return $res ?
            json_success("存入成功",$res,200):
            json_fail("存入失败",NULL,100);
    }



    /**
     * 运行记录的删除
     * @author oys
     * @param DeleteLabrunRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function DeleteLabrun(DeleteLabrunRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Laboratory_operation_records::DeleteEquipment($form_id);
        return $res ?
            json_success("删除成功",$res,200):
            json_fail("删除失败",NULL,100);
    }



    /**
     * 运行记录的修改
     * @author oys
     * @param UpdateLabrunRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateLabrun(UpdateLabrunRequest $request)
    {
        $form_id=$request['form_id'];
        $laboratory_id=$request['laboratory_id'];
        $week=$request['week'];
        $time=$request['time'];
        $class_id=$request['class_id'];
        $number=$request['number'];
        $class_name=$request['class_name'];
        $class_type=$request['class_type'];
        $teacher=$request['teacher'];
        $situation=$request['situation'];
        $remark=$request['remark'];
        $res = Laboratory_operation_records::UpdateLabrun($form_id,$laboratory_id,$week,$time,$class_id,$number,$class_name,$class_type,$teacher,$situation,$remark);
        return $res ?
            json_success("修改成功",$res,200):
            json_fail("修改失败",NULL,100);
    }


    /**
     * 运行记录的查看
     * @author oys
     * @param SelectLabrunRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectLabrun(SelectLabrunRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Laboratory_operation_records::SelectLabrun($form_id);
        return $res ?
            json_success("运行记录的查看成功",$res,200):
            json_fail("运行记录的查看失败",NULL,100);
    }



}
