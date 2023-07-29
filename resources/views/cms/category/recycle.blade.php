@extends('cms.parent')

@section('title' , 'RecycleBin Category')

@section('main-title' , 'RecycleBin Category')

@section('sub-title' , 'RecycleBin Category')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <a href="{{ route('categories.index') }}" type="submit" class="btn btn-danger">Go Back</a>
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
                <th>status</th>
                <th>Settings</th>
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
                            <a href="{{ route('categories_restore' , $category->id) }}" type="button" class="btn btn-success">Restore</a>
                            <a href="{{ route('categories_delete' , $category->id) }}" type="button" class="btn btn-danger">Permanent Deletion</a>
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

@endsection
