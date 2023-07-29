@extends('cms.parent')

@section('title' , 'RecycleBin Speciality')

@section('main-title' , 'RecycleBin Speciality')

@section('sub-title' , 'RecycleBin Speciality')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <a href="{{ route('specialities.index') }}" type="submit" class="btn btn-danger">Go Back</a>
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
                <th>Speciality Name</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($specialities as $speciality )
                <tr>
                    <td>{{ $speciality->id }}</td>
                    <td>{{ $speciality->name }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('specialities_restore' , $speciality->id) }}" type="button" class="btn btn-success">Restore</a>
                            <a href="{{ route('specialities_delete' , $speciality->id) }}" type="button" class="btn btn-danger">Permanent Deletion</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $specialities->links() }}
      </div>
    </div>
  </div>
@endsection


@section('scripts')

@endsection
