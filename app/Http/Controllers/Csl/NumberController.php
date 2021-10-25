<?php

namespace  App\Http\Controllers\Csl;

use App\Http\Controllers\Controller;

use App\Models\Csl\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NumberController extends Controller
{
    /**
     * 期末实验教学检查记录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Tjform(Request $request){

        $res=Form::tjform();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
}
