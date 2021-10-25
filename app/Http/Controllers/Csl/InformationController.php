<?php

namespace  App\Http\Controllers\Csl;

use App\Http\Controllers\Controller;

use App\Http\Requests\Csl\LookRequest;

use App\Models\Csl\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    /**
     * 个人信息的查询
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Look(){
        $id = auth('apis')->user()->id;
        $res=Information::look($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
}
