@extends('visitor/includes/main')
@section('title','Edit Answer')


@section('body')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-xl-8 py-5 px-md-5">
                    <div class="row pt-md-4">
                            <div class="col-md-12">
                                <div class="blog-entry ftco-animate d-md-flex">
                                    <div class="text text-2 pl-md-4">
                                        <h3 class="mb-2"><a href="">{{$data['answer']->question->que_content}}</a></h3>
                                        <div class="meta-wrap">
                                            <p class="meta">
                                                <span><i class="icon-calendar mr-2"></i>{{$data['answer']->question->que_date}}</span>
                                                <span><i class="icon-clock-o mr-2"></i>{{$data['answer']->question->que_time}}</span>
                                            </p>
                                            <form action="{{route('answer.update',$data['answer']->id)}}" method="POST">
                                                <input type="hidden" name="_method" value="PUT"/>
                                                @csrf
                                                <div class="form-group">
                                                    <input name="question_id" type="hidden" value="{{$data['answer']->question_id}}">
                                                    <textarea name="ans_content" placeholder="Enter your Answer" class="form-control" id="ans_content">{{$data['answer']->ans_content}}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check icheck"></i>Update </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div><!-- END-->

                </div>
                <div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
                    <div class="sidebar-box pt-md-4">
                        <h4>
                            {{ \Illuminate\Support\Facades\Auth::guard('visitor')->user()->name }}
                            <a href="{{ route('visitor.auth.logout') }}">Logout</a>
                        </h4>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <h3 class="sidebar-heading">Categories</h3>
                        <ul class="categories">
                            @foreach($data['categories'] as $category)
                                <li><a href="#">{{$category->name}} <span>(6)</span></a></li>
                            @endforeach
                        </ul>
                    </div>


                </div><!-- END COL -->
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection


