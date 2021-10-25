<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * 登录注册模块
 */
Route::prefix('user')->group(function () {
    Route::post('login', 'Login\LoginController@login'); //super登陆
    Route::post('adminlogin', 'Login\LoginController@adminlogin'); //admin登录
    Route::post('studentlogin', 'Login\LoginController@studentlogin'); //student登录
    Route::post('logout', 'Login\LoginController@logout'); //管理员退出登陆
    Route::post('registered', 'Login\LoginController@registered'); //管理员注册
    Route::post('registereds', 'Login\LoginController@registereds'); //admin管理员注册
    Route::post('registeredss', 'Login\LoginController@registeredss'); //admin管理员注册
    Route::any('mail/send','MailController@send');//发送验证码
    Route::post('change1', 'Login\LoginController@change1'); //super修改密码
    Route::post('change2', 'Login\LoginController@change2'); //admin修改密码
    Route::post('change3', 'Login\LoginController@change3'); //student修改密码
});//--pxy


/**
 * 学生负责人模块
 */
Route::middleware('student.check')->prefix('test')->group(function (){
   Route::post('pxy','Login\LoginController@test');
});

/**
 * 普通管理员
 */
Route::middleware('ordinadmin.check')->prefix('test11')->group(function (){
    Route::post('admin','Login\LoginController@admin');
});

/**
 * 超级管理员
 */
Route::middleware('superadmin.check')->prefix('test22')->group(function (){
    Route::post('superadmin','Login\LoginController@superadmin');
    Route::post('superadmin','AdminController@add');

});


Route::prefix('student')->group(function () {
    Route::post('add','StudentController@add');//学生添加（完成）1
    Route::post('modify','StudentController@modify');//学生修改（完成）1
    Route::post('delete','StudentController@delete');//学生删除(完成)1
    Route::post('showstudent','StudentController@showstudent');//学生查询（完成）1
    Route::get('showall','StudentController@showall');//查询所有学生（完成）1
});//yjx


Route::prefix('admin')->group(function () {
    Route::post('add','AdminController@add');//管理员添加（完成）1
    Route::post('modify','AdminController@modify');//管理员改变（完成）1
    Route::post('delete','AdminController@delete');//管理员删除(完成)1
    Route::post('show','AdminController@show');//管理员查询(完成)1
    Route::get('showall','AdminController@showall');//查询所有管理员（完成）1
});//yjx

Route::prefix('equipment')->group(function () {
    Route::post('add','Equipment\EquipmentCangController@add');//器材添加（完成）1
    Route::post('modify','Equipment\EquipmentCangController@modify');//器材修改（完成）1
    Route::post('delete','Equipment\EquipmentCangController@delete');//器材删除（完成）1
    Route::post('show','Equipment\EquipmentCangController@show');//器材查询（完成）1
    Route::get('showall','Equipment\EquipmentCangController@showall');//查询所有设备（完成）1new
});//yjx

Route::prefix('equipment_borrow')->group(function () {
    Route::post('show','Equipment\Equipment_borrowController@show');//借出器材查询(完成)1
    Route::get('showall','Equipment\Equipment_borrowController@showall');//查询所有借出设备（完成）1new
});//yjx

Route::prefix('equipment_return')->group(function () {
    Route::post('change','Equipment\EquipmentReturnController@changestatus');//器材归还状态改变查询(完成)1
});//yjx

Route::prefix('laboratory')->group(function () {
    Route::post('show','Laboratory\LaboratroyController@show');//实验室查询(完成)1
    Route::get('showall','Laboratory\LaboratroyController@showall');//查询所有实验室（完成）1new
});//yjx


Route::prefix('superadmin')->group(function () {
    Route::post('show','SuperadminController@show');//超管查询(完成)1
    Route::get('selectformrun','SuperAdmin\FormController@SelectFormrun'); //查看表单运行情况   (完成)1
    Route::post('selectbypeople','SuperAdmin\FormController@SelectBypeople'); //通过申请人来查看 审批中审批表单 (完成)1

    Route::get('selectformcomplete','SuperAdmin\FormController@SelectFormcomplete'); // 查看表单完成   (完成)1
    Route::post('selectcompletebypeople','SuperAdmin\FormController@SelectCompleteBypeople'); //通过申请人来查看 已审批表单(完成)1

    Route::post('selectfour','SuperAdmin\FormController@selectfour'); // 筛选

    Route::post('stopformrun','SuperAdmin\FormController@StopFormrun'); //终止审批  (完成)1
    Route::post('passform','SuperAdmin\FormController@PassForm'); //通过审批/同意       (完成)1

    Route::get('selectformnum','SuperAdmin\FormController@SelectFormnum'); //查看审批中和未审批的数量  (完成)1
    Route::get('selectrunform','SuperAdmin\FormController@SelectrunForm'); //查看实验运行记录表 (完成)1
    Route::post('selectrunformbypeople','SuperAdmin\FormController@SelectrunFormbypeople'); //通过申请人来查看 查看实验运行记录表 (完成)1

});//yjx














/**
 * 普通管理员的所有功能实现
 */
