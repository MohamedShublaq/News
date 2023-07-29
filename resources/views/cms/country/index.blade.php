@extends('cms.parent')

@section('title' , 'Index Country')

@section('main-title' , 'Index Country')

@section('sub-title' , 'Index Country')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            @can('Create Country')
            <a href="{{ route('countries.create') }}" type="submit" class="btn btn-success">Add New Country</a>
            @endcan
            <a href ="{{ route('countries_recycle') }}" type="submit" class="btn btn-danger" >Recycle Bin</a>
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
                @canAny(['Edit Country','Delete Country','Show Country'])
                <th>Settings</th>
                @endcanany
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
                            @can('Edit Country')
                            <a href="{{ route('countries.edit' , $country->id) }}" type="button" class="btn btn-info">Edit</a>
                            @endcan
                            @can('Delete Country')
                            <button type="button" onclick="performDestroy({{ $country->id }} , this)" class="btn btn-danger">Delete</button>
                            @endcan
                            @can('Show Country')
                            <a href="{{ route('countries.show' , $country->id) }}" type="button" class="btn btn-success">Show</a>
                            @endcan
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
    <script>
        function performDestroy(id , reference){
            confirmDestroy('/cms/admin/countries/'+id , reference);
        }
    </script>
@endsection
