<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dispensasi - MAN 2 Kota Bandung</title>
        <script src="https://unpkg.com/feather-icons"></script>
        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/trix.css" rel="stylesheet">
        <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $dispensasi->type->name }}</h5>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Nomor Induk :</strong> <span class="data">{{ $dispensasi->user->nomor_induk }}</span></p>
                <hr class="divider">
            <p class="card-text"><strong>Nama :</strong> <span class="data">{{ $dispensasi->user->name }}</span></p>
                <hr class="divider">
            <p class="card-text"><strong>Kelas :</strong> <span class="data">{{ $dispensasi->user->kelas->name }}</span></p>
                <hr class="divider">
            <p class="card-text"><strong>Alasan :</strong> <span class="data">{{ $dispensasi->alasan->name }}</span></p>
                <hr class="divider">
            @if ($dispensasi->type_id === 2)
                <p class="card-text"><strong>Waktu Keluar :</strong> <span class="data">{{ $dispensasi->waktu_keluar }}</span></p>
                    <hr class="divider">
                <p class="card-text"><strong>Batas Waktu Kembali :</strong> <span class="data">{{ $dispensasi->waktu_kembali }}</span></p>
                    <hr class="divider">
                <p class="card-text"><strong>Waktu Persetujuan :</strong> <span class="data">{{ $dispensasi->waktu_persetujuan }}</span></p>
                    <hr class="divider">
                <p class="card-text"><strong>Waktu Selesai :</strong> <span class="data">{{ $dispensasi->waktu_selesai }}</span></p>
                    <hr class="divider">
            @endif
            @if ($dispensasi->type_id === 1)
                <p class="card-text"><strong>Waktu Masuk :</strong> <span class="data">{{ $dispensasi->waktu_masuk }}</span></p>
                    <hr class="divider">
                <p class="card-text"><strong>Waktu Persetujuan :</strong> <span class="data">{{ $dispensasi->waktu_persetujuan }}</span></p>
                    <hr class="divider">
            @endif
            <p class="card-text"><strong>Deskripsi :</strong> <span class="data">{{ $dispensasi->deskripsi }}</span></p>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        feather.replace();
    </script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/script.js"></script>
    <script src="/js/trix.js"></script>
    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/chart-area-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.js"></script>

    <script src="/js/demo/datatables-demo.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>
</html>