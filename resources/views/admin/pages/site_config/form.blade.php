@extends('admin.layouts.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-2">
                    <div class="card card-default">
                        <div class="card-header"><h3 class="card-title">{{$site_config->key}}</h3></div>
                        <form method="post" action="{{$action}}" enctype="multipart/form-data">
                            @if(!empty($site_config->key))
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    @if(!$site_config->key)
                                        <label for="">Key</label>
                                        <input type="text" class="form-control" placeholder="Key" name="key"
                                               value="{{$site_config->key}}">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Value</label>
                                    <input type="text" class="form-control" placeholder="Value" name="value"
                                           value="{{$site_config->value}}">
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

