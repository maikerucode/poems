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

</script>
