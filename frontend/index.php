<?php
/**
 * ReShare landing page.
 * Served internally from the application root via .htaccess.
 */
$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/frontend/index.php');
$frontendPos = strpos($scriptPath, '/frontend/');
$baseUrl = $frontendPos !== false ? substr($scriptPath, 0, $frontendPos) : rtrim(dirname(dirname($scriptPath)), '/');
$baseUrl = rtrim($baseUrl, '/');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>ReShare</title>
  <meta name="viewport" content="width=1280">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="<?= $baseUrl ?>/style/main.css" rel="stylesheet">
</head>
<body class="relative h-screen w-screen overflow-hidden text-[#FAFAF7]">
  <div class="absolute inset-0 -z-10">
    <div class="bg-slide active" style="background-image:url('<?= $baseUrl ?>/assets/images/background/slide1.jpg')"></div>
    <div class="bg-slide" style="background-image:url('<?= $baseUrl ?>/assets/images/background/slide2.jpg')"></div>
    <div class="bg-slide" style="background-image:url('<?= $baseUrl ?>/assets/images/background/slide3.jpg')"></div>
  </div>
  <div class="absolute inset-0 bg-black/45"></div>
  <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-20">
    <img id="heroLogo" src="<?= $baseUrl ?>/assets/images/logo/reshare.png" class="h-40 w-auto mb-4 drop-shadow-[0_20px_40px_rgba(0,0,0,0.4)]" alt="ReShare Logo">
    <h1 id="heroTitle" class="text-5xl font-semibold tracking-wide mb-6 cursor"></h1>
    <p id="heroDesc" class="text-lg max-w-2xl text-white/85 leading-relaxed cursor"></p>
    <a id="ctaBtn" href="<?= $baseUrl ?>/frontend/login.php" class="mt-14 px-14 py-4 rounded-full bg-[#FAFAF7] text-[#3e5648] text-lg font-bold tracking-wide opacity-0 translate-y-6 transition-all duration-700 ease-out hover:scale-105 hover:shadow-2xl">
      Get Started
    </a>
  </div>
  <script>
    const slides = document.querySelectorAll('.bg-slide');
    let slideIndex = 0;
    setInterval(() => {
      slides[slideIndex].classList.remove('active');
      slideIndex = (slideIndex + 1) % slides.length;
      slides[slideIndex].classList.add('active');
    }, 6000);
    function typeText(el, delay, speed, callback) {
      const text = el.dataset.text;
      let i = 0;
      setTimeout(() => {
        const interval = setInterval(() => {
          el.textContent += text[i];
          i++;
          if (i >= text.length) {
            clearInterval(interval);
            el.classList.remove('cursor');
            if (callback) callback();
          }
        }, speed);
      }, delay);
    }
    const title = document.getElementById('heroTitle');
    const desc  = document.getElementById('heroDesc');
    const btn   = document.getElementById('ctaBtn');
    const logo  = document.getElementById('heroLogo');
    title.dataset.text = 'Berbagi Lebih Bermakna';
    desc.dataset.text  = 'Platform donasi barang layak pakai untuk mengurangi limbah dan membantu sesama secara berkelanjutan.';
    setTimeout(() => logo.classList.add('show'), 300);
    setTimeout(() => {
      typeText(title, 0, 60, () => {
        typeText(desc, 200, 22, () => {
          btn.classList.remove('opacity-0', 'translate-y-6');
        });
      });
    }, 900);
  </script>
</body>
</html>
