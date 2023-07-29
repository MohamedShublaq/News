@extends('cms.parent')

@section('title' , 'Edit Category' )

@section('main-title' , 'Edit Category')

@section('sub-title' , 'Edit Category')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Category</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Category Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $categories->name }}">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2" name="status" id="status" style="width: 100%;">
                        <option selected value="{{ $categories->id }}">{{ $categories->status }}</option>
                          <option value="active">Avtive</option>
                          <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="discription">Description of Category</label>
                    <textarea class="form-control" style="resize: none;" id="description" name="description" rows="4" cols="50"> {{ $categories->description }} </textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="button" onclick="performUpdate({{ $categories->id }})" class="btn btn-primary">Update</button>
                @can('Index Category')
                <a href="{{ route('categories.index') }}" type="submit" class="btn btn-danger">Go Back</a>
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
            formData.append('status' , document.getElementById('status').value);
            formData.append('description' , document.getElementById('description').value);
            storeRoute('/cms/admin/categories_update/'+id , formData);
        }
    </script>
@endsection

