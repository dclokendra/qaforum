@extends('layouts.backend')
@section('title','Edit Category')

@section('content')

    <section class="content-header">
        <h1>
            Category Management
            <small>it all about category data</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Category
                    <a href="{{route('category.create')}}" class="btn btn-info"><i class="fa fa-plus"></i>Create</a>
                    <a href="{{route('category.index')}}" class="btn btn-info"><i class="fa fa-plus"></i>List</a>
                </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('layouts.includes.error')
                <form action="{{route('category.update',$data['category']->id)}}" method="post">
                    <input type="hidden" name="_method" value="PUT"/>
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$data['category']->name}}"/>
                        @include('layouts.includes.single_field_validation',['field'=>'name'])
                    </div>

                    <div class="form-group">
                        <label for="rank">Rank</label>
                        <input type="number" name="rank" class="form-control" id="rank" value="{{$data['category']->rank}}"/>
                        @include('layouts.includes.single_field_validation',['field'=>'rank'])
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        @if($data['category']->status==1)
                        <input type="radio" name="status" value="1" checked>Active
                            <input type="radio" name="status" value="0">DeActive
                        @else
                            <input type="radio" name="status" value="1">Active
                            <input type="radio" name="status" value="0" checked>DeActive
                        @endif
                    </div>
                    <input type="submit" name="submit" id="submit" class="btn btn-success" value="Update Category">
                    <input type="submit" name="submit" id="submit" class="btn btn-danger" value="Clear">
                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
@endsection
