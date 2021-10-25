<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\student\SelectStudentRequest;
use App\Models\equipment_borrow;
use App\Models\Student;

class StudentController extends Controller
{


    /**
     * 查看学生个人信息
     * @author oys
     * @param SelectStudentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SelectStudent(SelectStudentRequest $request)
    {
        $student_id=$request['student_id'];
        $student_password=$request['student_password'];
        $res = Student::SelectStudent($student_id,$student_password);
        return $res ?  //判断
            json_success("查询成功",$res,200):
            json_fail("查询失败",NULL,100);
    }
}
