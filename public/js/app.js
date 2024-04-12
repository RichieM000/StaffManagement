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
