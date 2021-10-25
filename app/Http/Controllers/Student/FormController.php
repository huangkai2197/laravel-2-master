<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\student\CreateFormRequest;
use App\Models\Equipment_borrow;
use App\Models\Form;
use App\Models\Form_status;
use App\Models\Form_type;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;


//表单控制器，生成表单
class FormController extends Controller
{


    /**
     * 主表单的创建
     * @author oys
     * @param CreateFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function  CreateForm(CreateFormRequest $request)
    {
        $form_id=$request['form_id'];
        $applicant_name=$request['applicant_name'];
        $type_id=$request['type_id'];
        $form_status=1;
        $res = Form::CreateForm($form_id,$applicant_name,$type_id,$form_status);
        return $res ?  //判断
            json_success("表单创建成功",$res,200):
            json_fail("表单创建失败",NULL,100);
    }



    /**
     * 查看表单信息，把表单类型和状态通过连表，改成相应的状态显示
     * @author oys
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectForm()
    {
        $res = Form::SelectForm();
        $res2=array();
        foreach($res as $k=>$v)
        {
            $form_id=$res[$k]->form_id;         //表单id
            $type=Form_type::SelectFormtype($res[$k]->type_id);    //表单类型
            $created_at=$res[$k]->updated_at;     //修改日期
            $applicant_name=$res[$k]->applicant_name; //填报人
            $form_status=Form_status::SelectFormstatus($res[$k]->form_status);    //处理结果
            array_push($res2,$form_id,$type,$created_at,$applicant_name,$form_status);
        }
        return $res2 ?  //判断
            json_success("表单查看成功",$res2,200):
            json_fail("表单查看失败",NULL,100);
    }


}
