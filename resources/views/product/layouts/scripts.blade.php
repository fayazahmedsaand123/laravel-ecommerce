<script src="{{ asset('AjaxJS/livesupportlibrary.js') }}"></script>
<script>
    $(document).ready(function() {
        // ================ ADD PRODUCT ===================== //
        $('#addProductForm').on('submit',function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url:"{{ route('products_store') }}",
                type:'post',
                data:formData,
                processData:false,
                contentType:false,
                dataType:'json',
                success:function(response) {
                    if(response.status === 'success') {
                        alert(response.message); // success
                        window.location.href = response.redirect_to;
                    }
                    else {
                        alert(response.message); // Name already exists
                    }
                },
                error: function(xhr) {
                    $('.error').text('');
                    if (xhr.status === 422) {
                        var response = xhr.responseJSON;
                        if (!response) {
                            response = JSON.parse(xhr.responseText);
                        }
                        var errors = response.errors;
                        $.each(errors, function(field, messages) {
                            $('.error-' + field).text(messages[0]);
                        });
                    }
                }
            });
        });
        // ================= UPDATE PRODUCT ================= //
        $('#UpdateProductForm').on('submit',function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var update_product = $(this).attr('action');     
            $.ajax({
                url:update_product,
                type:'post',
                data:formData,
                processData:false,
                contentType:false,
                dataType:'json',
                success:function(response) {
                    if(response.status === 'success') {
                        alert(response.message); // success
                        window.location.href = response.redirect_to;
                    }
                },
                error: function(xhr) {
                    $('.error').text('');
                    if (xhr.status === 422) {
                        var response = xhr.responseJSON;
                        if (!response) {
                            response = JSON.parse(xhr.responseText);
                        }
                        var errors = response.errors;
                        $.each(errors, function(field, messages) {
                            $('.error-' + field).text(messages[0]);
                        });
                    }
                }
            });
        });
        // ================= DELETE PRODUCT ================= //
        $('.deleteBtn').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm("Are you sure you want to delete this product?")) {
                $.ajax({
                    url: '/delete_product/' + id,
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
                    type: "POST",
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
    // ================= SweetAlert2 ======================== //
    document.addEventListener("DOMContentLoaded", function () {
        // ================= PROFILE IMAGE VIEW ================= //
        document.querySelectorAll(".showProfile").forEach(profile => {
            profile.addEventListener("click", function() {
                var name = this.dataset.name;
                var email = this.dataset.email;
                var image = this.dataset.image;
                Swal.fire({
                    title: name,
                    html: `
                        <img src="${image}" 
                            style="width:190px;height:200px;border-radius:50%;margin-top:10px;">
                            <p style="margin-top:15px;font-size:18px;">
                                <i class="fa fa-envelope"></i> <b>${email}</b>
                            </p>`,
                    confirmButtonText: "Close"
                });
            });
        });
    }); // End DOMContentLoaded
    
    // ================= IMAGE PREVIEW ================= //
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result; 
                imagePreview.style.display = "block";
            };
            reader.readAsDataURL(file);
        } 
        else {
            imagePreview.src = "{{ asset('Register_Image/default.png') }}";
            imagePreview.style.display = "block";
        }
    }
</script>
