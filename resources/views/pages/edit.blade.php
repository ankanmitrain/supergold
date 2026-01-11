@extends('adminlte::page')

@section('title', 'Edit Page Content')

@section('content_header')
    <h1>Edit PDF</h1>
@stop

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> 
    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $page->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Page Content</label>
            <textarea name="content" placeholder="Content" id="editor" required class="form-control">{{ $page->content ?? '' }}</textarea>
        </div>
        

    
       

        <button class="btn btn-primary">Update</button>
    </form>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@stop
