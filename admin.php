<?php
session_start();

include 'crud_operations.php'; // Include database connection file
$conn = connectDB(); // Connect to the database

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login_register.php");
    exit();
}

// Check the role of the user
$sql = "SELECT Role FROM users WHERE id = '{$_SESSION['id']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $role = $row['Role'];
    
    // If role is not 'Admin', redirect to login page
    if ($role !== 'Admin') {
        header("Location: login_register.php");
        exit();
    }
} else {
    // If user not found, redirect to login page
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

function displayUserData($conn) {
    $sql = "SELECT * FROM users WHERE Role = 'User'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Data Pengguna</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='table-dark'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Nama</th><th>Umur</th><th>Gender</th><th>No. Telpon</th><th>Email</th><th>Member</th><th>Action</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['password']."</td>";
            echo "<td>".$row['Nama']."</td>";
            echo "<td>".$row['umur']."</td>";
            echo "<td>".$row['gender']."</td>";
            echo "<td>".$row['no_telpon']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row["Member"]."</td>";
            echo "<td><button class='btn btn-sm btn-primary edit-user' data-id='".$row['id']."' onclick='editUser(".$row['id'].")'>Edit</button> <button class='btn btn-sm btn-danger delete-user' data-id='".$row['id']."'>Hapus</button></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "Tidak ada data pengguna.";
    }
}

function displayAddUserForm() {
    echo "<div style='margin: 0 auto; max-width: 500px;'>"; // Maksimum lebar form 500px dan posisi tengah
    echo "<div style='border: 1px solid #ccc; padding: 20px; background-color: #f9f9f9;'>"; // Kotak dengan garis pinggir, padding, dan latar belakang abu-abu muda
    echo "<h2 style='text-align: center;'>Tambah Pengguna</h2>"; // Judul di tengah

    echo "<form method='post'>";
    echo "<label for='username'>Username:</label><br>";
    echo "<input type='text' id='username' name='username' class='form-control' style='width: 100%;'><br>"; // Lebar 100% agar menyesuaikan kotak
    echo "<label for='password'>Password:</label><br>";
    echo "<input type='password' id='password' name='password' class='form-control' style='width: 100%;'><br>"; // Lebar 100% agar menyesuaikan kotak
    echo "<label for='nama'>Nama:</label><br>";
    echo "<input type='text' id='nama' name='nama' class='form-control' style='width: 100%;'><br>"; // Lebar 100% agar menyesuaikan kotak
    echo "<label for='umur'>Umur:</label><br>";
    echo "<input type='text' id='umur' name='umur' class='form-control' style='width: 100%;'><br>"; // Lebar 100% agar menyesuaikan kotak
    echo "<label for='gender'>Gender:</label><br>";
    echo "<input type='radio' id='gender_laki' name='gender' value='Laki-laki'> Laki-laki";
    echo "<input type='radio' id='gender_perempuan' name='gender' value='Perempuan'> Perempuan<br>";
    echo "<label for='no_telpon'>No. Telpon:</label><br>";
    echo "<input type='text' id='no_telpon' name='no_telpon' class='form-control' style='width: 100%;'><br>"; // Lebar 100% agar menyesuaikan kotak
    echo "<label for='email'>Email:</label><br>";
    echo "<input type='text' id='email' name='email' class='form-control' style='width: 100%;'><br><br>"; // Lebar 100% agar menyesuaikan kotak
    echo "<label for='member'>Member:</label><br>"; // Label untuk member
    echo "<select id='member' name='member' class='form-control' style='width: 100%;'>"; // Dropdown untuk memilih member
    echo "<option value='Basic'>Basic</option>"; // Opsi untuk member Basic
    echo "<option value='Premium'>Premium</option>"; // Opsi untuk member Premium
    echo "<option value=''>Tidak Ada</option>"; // Opsi untuk member tidak ada
    echo "</select><br>"; // Tutup dropdown
    echo "<div style='display: flex; justify-content: space-between;'>"; // Gunakan flexbox untuk mengatur jarak antara tombol "Tambah" dan "Batal"
    echo "<input type='submit' name='add_user_submit' value='Tambah' class='btn btn-success'>"; // Tambahkan kelas 'btn' dan 'btn-success' untuk gaya Bootstrap
    echo "<button type='button' onclick='hideAddUserForm()' class='btn btn-secondary'>Batal</button>"; // Tambahkan kelas 'btn' dan 'btn-secondary' untuk gaya Bootstrap
    echo "</div>"; // Tutup flexbox
    echo "</form>";

    echo "</div>"; // Tutup kotak
    echo "</div>"; // Tutup div pusat
}

// Proses penambahan pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user_submit'])) {
    // Memperoleh nilai dari form
    $add_username = $_POST['username'];
    $add_password = $_POST['password'];
    $add_nama = $_POST['nama'];
    $add_umur = $_POST['umur'];
    $add_gender = $_POST['gender'];
    $add_no_telpon = $_POST['no_telpon'];
    $add_email = $_POST['email'];
    $add_member = $_POST['member']; // Ambil nilai keanggotaan dari formulir

    // Validasi input dan proses penambahan pengguna jika tidak ada kesalahan
    // ...
}

