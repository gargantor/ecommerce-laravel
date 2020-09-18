@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fatags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
            <h3 class="tile-title">{{ $subTitle}}</h3>
            <form action="{{ route('admin.categories.store')  }}" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="tile-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Name <span class="m-l-5 text-danger">*</span> </label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                        @error('name') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                    <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="parent">Parent Category <span class="m-l-5 text-danger"> *</span></label>
                        <select id=parent class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror" name="parent_id">
                            <option value="0">Select a parent category</option>
                            @foreach($categories as $key => $category)
                                <option value="{{ $key }}"> {{ $category }} </option>
                            @endforeach
                        </select>
                        @error('parent_id') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="featured" name="featured" />Featured Category
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="menu" name="menu" />Show in Menu
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" />
                        @error('image') {{ $message }} @enderror
                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection
