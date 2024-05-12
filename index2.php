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

// Process logout
if(isset($_POST['logout'])){
    // Destroy the session
    session_destroy();
    header("Location: login_register.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="images/logo3.png" rel="icon">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <link rel="stylesheet" href="styles.css" />

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
                        <a class="nav-link text-white" style="font-size: 15px;" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#service">Kategori Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#price">Paket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" style="font-size: 15px;" href="add_event.php">Tambah Event</a>
                    </li>
                </ul>
                <form class="d-flex" method="post" action="login_register.php">
                    <button class="btn btn-outline-danger btn-sm" type="submit" name="logout">Logout</button>
                </form>

            </div>
        </div>
    </nav>
    
    
    
    <!-- home section starts  -->
    <section class="home" id="home">
        <div class="content">
          <h3>
            Selamat Datang Di 
            <span> EventLink Samarinda </span>
          </h3>
          <a href="events.php" class="btn">Lihat Event</a>
        </div>
      </section>
  
      <!-- service section starts  -->
      <section class="service" id="service">
        <h1 class="heading">Kategori <span>Event</span></h1>
  
        <div class="box-container">
          <div class="box">
            <i class="fas fa-umbrella-beach"></i>
            <h3>Leisure Event</h3>
            <p>
              Leisure Event adalah kategori yang menawarkan beragam acara rekreasi yang dirancang untuk menghibur dan memanjakan pengunjung dari segala usia
            </p>
            
            <br>
            <a href="events.php" class="white-text">Lihat Event</a>
          </div>
  
          <div class="box">
            <i class="fas fa-music"></i>
            <h3>Music Festival</h3>
            <p>
              Music Festival adalah kategori yang menyajikan berbagai festival musik yang memukau dari berbagai genre, mulai dari rock, pop, hip-hop, hingga musik elektronik. 
            </p>
            <br>
            <a href="events.php" class="white-text">Lihat Event</a>
          </div>
  
          <div class="box">
            <i class="fa-solid fa-earth-asia"></i>
            <h3>Cultural Event</h3>
            <p>
              Cultural Event adalah kategori yang mempersembahkan beragam acara budaya yang memikat dan menginspirasi.
            </p>
            <br>
            
            <a href="events.php" class="white-text">Lihat Event</a>
          </div>
  
          <div class="box">
            <i class="fas fa-wrench"></i>
            <h3>Automotive Festival</h3>
            <p>
              Automotive Festival adalah kategori yang menghadirkan pameran otomotif yang mengagumkan dan memukau.
            </p>
            <br>
            <a href="events.php" class="white-text">Lihat Event</a>
          </div>
  
          <div class="box">
            <i class="fas fa-store"></i>
            <h3>Bazaar</h3>
            <p>
              Bazaar adalah kategori yang menawarkan pameran belanja yang seru dan memikat bagi para pengunjung.
            </p>
            <br>
            <a href="events.php" class="white-text">Lihat Event</a>
          </div>
  
          <div class="box">
            <i class="fas fa-sitemap"></i>
            <h3>Organizational Event</h3>
            <p>
              Organizational Event adalah kategori yang menawarkan berbagai kegiatan seperti konferensi, seminar, dan pelatihan.
            </p>
            <br>
            <a href="events.php" class="white-text"></a>
          </div>
        </div>
      </section>
  
      <!-- about section starts  -->
      <section class="about" id="about">
        <h1 class="heading"><span>Tentang </span>Kami</h1>
  
        <div class="row">
          <div class="image">
            <img src="images/E.png" alt="" style="border: transparent;" />
          </div>
          
  
          <div class="content">
            <p>
              EventLink adalah sebuah platform yang bertujuan untuk memudahkan penduduk Samarinda terhubung dengan berbagai acara dan kegiatan yang terjadi di kota tersebut. Dengan menyediakan agenda acara yang komprehensif dan fitur notifikasi acara, EventLink memastikan bahwa pengguna tidak ketinggalan informasi tentang kegiatan menarik di sekitar mereka. Dengan berbagai opsi acara yang disajikan sesuai dengan minat dan preferensi pengguna, EventLink memberikan kemudahan dalam menjelajahi dan mengikuti kegiatan yang sesuai dengan keinginan mereka. EventLink membangun komunitas yang aktif dan bersemangat dalam mendukung dan mengikuti berbagai acara yang menghidupkan Samarinda.         
            </p>
            <p>
              Bergabunglah dengan kami dan jadilah bagian dari komunitas yang aktif dan bersemangat dalam mengikuti dan mendukung berbagai acara dan kegiatan yang menghidupkan Samarinda!
            </p>
            <a href="#" class="btn">Daftar</a>
          </div>
        </div>
      </section>
  
      <!-- gallery section starts  -->
      <section class="gallery" id="gallery">
        <h1 class="heading">Gallery <span>Kami</span></h1>
  
        <div class="box-container">
          <div class="box">
            <img src="images/duaevent.jpg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
  
          <div class="box">
            <img src="images/tigaevent.jpg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
  
          <div class="box">
            <img src="images/satuevent.jpg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
  
          <div class="box">
            <img src="images/event1.jpg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
  
          <div class="box">
            <img src="images/event2.jpeg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
  
          <div class="box">
            <img src="images/event26.jpg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
  
          <div class="box">
            <img src="images/event27.jpg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
  
          <div class="box">
            <img src="images/Festival1.jpeg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
  
          <div class="box">
            <img src="images/empatevent.jpg" alt="" />
            <h3 class="title">best events</h3>
            <div class="icons">
  
            </div>
          </div>
        </div>
      </section>
  
      <!-- price section starts  -->
      <section class="price" id="price">
        <h1 class="heading">Paket <span>Member</span></h1>
  
        <div class="box-container">
          <!-- Basic Membership -->
          <div class="box">
              <h3 class="title">Basic</h3>
              <h3 class="amount"> Free </h3>
              <ul>
                  <li><i class="fas fa-check"></i> Akses ke Semua Agenda Acara</li>
                  <li><i class="fas fa-check"></i> Detail Acara</li>
              </ul>
              <a href="purchase.php?member=Basic" class="btn">Beli</a>
          </div>

          <!-- Premium Membership -->
          <div class="box">
              <h3 class="title">Premium</h3>
              <h3 class="amount">50.000</h3>
              <ul>
                  <li><i class="fas fa-check"></i> Semua Fitur Paket Basic</li>
                  <li><i class="fas fa-check"></i> Tambah event</li>
                  <li><i class="fas fa-check"></i> Diskon Tiket 10%</li>
                  
              </ul>
              <a href="purchase.php?member=Premium" class="btn">Beli</a>
          </div>

        </div>
      </section>
  
      <!-- contact section starts  -->
      <section class="contact" id="contact">
        <h1 class="heading"><span>Kontak</span> Kami</h1>
  
        <form action="">
          <div class="inputBox">
            <input type="text" placeholder="name" />
            <input type="email" placeholder="email" />
          </div>
          <div class="inputBox">
            <input type="tel" placeholder="number" />
            <input type="text" placeholder="subject" />
          </div>
          <textarea
            name=""
            placeholder="message"
            id=""
            cols="30"
            rows="10"
          ></textarea>
          <input type="submit" value="send message" class="btn" />
        </form>
      </section>
  
      <!-- footer section starts  -->
      <section class="footer">
        <div class="box-container">
  
          <div class="box">
            <h3>quick links</h3>
            <a href="#home"> <i class="fas fa-arrow-right"></i> Home </a>
            <a href="#service"> <i class="fas fa-arrow-right"></i> Event </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Tentang </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Gallery </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Paket </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Kotak </a>
          </div>
  
          <div class="box">
            <h3>contact info</h3>
            <a href="#"> <i class="fas fa-phone"></i> 082252661012 </a>
            <a href="#"> <i class="fas fa-envelope"></i>adityadinata40@gmail.com</a>
            <a href="#">
              <i class="fas fa-map-marker-alt"></i>Samarinda Utara, indonesia - 75243
            </a>
          </div>
  
          <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin-in"></i> linkedin </a>
          </div>
        </div>
  
        <div class="credit">
          created by <span>EventLink</span> | all rights reserved
        </div>
      </section>

      <script>
    function logout() {
        // Lakukan aksi logout di sini, seperti mengirimkan request ke server
        // Setelah logout berhasil, arahkan pengguna ke halaman login_register.php
        window.location.href = 'login_register.php';
      }
    </script>
      <!--JS file-->
  
      <!-- Swiper JS -->
      
    <!-- Bootstrap JS -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
    function confirmPurchase(member) {
        if (confirm("Apakah Anda yakin ingin membeli member " + member + "?")) {
            // Jika dikonfirmasi, lakukan pembaruan di database
            // Buat permintaan AJAX atau langsung lakukan pembaruan
            // Misalnya, jika menggunakan AJAX:
            $.ajax({
                url: 'purchase.php',
                type: 'POST',
                data: { member: member },
                success: function(response) {
                    // Tampilkan pesan sukses atau lakukan tindakan lain
                    alert("Member " + member + " berhasil dibeli!");
                    // Kemungkinan pembaruan tampilan atau halaman
                    location.reload(); // Muat ulang halaman jika diperlukan
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan jika ada
                    console.error(error);
                    alert("Terjadi kesalahan saat membeli member " + member);
                }
            });
        }
    }
</script>
      <script src="app.js"></script>
    </body>
</html>
