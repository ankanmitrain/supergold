@extends('adminlte::page')

@section('title', 'Generate PDF Mobile')

@section('content_header')
    <h1>Generate PDF</h1>
@stop

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="{{ asset('js/script-mobile.js') }}"></script>
<div class="card">
  <!--begin::Header-->
  <div class="card-header">
    <div class="card-title">Generate PDF</div>
  </div>
  <div class="card-body p-0">
 <!-- <form action="{{ route('admin.uploadpdf.store') }}" method="POST" enctype="multipart/form-data">-->
    @csrf
    <div class="pdf-g-body">
        <div class="row">
          <div class="col-md-12">
            <div class="pdf-g-header">

          <input type="text" class="input-date" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" id="date" />
          <input type="text" class="input-time" id="time" value="01:30 PM" />
          <input type="text" class="first-firze-ele input-id" value="00000000" required max="8" id="id" />
          <!-- <input type="text" class="input id2" value="65B02639" required /> -->
          <input type="text" class="input-name" value="00000" max="5" required id="name" />

              <img src="{{ asset('images/pdf-top-banner.png') }}" alt="lottery" class="background-image-pdf" width="100%" />
              

            </div>
          </div>
        </div>
        <div class="boder-pdf">
         <div class="row pdf-border-box" >
          <div class="col-md-4">
            <img src="{{ asset('images/prize1.png') }}" alt="lottery" class="background-image" width="100%" />
          </div>
          <div class="col-md-7"><div class="grid pdf-input grid5 secondPrize" id="secondPrize"></div></div>
          <div class="col-md-1"> <div class="pdf-input"><button class="btn btn-primary" onclick="sortInputsByButton('secondPrize')">Sort</button></div></div>
        </div>

         <div class="row pdf-border-box">
          <div class="col-md-4">
            <img src="{{ asset('images/prize2.png') }}" alt="lottery" class="background-image" width="100%" />
          </div>
          <div class="col-md-7"><div class="grid  pdf-input grid5 thirdPrize" id="thirdPrize"></div></div>
          <div class="col-md-1"> <div class="pdf-input"><button class="btn btn-primary" onclick="sortInputsByButton('thirdPrize')">Sort</button></div></div>
        </div>

         <div class="row pdf-border-box">
          <div class="col-md-4">
            <img src="{{ asset('images/prize3.png') }}" alt="lottery" class="background-image" width="100%" />
          </div>
          <div class="col-md-7"><div class="grid pdf-input grid4 fourthPrize" id="fourthPrize"></div></div>
          <div class="col-md-1"> <div class="pdf-input"><button class="btn btn-primary" onclick="sortInputsByButton('fourthPrize')">Sort</button></div></div>
        </div>

         <div class="row">
          <div class="col-md-4 pdf-border-box">
            <img src="{{ asset('images/prize4.png') }}" alt="lottery" class="background-image" width="100%" />
          </div>
          <div class="col-md-7 "><div class="grid pdf-input grid4 sixthPrize" id="sixthPrize"></div></div>
          <div class="col-md-1"> <div class="pdf-input"><button class="btn btn-primary" onclick="sortInputsByButton('sixthPrize')">Sort</button></div></div>
        </div>

        <div class="row pdf-border-box">
          <div class="col-md-4">
            <img src="{{ asset('images/prize5.png') }}" alt="lottery" class="background-image" width="100%" />
          </div>
          <div class="col-md-7 "> <div class="pdf-input grid grid4 fifthPrize" id="fifthPrize"></div></div>
          <div class="col-md-1"> <div class="pdf-input"><button class="btn btn-primary" onclick="sortInputsByButton('fifthPrize')">Sort</button></div></div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <img src="{{ asset('images/superlottery-9.png') }}" alt="lottery" class="background-image" width="100%" />
          </div>
          <div class="col-md-12 ">
            <div class="grid grid10 seventhPrize pdf-center" id="seventhPrize">
                        

            </div>
           </div> 

            <div class="col-md-12"> <div class="pdf-input"><button class="btn btn-primary" onclick="sortInputsByButton('seventhPrize')">Sort</button></div></div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <img src="{{ asset('images/superlottery-10.png') }}" alt="lottery" class="background-image" width="100%" />
          </div>

        </div>
    </div>

<!--</form>-->
</div>
 <div class="card-footer">
        <button class="btn btn-primary" onclick="saveFormToLocalStorage()">Save to localStorage</button>
    <button class="btn btn-primary" onclick="downloadPDF()">View and Download PDF</button>  <button class="btn btn-primary" onclick="resetForm()">Reset Form</button>
  </div>
</div>


<style>
  .boder-pdf{
    border-left: 2px solid #000;
    margin-left: 11px;
    margin-right: 11px;
    border-right: 2px solid #000;
  }
  .pdf-border-box{
    padding-top: 10px;
    padding-bottom: 10px;
  }

  .pdf-input input{
    width: 130px;    
  }

   .pdf-input {
   padding-top: 13px;
   text-align: center;
  }

  .pdf-center{
    text-align: center;

  }

  .pdf-center input{
    width: 110px;    
  }

  .first-firze-ele{
    position: absolute;
    left: 38%;
    top: 47%;
    font-size: 4vw;
    color: white;
    font-weight: bold;
    background: transparent;
    border: none;
    outline: none;
  }

  .input-date{
     position: absolute;
         bottom: 15%;
    left: 43%;
    font-size: 2vw;
    color: black;
    font-weight: bold;
    background: transparent;
    border: none;
    outline: none;
  } 
  .input-time{
     position: absolute;
     right: 4%;
    bottom: 16%;
    width: 200px;
    font-size: 3vw;
    color: white;
    text-align: right;
    font-weight: bold;
    background: transparent;
    border: none;
    outline: none;
  }

  .input-name{
     position: absolute;
     left: 49%;
    bottom: 0;
    color: #3b82f6;
    font-size: 2vw;
    font-weight: bold;
    background: transparent;
    border: none;
    outline: none;
  }

  .background-image-pdf{
    /*min-height: 300px;*/
  }

  .text-input{
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    box-shadow: inset 0 0 0 transparent;
    transition: border-color .15s 
    ease-in-out, box-shadow .15s 
    ease-in-out;
  }

</style>
@stop