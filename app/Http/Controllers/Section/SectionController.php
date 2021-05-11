<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Auth;
use Illuminate\Http\Request;

class SectionController extends controller
{
    function __construct()
    {
        $this->middleware('permission:اضافة قسم', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل قسم', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sections=Section::all();
        return view('sections.section',compact('sections'));
    }

    public function store(SectionRequest $request)
    {
        section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'Created_by' => (Auth::user()->name),

        ]);
        session()->flash('Add', 'تم اضافة القسم بنجاح ');
        return redirect()->route('Sections.index');
    }


    public function update(SectionRequest $request)
    {
       $Section=Section::findOrFail($request->id);
       $Section->update([
           'section_name' => $request->section_name,
           'description' => $request->description,
       ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect()->route('Sections.index');

    }

    public function destroy(Request $request)
    {
        $Section=Section::findOrFail($request->id);
        $Section->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect()->route('Sections.index');

    }
}
