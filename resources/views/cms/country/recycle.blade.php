@extends('cms.parent')

@section('title' , 'RecycleBin Country')

@section('main-title' , 'RecycleBin Country')

@section('sub-title' , 'RecycleBin Country')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <a href="{{ route('countries.index') }}" type="submit" class="btn btn-danger">Go Back</a>
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
                <th>Country Name</th>
                <th>Country Code</th>
                <th>Number of Cities</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country )
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->code }}</td>
                    <td>{{ $country->cities_count }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('countries_restore' , $country->id) }}" type="button" class="btn btn-success">Restore</a>
                            <a href="{{ route('countries_delete' , $country->id) }}" type="button" class="btn btn-danger">Permanent Deletion</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $countries->links() }}
      </div>
    </div>
  </div>
@endsection


@section('scripts')

@endsection
