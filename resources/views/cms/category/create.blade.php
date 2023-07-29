@extends('cms.parent')

@section('title' , 'Create Category' )

@section('main-title' , 'Create Category')

@section('sub-title' , 'Create Category')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create New Category</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Category Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of Category">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2" name="status" id="status" style="width: 100%;">
                          <option value="active">Avtive</option>
                          <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="discription">Description of Category</label>
                    <textarea class="form-control" style="resize: none;" id="description" name="description" rows="4"
                    placeholder="Enter Description of Category " cols="50"> </textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
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
        function performStore(){
            let formData = new FormData();
            formData.append('name' , document.getElementById('name').value);
            formData.append('status' , document.getElementById('status').value);
            formData.append('description' , document.getElementById('description').value);
            store('/cms/admin/categories' , formData);
        }
    </script>
@endsection

