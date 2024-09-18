@extends('layouts.app')

@section('body')
    <h1>Detail Book</h1>
    <hr />
    <form action="{{route('book.update', $book->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control" value="{{$book->name}}">
            </div>
            <div class="col">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" value="{{$book->author}}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Year</label>
                <input type="text" name="year" class="form-control" value="{{$book->year}}">
            </div>
            <div class="col">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control">{{$book->description}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