Route::prefix('Admin2')->namespace('Csl')->group(function (){
    //期末教学检查
    Route::post("jlform","RecordController@Jlform");//记录人和编号存入
    Route::get("qmshow","RecordController@Qmshow");//期末实验教学检查记录
    Route::post("qmchange","RecordController@Qmchange");//期末实验教学检查记录修改
    Route::post("qmdelete","RecordController@Qmdelete");//期末实验教学检查记录删除
    Route::post("qmadd","RecordController@Qmadd");//期末实验教学检查记录添加
    //待审批表单
    Route::post("spform","ShenpiController@Spshow");//待审批表单信息展示
    Route::post("search","ShenpiController@Search");//待审批表以申请人搜索
    Route::post("approve1","ShenpiController@Approve1");//待审批表的审批设备借用表
    Route::post("approve2","ShenpiController@Approve2");//待审批表的审批设备借用清单
    Route::post("approve3","ShenpiController@Approve3");//待审批表的审批设备借用清单，同意或否决的状态存入
    Route::post("approve4","ShenpiController@Approve4");//待审批表的审批设备借用清单，否决原因的存入

    //已提交表单
    Route::post("afterform","SubmittedController@Aftershow");//已提交表单的信息展示
    Route::post("aftersearch","SubmittedController@Aftersearch");//已提交表单以填报人进行搜索
    Route::post("afterlook1","SubmittedController@Afterlook1");//已提交表单设备借用的查看
    Route::post("afterlook2","SubmittedController@Afterlook2");//已提交表单的设备清单查看
    Route::post("afterlook3","SubmittedController@Afterlook3");//已提交表单的审批查看
    Route::post("afterchange","SubmittedController@Afterchange");//已提交表单的审批结果的修改
    Route::post("approve4","ShenpiController@Approve4");//待审批表的审批设备借用清单，否决原因的存入
//    Route::post();//表单的统计
    Route::post("tjform","NumberController@Tjform");
    //个人信息的查看
    Route::post("look","InformationController@look");
    //设备仓库
    Route::get("eshow","WarehouseController@Eshow");//仓库信息展示
    Route::post("esearch","WarehouseController@Esearch");//搜索


});



/**
 * 学生负责人模块
 * oys
 */
Route::prefix('student')->group(function () {

    //表单
    Route::post('createform', 'Student\FormController@CreateForm'); //学生负责人,创建表单，点击每个实验都会创建一个表单   1
    Route::Get('selectform', 'Student\FormController@SelectForm'); //学生负责人,查看已提交表单，包括状态已经处理结果    1

    //设备借用表
    Route::post('equipmentborrow', 'Student\EquipmentController@EquipmentBorrow'); //学生负责人 设备借用  1
    Route::post('addequipment', 'Student\EquipmentController@AddEquipment'); //添加设备   1
    Route::post('deleteequipment', 'Student\EquipmentController@DeleteEquipment'); //删除设备 1
    Route::post('updateequipment', 'Student\EquipmentController@UpdateEquipment'); //修改设备 1
    Route::post('addequipmentcheck', 'Student\EquipmentController@AddEquipment_borrow_checklist'); //设备清单的添加  1
    Route::Post('selectequipmentborrow', 'Student\EquipmentController@SelectEquipment_borrow'); //查看设备借用表信息  1
    Route::Post('selectequipmentlist', 'Student\EquipmentController@SelectEquipmenlist'); //根据总表的id查看该表的借用设备清单表(已提交表单里面,设备借用表的查看) 1
    Route::post('equipmentborrowupdate', 'Student\EquipmentController@EquipmentBorrowUpdate'); //设备借用表 信息的修改 1

    //实验室借用表
    Route::post('labborrow', 'Student\LabloanController@LabBorrow'); //学生负责人 实验室借用 1
    Route::Post('selectlabloan', 'Student\LabloanController@SelectLabloan');  //查看实验室申请表 1
    Route::Post('updatelabloan', 'Student\LabloanController@UpdateLabloan');  //修改实验室申请表 1

    //实验室运行记录表
    Route::post('addlabrun', 'Student\LabrunController@AddLabrun'); //学生负责人 添加        1
    Route::post('deletelabrun', 'Student\LabrunController@DeleteLabrun'); //学生负责人 删除   1
    Route::post('updatelabrun', 'Student\LabrunController@UpdateLabrun'); //学生负责人 修改    1
    Route::Post('selectlabrun', 'Student\LabrunController@SelectLabrun');  //查看实验室申请表   1

    //开放实验室借用表
    Route::post('openlabborrow', 'Student\OpenlabController@OpenlabBorrow'); //学生负责人 开放实验室借用 1
    Route::post('openlabaddstu', 'Student\OpenlabController@OpenlabAddstu'); //添加学生        1
    Route::post('openlabdeletestu', 'Student\OpenlabController@OpenlabDeletestu'); //删除学生   1
    Route::post('openlabupdatestu', 'Student\OpenlabController@OpenlabUpdatestu'); //修改学生   1
    Route::post('openlabselect', 'Student\OpenlabController@OpenlabSelect'); //学生负责人 开放实验室查看  1
    Route::post('openlabselectstu', 'Student\OpenlabController@OpenlabSelectstu'); //学生查看成功   1


    //设备归还信息查看
    Route::get('selectreturnequipment', 'Student\EquipmentController@SelectReturnEquipment'); //设备归还的信息查看
    Route::post('returnequipment', 'Student\EquipmentController@ReturnEquipment'); //归还设备


    Route::post('select', 'Student\StudentController@SelectStudent'); //学生负责人个人信息查看  1
});




