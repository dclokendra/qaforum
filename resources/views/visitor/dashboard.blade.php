@extends('visitor/includes/main')
@section('title','Home Page')


@section('body')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-xl-8 py-5 px-md-5">
                    <div class="row pt-md-4">
{{--                        Ask Qustion--}}
                        <div class="col-md-12">
                            <form action="{{route('question.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        <option>Select Category</option>
                                        @foreach($data['categories'] as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Question</label>
                                    <input type="text" name="que_content" class="form-control" id="que_content">
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check icheck"></i>Save </button>
                            </form>
                        </div>

                        @foreach($data['questions'] as $question)
                        <div class="col-md-12">
                            <div class="blog-entry ftco-animate d-md-flex">
                                <div class="text text-2 pl-md-4">
                                    <h3 class="mb-2"><a href="">{{$question->que_content}}</a></h3>
                                    <div class="meta-wrap">
                                        <p class="meta">
                                            <span><i class="icon-calendar mr-2"></i>{{$question->que_date}}</span>
                                            <span><i class="icon-clock-o mr-2"></i>{{$question->que_time}}</span>
                                            <span><a href="single.html"><i class="icon-folder-o mr-2"></i>{{$question->name}}</a></span>
                                        </p>
                                        @php($answers= \App\Model\Answer::select('id','ans_content')->where([['question_id','=',$question->id],['status', '=', 1]])->get() )
                                        @foreach($answers as $answer)
                                        <p>{{$answer->ans_content}}</p>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- END-->

                </div>
                <div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
                    <div class="sidebar-box pt-md-4">
                        <h4>
                            @if(isset(auth()->guard('visitor')->user()->id))
                                {{ \Illuminate\Support\Facades\Auth::guard('visitor')->user()->name }}
                                <a href="{{ route('visitor.auth.logout') }}">Logout</a>
                            @else
                                <script>window.location.href = "{{route('visitor.auth.login')}}";</script>
                            @endif
                        </h4>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <h3 class="sidebar-heading">Categories</h3>
                        <ul class="categories">
                            @foreach($data['categories'] as $category)
                                <li>{{$category->name}}</li>
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

