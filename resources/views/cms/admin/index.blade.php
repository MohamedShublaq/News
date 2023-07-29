@extends('cms.parent')

@section('title' , 'Index Admin')

@section('main-title' , 'Index Admin')

@section('sub-title' , 'Index Admin')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            @can('Create Admin')
            <a href="{{ route('admins.create') }}" type="submit" class="btn btn-success">Add New Admin</a>
            @endcan
            <a href ="{{ route('admins_recycle') }}" type="submit" class="btn btn-danger" >Recycle Bin</a>
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
                @canAny(['Edit Admin','Delete Admin','Show Admin'])
                <th>Settings</th>
                @endcanany
              </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>
                        <img class="img-circle img-bordered-sm" src="{{asset('storage/images/admin/'.$admin->user->image ?? "")}}" width="60" height="60" alt="User Image">
                    </td>
                    <td>{{ $admin->user->first_name .' '. $admin->user->last_name ?? ""}}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->user->gender ?? "" }}</td>
                    <td>{{ $admin->user->status ?? "" }}</td>
                    <td>{{ $admin->user->city->name ?? "" }}</td>
                    <td>{{ $admin->user->speciality->name ?? "" }}</td>
                    <td>
                        <div class="btn-group">
                            @can('Edit Admin')
                            <a href="{{ route('admins.edit' , $admin->id) }}" type="button" class="btn btn-info">Edit</a>
                            @endcan
                            @can('Delete Admin')
                            <button type="button" onclick="performDestroy({{ $admin->id }} , this)" class="btn btn-danger">Delete</button>
                            @endcan
                            @can('Show Admin')
                            <a href="{{ route('admins.show' , $admin->id) }}" type="button" class="btn btn-success">Show</a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $admins->links() }}
      </div>
    </div>
  </div>
@endsection


@section('scripts')
    <script>
        function performDestroy(id , reference){
            confirmDestroy('/cms/admin/admins/'+id , reference);
        }
    </script>
@endsection
