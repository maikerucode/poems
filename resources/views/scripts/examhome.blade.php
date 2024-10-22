<script>
    const dropdownItems = document.querySelectorAll(".drop-option");

    dropdownItems.forEach(item => {
        item.addEventListener("click", function() {
            const selectedValue = this.getAttribute('value'); // Use getAttribute() to retrieve the value
            console.log("Selected Value:", selectedValue);

            document.getElementById("selectedTime").innerText = selectedValue;
            document.getElementById("selectedTimeLimit").value = selectedValue;

            // Close the dropdown
            const dropdown = document.getElementById("dropdown");
            dropdown.classList.add("hidden");
        });
    });

    document.querySelectorAll('tr').forEach(row => {
        row.addEventListener('click', event => {
            if (event.target.tagName === 'TD') {
                const checkbox = row.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
            }
        });
    });

</script>
