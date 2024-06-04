document.addEventListener('DOMContentLoaded', function () {
    const jobroleSelect = document.getElementById('jobrole');
    const checkboxLabel = document.getElementById('checkboxLabel');
    const checkboxDiv = document.getElementById('checkboxDiv');

    checkboxLabel.style.display = 'none';

    // Add change event listener to the select input
    jobroleSelect.addEventListener('change', function () {
        const selectedJobrole = jobroleSelect.value;

        if (selectedJobrole === 'Kagawad') {
            checkboxLabel.style.display = 'block';
        } else {
            checkboxLabel.style.display = 'none';
        }

        // Get all checkboxes within the checkboxDiv
        const checkboxes = checkboxDiv.querySelectorAll('input[type="checkbox"]');

        // Toggle visibility of checkboxes based on the selected job role
        checkboxes.forEach(checkbox => {
            if (selectedJobrole === 'Kagawad') {
                checkbox.parentElement.classList.remove('hidden');
                checkboxDiv.classList.remove('hidden');
                checkbox.disabled = false;
            } else {
                checkbox.parentElement.classList.add('hidden');
                checkboxDiv.classList.add('hidden');
                checkbox.checked = false; // Uncheck if it was checked before
                checkbox.disabled = true;
            }
        });
    });
});

  





function updateTime() {
    const currentTimeElement = document.getElementById('currentTime');
    const currentDateElement = document.getElementById('currentDate');
    const now = new Date();
    const options = { timeZone: 'Asia/Manila', hour12: true, hour: 'numeric', minute: 'numeric', second: 'numeric' };
    const formattedTime = now.toLocaleString('en-US', options);
    
    // Function to convert numerical month to word
    function getMonthName(month) {
      const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
      ];
      return months[month];
    }

    // Get year, month, and day
    const year = now.getFullYear();
    const month = now.getMonth();
    const day = now.getDate();

    // Format date into words
    const formattedDate = `${getMonthName(month)}-${day}-${year}`;

    currentTimeElement.textContent = formattedTime;
    currentDateElement.textContent = formattedDate;
}

// Update the time initially
updateTime();

// Update the time every second
setInterval(updateTime, 1000);


// document.addEventListener('DOMContentLoaded', function() {
//     let startTime = null;
//     let timeInterval = null;
//     const timeTrackingElement = document.getElementById('timeTracking');
    

//     function updateTimeTracking() {
//         if (startTime) {
//             const currentTime = new Date();
//             const elapsedTime = new Date(currentTime - startTime);
//             const hours = String(elapsedTime.getUTCHours()).padStart(2, '0');
//             const minutes = String(elapsedTime.getUTCMinutes()).padStart(2, '0');
//             const seconds = String(elapsedTime.getUTCSeconds()).padStart(2, '0');
//             timeTrackingElement.textContent = `Time tracked: ${hours}:${minutes}:${seconds}`;
//         }
//     }

//     document.getElementById('timeInBtn').addEventListener('click', function(event) {
//         event.preventDefault();
//         startTime = new Date();
//         timeInterval = setInterval(updateTimeTracking, 1000);
//         
//     });

//     document.getElementById('timeOutBtn').addEventListener('click', function(event) {
//         event.preventDefault();
//         clearInterval(timeInterval);
//         startTime = null;
//         timeTrackingElement.textContent = 'Time tracked: 00:00:00';
//         document.getElementById('attendanceForm').submit();
//     });
// });




// document.addEventListener('DOMContentLoaded', function() {
//     const timeInBtn = document.getElementById('timeInBtn');
//     const timeOutBtn = document.getElementById('timeOutBtn');
//     const successMessage = document.getElementById('successMessage');

//     // Initially, only show Time In button
//     timeInBtn.style.display = 'block';
//     timeOutBtn.style.display = 'none';

//     timeInBtn.addEventListener('click', function(event) {
       
//         // Submit Time In form here if needed
//         document.getElementById('attendanceForm').submit(); // Submit the form

//         // Show Time Out button and hide Time In button
//         timeOutBtn.style.display = 'block';
//         timeInBtn.style.display = 'none';
//     });

//     timeOutBtn.addEventListener('click', function(event) {
        
//         // Submit Time Out form here if needed
//         document.getElementById('attendanceForm').submit(); // Submit the form

//         // Show Time In button and hide Time Out button
//         timeInBtn.style.display = 'block';
//         timeOutBtn.style.display = 'none';
//     });

//     // Automatically hide the success message after 5 seconds (5000 milliseconds)
//     if (successMessage) {
//         setTimeout(function() {
//             successMessage.style.display = 'none';
//         }, 5000); // Adjust the timeout value as needed (in milliseconds)
//     }
// });





// import DataTable from 'datatables.net-dt';
// import 'datatables.net-responsive-dt';
 
// let table = new DataTable('#myTable', {
//     responsive: true
// });

$(document).ready( function () {
    $('#example').DataTable();
} );
    // import DataTable from 'datatables.net-dt';
 
    // let table = new DataTable('#myTable');
