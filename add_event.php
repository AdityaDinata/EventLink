<?php
require_once "crud_operations.php";

// Logika untuk menambah event
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tambahkan logika untuk memproses data yang dikirim melalui form
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Gaya tambahan */
        .btn-primary {
            background-color: #ffd700; /* Warna tombol utama yang lebih cerah */
            border-color: #ffd700; /* Warna border tombol */
            color: #333;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #ffdf4f; /* Warna tombol utama saat hover */
            border-color: #ffdf4f; /* Warna border tombol saat hover */
            color: #333;
        }
        .btn-secondary {
            background-color: #333; /* Warna tombol sekunder yang lebih gelap */
            border-color: #333; /* Warna border tombol */
            color: #fff;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #444; /* Warna tombol sekunder saat hover */
            border-color: #444; /* Warna border tombol saat hover */
            color: #fff;
        }
        .portfolio-item {
            border: 1px solid #ddd; /* Border untuk setiap item portofolio */
            border-radius: 10px; /* Rounding border */
            overflow: hidden; /* Mengatasi overflow gambar */
            transition: transform 0.3s ease-in-out; /* Efek transisi saat hover */
        }
        .portfolio-item:hover {
            transform: scale(1.05); /* Efek scaling saat hover */
        }
        .portfolio-link {
            position: relative;
            display: block;
        }
        .portfolio-link .portfolio-hover {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .portfolio-link:hover .portfolio-hover {
            opacity: 1;
        }
        .portfolio-hover-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .portfolio-hover-content i {
            color: #fff;
            font-size: 36px;
            transition: all 0.3s ease;
        }
        .portfolio-link:hover .portfolio-hover-content i {
            font-size: 48px;
        }
        .portfolio-caption {
            padding: 20px;
            text-align: center;
        }
        .portfolio-caption-heading {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .edit-form input[type="text"],
        .edit-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .edit-form input[type="text"]:focus,
        .edit-form textarea:focus {
            outline: none;
            border-color: #ffd700;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-dark bg-gradient">
        <div class="container-fluid">
            <!-- Bagian kiri navbar -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="#"><img src="images/logo3.png" alt="EventLink Logo"></a>
                <a class="navbar-brand" href="#">
                    <span class="text-white" style="font-size: 20px;">Event</span><span class="text-danger" style="font-size: 15px;">Link</span>
                </a>
            </div>
    
            <!-- Tombol Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Bagian kanan navbar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-3 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#Home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#Agenda_Acara">Kategori Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#Tentang_Kami">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#Tentang_Kami">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#Tentang_Kami">Paket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#Kontak">Kontak</a>
                    </li>
                </ul>
                <form class="d-flex" method="post" action="login_register.php">
                    <button class="btn btn-outline-danger btn-sm" type="submit" name="logout">Logout</button>
                </form>

            </div>
        </div>
    </nav>


<!-- Konten halaman -->
<section class="page-section bg-light mb-2" id="alatbangunan">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mb-4">Katalog Events</h2>
            <h3 class="section-subheading text-muted">Semua Events</h3>
        </div>
        <div class="row">
            <?php
            $data = getAllData();
            foreach ($data as $row) {
                $id = $row['id'];
                $nama = $row['nama'];
                $deskripsi = $row['deskripsi'];
                $harga = $row['harga'];
                $gambar = $row['gambar'];
                $kategori = $row['kategori'];
                $static_map_url = $row['static_map_url'];
            ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal<?php echo $id; ?>">
                            <img class="img-fluid" src="data:image/jpeg;base64,<?php echo base64_encode($gambar); ?>" alt="..." />
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading"><?php echo $nama; ?></div>
                            <!-- Button group for deleting and editing -->
                            <div class="btn-group">
                                <form action="hapus.php" method="post">
                                    <input type="hidden" name="event_id" value="<?php echo $id; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <button class="btn btn-success btn-sm edit-btn" data-eventid="<?php echo $id; ?>">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hidden edit form -->
                <div class="col-lg-4 col-sm-6 mb-4 edit-form" id="editForm_<?php echo $id; ?>" style="display:none;">
                    <form action="edit.php" method="post">
                        <input type="hidden" name="event_id" value="<?php echo $id; ?>">
                        <input type="text" name="nama" placeholder="Nama Event" value="<?php echo $nama; ?>"><br>
                        <input type="text" name="harga" placeholder="Harga" value="<?php echo $harga; ?>"><br>
                        <textarea name="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea><br>
                        <input type="text" name="kategori" placeholder="Kategori" value="<?php echo $kategori; ?>"><br>
                        <input type="text" name="static_map_url" placeholder="Static Map URL" value="<?php echo $static_map_url; ?>"><br>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <!-- Button to close the edit form -->
                        <button type="button" class="btn btn-secondary btn-sm close-btn" data-eventid="<?php echo $id; ?>">Tutup</button>
                    </form>
                </div>
            <?php } ?>
        </div>
        <!-- Tombol Tambah -->
        <div class="text-center mt-4">
            <button class="btn btn-primary add-event-button" id="addEventButton">
                <i class="fas fa-plus"></i> Tambah Event
            </button>
        </div>
    </div>
</section>

<!-- Form Tambah Event -->
<!-- Form Tambah Event -->
<div class="container add-event-form" id="addEventForm" style="display:none;">
    <form action="tambah.php" method="post" enctype="multipart/form-data">
        <!-- Input untuk data event baru -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Event</label>
            <input type="text" class="form-control" id="nama" name="nama">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-control" id="kategori" name="kategori">
                <option value="Leisure Event">Leisure Event</option>
                <option value="Music Festival">Music Festival</option>
                <option value="Cultural Event">Cultural Event</option>
                <option value="Automotive Festival">Automotive Festival</option>
                <option value="Bazaar">Bazaar</option>
                <option value="Organizational Event">Organizational Event</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="static_map_url" class="form-label">Static Map URL</label>
            <input type="text" class="form-control" id="static_map_url" name="static_map_url">
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>
        <!-- Tombol untuk menyimpan data -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" id="closeAddForm">Tutup</button>
    </form>
</div>



<!-- Skrip JavaScript -->
<script>
    $(document).ready(function(){
        // Tampilkan form tambah event ketika tombol Tambah diklik
        $("#addEventButton").click(function(){
            $("#addEventForm").toggle();
        });

        // Ketika tombol Tutup pada form tambah diklik, sembunyikan form tambah
        $("#closeAddForm").click(function(){
            $("#addEventForm").hide();
        });

        // Ketika tombol Edit diklik, tampilkan form edit yang sesuai
        $(".edit-btn").click(function(){
            var eventId = $(this).data("eventid");
            $("#editForm_" + eventId).toggle();
        });

        // Ketika tombol Tutup pada form edit diklik, sembunyikan form edit
        $(".close-btn").click(function(){
            var eventId = $(this).data("eventid");
            $("#editForm_" + eventId).hide();
        });
    });
</script>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>
