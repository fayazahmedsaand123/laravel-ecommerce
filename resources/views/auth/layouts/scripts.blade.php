<script>
    function togglePassword(inputId, icon) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } 
        else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    // ========== Second JS =========== //
    setTimeout(() => {
        alertBox = document.getElementById('success-alert');
        if(alertBox) {
            alertBox.style.display = "none";
        }
    }, 6000);
</script>