<?php

namespace  App\Http\Controllers\Csl;

use App\Http\Controllers\Controller;

use App\Http\Requests\Csl\AfterchangeRequest;
use App\Http\Requests\Csl\Approve1Request;
use App\Http\Requests\Csl\Approve2Request;
use App\Http\Requests\Csl\SearchRequest;
use App\Http\Requests\Csl\UserRequest;
use App\Models;
use App\Models\Csl\Information;
use App\Models\Csl\Shenpi;

use App\Models\Csl\Submitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmittedController extends Controller
{
    //////////////////审批已经提交表单信息展示/////////////////////////////////
    /**
     *  已提交表单信息展示
     * @param
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Aftershow()
    {
        $id = auth('apis')->user()->id;

        $a=Information::selecttype($id);
        if($a==1){$res =Submitted::aftershow1();}
        if($a==2){$res = Submitted::aftershow2();}
        if ($a==3){ $res = Submitted::aftershow3();}
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     *  已提交表单的搜索信息展示
     * @param SearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Aftersearch(SearchRequest $request)
    {
        $applicant_name = $request['applicant_name'];
        $res = submitted::search($applicant_name);

        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     *  已提交表单设备借用信息的查看
     * @param Approve1Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Afterlook1(Approve1Request $request)
    {
        $form_id = $request['form_id'];

        $res = Shenpi::approve1($form_id);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     *  已提交表单的设备借用清单
     * @param Approve2Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Afterlook2(Approve2Request $request)
    {
        $form_id = $request['form_id'];
        $res = Shenpi::approve2($form_id);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     *  已提交表单的同意或否决查询
     * @param Approve2Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Afterlook3(Approve2Request $request)
    {
        $form_id =$request['form_id'];
        $res = Submitted::afterlook3($form_id);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     *  已提交表单的同意或否决修改的存入
     * @param AfterchangeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Afterchange(AfterchangeRequest $request)
    {
        $id = auth('apis')->user()->id;
        $type=Information::selecttype($id);
        $form_id=$request['form_id'];
        $form_statu=$request['form_statu'];
        if($type==1){
            if ($form_statu=='同意'){
                $form_status=3;
            }
            if ($form_statu=='否决'){
                $form_status=2;
            }
            $a=Submitted::afterchange($form_id);
            if ($a==3){
                if($form_status==3){
                    $res=Submitted::agree1($form_id, $form_status);}
                if($form_status==2){
                    $res=Submitted::disagree2($form_id,$form_status);
                }
            }
            if ($a==2){
                if($form_status==3){
                    $res=Submitted::agree1($form_id, $form_status);}
                if($form_status==2){
                    $res=Submitted::disagree2($form_id,$form_status);
                }
            }
        }


        if ($type==2){
            if ($form_statu=='同意'){
                $form_status=5;
            }
            if ($form_statu=='否决'){
                $form_status=4;
            }
            $a=Submitted::afterchange($form_id);

            if ($a==5){
                if($form_status==5){
                    $res=Submitted::agree1($form_id, $form_status);}
                if($form_status==4){
                    $res=Submitted::disagree2($form_id,$form_status);
                }
            }
            if ($a==4){
                if($form_status==5){
                    $res=Submitted::agree1($form_id, $form_status);}
                if($form_status==4){
                    $res=Submitted::disagree2($form_id,$form_status);
                }
            }}

        if($type==3){
            if ($form_statu=='同意'){
                $form_status=11;
            }
            if ($form_statu=='否决'){
                $form_status=6;
            }
            $a=Submitted::afterchange($form_id);

            if ($a==11){
                if($form_status==11){
                    $res=Submitted::agree1($form_id, $form_status);}
                if($form_status==6){
                    $res=Submitted::disagree1($form_id,$form_status);
                }
            }
            if ($a==6){
                if($form_status==11){
                    $res=Submitted::agree2($form_id, $form_status);}
                if($form_status==6){
                    $res=Submitted::disagree2($form_id,$form_status);
                }
            }
        }

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }



























}
