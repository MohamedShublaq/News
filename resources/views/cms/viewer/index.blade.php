@extends('cms.parent')

@section('title' , 'Index Viewer')

@section('main-title' , 'Index Viewer')

@section('sub-title' , 'Index Viewer')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            @can('Create Viewer')
            <a href="{{ route('viewers.create') }}" type="submit" class="btn btn-success">Add New Viewer</a>
            @endcan
            <a href ="{{ route('viewers_recycle') }}" type="submit" class="btn btn-danger" >Recycle Bin</a>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Status</th>
                <th>City Name</th>
                <th>Speciality Name</th>
                @canAny(['Edit Viewer','Delete Viewer','Show Viewer'])
                <th>Settings</th>
                @endcanany
              </tr>
            </thead>
            <tbody>
                @foreach ($viewers as $viewer )
                <tr>
                    <td>{{ $viewer->id }}</td>
                    <td>
                        <img class="img-circle img-bordered-sm" src="{{asset('storage/images/viewer/'.$viewer->user->image ?? "")}}" width="60" height="60" alt="User Image">
                    </td>
                    <td>{{ $viewer->user->first_name .' '. $viewer->user->last_name ?? ""}}</td>
                    <td>{{ $viewer->email }}</td>
                    <td>{{ $viewer->user->gender ?? "" }}</td>
                    <td>{{ $viewer->user->status ?? "" }}</td>
                    <td>{{ $viewer->user->city->name ?? "" }}</td>
                    <td>{{ $viewer->user->speciality->name ?? "" }}</td>
                    <td>
                        <div class="btn-group">
                            @can('Edit Viewer')
                            <a href="{{ route('viewers.edit' , $viewer->id) }}" type="button" class="btn btn-info">Edit</a>
                            @endcan
                            @can('Delete Viewer')
                            <button type="button" onclick="performDestroy({{ $viewer->id }} , this)" class="btn btn-danger">Delete</button>
                            @endcan
                            @can('Show Viewer')
                            <a href="{{ route('viewers.show' , $viewer->id) }}" type="button" class="btn btn-success">Show</a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $viewers->links() }}
      </div>
    </div>
  </div>
@endsection


@section('scripts')
    <script>
        function performDestroy(id , reference){
            confirmDestroy('/cms/admin/viewers/'+id , reference);
        }
    </script>
@endsection
