
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lottery Form</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>


<div class="download-container">
    <button class="download-btn" onclick="saveFormToLocalStorage()">Save to localStorage</button>
    <button class="download-btn" onclick="downloadPDF()">Download PDF</button>
  </div>
  <div class="wrapper" id="capture">
    <div class="lottery-form" id="lottery-form">
      <img src="{{ asset('images/superlottery.png') }}" alt="lottery" class="background-image" />
      <input type="text" class="input date" value=""/>
      <input type="text" class="input time" id="time" value="01:30 PM" />
      <input type="text" class="input id" value="00000000" required max="8" />
      <!-- <input type="text" class="input id2" value="65B02639" required /> -->
      <input type="text" class="input name" value="00000" max="5" required/>

      <div class="grid grid5 secondPrize" id="secondPrize"></div>
      <div class="grid grid5 thirdPrize" id="thirdPrize"></div>
      <div class="grid grid4 fourthPrize" id="fourthPrize"></div>
      <div class="grid grid4 sixthPrize" id="sixthPrize"></div>
      <div class="grid grid4 fifthPrize" id="fifthPrize"></div>
      <div class="grid grid10 seventhPrize" id="seventhPrize"></div>
      <div class="date-container" id="date-container"></div>
    </div>
  </div>
  <div class="container">
    <button class="reset-btn" onclick="resetForm()">Reset Form</button>
  </div>
    

<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>