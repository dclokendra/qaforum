<?php

namespace App\Http\Controllers;

use App\Model\Question;
use App\Model\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['questions']=DB::table('questions')
            ->join('categories', 'questions.category_id','=','categories.id')
            ->select('questions.*','categories.name')
            ->get();
        $data['categories']=DB::table('categories')->select('id','name')->where('status',1)->limit(5)->get();
        return view('visitor.dashboard',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visitor.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
//        dd($request);
        // store in the database
        $visitor = new Visitor();
        $visitor->name = $request->name;
        $visitor->email = $request->email;
        $visitor->status = $request->status;
        $visitor->verification_key = uniqid();
        $visitor->status = 0;
        $visitor->last_login = date('Y-m-d H:i:s');
        $visitor->password=bcrypt($request->password);
//        dd($visitor);
        if (  $visitor->save()){
            $path = route('visitor.register.verify',$visitor->verification_key);
            $link = "<a href='$path' target='_blank'>Verify</a>";
            $request->session()->flash('success_message',"Your Registration is Success!, Please click on verification link, $link");
        }else {
            $request->session()->flash('error_message','Registration Failed!');
            return redirect()->route('visitor.register');
        }
        return redirect()->route('visitor.auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
