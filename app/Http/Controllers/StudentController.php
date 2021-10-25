<?php

namespace App\Http\Controllers;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentRequest1;
use App\Http\Requests\StudentRequest2;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /***
     * yjx
     * 增加学生
     * @param StudentRequest $request
     * @return JsonResponse
     *
     */
    public function add(StudentRequest $request){
        $account = $request['account'];
        $password = $request['password'];
        $name = $request['name'];
        $phone = $request['phone'];
        $email = $request['email'];

        $res1 = Student::establish(
            $account,
            $password,
            $name,
            $phone,
            $email

        );
        return $res1?
            json_success("操作成功",$res1,200):
            json_fail("操作失败",$res1,100);

}

    /***
     * yjx
     * 修改学生
     * @param StudentRequest2 $request
     * @return JsonResponse
     */
    public function modify(Request $request){
        $account = $request['account'];
        //$password = $request['password'];
        $name = $request['name'];
        $phone = $request['phone'];
        $email = $request['email'];

        $res1 = Student::modify(
            $account,
            //$password,
            $name,
            $phone,
            $email
        );
        return $res1?
            json_success("操作成功",$res1,200):
            json_fail("操作失败",$res1,100);
    }

    /***
     * yjx
     * 删除学生
     * @param StudentRequest1 $request
     * @return JsonResponse
     */
    public function delete(StudentRequest1 $request)
    {

        $account = $request['account'];
        $res = Student::delete1($account);

        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }

    /***
     * yjx
     * 查询学生
     * @param StudentRequest1 $request
     * @return JsonResponse
     */
    public function showstudent(StudentRequest1 $request){
        $account = $request['account'];
        $res = Student::show($account);

        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);



    }

    /**
     * yjx
     * 查询所有学生
     * @return JsonResponse
     */
    public function showall(){

        $res = Student::showall();

        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);



    }



}
