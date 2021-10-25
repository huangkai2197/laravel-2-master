<?php

namespace App\Models;


use http\Env\Request;
use Illuminate\Database\Eloquent\Model;


//class Form extends Model
//{
//    protected $table='form';
//    // protected $primaryKey='form_id';
//
//use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table='form';
   // protected $primaryKey='form_id';

    public  $timestamps= true;
    protected $guarded = [];


    /**

     * 查看审批中的表单
     * @author oys
     * @return false
     */
    public static function SelectFormrun()
    {
        try {
            //申请表创建成功
            $res=self::
            select('form.form_id','form_type.type_name','form.created_at','form.applicant_name','form_status.status_name')
                ->leftJoin('form_type','form_type.type_id','form.type_id')
                ->leftJoin('form_status','form_status.status_id','form.status_id')
                ->where('form.status_id',1)
                ->orwhere('form.status_id',3)
                ->orwhere('form.status_id',5)
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('查看成功',[$e->getMessage()]);
            return false;
        }
    }





    /**
     * 查看通过申请人查看审批中的表单()((()(()()()()()()()()()()()()()()()()()()())()()()()()()()()()()()()909
     * @author oys
     * @param $applicant_name
     * @return array|false
     */
    public static function SelectBypeople($applicant_name)
    {
        try {
            $res1=self::select('form.form_id','form_type.type_name','form.created_at','form.applicant_name','form_status.status_name')
                ->leftJoin('form_type','form_type.type_id','form.type_id')
                ->leftJoin('form_status','form_status.status_id','form.status_id')
                ->where('applicant_name',$applicant_name)->where('form.status_id',1)->get();

            $res2=self::select('form.form_id','form_type.type_name','form.created_at','form.applicant_name','form_status.status_name')
                ->leftJoin('form_type','form_type.type_id','form.type_id')
                ->leftJoin('form_status','form_status.status_id','form.status_id')
                ->where('applicant_name',$applicant_name)->where('form.status_id',3)->get();

            $res3=self::select('form.form_id','form_type.type_name','form.created_at','form.applicant_name','form_status.status_name')
                ->leftJoin('form_type','form_type.type_id','form.type_id')
                ->leftJoin('form_status','form_status.status_id','form.status_id')
                ->where('applicant_name',$applicant_name)->where('form.status_id',5)->get();

            $res['type1']=$res1;
            $res['type2']=$res2;
            $res['type3']=$res3;

            return $res;
        }catch (\Exception $e){
            logError('查看成功',[$e->getMessage()]);
            return false;
        }
    }





    /**
     * 终止审批
     * @author oys
     * @param $form_id
     * @return false
     */
    public static function StopFormrun($form_id)
    {
        try {
            //申请表创建成功
            $res=self::where('form_id',$form_id)
                ->update([
                    'status_id'=>2
                ]);
            return $res;
        }catch (\Exception $e){
            logError('终止审批成功',[$e->getMessage()]);}}

     /* 在点击的时候就创建一个表单
     * @author oys
     * @param $applicant_name
     * @param $type_id
     * @param $form_status
     * @return false
     */
    public static function CreateForm($form_id,$applicant_name,$type_id,$form_status)
    {
        try {
            //申请表创建成功
            $res=self::create(
                [
                    'form_id'=>$form_id,
                    'applicant_name'=>$applicant_name,
                    'type_id'=>$type_id,
                    'form_status'=>$form_status,
                ]
            );
            return $res;
        }catch (\Exception $e){
            logError('主表创建成功',[$e->getMessage()]);

            return false;
        }
    }



    /**

     * 查看已审批的表单
     * @author oys
     * @return false
     */
    public static function SelectFormcomplete()
    {
        try {
            //申请表创建成功
            $res=self::
            select('form.form_id','form_type.type_name','form.created_at','form.applicant_name','form_status.status_name')
                ->leftJoin('form_type','form_type.type_id','form.type_id')
                ->leftJoin('form_status','form_status.status_id','form.status_id')
                ->orwhere('form.status_id',11)
                ->get();
            return $res;
        }catch (\Exception $e) {
            logError('查看成功', [$e->getMessage()]);}}

            /* 查看这个表单
            * @author oys
            * @return false
            */
            public static function SelectForm()
            {
                try {
                    //申请表创建成功
                    $res = self::get();
                    return $res;
                } catch (\Exception $e) {
                    logError('已提交表单查看成功', [$e->getMessage()]);

                    return false;
                }
            }


            /**
             * @param $applicant_name
             * @return array|false
             * @author oys
             * 查看已审批 通过申请人
             */
            public static function SelectCompleteBypeople($applicant_name)
            {
                try {


                    $res1 = self::select('form.form_id', 'form_type.type_name', 'form.created_at', 'form.applicant_name', 'form_status.status_name')
                        ->leftJoin('form_type', 'form_type.type_id', 'form.type_id')
                        ->leftJoin('form_status', 'form_status.status_id', 'form.status_id')
                        ->where('applicant_name', $applicant_name)
                        ->where('form.status_id', 11)
                        ->get();


                    $res2 = self::select('form.form_id', 'form_type.type_name', 'form.created_at', 'form.applicant_name', 'form_status.status_name')
                        ->leftJoin('form_type', 'form_type.type_id', 'form.type_id')
                        ->leftJoin('form_status', 'form_status.status_id', 'form.status_id')
                        ->where('applicant_name', $applicant_name)
                        ->where('form.status_id', 6)
                        ->get();

                    $res['pass'] = $res1;
                    $res['fail'] = $res2;

                    return $res;
                } catch (\Exception $e) {
                    logError('查看成功', [$e->getMessage()]);
                    return false;
                }
            }


            /**
             * 审批  通过
             * @param $form_id
             * @return false
             * @author oys
             */
            public static function DecideForm($form_id)
            {
                try {
                    $res = self::where('form_id', $form_id)
                        ->update([
                            'status_id' => 11
                        ]);
                    return $res;
                } catch (\Exception $e) {
                    logError('查看成功', [$e->getMessage()]);
                    return false;
                }
            }


            /**
             * 查看设备借用表的比例
             * @return array|false
             * @author oys
             */
            public static function SelectFormnum()
            {
                try {
                    $res1 = self::where('form.type_id', 3)->where('form.status_id', 11)->get();//设备借用表
                    $res2 = self::where('form.type_id', 3)->get();//设备借用表总数

                    $res3 = self::where('form.type_id', 1)->where('form.status_id', 11)->get();//实验室借用表
                    $res4 = self::where('form.type_id', 1)->get();//实验室借用表总数

                    $res5 = self::where('form.type_id', 5)->where('form.status_id', 11)->get();//实验室借用表
                    $res6 = self::where('form.type_id', 5)->get();//开放实验室表总数

                    $res['$equipment_borrowComplete'] = count($res1);
                    $res['$equipment_borrowAll'] = count($res2);
                    $res['$labComplete'] = count($res3);
                    $res['$labAll'] = count($res4);
                    $res['$openlabComplete'] = count($res5);
                    $res['$openlabAll'] = count($res6);

                    return $res;
                } catch (\Exception $e) {
                    logError('查看成功', [$e->getMessage()]);
                    return false;
                }
            }


            /**
             * 查看运行记录表
             * @return false
             * @author oys
             */
            public
            static function SelectrunForm()
            {
                try {
                    $res = self::select('form.form_id', 'form_type.type_name', 'form.created_at', 'form.applicant_name')
                        ->where('form.type_id', 4)
                        ->leftJoin('form_type', 'form_type.type_id', 'form.type_id')
                        ->get();
                    return $res;
                } catch (\Exception $e) {
                    logError('查看成功', [$e->getMessage()]);
                    return false;
                }
            }


            /**
             * 查看运行记录表 通过申请人
             * @param $applicant_name
             * @return false
             * @author oys
             */
            public
            static function SelectrunFormbypeople($applicant_name)
            {
                try {
                    $res = self::select('form.form_id', 'form_type.type_name', 'form.created_at', 'form.applicant_name')
                        ->leftJoin('form_type', 'form_type.type_id', 'form.type_id')
                        ->where('applicant_name', $applicant_name)
                        ->where('form.type_id', 4)
                        ->get();
                    return $res;
                } catch (\Exception $e) {
                    logError('查看成功', [$e->getMessage()]);
                    return false;
                }
            }


    /***
     * yjx
     * 筛选
     * @param $laboratory_name
     * @return false|int
     */
            public static function selectfour($laboratory_name){

                try {
                    if($laboratory_name == "设备借用表")
                    {
                        $res = self::join('equipment_borrow','equipment_borrow.form_id','form.form_id')
                            ->join('equipment_borrow_checklist','equipment_borrow_checklist.form_id','equipment_borrow.form_id')
                            ->join('equipment','equipment.equipment_id','equipment_borrow_checklist.equipment_id')
                            ->join('form_type','form_type.type_id','form.type_id')
                            ->select('borrow_department','borrow_application','destine_start_time','destine_end_time','borrower_name','borrower_phone','equipment_borrow_checklist.equipment_id','model','equipment_number','status_id','form_type.type_id')
                            ->where('form_type.type_id',3)
                            ->get()
                            ->paginate(15);
                        return $res ?
                            $res :
                            false;
                    }elseif($laboratory_name == "开放实验室使用申请"){
                        $res = self::join('open_laboratory_loan','open_laboratory_loan.form_id','form.form_id')
                            ->join('open_laboratory_student_list','open_laboratory_student_list.form_id','form.form_id')
                            ->join('form_type','form_type.type_id','form.type_id')
                            ->select('reason_use','porject_name','start_time','end_time','student_name','student_id','phone','work','applicant_name','form.created_at','status_id','form_type.type_id')
                            ->where('form_type.type_id',5)
                            ->get();
                        return $res ?
                            $res :
                            false;
                    }elseif ($laboratory_name == "实验室借用申请"){
                        $res = self::join('laboratory_loan','laboratory_loan.form_id','form.form_id')
                            ->join('laboratory','laboratory.laboratory_id','laboratory_loan.laboratory_id')
                            ->join('form_type','form_type.type_id','form.type_id')
                            ->select('laboratory.laboratory_name','laboratory_loan.laboratory_id','course_name','class_id','number','purpose','start_time','end_time','start_class','end_class','phone','form.created_at','status_id','form_type.type_id')
                            ->where('form_type.type_id',1)
                            ->get();
                        return $res ?
                            $res :
                            false;

                    }elseif($laboratory_name == "实验室运行记录表"){
                        $res = self::join('laboratory_operation_records','laboratory_operation_records.form_id','form.form_id')
                            ->join('form_type','form_type.type_id','form.type_id')
                            ->select('laboratory_operation_records.laboratory_id','week','time','class_id','number','class_name','class_type','teacher','situation','remark')
                            ->where('form_type.type_id',4)
                            ->get();
                        return $res ?
                            $res :
                            false;

                    }else{
                        return 0;
                    }
                    return $res;

                } catch (\Exception $e) {
                    logError('查看失败', [$e->getMessage()]);
                    return false;
                }

            }





        }
