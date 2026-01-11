
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Super Gold Lottery</title>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>


  <div class="wrapper" id="capture">
    <div class="lottery-form" id="lottery-form">
      <img src="{{ asset('images/superlottery.png') }}" alt="lottery" class="background-image" />
      <input type="text" class="input date" value="{{ $data['date'] }}" readonly />
      <input type="text" class="input time" id="time" value="{{ $data['time'] }}" readonly />
      <input type="text" class="input id" value="{{ $data['id'] }}" required max="8"  readonly/>
      <!-- <input type="text" class="input id2" value="65B02639" required /> -->
      <input type="text" class="input name" value="{{ $data['name'] }}" max="5" readonly/>

      <div class="grid grid5 secondPrize">
        @foreach ($data['secondPrize'] as $item)
          <input type="text" class="text-input " maxlength="5" value="{{ $item }}" inputmode="numeric" pattern="\d+" readonly>
          
        @endforeach

      </div>
      <div class="grid grid5 thirdPrize" id="thirdPrize">
        @foreach ($data['thirdPrize'] as $item)
           <input type="text" class="text-input " maxlength="5" value="{{ $item }}" inputmode="numeric" pattern="\d+" readonly>
        @endforeach
      </div>
      <div class="grid grid4 fourthPrize" id="fourthPrize">
        @foreach ($data['fourthPrize'] as $item)
          <input type="text" class="text-input medium" value="{{ $item }}" maxlength="4" inputmode="numeric" pattern="\d+" readonly>
        @endforeach
      </div>
      <div class="grid grid4 sixthPrize" id="sixthPrize">
         @foreach ($data['sixthPrize'] as $item)
          <input type="text" class="text-input medium" value="{{ $item }}" maxlength="4" inputmode="numeric" pattern="\d+" readonly>
        @endforeach
      </div>
      <div class="grid grid4 fifthPrize" id="fifthPrize">
        @foreach ($data['fifthPrize'] as $item)
          <input type="text" class="text-input medium" value="{{ $item }}" maxlength="4" inputmode="numeric" pattern="\d+" readonly>
        @endforeach
      </div>
      <div class="grid grid10 seventhPrize" id="seventhPrize">
        @foreach ($data['seventhPrize'] as $item)
    
        <input type="text" class="text-input small" maxlength="4" value="{{ $item }}" inputmode="numeric" pattern="\d+" readonly>

        
        @endforeach

      </div>
      <div class="date-container" id="date-container">{{ $data['date'] }}</div>
    </div>
  </div>
 
<script>

// Utility: Show temporary loading message
const showLoadingMessage = () => {
  const loadingMessage = document.createElement('div');
  loadingMessage.textContent = 'Generating PDF...';
  Object.assign(loadingMessage.style, {
    position: 'fixed',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    backgroundColor: 'rgba(0, 0, 0, 0.85)',
    color: '#fff',
    padding: '20px 30px',
    borderRadius: '8px',
    fontSize: '1rem',
    zIndex: 10000,
  });
  loadingMessage.id = 'loadingMessage';
  document.body.appendChild(loadingMessage);

  setTimeout(() => {
    const msg = document.getElementById('loadingMessage');
    msg?.remove();
  }, 3000);
};  
  
async function downloadPDF() {
  
  const captureElement = document.getElementById('lottery-form');
  const options = {
    filename: 'lottery-result.pdf',
    html2canvas: { scale: 3 },
    jsPDF: { format: 'a4', orientation: 'portrait' }
  };

  try {
    showLoadingMessage();
    await html2pdf().from(captureElement).set(options).save();
  } catch (error) {
    console.error('Error generating PDF:', error);
  }
}

downloadPDF();
</script>
</body>
</html>