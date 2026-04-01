<?php
$active = 'user_warmup';
require __DIR__ . '/../includes/header.php';

$gender = (string)($_GET['gender'] ?? '');
if ($gender !== 'female' && $gender !== 'male') {
  $gender = 'male';
}

$isMale = ($gender === 'male');
$videoUrl = $isMale
  ? 'https://www.youtube.com/watch?v=g-my5q30ZNI&t=18s'
  : 'https://www.youtube.com/watch?v=rWREESdeqxc&t=29s';

function youtubeEmbedUrl(string $url): string {
  $u = trim($url);
  if ($u === '') return '';
  $id = '';
  if (preg_match('~youtube\.com/watch\?v=([^?&#/]+)~i', $u, $m)) {
    $id = $m[1];
  } elseif (preg_match('~youtu\.be/([^?&#/]+)~i', $u, $m)) {
    $id = $m[1];
  }
  if ($id === '') return '';
  return 'https://www.youtube.com/embed/' . $id;
}

$embed = youtubeEmbedUrl($videoUrl);
$pageTitle = $isMale ? 'إحماء للرجال' : 'إحماء للنساء';
$tips = [
  'قم بالإحماء لمدة 5-10 دقائق قبل التمرين الأساسي.',
  'ركز على تسخين المفاصل الرئيسية (الركبتين، الكتفين، الورك).',
  'زد من معدل ضربات القلب تدريجياً خلال الإحماء.',
  'تجنب الإفراط في التمدد قبل التمرين القوي.',
  'شرب الماء قبل وأثناء الإحماء مهم للترطيب.'
];
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
  <h1 class="h3 fw-bold m-0">🔥 <?php echo htmlspecialchars($pageTitle); ?></h1>
  <a class="btn btn-outline-secondary fw-bold" href="javascript:history.back()">رجوع</a>
</div>

<div class="row g-3">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body p-3 p-md-4">
        <?php if ($embed !== ''): ?>
          <div class="ratio ratio-16x9">
            <iframe src="<?php echo htmlspecialchars($embed); ?>" title="Warmup Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          </div>
        <?php else: ?>
          <div class="alert alert-warning mb-0">لا يمكن عرض الفيديو.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card h-100">
      <div class="card-body p-3 p-md-4">
        <div class="fw-bold mb-3">💡 نصائح مهمة للإحماء</div>
        <ul class="list-group list-group-flush">
          <?php foreach ($tips as $tip): ?>
            <li class="list-group-item px-0 py-2"><?php echo htmlspecialchars($tip); ?></li>
          <?php endforeach; ?>
        </ul>
        <div class="alert alert-info mt-4 mb-0 small">
          <strong>تنبيه:</strong> الإحماء ضروري لتجنب الإصابات وتحسين الأداء.
        </div>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>
