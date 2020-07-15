@extends('visitor/includes/main')
@section('title','List Answer')


@section('body')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-xl-8 py-5 px-md-5">
                    <div class="row pt-md-4">
                        {{--                        Ask Qustion--}}
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data['answers'] as $answer)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$answer->que_content}}</td>
                                        <td>{{$answer->ans_content}}</td>
                                        <td>{{$answer->ans_date}}</td>
                                        <td>
                                            @if($answer->status==1)
                                                <label class="labell label-success">Active</label>
                                            @else
                                                <label class="labell label-danger">De Active</label>
                                            @endif
                                        </td>
                                        <td><a href="{{route('answer.edit',$answer->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i>edit</a>
                                            <form action="{{route('answer.destroy',$answer->id)}}" method="post" onsubmit="return confirm('Are you surer to Delete')">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                            </form>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

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


