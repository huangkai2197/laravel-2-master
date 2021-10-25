<?php

namespace  App\Http\Controllers\Csl;
// 引入验证

use App\Http\Requests\Csl\JlformRequest;
use App\Http\Requests\Csl\JlfromRequest;
use App\Http\Requests\Csl\QmaddRequest;
use App\Http\Requests\Csl\QmchangeRequest;
use App\Http\Requests\Csl\QmdeleteRequest;
use App\Models\csl\Approve;
use App\Models\csl\Record;

use App\Models\Csl\teaching_inspection;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class RecordController extends Controller
{

    /**
     *记录
     * @param  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Jlform(JlformRequest $request){
        $name=$request['name'];
        $form_id=$request['form_id'];
        $res=teaching_inspection::jlshow1($name,$form_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     * 期末实验教学检查记录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Qmshow(){
        $res=Record::qmshow();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 期末实验教学检查记录修改
     * @param QmchangeRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Qmchange(QmchangeRequest $request){
        $laboratory_id=$request->get('laboratory_id');
        $class_name=$request->get('class_name');
        $teacher=$request->get('teacher');
        $teach_operating_condition=$request->get('teach_operating_condition');
        $operating_condition=$request->get('operating_condition');
        $remark=$request->get('remark');
        $info_id=$request->get('info_id');
        $res=Record::qmchange($info_id,$laboratory_id,$class_name,$teacher, $teach_operating_condition, $operating_condition,$remark);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 期末实验教学检查记录删除
     * @param QmdeleteRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */

    public function Qmdelete(QmdeleteRequest $request){
        $info_id=$request['info_id'];
        $res=Record::qmdelete($info_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 期末实验教学检查记录增加
     * @param QmaddRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Qmadd(QmaddRequest $request){
        $laboratory_id=$request['laboratory_id'];
        $class_name=$request['class_name'];
        $teacher=$request['teacher'];
        $teach_operating_condition=$request['teach_operating_condition'];
        $operating_condition=$request['operating_condition'];
        $remark=$request['remark'];
        $res=Record::qmadd($laboratory_id,$class_name,$teacher, $teach_operating_condition, $operating_condition,$remark);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
}
