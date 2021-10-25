<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\DecideFormRequest;
use App\Http\Requests\SuperAdmin\SelectBypeopleRequest;
use App\Http\Requests\SuperAdmin\SelectCompleteBypeopleRequest;
use App\Http\Requests\SuperAdmin\SelectrunFormbypeopleRequest;
use App\Http\Requests\SuperAdmin\StopFormrunRequest;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{

    /**
     * 管理员查看审批中的表单
     * @author oys
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectFormrun()
    {
        $res = Form::SelectFormrun();
        return $res ?  //判断
            json_success("表单查看成功",$res,200):
            json_fail("表单查看失败",NULL,100);
    }

    /**
     * @author oys
     * 查看通过申请人 审批中的表单
     * @param SelectBypeopleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectBypeople(SelectBypeopleRequest $request)
    {
        $applicant_name=$request['applicant_name'];
        $res = Form::SelectBypeople($applicant_name);
        return $res ?  //判断
            json_success("表单查看成功",$res,200):
            json_fail("表单查看失败",NULL,100);
    }


    /**
     * @author oys
     * 审批中表单 终止审批/不同意通过
     * @param StopFormrunRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function StopFormrun(StopFormrunRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Form::StopFormrun($form_id);
        return $res ?  //判断
            json_success("终止审批成功",$res,200):
            json_fail("终止审批失败",NULL,100);
    }




    /**
     * @author oys
     * 审批通过
     * @param DecideFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function PassForm(DecideFormRequest $request)
    {
        $form_id=$request['form_id'];
        $res = Form::DecideForm($form_id);
        return $res ?  //判断
            json_success("表单通过成功",$res,200):
            json_fail("表单通过失败",NULL,100);
    }





    /**
     * 查看已审批的表单
     * @author oys
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectFormcomplete()
    {
        $res = Form::SelectFormcomplete();
        return $res ?  //判断
            json_success("已审批表单查看成功",$res,200):
            json_fail("已审批表单查看失败",NULL,100);
    }



    /**
     * @author oys
     * 查看通过申请人 查看已经审批的表单
     * @param SelectCompleteBypeopleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectCompleteBypeople(SelectCompleteBypeopleRequest $request)
    {
        $applicant_name=$request['applicant_name'];
        $res = Form::SelectCompleteBypeople($applicant_name);
        return $res ?  //判断
            json_success("表单查看成功",$res,200):
            json_fail("表单查看失败",NULL,100);
    }



    /**
     * @author oys
     * 审批通过的比例
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectFormnum()
    {
        $res = Form::SelectFormnum();
        return $res ?  //判断
            json_success("表单查看成功",$res,200):
            json_fail("表单查看失败",NULL,100);
    }




    /**
     * @author oys
     * 查看运行记录表
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectrunForm()
    {
        $res = Form::SelectrunForm();
        return $res ?  //判断
            json_success("表单查看成功",$res,200):
            json_fail("表单查看失败",NULL,100);
    }




    /**
     * @author  oys
     * 通过人查运行记录表
     * @param SelectrunFormbypeopleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectrunFormbypeople(SelectrunFormbypeopleRequest $request)
    {
        $applicant_name=$request['applicant_name'];
        $res = Form::SelectrunFormbypeople($applicant_name);
        return $res ?  //判断
            json_success("表单查看成功",$res,200):
            json_fail("表单查看失败",NULL,100);
    }


    /***
     * yjx
     * 筛选
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectfour(Request $request){
        $laboratory_name = $request['laboratory_name'];
        $res = Form::selectfour($laboratory_name);
        return $res ?  //判断
            json_success("操作成功",$res,200):
            json_fail("表单查看失败",NULL,100);

    }


}
