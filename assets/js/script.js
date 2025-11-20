  const videos = document.querySelectorAll("video");

  videos.forEach(video => {
    video.addEventListener("play", () => {
      videos.forEach(v => {
        if (v !== video) {
          v.pause();
        }
      });
    });
  });






  function openLightbox(img) {
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    lightboxImg.src = img.src;
    lightbox.style.display = "flex";
  }

  function closeLightbox() {
    document.getElementById("lightbox").style.display = "none";
  }



  const hamburger = document.getElementById('hamburger');
  const navMenu = document.getElementById('nav-menu');

  hamburger.addEventListener('click', () => {
    navMenu.classList.toggle('show');
  });

  

