@extends('visitor/layouts/master')
@section('title','Ask Question')
@section('body')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-xl-8 py-5 px-md-5">
                    <div class="row pt-md-4">
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
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-undo icheck"></i>Close</button>

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


