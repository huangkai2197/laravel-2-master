<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\student\OpenlabAddstuRequest;
use App\Http\Requests\student\OpenlabBorrowRequest;
use App\Http\Requests\student\OpenlabDeletestuRequest;
use App\Http\Requests\student\OpenlabSelectRequest;
use App\Http\Requests\student\OpenlabSelectstuRequest;
use App\Http\Requests\student\OpenlabUpdatestuRequest;
use App\Models\Open_laboratory_loan;
use App\Models\Open_laboratory_student_list;
use Illuminate\Http\Request;

class OpenlabController extends Controller
{


    /**
     * 开放实验室借用记录
     * @author oys
     * @param OpenlabBorrowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function OpenlabBorrow(OpenlabBorrowRequest $request)
    {
        $form_id='t4'.date("ymjHis");
        $reason_use=$request['reason_use'];
        $porject_name=$request['porject_name'];
        $start_time=$request['start_time'];
        $end_time=$request['end_time'];
        $res = Open_laboratory_loan::Openlab_borrow($form_id,$reason_use,$porject_name,$start_time,$end_time);
        return $res ?  //判断
            json_success("提交成功",$res,200):
            json_fail("提交失败",NULL,100);
    }


    /**
     * 开放实验室申请查看
     * @author oys
     * @param OpenlabSelectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function OpenlabSelect(OpenlabSelectRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Open_laboratory_loan::OpenlabSelect($form_id);
        return $res ?  //判断
            json_success("提交成功",$res,200):
            json_fail("提交失败",NULL,100);
    }



    /**
     * 申请学生的添加
     * @author oys
     * @param OpenlabAddstuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function OpenlabAddstu(OpenlabAddstuRequest $request)
    {
        $form_id=$request['form_id'];
        $student_name=$request['student_name'];
        $student_id=$request['student_id'];
        $phone=$request['phone'];
        $work=$request['work'];
        $res = Open_laboratory_student_list::AddStudent($form_id,$student_name,$student_id,$phone,$work);
        return $res ?
            json_success("存入成功",$res,200):
            json_fail("存入失败",NULL,100);
    }



    /**
     * 申请学生的删除
     * @author oys
     * @param OpenlabDeletestuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function OpenlabDeletestu(OpenlabDeletestuRequest $request)
    {
        $list_id=$request['list_id'];
        $res = Open_laboratory_student_list::DeleteStudent($list_id);
        return $res ?
            json_success("删除成功",$res,200):
            json_fail("删除失败",NULL,100);
    }



    /**
     * 申请学生的修改
     * @author oys
     * @param OpenlabUpdatestuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function OpenlabUpdatestu(OpenlabUpdatestuRequest $request)
    {
        $list_id=$request['list_id'];
        $student_name=$request['student_name'];
        $student_id=$request['student_id'];
        $phone=$request['phone'];
        $work=$request['work'];
        $res = Open_laboratory_student_list::UpdateStudent($list_id,$student_name,$student_id,$phone,$work);
        return $res ?
            json_success("修改成功",$res,200):
            json_fail("修改失败",NULL,100);
    }


    /**
     * 申请学生的查看
     * @author oys
     * @param OpenlabSelectstuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function OpenlabSelectstu(OpenlabSelectstuRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Open_laboratory_student_list::SelectStudent($form_id);
        return $res ?
            json_success("查看成功",$res,200):
            json_fail("查看失败",NULL,100);
    }

}
