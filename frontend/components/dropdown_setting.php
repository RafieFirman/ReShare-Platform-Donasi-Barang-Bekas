<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    return;
}

require_once __DIR__ . '/../../backend/config/connection.php';
require_once __DIR__ . '/../../backend/leaderboard/user_badge.php';

$badgeMap = require __DIR__ . '/../../backend/config/badge_map.php';

$userId = (int) ($_SESSION['user_id'] ?? 0);
$userBadgeKey = $userId > 0 ? getUserBadge($conn, $userId) : null;
$badgeData = $userBadgeKey ? ($badgeMap[$userBadgeKey] ?? null) : null;
?>

<div
  id="settingMenu"
  class="dropdown-menu absolute right-0 mt-4 w-[380px]
         bg-[#FAFAF7] rounded-3xl shadow-xl
         opacity-0 scale-95 -translate-y-2
         pointer-events-none transition-all duration-200
         ease-out origin-top-right overflow-hidden"
>
  <!-- PROFILE -->
  <div
    class="relative h-44 bg-cover bg-center"
    style="background-image:url('../assets/images/background/bg3.jpg')"
  >
    <div class="absolute inset-0 bg-black/30"></div>

    <div class="relative z-10 p-6 text-white">
      <p class="text-lg">Halo!</p>

      <div class="flex items-center justify-between gap-3">
        <a
          href="inbox.php"
          class="text-[30px] font-semibold hover:underline leading-tight"
        >
          <?= htmlspecialchars($_SESSION['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </a>

        <?php if ($badgeData): ?>
          <div
            class="relative -translate-y-12 shrink-0 inline-flex items-center gap-2
                   px-3 py-1.5 bg-white/90 border border-[#3e5648]
                   rounded-full text-[#3e5648] text-sm font-semibold shadow"
          >
            <img src="<?= htmlspecialchars($badgeData['icon'], ENT_QUOTES, 'UTF-8') ?>" class="w-6 h-6" alt="">
            <?= htmlspecialchars($badgeData['label'], ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>
      </div>

      <p class="text-right text-sm mt-0">
        <?= htmlspecialchars($_SESSION['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>
      </p>
      <p class="text-right text-sm">
        <?= htmlspecialchars($_SESSION['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>
      </p>
    </div>
  </div>

  <!-- SETTINGS -->
  <div class="p-5 space-y-4">
    <?php
      $settings = [
        ['Ganti Username', 'user.svg', 'settings/rename.php'],
        ['Ganti Password', 'password.svg', 'settings/ganti_password.php'],
        ['Ganti Email', 'email.svg', 'settings/ganti_email.php'],
        ['Ganti Nomor', 'kontak.svg', 'settings/ganti_nomor.php'],
      ];
    ?>

    <?php foreach ($settings as $setting): ?>
      <a
        href="<?= htmlspecialchars($setting[2], ENT_QUOTES, 'UTF-8') ?>"
        class="flex items-center gap-4 px-6 py-4 rounded-xl
               bg-[#7fb7a4] text-white hover:opacity-90"
      >
        <img src="../assets/icons/<?= htmlspecialchars($setting[1], ENT_QUOTES, 'UTF-8') ?>" class="w-7 h-7" alt="">
        <span class="text-lg"><?= htmlspecialchars($setting[0], ENT_QUOTES, 'UTF-8') ?></span>
      </a>
    <?php endforeach; ?>

    <hr class="border-[#3e5648]/30 my-4">

    <!-- LOGOUT -->
    <a
      href="../backend/auth/logout.php"
      class="flex items-center justify-center gap-3 py-4 rounded-xl
             bg-[#3e5648] text-white text-lg"
    >
      <img src="../assets/icons/logout.svg" class="w-6 h-6" alt="">
      Log Out
    </a>
  </div>
</div>
