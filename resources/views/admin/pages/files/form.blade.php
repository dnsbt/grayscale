@extends('admin.layouts.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-2">
                    <div class="card card-default">
                        <div class="card-header"><h3 class="card-title">{{$file->name}}</h3></div>
                        <form method="post" action="{{$action}}" enctype="multipart/form-data">
                            @if(!empty($file->name))
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="file" name="files" class="form-control" accept="image/*">
                                    @if ($errors->has('files'))
                                        @foreach ($errors->get('files') as $error)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$error}}</strong>
                                             </span>
                                        @endforeach
                                    @endif
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
