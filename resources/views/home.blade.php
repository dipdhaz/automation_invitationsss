<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">



    <style>
        body {
            background-image: url('{{ asset('images/bg.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 89vh;
        }

        .container {
            text-align: center;
            color: white;
            font-size: 33px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo {
            max-width: 150px;
            /* Responsive logo size */
        }

        .search-bar-container {
            position: relative;
        }

        .search-form {
            display: flex;
            align-items: center;
            position: relative;
        }

        .search-bar {
            width: 650px;
            height: 35px;
            padding: 10px 40px 10px 40px;
            /* Increased padding on the left to accommodate the button */
            border: none;
            border-radius: 10px;
            font-size: 16px;
            background-size: 20px;
            background-position: 5% 50%;
            background-repeat: no-repeat;
            text-align: center;
            color: #999;
        }

        .search-button {
            width: 40px;
            height: 40px;
            background: none;
            border: none;
            cursor: pointer;
            position: absolute;
            left: 10px;
            /* Adjust as needed */
        }

        @media screen and (max-width: 600px) {
            .search-bar {
                width: 70%;
                /* Adjusted for smaller screens */
            }

            .search-button {
                left: 1vw;
                /* Adjusted for smaller screens */
            }
        }

        .search-button img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Your existing content goes here -->
        <img src="{{ asset('images/1.png') }}" class="logo" alt="Logo">
        <p>Dapatkan undangan pemilihan umum dengan menginput nomor paspor/NIK</p>

        <div class="search-bar-container">
            <form action="{{ route('user.search') }}" method="GET" class="search-form">
                <input type="text" class="search-bar" placeholder="Enter NIK or Passport Number" name="query"
                    required>
                <button type="submit" class="search-button">
                    <img src="{{ asset('images/cari.jpg') }}" alt="Search">
                </button>
            </form>
        </div>
    </div>
   <!-- Your other HTML content -->

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Check for the flashed session variable and display SweetAlert -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif
    });
</script>




</body>

</html>
