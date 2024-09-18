@extends('layouts.app')

@section('body')
    <h1>Detail Book</h1>
    <hr />
        <div class="row mb-3">
            <div class="col">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control" value="{{$book->name}}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" value="{{$book->author}}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Year</label>
                <input type="text" name="year" class="form-control" value="{{$book->year}}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" readonly>{{$book->description}}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
              <label class="form-label">Created At</label>
              <input type="text" name="created_at" class="form-control" value="{{$book->created_at}}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Updated At</label>
                <input type="text" name="updated_at" class="form-control" value="{{$book->updated_at}}" readonly>
            </div>
        </div>
@endsection
