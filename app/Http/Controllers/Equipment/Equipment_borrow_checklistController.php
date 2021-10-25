<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Equipment_borrow_checklist;
use Illuminate\Http\Request;

class Equipment_borrow_checklistController extends Controller
{

    public function show(Request $request){
        $checklist_id = $request['checklist_id'];
        $res = Equipment_borrow_checklist::show($checklist_id);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);
    }
}
