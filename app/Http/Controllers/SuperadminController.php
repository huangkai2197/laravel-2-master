<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuperadminRequest;
use App\Models\Superadmin;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    /***
     * yjx
     * 查看超管信息
     * @param SuperadminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SuperadminRequest $request){
        $account = $request['account'];
        $res = Superadmin::show($account);

        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }
}

