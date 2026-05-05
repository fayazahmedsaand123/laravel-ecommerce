<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>No Connection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">
    <div class="card shadow text-center p-4" style="max-width: 420px;">
        <div class="mb-3">
            <i class="fa fa-wifi text-warning" style="font-size:60px;"></i>
        </div> 
        <h2 class="text-danger">No Internet Connection</h2>
        <p class="text-muted">
            Please check your WiFi or mobile data and try again.
        </p>
        {{-- Back to Home --}}
        <a href="{{ url()->previous() }}" class="btn btn-warning">
            Go Back
        </a>
    </div>
</body>
</html>
