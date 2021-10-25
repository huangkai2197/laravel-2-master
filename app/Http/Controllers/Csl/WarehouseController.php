<?php

namespace App\Http\Controllers\Csl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Csl\EsearchRequest;
use App\Http\Requests\Csl\SearchRequest;
use App\Models\Csl\Submitted;
use App\Models\Csl\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function Eshow()
    {
        $res =Warehouse::eshow();
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     * 搜索
     * @param SearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Esearch(SearchRequest $request)
    {
        $applicant_name = $request['applicant_name'];
        $res =Warehouse::esearch($applicant_name );
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
}
