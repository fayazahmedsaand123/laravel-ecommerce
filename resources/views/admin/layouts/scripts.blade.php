<script src="{{ asset('AjaxJS/livesupportlibrary.js') }}"></script>
<script>
    $(document).ready(function() {
        // ================= DELETE PRODUCT ================= //
        $('.delete-customer').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm("Are you sure you want to delete this customer?")) {
                $.ajax({
                    url: '/delete_customer/' + id,
                    type: 'get',
                    success: function(res) {
                        if(res.status == "success") {
                            alert(res.message);
                            location.reload();
                        }
                        else {
                            alert(res.message);
                        }
                    },
                    error: function () {
                        alert("Something went wrong!");
                    }
                });
            }
        });
        // ================= LOGOUT AJAX ================= //
        $('#logoutBtn').click(function(e) {
            e.preventDefault();
            if(confirm("Are you sure you want to logout?")) {
                $.ajax({
                    url: "{{ route('logout') }}",
                    type: "post",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if(response.status === "success") {
                            window.location.href = response.redirect_to;
                        }
                    },
                    error: function() {
                        alert("Logout failed!");
                    }
                });
            }
        });
    });






    // ===================== SweetAlert2 ======================= //
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".showAdminProfile").forEach(profile => {
            profile.addEventListener("click", function() {

                var name = this.dataset.name;
                var email = this.dataset.email;
                var image = this.dataset.image;

                Swal.fire({
                    title: name,
                    html: `
                        <img src="${image}" 
                            style="width:230px;height:250px;border-radius:50%;margin-top:10px;">
                        
                        <p style="margin-top:15px;font-size:16px;">
                            <i class="fa-solid fa-envelope"></i> <b>${email}</b>
                        </p>
                    `,
                    confirmButtonText: "Close"
                });
            });
        });
    });

    document.querySelectorAll('.confirm-action').forEach(button => {
        button.addEventListener('click', function () {
            var form = this.closest("form");

            Swal.fire({
                title: 'Are you sure?',
                text: "This action can be changed later.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
