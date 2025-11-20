<!-- index.html - Adventure Call EST -->
<?php
require_once 'includes/db.php';  // or the correct path to your DB connection file

// Now $conn should be available as your mysqli connection object
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adventure Call EST</title>
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
  <script defer src="assets/js/script.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-/1Y6bTAYUqU4xkYvbXqG2XYcALc6LF5b7GwZLmXo2Za/tnwPzq1vUoXZ3l4xj5p2LgZ5p7pt3vMfHt1lsbJ1Fw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">


</head>
 
<body>

<!-- Navigation Bar -->


<nav class="nav-bar">
  <div class="hamburger" id="hamburger">&#9776;</div>
  
  <ul id="nav-menu">
    <li><a href="#about">About</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#social-links">Follow Us</a></li>
    <li><a href="monitor-apply.php">Apply Here</a></li>
  </ul>

  <a href="admin/login.php" class="admin-link">Admin</a>
</nav>






  <!-- Hero Section -->
  <header class="hero">
    <div class="hero-overlay">
      <h1>Adventure Call EST</h1>
      <p>Where Adventure Begins</p>
      <a href="register.php" class="btn">Register Now</a>
    </div>
  </header>

<!-- Video Gallery Section -->


<section id="videos">
  <h2>Watch the Adventures</h2>
  <div class="video-gallery">
    <?php
      // Example assuming $conn is your MySQL connection
      $result = $conn->query("SELECT id, filename FROM media ORDER BY id DESC");
      while ($row = $result->fetch_assoc()) {
        $file = htmlspecialchars($row['filename']);
        $id = (int)$row['id'];
        echo "<div class='video-item'>";
        echo "<video controls>";
        echo "<source src='assets/videos/$file' type='video/mp4'>";
        echo "Your browser does not support the video tag.";
        echo "</video>";
        echo "</div>";
      }
    ?>
  </div>
</section>



  <!-- About Section -->
  <section id="about">
    <h2>About Our Colony</h2>

    <?php
        require_once 'includes/db.php';
        $result = $conn->query("SELECT content FROM about_section WHERE id = 1");
        $about = $result->fetch_assoc()['content'];
        echo nl2br(htmlspecialchars($about));
        ?>


    <div class="activities" id="activities">
      <!-- Dynamic activities loaded from PHP/MySQL -->
    </div>
    <div class="location">
        <h3>Our Location</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2350.469086547654!2d35.492720373969085!3d33.88397052659979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f1723517b5e8f%3A0xf93e4cb98c751632!2sBeirut%20Baptist%20School!5e1!3m2!1sen!2slb!4v1751227026868!5m2!1sen!2slb" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  <p>
    <a href="https://maps.app.goo.gl/njGaLvDxie3FFBB68" target="_blank" class="btn">
      📍 Open in Google Maps
    </a>
  </p>
</div>

  </section>



<!-- Offers / Trips Section -->
<section id="offers" style="text-align:center; margin-top:40px;">
  <h2>New Trips & Offers</h2>
  <div class="offers-gallery" style="display:flex; flex-direction:column; align-items:center; gap:20px;">
    <?php
      $offers = $conn->query("SELECT * FROM trip_offers ORDER BY uploaded_at DESC");
      if ($offers->num_rows > 0) {
        while ($offer = $offers->fetch_assoc()) {
          $img = htmlspecialchars($offer['image_path']);
          echo "<div style='width:50% ; max-width:1000px; overflow:hidden; border-radius:15px; box-shadow:0 4px 10px rgba(0,0,0,0.2);'>";
          echo "<img src='$img' alt='Trip Offer' style='width:100%; height:auto; display:block; object-fit:cover;'>";
          echo "</div>";
        } 
      } else {
        echo "<p style='color:gray;'>No current trips or offers.</p>";
      } 
    ?>
  </div>
</section>





<!-- Image Gallery Section -->
<section id="gallery">
  <h2>Moments from the Colony</h2>
  <div class="gallery">
  <?php
    require_once 'includes/db.php';
    $result = $conn->query("SELECT * FROM homepage_photos ORDER BY uploaded_at DESC");
    while ($row = $result->fetch_assoc()):
  ?>
    <img src="<?= $row['image_path'] ?>" alt="Adventure" onclick="openLightbox(this)">
  <?php endwhile; ?>
</div>
</section>


<!-- Lightbox container -->
<div id="lightbox" onclick="closeLightbox()">
  <span id="close-btn">&times;</span>
  <img id="lightbox-img" src="" alt="Full Size">
</div>

  
  <!-- Contact Section -->
<?php
  require_once 'includes/db.php';
  $contact = $conn->query("SELECT * FROM contact_info WHERE id=1")->fetch_assoc();
?>
<section id="contact">
  <h2>Contact Us</h2>
  <p><i class="fas fa-envelope"></i> Email: <span id="contact-email"><?= htmlspecialchars($contact['email']) ?></span></p>
  <p><i class="fab fa-whatsapp"></i> Phone: <span id="contact-phone"><?= htmlspecialchars($contact['phone']) ?></span></p>
  <a href="https://wa.me/<?= preg_replace('/\D/', '', $contact['phone']) ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
  <a href="mailto:<?= htmlspecialchars($contact['email']) ?>"><i class="fas fa-envelope"></i></a>
</section>



<?php
$socials = $conn->query("SELECT * FROM social_links");

$platformIcons = [
    'facebook'  => 'facebook-f',
    'instagram' => 'instagram',
    'tiktok'    => 'tiktok',
    'youtube'   => 'youtube',
    'twitter'   => 'twitter',
    'linkedin'  => 'linkedin',
    'snapchat'  => 'snapchat-ghost'
];
?>
<footer>
  <h2>Follow Us On</h2>
  <div class="social-links" id="social-links">
    <?php while ($row = $socials->fetch_assoc()): ?>
      <?php
        $platformKey = strtolower(trim($row['platform']));
        $icon = $platformIcons[$platformKey] ?? 'link';
        $url = trim($row['url']);
        if (!empty($url)): // Only show if URL exists
      ?>
        <a href="<?= htmlspecialchars($url) ?>" target="_blank" rel="noopener">
          <i class="fab fa-<?= $icon ?>"></i>
        </a>
      <?php endif; ?>
    <?php endwhile; ?>
  </div>
</footer>
<!-- Social Media -->
<!-- <footer>
  <h2>Follow Us On</h2>
  <div class="social-links" id="social-links">
    <a href="https://www.facebook.com/share/1ArubXRJma/" target="_blank" rel="noopener">
      <i class="fab fa-facebook-f"> </i>
    </a>
    <a href="https://www.instagram.com/adventurecallest?igsh=YmV2bHkyMDl1cWlr" target="_blank" rel="noopener">
      <i class="fab fa-instagram"> </i>
    </a>
    <a href="https://www.tiktok.com/@adventurecallest?_t=ZS-8xOrsb16IER&_r=1" target="_blank" rel="noopener">
      <i class="fab fa-tiktok"> </i>
    </a>
  </div>
</footer> -->



  <script src="assets/js/script-test.js? v=2"> </script>

</body>
</html>
