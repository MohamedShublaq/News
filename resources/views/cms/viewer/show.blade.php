@extends('cms.parent')

@section('title' , 'Show Viewer' )

@section('main-title' , 'Show Viewer')

@section('sub-title' , 'Show Viewer')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Show Data of Viewer</h3>
            </div>
            <form>
                <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $viewers->user->first_name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$viewers->user->last_name}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $viewers->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{$viewers->password}}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control select2" name="gender" id="gender" style="width: 100%;" disabled>
                                <option selected value="{{ $viewers->id }}">{{ $viewers->user->gender }}</option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" name="status" id="status" style="width: 100%;" disabled>
                                <option selected value="{{ $viewers->id }}">{{ $viewers->user->status }}</option>
                                  <option value="active">Avtive</option>
                                  <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" value="{{ $viewers->user->image }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="date">Date of Birth</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $viewers->user->date }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $viewers->user->mobile }}" disabled>
                        </div>
                        <div class="form-group">
                          <label>City Name</label>
                          <select class="form-control select2" name="city_id" id="city_id" style="width: 100%;" disabled>
                            @foreach ($cities as $city )
                                <option @if($city->id == $viewers->user->city_id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                            <label>Speciality Name</label>
                            <select class="form-control select2" name="speciality_id" id="speciality_id" style="width: 100%;" disabled>
                              @foreach ($specialities as $speciality )
                                    <option @if($speciality->id == $viewers->user->speciality_id) selected @endif value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                              @endforeach
                            </select>
                          </div>
                </div>
              <div class="card-footer">
                @can('Index Viewer')
                <a href="{{ route('viewers.index') }}" type="submit" class="btn btn-danger">Go Back</a>
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

