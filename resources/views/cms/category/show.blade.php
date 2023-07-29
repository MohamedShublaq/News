@extends('cms.parent')

@section('title' , 'Show Category' )

@section('main-title' , 'Show Category')

@section('sub-title' , 'Show Category')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Show Data of Category</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Category Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $categories->name }}" disabled>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2" name="status" id="status" style="width: 100%;" disabled>
                        <option selected value="{{ $categories->id }}">{{ $categories->status }}</option>
                          <option value="active">Avtive</option>
                          <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="discription">Description of Category</label>
                    <textarea class="form-control" style="resize: none;" id="description" name="description" disabled rows="4" cols="50"> {{ $categories->description }} </textarea>
                </div>
              </div>
              <div class="card-footer">
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

@endsection

