<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminRequest1;
use App\Http\Requests\AdminRequest2;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /***
     * yjx
     * 添加管理员
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(AdminRequest $request){
        $account = $request['account'];
        $password = $request['password'];
        $name = $request['name'];
        $phone = $request['phone'];
        $email = $request['email'];
        $type = $request['type'];

        $res1 = Admin::establish(
            $account,
            $password,
            $name,
            $phone,
            $email,
            $type
        );
        return $res1?
            json_success("操作成功",$res1,200):
            json_fail("操作失败",$res1,100);

    }

    /***
     * yjx
     * 修改管理员
     * @param AdminRequest2 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modify(AdminRequest2 $request){
        $account = $request['account'];
        //$password = $request['password'];
        $name = $request['name'];
        $phone = $request['phone'];
        $email = $request['email'];
        $type = $request['type'];


        $res1 = Admin::modify(
            $account,
            //$password,
            $name,
            $phone,
            $email,
            $type
        );
        return $res1?
            json_success("操作成功",$res1,200):
            json_fail("操作失败",$res1,100);
    }


    /***
     * yjx
     * 删除管理员
     * @param AdminRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(AdminRequest1 $request){
        $account = $request['account'];
        $res1 = Admin::delete1($account);

        return $res1?
            json_success("操作成功",$res1,200):
            json_fail("操作失败",$res1,100);

    }

    /***
     * yjx
     *查询管理员
     * @param AdminRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(AdminRequest1 $request){
        $account = $request['account'];
        $res1 = Admin::show($account);

        return $res1?
            json_success("操作成功",$res1,200):
            json_fail("操作失败",$res1,100);
    }

    /***
     * yjx
     * 查询所有管理员
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){
        $res = Admin::showall();
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }
}

