@extends('cms.parent')

@section('title' , 'Index Category')

@section('main-title' , 'Index Category')

@section('sub-title' , 'Index Category')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            @can('Create Category')
            <a href="{{ route('categories.create') }}" type="submit" class="btn btn-success">Add New Category</a>
            @endcan
            <a href ="{{ route('categories_recycle') }}" type="submit" class="btn btn-danger" >Recycle Bin</a>
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
                <th>Category Name</th>
                <th>Status</th>
                @canAny(['Edit Category','Delete Category','Show Category'])
                <th>Settings</th>
                @endcanany
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category )
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>
                        <div class="btn-group">
                            @can('Edit Category')
                            <a href="{{ route('categories.edit' , $category->id) }}" type="button" class="btn btn-info">Edit</a>
                            @endcan
                            @can('Delete Category')
                            <button type="button" onclick="performDestroy({{ $category->id }} , this)" class="btn btn-danger">Delete</button>
                            @endcan
                            @can('Show Category')
                            <a href="{{ route('categories.show' , $category->id) }}" type="button" class="btn btn-success">Show</a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $categories->links() }}
      </div>
    </div>
  </div>
@endsection


@section('scripts')
    <script>
        function performDestroy(id , reference){
            confirmDestroy('/cms/admin/categories/'+id , reference);
        }
    </script>
@endsection
