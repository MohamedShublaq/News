@extends('cms.parent')

@section('title' , 'Show City' )

@section('main-title' , 'Show City')

@section('sub-title' , 'Show City')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Show Data of City</h3>
            </div>
            <form>
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Country Name</label>
                          <select class="form-control select2" name="country_id" id="country_id" style="width: 100%;">
                            @foreach ($countries as $country )
                                <option @if($country->id == $cities->country_id) selected @endif value="{{ $country->id }}" disabled>{{ $country->name }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                </div>
            </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">City Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $cities->name }}" disabled>
                </div>
              </div>
              <div class="card-footer">
                @can('Index City')
                <a href="{{ route('cities.index') }}" type="submit" class="btn btn-danger">Go Back</a>
                @endcan
              </div>
            </form>
          </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

@endsection

