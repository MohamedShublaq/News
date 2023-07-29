@extends('cms.parent')

@section('title' , 'RecycleBin City')

@section('main-title' , 'RecycleBin City')

@section('sub-title' , 'RecycleBin City')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <a href="{{ route('cities.index') }}" type="submit" class="btn btn-danger">Go Back</a>
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
                <th>City Name</th>
                <th>Country Name</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cities as $city )
                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->country->name ?? "" }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('cities_restore' , $city->id) }}" type="button" class="btn btn-success">Restore</a>
                            <a href="{{ route('cities_delete' , $city->id) }}" type="button" class="btn btn-danger">Permanent Deletion</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $cities->links() }}
      </div>
    </div>
  </div>
@endsection


@section('scripts')

@endsection
