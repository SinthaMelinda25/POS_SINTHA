<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- isi title yang kita kirimkan dari views lain-->
    <title>@yield('title')</title>
    <!-- memanggil file css bootstrap -->
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body>

    <!-- 1. Letakkan komponen Navbar di sini jika ingin dipisahkan global -->
    @yield('navbar') 

    <div class="container mt-3">

        <!-- 2. Taruh pemberitahuan sukses di sini (Sekarang posisinya di bawah navbar) -->
        @if (session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- 3. Isi konten halaman utama seperti tabel dan tombol -->
        @yield('content')

    </div>

</body>

</html>
