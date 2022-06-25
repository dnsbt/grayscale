@extends('admin.layouts.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-2">
                    <div class="card card-default">
                        <div class="card-header"><h3 class="card-title">{{$project->title}}</h3></div>
                        <form method="post" action="{{$action}}" enctype="multipart/form-data">
                            @if(!empty($project->title))
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" placeholder="Title" name="title"
                                           value="{{$project->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" class="form-control" placeholder="Description" name="description"
                                           value="{{$project->description}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Photo</label>
                                    <select class="form-control" name="file_id" required>
                                        @foreach($files as $file)
                                            <option @if($file['id'] === $project->file_id) selected
                                                    @endif value="{{$file['id']}}">{{$file['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
