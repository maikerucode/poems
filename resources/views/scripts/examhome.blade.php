<script>
    const dropdownItems = document.querySelectorAll("#dropdown li a");
    
    dropdownItems.forEach(item => {
      item.addEventListener("click", function() {
        const selectedTime = this.dataset.timeLimit;
        document.getElementById("selectedTimeLimit").value = selectedTime;
      });
    });
</script>
