@extends('admin.layouts.table')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{$create_url}}" class="btn btn-success">Создать</a>
                            <table id="example2" class="table table-bordered table-hover admin-data-table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Created At</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item['key'] }}</td>
                                        <td>{{ $item['value'] }}</td>
                                        <td>{{ $item['created_at'] }}</td>
                                        <td>
                                            <a href="{{$item['edit_url']}}" class="btn btn-success">Update</a>
                                        </td>
                                        <td>
                                            <form action="{{$item['delete_url']}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Created At</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
