@extends('cms.parent')

@section('title' , 'Create Speciality' )

@section('main-title' , 'Create Speciality')

@section('sub-title' , 'Create Speciality')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create New Speciality</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Speciality Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of Speciality">
                </div>
              </div>
              <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
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
        function performStore(){
            let formData = new FormData();
            formData.append('name' , document.getElementById('name').value);
            store('/cms/admin/specialities' , formData);
        }
    </script>
@endsection

