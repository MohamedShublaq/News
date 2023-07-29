@extends('cms.parent')

@section('title' , 'Index Author')

@section('main-title' , 'Index Author')

@section('sub-title' , 'Index Author')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            @can('Create Author')
            <a href="{{ route('authors.create') }}" type="submit" class="btn btn-success">Add New Author</a>
            @endcan
            <a href ="{{ route('authors_recycle') }}" type="submit" class="btn btn-danger" >Recycle Bin</a>
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
                <th>Articles</th>
                @canAny(['Edit Author','Delete Author','Show Author'])
                <th>Settings</th>
                @endcanany
              </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author )
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>
                        <img class="img-circle img-bordered-sm" src="{{asset('storage/images/author/'.$author->user->image ?? "")}}" width="60" height="60" alt="User Image">
                    </td>
                    <td>{{ $author->user->first_name .' '. $author->user->last_name ?? ""}}</td>
                    <td>{{ $author->email }}</td>
                    <td>{{ $author->user->gender ?? "" }}</td>
                    <td>{{ $author->user->status ?? "" }}</td>
                    <td>{{ $author->user->city->name ?? "" }}</td>
                    <td>{{ $author->user->speciality->name ?? "" }}</td>
                    <td><a href="{{route('indexArticle',['authid'=>$author->id])}}"
                        class="btn btn-info">({{$author->articles_count}})
                        article/s</a> </td>
                    <td>
                        <div class="btn-group">
                            @can('Edit Author')
                            <a href="{{ route('authors.edit' , $author->id) }}" type="button" class="btn btn-info">Edit</a>
                            @endcan
                            @can('Delete Author')
                            <button type="button" onclick="performDestroy({{ $author->id }} , this)" class="btn btn-danger">Delete</button>
                            @endcan
                            @can('Show Author')
                            <a href="{{ route('authors.show' , $author->id) }}" type="button" class="btn btn-success">Show</a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $authors->links() }}
      </div>
    </div>
  </div>
@endsection


@section('scripts')
    <script>
        function performDestroy(id , reference){
            confirmDestroy('/cms/admin/authors/'+id , reference);
        }
    </script>
@endsection
