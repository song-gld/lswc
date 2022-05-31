<?php

namespace App\Http\Controllers;

use App\Models\lswc;
use App\Models\Teacher;
use Illuminate\Http\Request;

class lswcController extends Controller
{
    //数据插入
    public function insert() {
        $lswcs = new lswc();
        $res = $lswcs->where('qjsj', date("Y-m-d"))->get();                        
        return view('lswc.insert', ['lswcs' => $res, 'lswc' => $res]);
    }
    //获取并处理传入的姓名
    public function store(Request $request) {
        $teacher = Teacher::firstWhere('name', $request->input('name')); 
        if ($teacher == null) {
            return -1;
        } else {
            return $teacher;
        }        
    }
    // 向数据库lswc插入数据
    public function insertData(Request $request) {
        $lswc = new lswc;
        $lswc->name = $request->name;
        $lswc->grade = $request->nj;
        $lswc->course = $request->km;
        $lswc->gs = $request->gs;
        $lswc->sy = $request->sy;
        $lswc->bz = $request->bz;
        $lswc->qjsj = $request->date;
        $lswc->save();
        return $request->all();
    }
    // 删除数据
    public function destroy(lswc $lswc) {
        $res = $lswc->delete();
        return $res;
    }
}
