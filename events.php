<?php
session_start();

include 'crud_operations.php'; // Include database connection file
$conn = connectDB(); // Connect to the database

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login_register.php");
    exit();
}

// Process logout
if(isset($_POST['logout'])){
    // Destroy the session
    session_destroy();
    header("Location: login_register.php");
    exit();
}


// Check the role of the user
$sql = "SELECT role FROM users WHERE id = '{$_SESSION['id']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $role = $row['role'];
    

    if ($role !== 'User') {
        header("Location: login_register.php");
        exit();
    }
} else {
  
    header("Location: login_register.php");
    exit();
}


// Ambil informasi keanggotaan pengguna dari basis data
$isPremiumMember = false; // Atur default ke false jika informasi tidak tersedia

// Misalnya, jika Anda memiliki kolom 'Member' dalam tabel 'users' yang menunjukkan status keanggotaan
// Lakukan query untuk mendapatkan informasi keanggotaan pengguna
$user_id = $_SESSION['id']; // Ambil ID pengguna dari sesi
$query = "SELECT Member FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $membership_status = $row['Member'];
    // Tentukan apakah pengguna adalah member premium berdasarkan status keanggotaan
    if ($membership_status === "Premium") {
        $isPremiumMember = true;
    }
}

// Process logout
if(isset($_POST['logout'])){
    // Destroy the session
    session_destroy();
    header("Location: login_register.php");
    exit();}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="images/logo3.png" rel="icon">
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
                        <a class="nav-link text-white" style="font-size: 15px;" href="index2.php#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#Agenda_Acara">Favorit</a>
                    </li>
                </ul>
                <form class="d-flex" method="post" action="login_register.php">
                    <button class="btn btn-outline-danger btn-sm" type="submit" name="logout">Logout</button>
                </form>

            </div>
        </div>
    </nav>
        <!-- Formulir pencarian -->
        <form class="d-flex mt-3 mb-3" method="GET" action="">
        <input class="form-control me-2" type="search" placeholder="Cari acara..." aria-label="Search" name="keyword">
        <select class="form-select me-2" aria-label="Default select example" name="category">
            <option value="">Semua Kategori</option>
            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
        </select>
        <button class="btn btn-outline-primary" type="submit">Cari</button>
     </form>

    <section class="page-section bg-light mb-2" id="katalogproduk">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase mb-4">Katalog Acara</h2>
                <h3 class="section-subheading text-muted">Semua Acara</h3>
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
                    $kategori= $row['kategori'];
                    $static_map_url=$row['static_map_url'];
                    $status = $row['status'];
                    $tanggal = $row['tanggal'];
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
    $status = $row['status'];
    $tanggal = $row['tanggal'];
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
                                <p>Kategori: <?php echo $kategori; ?></p>
                                <p>Status: <?php echo $status; ?></p>
                                <p>Tanggal: <?php echo $tanggal; ?></p>
                                <p>Harga: <?php echo $harga; ?></p>

                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Close
                                    </button>
                                    <button class="btn btn-danger btn-xl text-uppercase ms-2" type="button">
                                        <i class="fas fa-heart"></i>
                                        Favorite
                                    </button>
                                    <button class="btn btn-success btn-xl text-uppercase ms-2" onclick="confirmPurchase(<?php echo $harga; ?>)" type="button">
                                        <i class="fas fa-shopping-cart"></i>
                                        Beli
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    function confirmPurchase(harga) {
        // Cek apakah pengguna adalah member premium
        var isPremiumMember = <?php echo $isPremiumMember ? 'true' : 'false'; ?>;
        
        // Hitung harga setelah diskon jika pengguna adalah member premium
        if (isPremiumMember) {
            harga *= 0.9; // Potongan harga 10%
        }
        
        if (confirm("Apakah Anda yakin ingin membeli tiket ini dengan harga IDR" + harga + "?")) {
            // Jika dikonfirmasi, tampilkan pesan berhasil
            alert("Tiket berhasil dibeli!");
        }
    }
</script>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>
