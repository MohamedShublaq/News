@extends('cms.parent')

@section('title' , 'Show Speciality' )

@section('main-title' , 'Show Speciality')

@section('sub-title' , 'Show Speciality')

@section('styles')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Show Data of Speciality</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Speciality Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $specialities->name }}" disabled >
                </div>
              </div>
              <div class="card-footer">
                @can('Index Speciality')
                <a href="{{ route('specialities.index') }}" type="submit" class="btn btn-danger">Go Back</a>
                @endcan
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('scripts')

@endsection

