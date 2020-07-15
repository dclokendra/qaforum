<?php

namespace App\Http\Controllers;

use App\Model\Answer;
use App\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories']=DB::table('categories')->select('id','name')->where('status',1)->limit(5)->get();
        $data['answers']=DB::table('answers')
            ->join('questions', 'answers.question_id','=','questions.id')
            ->select('answers.*','questions.que_content')
            ->where('answers.created_by','=',Auth::guard('visitor')->user()->id)
            ->get();
        return view('visitor.answer.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
//        $request->request->add(['created_by'=>Auth::guard('visitor')->user()->id]);

        $data = [];
        $data['questions']=DB::table('questions')
            ->join('categories', 'questions.category_id','=','categories.id')
            ->select('questions.*','categories.name')
            ->where('questions.created_by','!=',Auth::guard('visitor')->user()->id)
            ->get();
        $data['categories']=DB::table('categories')->select('id','name' , 'slug')->where('status',1)->limit(5)->get();
        return view('visitor.answer.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->ans_content);
        $request->request->add(['status' => 1]);
        $request->request->add(['ans_date'=>date('Y-m-d')]);
        $request->request->add(['ans_time'=>date('H:i:s')]);
//        \Illuminate\Support\Facades\Auth::guard('visitor')->user()->name
        $request->request->add(['created_by'=>Auth::guard('visitor')->user()->id]);
        $id=Answer::create($request->all());
        if ($id){
            $request->session()->flash('success_message','Successfully Answered ');
            //redirect abck to tag index page
        }else{
            $request->session()->flash('error_message','Answer Failed');
            //redirect abck to tag index page
        }
        return redirect()->route('visitor.index');

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories']=DB::table('categories')->select('id','name' , 'slug')->where('status',1)->limit(5)->get();
        $data['answer']=Answer::find($id);
        return view('visitor.answer.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $answer=Answer::find($id);
        //add updated by to request
        $request['slug'] = Str::slug($request->que_content);
        $request->request->add(['status' => 1]);
        $request->request->add(['ans_date'=>date('Y-m-d')]);
        $request->request->add(['ans_time'=>date('H:i:s')]);
        $request->request->add(['updated_by'=>Auth::guard('visitor')->user()->id]);
        $status=$answer->update($request->all());

        if ($status){
            $request->session()->flash('success_message','Answer Updated Successfully');
        }else{
            $request->session()->flash('error_message','Answer Updated Failed');
        }
        //redirect abck to tag index page
        return redirect()->route('answer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $answer=Answer::find($id);
        //delete
        if ($answer->delete()){
            $request->session()->flash('success_message','Answer Deleted Successfully');
        }else{
            $request->session()->flash('error_message','Answer Delete Failed');
        }
        //redirect abck to category index page
        return redirect()->route('answer.index');
    }
}
