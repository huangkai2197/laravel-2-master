<?php

namespace  App\Http\Controllers\Csl;
use App\Http\Controllers\Controller;

use App\Http\Requests\Csl\Approve1Request;
use App\Http\Requests\Csl\Approve2Request;
use App\Http\Requests\Csl\Approve3Request;
use App\Http\Requests\Csl\Approve4Request;
use App\Http\Requests\Csl\SearchRequest;
use App\Http\Requests\Csl\UserRequest;
use App\Models\Admin;
use App\Models\csl\Approve;
use App\Models\Csl\Information;
use App\Models\Csl\Shenpi;


class ShenpiController extends Controller
{
    /**
     * 审批页面信息展示
     * @param
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Spshow(){
        $id = auth('apis')->user()->id;
        $res=Shenpi::spshow($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     * 审批页面搜索后信息展示
     * @param SearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Search(SearchRequest $request){
        $applicant_name=$request['applicant_name'];
        $res=Shenpi::search($applicant_name);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     * 审批设备借用
     * @param  Approve1Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Approve1(Approve1Request $request){
        $form_id=$request['form_id'];
        $res=Shenpi::approve1( $form_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     * 审批设备借用
     * @param Approve2Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Approve2(Approve2Request $request){
        $form_id=$request['form_id'];
        $res=Shenpi::approve2($form_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     * 审批设备
     * @param Approve3Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public static function Approve3(Approve3Request $request){
        $id = auth('apis')->user()->id;
        $form_id=$request['form_id'];
        $form_statu=$request['form_statu'];
        $a=Information::selecttype($id);
        $name=Information::selectname($id);
        //借用部门负责人
        if ($a==1){
            if ($form_statu=='同意'){
                $form_status=3;
            }
            if ($form_statu=='否决'){
                $form_status=2;
            }
            if ($form_status==3){
                //审批为同意
                $res=Shenpi::approve3($form_id, $form_status, $name);
            }
            if ($form_status==2) {
                //审批为拒绝
                $res=Shenpi::approve4($form_id,$form_status, $name);
            }
        }
        //普通管理员
        if($a==2){
            if ($form_statu=='同意'){
                $form_status=5;
            }
            if ($form_statu=='否决'){
                $form_status=4;
            }
            if ($form_status==5){
                //审批为同意
                $res=Shenpi::approve5($form_id, $form_status,$name);
            }
            if ($form_status==4) {
                //审批为拒绝
                $res=Shenpi::approve6($form_id,$form_status,$name);
            }
        }
        //中心主任
        if($a==3){
            if ($form_statu=='同意'){
                $form_status=11;
            }
            if ($form_statu=='否决'){
                $form_status=6;
            }
            if ($form_status==6){
                //审批为同意
                $res=Shenpi::approve7($form_id, $form_status,$name);
            }
            if ($form_status==11){
                //审批为拒绝
                $res=Shenpi::approve8($form_id,$form_status,$name);
            }
        }

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 审批设备否决原因的存入
     * @param Approve4Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Approve4(Approve4Request $request){
        $form_id=$request['form_id'];
        $reason=$request['reason'];
        $id = auth('apis')->user()->id;
        $a=Information::selecttype($id);
        $name=Information::selectname($id);
        //审批为否决，借用部门负责人信息的存入
        if ($a==1){
            $res=Approve::approve1($form_id,$reason,$name);}

        if ($a==2){
            $res=Approve::approve2($form_id,$reason,$name);}

        if ($a==3){
            $res=Approve::approve3($form_id,$reason,$name);}


        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }















}
