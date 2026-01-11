// See the Electron documentation for details on how to use preload scripts:
// https://www.electronjs.org/docs/latest/tutorial/process-model#preload-scripts
// Utility: Debounce
const debounce = (func, delay = 300) => {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => func(...args), delay);
  };
};

// Utility: Format time string to AM/PM format
const formatTime = (timeString) => {
  const [hours, minutes] = timeString.split(":");
  const hour = parseInt(hours, 10);
  const ampm = hour >= 12 ? "PM" : "AM";
  const formattedHour = hour % 12 || 12;
  return `${formattedHour.toString().padStart(2, '0')}:${minutes.padStart(2, '0')} ${ampm}`;
};

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

// Utility: Generate random numbers
function generateZeros(count, digits, sort = false) {
  const numbers = Array.from({ length: count }, () => '0'.repeat(digits));
  return sort ? numbers.sort() : numbers;
}

function populateInputs(containerId, numbers, medium = false, small = false) {
  const container = document.getElementById(containerId);
  container.innerHTML = '';

  const createInput = (value) => {
    const input = document.createElement('input');
    input.type = 'text';
    input.value = value;
    input.className = `text-input ${small ? 'small' : medium ? 'medium' : ''}`;
    input.maxLength = small || medium ? 4 : 5;
    input.inputMode = 'numeric';
    input.pattern = '\\d+';
    input.required = true;

    input.addEventListener('input', () => {
      input.value = input.value.replace(/\D/g, '').slice(0, input.maxLength);
    });

    input.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') sortInputs(container);
    });

    return input;
  };

  numbers.forEach(num => container.appendChild(createInput(num)));
}

function sortInputs(container) {
  const inputs = Array.from(container.querySelectorAll('input'));
  const values = inputs
    .map(input => input.value)
    .filter(Boolean)
    .sort();

  container.innerHTML = '';
  values.forEach(value => {
    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.value = value;
    newInput.className = inputs[0].className;
    newInput.maxLength = inputs[0].maxLength;
    newInput.required = true;
    newInput.inputMode = 'numeric';

    newInput.addEventListener('input', () => {
      newInput.value = newInput.value.replace(/\D/g, '').slice(0, newInput.maxLength);
    });

    newInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') sortInputs(container);
    });

    container.appendChild(newInput);
  });
}

function checkForDuplicates() {
  const inputs = document.querySelectorAll('.text-input');
  const valueMap = {};
  let hasDuplicates = false;

  inputs.forEach(input => {
    const value = input.value.trim();
    input.style.border = '';
    if (value) {
      if (valueMap[value]) {
        hasDuplicates = true;
        input.style.border = valueMap[value].style.border = '2px solid red';
      } else {
        valueMap[value] = input;
      }
    }
  });

  if (hasDuplicates) {
    alert('Duplicate numbers found! Please correct them before downloading.');
  }

  return !hasDuplicates;
}

function updateDate() {
  const today = new Date();
  const day = String(today.getDate()).padStart(2, '0');
  const month = String(today.getMonth() + 1).padStart(2, '0');
  const year = today.getFullYear();
  const formattedDate = `${day}/${month}/${year}`;

  const dateContainer = document.querySelector('.date-container');
  const dateInput = document.querySelector('.input.date');
  if (dateContainer) dateContainer.textContent = formattedDate;
  if (dateInput) dateInput.value = formattedDate;
}

async function downloadPDF() {
  if (!checkForDuplicates()) return;

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

async function saveFormToLocalStorage() {
  const data = {};
  ['id', 'date', 'time', 'name'].forEach(field => {
    const input = document.getElementById(field);
    if (input) data[field] = input.value;
  });
  ['secondPrize', 'thirdPrize', 'fourthPrize', 'sixthPrize', 'fifthPrize', 'seventhPrize'].forEach(prizeId => {
    const container = document.getElementById(prizeId);
    if (container) {
      const inputs = container.querySelectorAll('input');
      data[prizeId] = Array.from(inputs).map(input => input.value);
    }
  });
  localStorage.setItem('lotteryFormData', JSON.stringify(data));
}

async function resetForm() {
  // Reset simple input fields
  const defaultValues = {
    id: '00000',
    date: '',
    time: '',
    name: ''
  };

  Object.entries(defaultValues).forEach(([field, value]) => {
    const input = document.getElementById(field);
    if (input) input.value = value;
  });

  // Reset formatted time display
  const formattedTimeDisplay = document.getElementById("formattedTime");
  if (formattedTimeDisplay) formattedTimeDisplay.textContent = '';

  // Repopulate prize containers with zero values
  [
    { id: 'secondPrize', count: 10, digits: 5, medium: false, small: false },
    { id: 'thirdPrize', count: 10, digits: 5, medium: false, small: false },
    { id: 'fourthPrize', count: 10, digits: 4, medium: true, small: false },
    { id: 'fifthPrize', count: 10, digits: 4, medium: true, small: false },
    { id: 'sixthPrize', count: 10, digits: 4, medium: true, small: false },
    { id: 'seventhPrize', count: 100, digits: 4, medium: false, small: true }
  ].forEach(({ id, count, digits, medium, small }) => {
    const zeros = generateZeros(count, digits, true);
    populateInputs(id, zeros, medium, small);
  });

  localStorage.removeItem('lotteryFormData');
}


function initializeOrLoadLotteryForm() {
  const savedData = JSON.parse(localStorage.getItem('lotteryFormData') || '{}');

  updateDate();
  setInterval(updateDate, 60000);

  document.getElementById("time")?.addEventListener("input", debounce(() => {
    const timeInput = document.getElementById("time");
    const formattedTimeDisplay = document.getElementById("formattedTime");
    formattedTimeDisplay.textContent = timeInput?.value ? formatTime(timeInput.value) : "";
  }, 300));

  [
    { id: 'secondPrize', medium: false, small: false },
    { id: 'thirdPrize', medium: false, small: false },
    { id: 'fourthPrize', medium: true, small: false },
    { id: 'fifthPrize', medium: true, small: false },
    { id: 'sixthPrize', medium: true, small: false },
    { id: 'seventhPrize', medium: false, small: true }
  ].forEach(({ id, medium, small }) => {
    const values = Array.isArray(savedData[id])
      ? savedData[id]
      : generateZeros(id === 'seventhPrize' ? 100 : 10, small || medium ? 4 : 5, true);
    populateInputs(id, values, medium, small);
  });

  ['id', 'date', 'time', 'name'].forEach(key => {
    const input = document.getElementById(key);
    if (input && savedData[key]) {
      input.value = savedData[key];
      if (key === 'time') {
        const formattedTimeDisplay = document.getElementById("formattedTime");
        formattedTimeDisplay.textContent = formatTime(savedData[key]);
      }
    }
  });

}

window.addEventListener('DOMContentLoaded', () => {
  initializeOrLoadLotteryForm();
  
});
