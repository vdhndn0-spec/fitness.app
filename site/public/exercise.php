<?php
$active = 'user_exercise';
require __DIR__ . '/../includes/header.php';

function youtubeEmbedUrl(string $url): string {
  $u = trim($url);
  if ($u === '') return '';

  $id = '';
  if (preg_match('~youtube\.com/shorts/([^?&#/]+)~i', $u, $m)) {
    $id = $m[1];
  } elseif (preg_match('~youtube\.com/watch\?v=([^?&#/]+)~i', $u, $m)) {
    $id = $m[1];
  } elseif (preg_match('~youtu\.be/([^?&#/]+)~i', $u, $m)) {
    $id = $m[1];
  }

  if ($id === '') return '';
  return 'https://www.youtube.com/embed/' . $id;
}

function findLibraryVideoUrlById(string $id): string {
  $id = strtolower(trim($id));
  if ($id === '') return '';

  $lib = [];
  if (file_exists(__DIR__ . '/../includes/exercise_library.php')) {
    require_once __DIR__ . '/../includes/exercise_library.php';
  }

  $sources = [];
  if (function_exists('getTeenExerciseLibrary')) $sources[] = getTeenExerciseLibrary();
  if (function_exists('getAdultExerciseLibrary')) $sources[] = getAdultExerciseLibrary();
  if (function_exists('getMatureExerciseLibrary')) $sources[] = getMatureExerciseLibrary();
  if (function_exists('getSeniorExerciseLibrary')) $sources[] = getSeniorExerciseLibrary();
  if (function_exists('getWarmupLibrary')) $sources[] = getWarmupLibrary();

  foreach ($sources as $items) {
    if (!is_array($items)) continue;
    foreach ($items as $ex) {
      if (!is_array($ex)) continue;
      $exId = strtolower(trim((string)($ex['id'] ?? '')));
      if ($exId === '') {
        $exId = strtolower(trim((string)($ex['name_en'] ?? '')));
      }
      if ($exId === '' || $exId !== $id) continue;

      foreach (['video_url_male', 'video_url_female', 'videoUrl', 'video_url'] as $k) {
        if (isset($ex[$k]) && is_string($ex[$k]) && trim($ex[$k]) !== '') {
          return trim($ex[$k]);
        }
      }

      if (function_exists('exerciseLibraryVideoUrl')) {
        $gender = (string)($_GET['gender'] ?? '');
        $gender = strtolower(trim($gender));
        if ($gender !== 'female' && $gender !== 'male') $gender = 'male';
        $fallback = trim((string)exerciseLibraryVideoUrl($ex, $gender));
        if ($fallback !== '') return $fallback;
      }
    }
  }

  return '';
}

function findLibraryVideoUrlByName(string $name): string {
  $name = strtolower(trim($name));
  if ($name === '') return '';

  if (file_exists(__DIR__ . '/../includes/exercise_library.php')) {
    require_once __DIR__ . '/../includes/exercise_library.php';
  }

  $sources = [];
  if (function_exists('getTeenExerciseLibrary')) $sources[] = getTeenExerciseLibrary();
  if (function_exists('getAdultExerciseLibrary')) $sources[] = getAdultExerciseLibrary();
  if (function_exists('getMatureExerciseLibrary')) $sources[] = getMatureExerciseLibrary();
  if (function_exists('getSeniorExerciseLibrary')) $sources[] = getSeniorExerciseLibrary();
  if (function_exists('getWarmupLibrary')) $sources[] = getWarmupLibrary();

  foreach ($sources as $items) {
    if (!is_array($items)) continue;
    foreach ($items as $ex) {
      if (!is_array($ex)) continue;
      $exName = strtolower(trim((string)($ex['name'] ?? '')));
      $exNameEn = strtolower(trim((string)($ex['name_en'] ?? '')));
      if ($exName !== $name && $exNameEn !== $name) continue;

      foreach (['video_url_male', 'video_url_female', 'videoUrl', 'video_url'] as $k) {
        if (isset($ex[$k]) && is_string($ex[$k]) && trim($ex[$k]) !== '') {
          return trim($ex[$k]);
        }
      }

      if (function_exists('exerciseLibraryVideoUrl')) {
        $gender = (string)($_GET['gender'] ?? '');
        $gender = strtolower(trim($gender));
        if ($gender !== 'female' && $gender !== 'male') $gender = 'male';
        $fallback = trim((string)exerciseLibraryVideoUrl($ex, $gender));
        if ($fallback !== '') return $fallback;
      }
    }
  }

  return '';
}

$id = (string)($_GET['id'] ?? '');
$name = (string)($_GET['name'] ?? '');
$duration = (string)($_GET['duration'] ?? '');
$difficulty = (string)($_GET['difficulty'] ?? '');
$benefits = (string)($_GET['benefits'] ?? '');
$videoUrl = (string)($_GET['videoUrl'] ?? '');

// Debug info (temporary)
$debugInfo = [];
$debugInfo['received_id'] = $id;
$debugInfo['received_videoUrl'] = $videoUrl;

if (trim($videoUrl) === '' && trim($id) !== '') {
  $videoUrl = findLibraryVideoUrlById($id);
  $debugInfo['lookup_by_id'] = $videoUrl;
}

if (trim($videoUrl) === '' && trim($name) !== '') {
  $videoUrl = findLibraryVideoUrlByName($name);
  $debugInfo['lookup_by_name'] = $videoUrl;
}

$embed = youtubeEmbedUrl($videoUrl);
?>
<!-- Debug: <?php echo htmlspecialchars(json_encode($debugInfo, JSON_UNESCAPED_UNICODE)); ?> -->

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
  <h1 class="h3 fw-bold m-0"><?php echo htmlspecialchars($name ?: 'التمرين'); ?></h1>
  <div class="d-flex gap-2">
    <button class="btn btn-success fw-bold" type="button" id="markDoneBtn">تم التمرين</button>
    <a class="btn btn-outline-secondary fw-bold" href="javascript:history.back()">رجوع</a>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-7">
    <div class="card">
      <div class="card-body p-3 p-md-4">
        <?php if ($embed !== ''): ?>
          <div class="ratio ratio-16x9">
            <iframe src="<?php echo htmlspecialchars($embed); ?>" title="Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          </div>
        <?php else: ?>
          <div class="alert alert-warning mb-0">لا يوجد فيديو لهذا التمرين حاليًا.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="card">
      <div class="card-body p-3 p-md-4">
        <?php if ($duration !== ''): ?>
          <div class="mb-2"><span class="fw-bold">المدة:</span> <?php echo htmlspecialchars($duration); ?></div>
        <?php endif; ?>
        <?php if ($difficulty !== ''): ?>
          <div class="mb-2"><span class="fw-bold">الصعوبة:</span> <?php echo htmlspecialchars($difficulty); ?></div>
        <?php endif; ?>
        <?php if ($benefits !== ''): ?>
          <div class="mt-3"><div class="fw-bold mb-1">الفوائد</div><div class="text-muted"><?php echo nl2br(htmlspecialchars($benefits)); ?></div></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<script>
  (function () {
    var btn = document.getElementById('markDoneBtn');
    if (!btn) return;

    btn.addEventListener('click', function () {
      try {
        var id = <?php echo json_encode($id); ?>;
        if (typeof window.fitnessMarkExerciseDone === 'function') {
          window.fitnessMarkExerciseDone(id);
        }
      } catch (e) {}

      window.location.href = 'results.php#progress';
    });
  })();
</script>
<?php require __DIR__ . '/../includes/footer.php'; ?>
