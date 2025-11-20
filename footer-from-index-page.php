
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