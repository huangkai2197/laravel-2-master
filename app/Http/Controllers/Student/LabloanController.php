<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\student\LabBorrowRequest;
use App\Http\Requests\student\SelectLabloanRequest;
use App\Http\Requests\student\UpdateLabloanRequest;
use App\Models\Laboratory_loan;
use Illuminate\Http\Request;

class LabloanController extends Controller
{

    /**
     * 实验室借用记录
     * oys
     * @param LabBorrowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function LabBorrow(LabBorrowRequest $request)
    {
        $form_id='t2'.date("ymjHis");
        $laboratory_id=$request['laboratory_id'];
        $course_name=$request['course_name'];
        $class_id=$request['class_id'];
        $number=$request['number'];
        $purpose=$request['purpose'];
        $start_time=$request['start_time'];
        $end_time=$request['end_time'];
        $start_class=$request['start_class'];
        $end_class=$request['end_class'];
        $phone=$request['phone'];
        $res = Laboratory_loan::LabBorrow($form_id,$laboratory_id,$course_name,$class_id,$number,$purpose,$start_time,$end_time,$start_class,$end_class,$phone);
        return $res ?  //判断
            json_success("提交成功",$res,200):
            json_fail("提交失败",NULL,100);
    }



    /**
     * 查看实验室借用表单
     * @author oys
     * @param SelectLabloanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectLabloan(SelectLabloanRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Laboratory_loan::SelectLabloan($form_id);
        return $res ?  //判断
            json_success("查看成功",$res,200):
            json_fail("查看失败",NULL,100);
    }



    /**
     * 修改实验室表单申请表的 信息
     * @author oys
     * @param UpdateLabloanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateLabloan(UpdateLabloanRequest $request)
    {
        $form_id=$request['form_id'];
        $laboratory_id=$request['laboratory_id'];
        $course_name=$request['course_name'];
        $class_id=$request['class_id'];
        $number=$request['number'];
        $purpose=$request['purpose'];
        $start_time=$request['start_time'];
        $end_time=$request['end_time'];
        $start_class=$request['start_class'];
        $end_class=$request['end_class'];
        $phone=$request['phone'];
        $res = Laboratory_loan::UpdateLabloan($form_id,$laboratory_id,$course_name,$class_id,$number,$purpose,$start_time,$end_time,$start_class,$end_class,$phone);
        return $res ?  //判断
            json_success("修改成功",$res,200):
            json_fail("修改失败",NULL,100);
    }




}
