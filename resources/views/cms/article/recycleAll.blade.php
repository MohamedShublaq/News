@extends('cms.parent')

@section('title' , 'RecycleBin Article')

@section('main-title' , 'RecycleBin Article')

@section('sub-title' , 'RecycleBin Article')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <a href="{{ route('articles.index') }}" type="submit" class="btn btn-danger">Go Back</a>
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
                <th>Article Name</th>
                <th>Short Description</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article )
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>
                        <img class="img-circle img-bordered-sm" src="{{asset('storage/images/article/'.$article->image)}}" width="60" height="60" alt="User Image">
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->short_description }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('articles_restore' , $article->id) }}" type="button" class="btn btn-success">Restore</a>
                            <a href="{{ route('articles_delete' , $article->id) }}" type="button" class="btn btn-danger">Permanent Deletion</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $articles->links() }}
      </div>
    </div>
  </div>
@endsection


@section('scripts')

@endsection
