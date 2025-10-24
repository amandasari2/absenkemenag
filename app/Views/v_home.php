<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kementerian Agama | Beranda</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="<?= base_url('admin') ?>/img/logodepag.png" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="<?= base_url('admin') ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url('admin') ?>/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="<?= base_url('admin') ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('admin') ?>/css/style.css" rel="stylesheet">

    <style>
        #kontent {
            width: 100%;
            min-height: 100vh;
            background: #FFFFFF;
            transition: 0.5s;
        }

        #kontent .navbar .navbar-nav .nav-link {
            margin-left: 25px;
            padding: 12px 0;
            color: var(--dark);
            outline: none;
        }

        #kontent .navbar .navbar-nav .nav-link:hover,
        #kontent .navbar .navbar-nav .nav-link.active {
            color: var(--primary);
        }

        #kontent .navbar .sidebar-toggler,
        #kontent .navbar .navbar-nav .nav-link i {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #FFFFFF;
            border-radius: 40px;
        }

        #kontent .navbar .dropdown-toggle::after {
            margin-left: 6px;
            vertical-align: middle;
            border: none;
            content: "\f107";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            transition: .5s;
        }

        #kontent .navbar .dropdown-toggle[aria-expanded=true]::after {
            transform: rotate(-180deg);
        }

        @media (max-width: 575.98px) {
            #kontent .navbar .navbar-nav .nav-link {
                margin-left: 15px;
            }
        }

        .card {
            border: none;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
            padding: 25px;
            border-radius: 15px;
        }

        #reader {
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
        }

        #result {
            font-weight: 600;
            font-size: 18px;
            color: #198754;
        }
    </style>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Content Start -->
        <div id="kontent">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="d-none d-md-flex ms-4">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Kementerian Agama Kabupaten Asahan</h3>
                </a>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item">
                        <a href="<?= base_url('login') ?>" class="nav-link">
                            <i class="fa fa-sign-in-alt me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Login</span>
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Scan QR Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center">
                        <h2 class="mb-4"><i class="fas fa-qrcode text-primary me-2"></i>Scan QR untuk Absen</h2>
                        <div class="card text-center">
                            <div class="card-body">
                                <div id="reader" style="width: 300px;"></div>
                                <div id="result" class="mt-3"></div>
                            </div>
                        </div>

                        <script src="https://unpkg.com/html5-qrcode@2.3.8"></script>
                        <script>
                            function onScanSuccess(decodedText, decodedResult) {
                                console.log("Hasil scan QR:", decodedText);
                                document.getElementById('result').innerHTML = "Memproses NIP: " + decodedText + "...";

                                fetch("/absen/simpan", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json"
                                        },
                                        body: JSON.stringify({
                                            nip: decodedText
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        document.getElementById('result').innerHTML = `<div class="alert alert-success mt-2">✅ ${data.message}</div>`;
                                    })
                                    .catch(error => {
                                        document.getElementById('result').innerHTML = `<div class="alert alert-danger mt-2">❌ Gagal mengirim data</div>`;
                                    });

                                html5QrcodeScanner.clear();
                            }

                            const html5QrcodeScanner = new Html5QrcodeScanner("reader", {
                                fps: 10,
                                qrbox: 250
                            });

                            html5QrcodeScanner.render(onScanSuccess);
                        </script>
                    </div>
                </div>
            </div>
            <!-- Scan QR End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 text-center">
                            &copy; <?= date('Y') ?> <a href="https://www.instagram.com/kankemenagkabasahan/">Kementerian Agama Kabupaten Asahan</a>, All Right Reserved.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('admin') ?>/lib/chart/chart.min.js"></script>
    <script src="<?= base_url('admin') ?>/lib/easing/easing.min.js"></script>
    <script src="<?= base_url('admin') ?>/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('admin') ?>/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url('admin') ?>/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?= base_url('admin') ?>/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?= base_url('admin') ?>/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?= base_url('admin') ?>/js/main.js"></script>
</body>

</html>
