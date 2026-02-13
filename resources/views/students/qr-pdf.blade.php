<!DOCTYPE html>
<html>
<head>
    <title>QR Kelas {{ $class->name }}</title>
    <style>
        body { font-family: sans-serif; }
        .qr-box {
            width: 45%;
            display: inline-block;
            text-align: center;
            margin-bottom: 30px;
        }
        /* Tambahkan ini biar SVG-nya gak meluber */
        .qr-image svg {
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Daftar QR Absensi: {{ $class->name }}</h2>
<hr>

@foreach($students as $student)
    <div class="qr-box">
        <p><strong>{{ $student->nama }}</strong></p>
        <p>No Absen: {{ $student->no_absen }}</p>
        
        <div class="qr-image">
            {{-- Kita generate langsung jadi SVG String --}}
            <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(150)->generate($student->qr_code)) }}">
        </div>
    </div>
@endforeach

</body>
</html>