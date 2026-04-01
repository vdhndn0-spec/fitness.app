<?php
if (!isset($active)) {
  $active = '';
}

$isUserHeader = (strpos($active, 'user_') === 0);

// Check if user is logged in
require_once __DIR__ . '/db.php';
$currentUser = getCurrentUser();
$isLoggedIn = ($currentUser !== null);
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>مدرب اللياقة الذكي</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">مدرب اللياقة <span class="text-success">الذكي</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ($isUserHeader): ?>
          <li class="nav-item"><a class="nav-link <?php echo $active === 'user_overview' ? 'active fw-bold' : ''; ?>" href="results.php">نظرة عامة</a></li>
          <li class="nav-item"><a class="nav-link" href="results.php#progress">التقدم</a></li>
          <li class="nav-item"><a class="nav-link <?php echo $active === 'user_settings' ? 'active fw-bold' : ''; ?>" href="assessment.php">الإعدادات</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link <?php echo $active === 'home' ? 'active fw-bold' : ''; ?>" href="index.php">الرئيسية</a></li>
          <li class="nav-item"><a class="nav-link <?php echo $active === 'about' ? 'active fw-bold' : ''; ?>" href="about.php">من نحن</a></li>
        <?php endif; ?>
      </ul>
      <div class="d-flex align-items-center gap-2">
        <?php if ($isLoggedIn): ?>
          <span class="text-muted small">مرحباً، <?php echo htmlspecialchars($currentUser['name'] ?? $currentUser['username']); ?></span>
          <a class="btn btn-outline-danger btn-sm fw-bold" href="logout.php">خروج</a>
        <?php elseif ($active === 'home'): ?>
          <a class="btn btn-outline-primary btn-sm fw-bold" href="login.php">دخول</a>
          <a class="btn btn-success btn-sm fw-bold" href="register.php">تسجيل</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<main class="py-4">
  <div class="container">
