<?php
$active = 'user_settings';
require __DIR__ . '/../includes/db.php';

requireLogin();

// Get current user data if logged in
$currentUser = getCurrentUser();
$userData = null;
if ($currentUser) {
    $userData = $currentUser;
}

$hc = $userData['health_condition'] ?? '';
$isChronicSubtype = in_array($hc, ['pressure', 'diabetes', 'heart', 'asthma'], true);

require __DIR__ . '/../includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-lg-9 col-xl-8">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white p-4 border-bottom">
        <h1 class="h4 fw-bold mb-1 text-center">نموذج التقييم الصحي</h1>
        <div class="text-muted small text-center">أدخل بياناتك بدقة للحصول على أفضل النتائج</div>
      </div>
      <div class="card-body p-4 p-md-5">
        <form id="assessmentForm" class="row g-3" method="post" action="results.php">
          <div class="col-md-6">
            <label class="form-label fw-bold">الاسم</label>
            <input class="form-control" name="name" required placeholder="الاسم الكامل" value="<?php echo htmlspecialchars($userData['name'] ?? ''); ?>" />
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">العمر</label>
            <input class="form-control" type="number" name="age" required min="10" max="100" placeholder="السنوات" value="<?php echo htmlspecialchars($userData['age'] ?? ''); ?>" />
          </div>

          <div class="col-12">
            <label class="form-label fw-bold">الجنس</label>
            <div class="d-flex gap-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="g1" value="male" required <?php if (($userData['gender'] ?? '') === 'male') echo 'checked'; ?>>
                <label class="form-check-label" for="g1">ذكر</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="g2" value="female" required <?php if (($userData['gender'] ?? '') === 'female') echo 'checked'; ?>>
                <label class="form-check-label" for="g2">أنثى</label>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-bold">الوزن (كجم)</label>
            <input class="form-control" type="number" name="weight" required min="30" max="300" placeholder="00" value="<?php echo htmlspecialchars($userData['weight'] ?? ''); ?>" />
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">الطول (سم)</label>
            <input class="form-control" type="number" name="height" required min="100" max="250" placeholder="000" value="<?php echo htmlspecialchars($userData['height'] ?? ''); ?>" />
          </div>

          <div class="col-md-6">
            <label class="form-label fw-bold">مستوى اللياقة</label>
            <select class="form-select" name="fitnessLevel" required>
              <option value="">اختر المستوى</option>
              <option value="beginner" <?php if (($userData['fitness_level'] ?? '') === 'beginner') echo 'selected'; ?>>مبتدئ (لا أمارس)</option>
              <option value="intermediate" <?php if (($userData['fitness_level'] ?? '') === 'intermediate') echo 'selected'; ?>>متوسط (أمارس قليلاً)</option>
              <option value="advanced" <?php if (($userData['fitness_level'] ?? '') === 'advanced') echo 'selected'; ?>>متقدم (رياضي)</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">الحالة الصحية</label>
            <select class="form-select" name="healthCondition" required>
              <option value="">اختر الحالة</option>
              <option value="normal" <?php if (($userData['health_condition'] ?? '') === 'normal') echo 'selected'; ?>>سليم (الحمد لله)</option>
              <option value="joint_pain" <?php if (($userData['health_condition'] ?? '') === 'joint_pain') echo 'selected'; ?>>آلام مفاصل</option>
              <option value="chronic" <?php if ((($userData['health_condition'] ?? '') === 'chronic') || $isChronicSubtype) echo 'selected'; ?>>أمراض مزمنة</option>
              <option value="injury" <?php if (($userData['health_condition'] ?? '') === 'injury') echo 'selected'; ?>>إصابة سابقة</option>
            </select>
          </div>

          <div class="col-md-6" id="chronicDetails" style="display:none;">
            <label class="form-label fw-bold">نوع المرض المزمن</label>
            <select class="form-select" name="chronicCondition">
              <option value="">اختر النوع</option>
              <option value="pressure" <?php if ($hc === 'pressure') echo 'selected'; ?>>ضغط</option>
              <option value="diabetes" <?php if ($hc === 'diabetes') echo 'selected'; ?>>سكر</option>
              <option value="heart" <?php if ($hc === 'heart') echo 'selected'; ?>>قلب</option>
              <option value="asthma" <?php if ($hc === 'asthma') echo 'selected'; ?>>ربو</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-bold">الهدف الرئيسي</label>
            <select class="form-select" name="goal" required>
              <option value="">حدد هدفك</option>
              <option value="weight_loss" <?php if (($userData['goal'] ?? '') === 'weight_loss') echo 'selected'; ?>>إنقاص الوزن</option>
              <option value="muscle_gain" <?php if (($userData['goal'] ?? '') === 'muscle_gain') echo 'selected'; ?>>بناء العضلات</option>
              <option value="general_fitness" <?php if (($userData['goal'] ?? '') === 'general_fitness') echo 'selected'; ?>>لياقة عامة</option>
              <option value="flexibility" <?php if (($userData['goal'] ?? '') === 'flexibility') echo 'selected'; ?>>مرونة وتوازن</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">الوقت المتاح</label>
            <select class="form-select" name="timeAvailable" required>
              <option value="">المدة اليومية</option>
              <option value="15">15 دقيقة</option>
              <option value="30">30 دقيقة</option>
              <option value="60">60 دقيقة</option>
            </select>
          </div>

          <div class="col-12 d-flex gap-2 pt-2">
            <a class="btn btn-outline-secondary fw-bold flex-fill" href="index.php">إلغاء</a>
            <button class="btn btn-success fw-bold flex-fill" type="submit">تحليل النتائج</button>
          </div>
        </form>
        <div class="text-muted small mt-3">ملاحظة: البيانات ستحفظ في حسابك للاستخدام المستقبلي.</div>
      </div>
    </div>
  </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
