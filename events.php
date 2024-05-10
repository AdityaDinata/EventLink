<?php
include 'crud_operations.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    <style>
            .portfolio-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .portfolio-item:hover {
            transform: translateY(-5px);
        }

        .portfolio-link {
            display: block;
            position: relative;
        }

        .portfolio-caption {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }

        .portfolio-caption-heading {
            font-size: 24px;
            color: #333;
        }

        .portfolio-caption-price {
            font-size: 18px;
            color: #888;
        }

        .portfolio-hover {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            background-color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s;
        }

        .portfolio-link:hover .portfolio-hover {
            opacity: 1;
        }

        .portfolio-hover-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: all 0.3s;
        }

        .portfolio-link:hover .portfolio-hover-content {
            opacity: 1;
        }

        .portfolio-link:hover .fa-plus {
            font-size: 3em;
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

    <section class="page-section bg-light mb-2" id="katalogproduk">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase mb-4">Katalog Produk</h2>
                <h3 class="section-subheading text-muted">Semua Produk</h3>
            </div>
            <div class="row">
                <?php
                $data = getAllData();
                foreach ($data as $row) {
                    $id = $row['id'];
                    $nama = $row['nama'];
                    $harga = $row['harga'];
                    $deskripsi = $row['deskripsi'];
                    $gambar = $row['gambar'];
                    $static_map_url=$row['static_map_url'];
                ?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal<?php echo $id; ?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="data:image/jpeg;base64,<?php echo base64_encode($gambar); ?>" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?php echo $nama; ?></div>
                                <div class="portfolio-caption-price"><?php echo 'IDR' . $harga; ?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php
foreach ($data as $row) {
    $id = $row['id'];
    $nama = $row['nama'];
    $harga = $row['harga'];
    $deskripsi = $row['deskripsi'];
    $gambar = $row['gambar'];
    $static_map_url = $row['static_map_url'];
?>
    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h2 class="text-uppercase"><?php echo $nama; ?></h2>
                                <img class="img-fluid d-block mx-auto" src="data:image/jpeg;base64,<?php echo base64_encode($gambar); ?>" alt="..." />
                                <p class="item-intro text-muted"><?php echo $deskripsi; ?></p>
                                <div class="mb-3">
                                    <label for="static_map_url" class="form-label">Lokasi :</label>
                                    <a href="<?php echo $static_map_url; ?>" target="_blank" rel="noopener noreferrer"><?php echo $static_map_url; ?></a>
                                </div>

                                <p>Harga: <?php echo $harga; ?></p>

                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Close
                                </button>

                                <button class="btn btn-success btn-xl text-uppercase ms-2" type="button">
                                    <i class="fas fa-shopping-cart"></i>
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

</body>


</html>
