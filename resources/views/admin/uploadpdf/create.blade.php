@extends('adminlte::page')

@section('title', 'Add PDF')

@section('content_header')
    <h1>Add PDF</h1>
@stop

@section('content')
<div class="col-md-8">
<div class="card card-primary card-outline mb-4">
  <!--begin::Header-->
  <div class="card-header">
    <div class="card-title">Add New PDF</div>
  </div>
    <form action="{{ route('admin.uploadpdf.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Publish Date</label>
            <input type="date" name="publish_date" class="form-control">
        </div>

        <div class="mb-3">
            <label>Publish Time</label>
            <input type="time" name="publish_time" class="form-control">
        </div>

        <div class="mb-3">
            <label>
                <input type="checkbox" name="enable_pdf" value="1" checked>
                Enable 
            </label>
            
        </div>

        <div class="mb-3">
            <label>PDF File</label>
            <input type="file" name="pdf" class="form-control" required>
        </div>
        </div>
         <div class="card-footer">
        <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
</div>
@stop