// Proses penyimpanan perubahan data pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_user_submit'])) {
    // Memperoleh nilai dari form
    $edit_user_id = $_POST['edit_user_id'];
    $edit_username = $_POST['edit_username'];
    $edit_nama = $_POST['edit_nama'];
    $edit_umur = $_POST['edit_umur'];
    $edit_gender = $_POST['edit_gender'];
    $edit_no_telpon = $_POST['edit_no_telpon'];
    $edit_email = $_POST['edit_email'];
    $edit_member = $_POST['edit_member']; // Ambil nilai keanggotaan dari formulir

    // Validasi input dan proses penyimpanan perubahan jika tidak ada kesalahan
    // ...
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="images/logo3.png" rel="icon">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    <style>
        /* Gaya khusus untuk tombol "Tambah" */
        #addUserForm {
            display: none; /* Form tambah pengguna default tersembunyi */
        }
    </style>

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
                        <a class="nav-link text-white" style="font-size: 15px;" href="admin.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#katalogproduk">Data Acara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#showAddUserForm">Data Pengguna</a>
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
                <h2 class="section-heading text-uppercase mb-4">Katalog Acara</h2>
                <h3 class="section-subheading text-muted">Semua Acara</h3>
            </div>
            <div class="row">
                <?php
                $data = getAllData2();
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
                                    <button class="btn btn-success btn-xl text-uppercase ms-2 approve-btn" onclick="approveEvent(<?php echo $id; ?>)" type="button">
                                        <i class="fas fa-check"></i>
                                        Setujui
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
<div class="container mt-5">

        <hr>
        <!-- Tombol untuk menampilkan form tambah pengguna -->
        <button id="showAddUserForm" class="btn btn-primary mb-3" onclick="displayAddUserForm()">Tambah Pengguna</button>
        <!-- Form tambah pengguna -->
        <div id="addUserForm">
            <?php displayAddUserForm(); ?>
        </div>
        <!-- Tabel data pengguna -->
        <?php displayUserData($conn); ?>
    </div>
<!-- User Edit Form (Hidden by default) -->
<div id="editUserForm" style="display: none;">
    <h4>Edit Pengguna</h4>
    <form method="post" id="editUserForm">
        <input type="hidden" id="editUserId" name="edit_user_id">
        <div class="mb-3">
            <label for="edit_username" class="form-label">Username:</label>
            <input type="text" id="edit_username" name="edit_username" class="form-control">
        </div>
        <div class="mb-3">
            <label for="edit_nama" class="form-label">Nama:</label>
            <input type="text" id="edit_nama" name="edit_nama" class="form-control">
        </div>
        <div class="mb-3">
            <label for="edit_umur" class="form-label">Umur:</label>
            <input type="number" id="edit_umur" name="edit_umur" class="form-control">
        </div>
        <div class="mb-3">
            <label for="edit_gender" class="form-label">Gender:</label>
            <select id="edit_gender" name="edit_gender" class="form-select">
                <option value="male">Laki-laki</option>
                <option value="female">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="edit_no_telpon" class="form-label">Nomor Telepon:</label>
            <input type="tel" id="edit_no_telpon" name="edit_no_telpon" class="form-control">
        </div>
        <div class="mb-3">
            <label for="edit_email" class="form-label">Email:</label>
            <input type="email" id="edit_email" name="edit_email" class="form-control">
        </div>
        <!-- Menambahkan field untuk Member -->
        <div class="mb-3">
            <label for="edit_member" class="form-label">Member:</label>
            <select id="edit_member" name="edit_member" class="form-select">
                <option value="basic">Basic</option>
                <option value="premium">Premium</option>
                <option value="">Tidak Ada</option> <!-- Menambahkan opsi "Tidak Ada" -->
            </select>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" name="edit_user_submit" class="btn btn-primary">Simpan Perubahan</button>
            <button type="button" class="btn btn-secondary cancel-edit">Batal</button>
        </div>
    </form>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Ketika tombol edit pengguna diklik
    $(".edit-user").click(function() {
        var userId = $(this).data("id");
        $.ajax({
            url: "fetch_user.php", // Ganti dengan alamat file yang sesuai
            type: "POST",
            data: { id: userId },
            success: function(response) {
                var userData = JSON.parse(response);
                $("#editUserId").val(userData.id);
                $("#edit_username").val(userData.username);
                $("#edit_nama").val(userData.nama);
                $("#edit_umur").val(userData.umur);
                $("#edit_gender").val(userData.gender);
                $("#edit_no_telpon").val(userData.no_telpon);
                $("#edit_email").val(userData.email);
                $("#edit_member").val(userData.member); // Memperbarui nilai field Member
                $("#editUserForm").show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Ketika tombol pembatalan edit diklik
    $(".cancel-edit").click(function() {
        $("#editUserForm").hide();
    });

    // Ketika tombol "Hapus Pengguna" diklik
    $(".delete-user").click(function() {
        if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) {
            var userId = $(this).data("id");
            $.ajax({
                url: "delete_user.php",
                type: "POST",
                data: { id: userId },
                success: function(response) {
                    // Tampilkan pesan sukses atau reload halaman jika diperlukan
                    alert("Pengguna berhasil dihapus.");
                    location.reload(); // Reload halaman untuk memperbarui data pengguna
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    // Function to display add user form
    function displayAddUserForm() {
        $("#addUserForm").toggle();
    }

    // Function to hide add user form
    function hideAddUserForm() {
        $("#addUserForm").hide();
    }
</script>
<script>
    function approveEvent(event_id) {
        // Buat elemen form secara dinamis
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'acc.php';

        // Buat input tersembunyi untuk menyimpan event_id
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'event_id';
        input.value = event_id;

        // Tambahkan input ke dalam form
        form.appendChild(input);

        // Tambahkan form ke dalam body dan kirimkan secara otomatis
        document.body.appendChild(form);
        form.submit();
    }
</script>


<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>
