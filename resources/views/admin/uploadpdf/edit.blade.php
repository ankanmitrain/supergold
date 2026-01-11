@extends('adminlte::page')

@section('title', 'Edit PDF')

@section('content_header')
    <h1>PDF Resault</h1>
@stop

@section('content')

<div class="col-md-8">
<div class="card card-primary card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header">
        <div class="card-title">Edit PDF</div>
      </div>
      
        <form action="{{ route('admin.uploadpdf.update', $uploadpdf->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $uploadpdf->title }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Publish Date</label>
                    <input type="date" name="publish_date" class="form-control"
                           value="{{ $uploadpdf->publish_date->format('Y-m-d') }}">
                </div>

                <div class="mb-3">
                    <label>Publish Time</label>
                    <input type="time" name="publish_time" class="form-control"
                           value="{{ $uploadpdf->publish_time }}">
                </div>

                <div class="mb-3">
                    <label>
                        <input type="checkbox" name="enable_pdf" value="1"
                               {{ $uploadpdf->enable_pdf ? 'checked' : '' }}>
                        Enable
                    </label>                
                </div>


                <div class=" mb-3">
                    <label>PDF File (leave empty to keep old)</label>
                    <input type="file" name="pdf" class="form-control">
                    
                    <a href="{{ asset('storage/' . $uploadpdf->pdf_path) }}" target="_blank" class="btn btn-info btn-sm mt-2">
                        View Current PDF
                    </a>

                   
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
     
</div>
</div>
@stop
