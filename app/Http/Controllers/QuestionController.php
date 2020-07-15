<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories']=DB::table('categories')->select('id','name')->where('status',1)->limit(5)->get();
        $data['questions']=DB::table('questions')
            ->join('categories', 'questions.category_id','=','categories.id')
            ->select('questions.*','categories.name')
            ->where('questions.created_by','=',Auth::guard('visitor')->user()->id)
            ->get();
        return view('visitor.question.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[];
        $data['categories']=Category::where('status',1)->get();
        return view('visitor.question.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        print_r($request->category_id);
        $request['slug'] = Str::slug($request->que_content);
        $request->request->add(['status' => 1]);
        $request->request->add(['que_date'=>date('Y-m-d')]);
        $request->request->add(['que_time'=>date('H:i:s')]);
        $request->request->add(['created_by'=>Auth::guard('visitor')->user()->id]);
        $id=Question::create($request->all());
        if ($id){
            $request->session()->flash('success_message','Category Created Successfully');
            //redirect abck to tag index page
            return redirect()->route('visitor.index');
        }else{
            $request->session()->flash('error_message','Category Creation Failed');
            //redirect abck to tag index page
            return redirect()->route('question.create');
        }
    }

   /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['question']=Question::find($id);
        return view('visitor.question.edit',compact('data'));
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

        $question=Question::find($id);
        //add updated by to request
        $request['slug'] = Str::slug($request->que_content);
        $request->request->add(['status' => 1]);
        $request->request->add(['que_date'=>date('Y-m-d')]);
        $request->request->add(['que_time'=>date('H:i:s')]);
        $request->request->add(['updated_by'=>Auth::guard('visitor')->user()->id]);
        //dd($question->update());
        $status=$question->update($request->all());

        if ($status){
            $request->session()->flash('success_message','Question Updated Successfully');
        }else{
            $request->session()->flash('error_message','Question Updated Failed');
        }
        //redirect abck to tag index page
        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $answer=Question::find($id);
        //delete
        if ($answer->delete()){
            $request->session()->flash('success_message','Question Deleted Successfully');
        }else{
            $request->session()->flash('error_message','Question Delete Failed');
        }
        //redirect abck to category index page
        return redirect()->route('question.index');
    }
}
