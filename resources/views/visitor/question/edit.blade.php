@extends('visitor/layouts/master')
@section('title','Edit Question')
@section('body')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-xl-8 py-5 px-md-5">
                    <div class="row pt-md-4">
                        <div class="col-md-12">
                            <form action="{{route('question.update',$data['question']->id)}}" method="POST" >
                                <input type="hidden" name="_method" value="PUT"/>
                                @csrf
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id"  class="form-control">
                                        <option value="{{$data['question']->category_id}}">{{$data['question']->category->name}}</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="name">Question</label>
                                    <input type="text" name="que_content" value="{{$data['question']->que_content}}" class="form-control" id="que_content">
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check icheck"></i>Update </button>
                            </form>

                        </div>
                    </div><!-- END-->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection



