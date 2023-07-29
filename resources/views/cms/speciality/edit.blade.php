@extends('cms.parent')

@section('title' , 'Edit Speciality' )

@section('main-title' , 'Edit Speciality')

@section('sub-title' , 'Edit Speciality')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Speciality</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Speciality Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $specialities->name }}" >
                </div>
              </div>
              <div class="card-footer">
                <button type="button" onclick="performUpdate({{ $specialities->id }})" class="btn btn-primary">Update</button>
                @can('Index Speciality')
                <a href="{{ route('specialities.index') }}" type="submit" class="btn btn-danger">Go Back</a>
                @endcan
              </div>
            </form>
          </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    function performUpdate(id){
        let formData = new FormData();
        formData.append('name' , document.getElementById('name').value);
        storeRoute('/cms/admin/specialities_update/'+id , formData);
    }
</script>
@endsection

