<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //教师列表展示
    public function show(Request $request) {
        $teachers = new Teacher();
        $keyword = $request->input('name');
        $grade = $request->input('grade');
        $course = $request->input('course');
        $identity = $request->input('identity');
        $teachers = $teachers
          ->when($keyword, function($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        })->when($grade, function($query) use ($grade) {
            $query->where('grade', 'like', "%{$grade}%");
        })->when($course, function($query) use ($course) {
            $query->where('course', 'like', "%{$course}%");
        })->when($identity, function($query) use ($identity) {
            $query->where('identity', 'like', "%{$identity}%");
        })->orderBy('grade')
            ->paginate(15);
        
        return view('lswc.teachers', ['teachers' => $teachers]);
    }
    // 教师添加
    public function add(Request $request) {
        $request->validate([
            'name' => 'unique:App\Models\Teacher,name|required'
        ]);
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->grade = $request->grade;
        $teacher->course = $request->course;
        $teacher->identity = $request->identity;
        $teacher->save();
        return $teacher;
    }

}
