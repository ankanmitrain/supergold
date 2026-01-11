@extends('adminlte::page')

@section('title', 'Add Page Content')

@section('content_header')
    <h1>Add Page</h1>
@stop

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        

        <div class="mb-3">
            <label>Page Content</label>
            <textarea name="content" placeholder="Content" id="editor" required class="form-control"></textarea>
        </div>

        

        <button class="btn btn-primary">Save</button>
    </form>
@stop
