<?php

declare(strict_types=1);

require_once __DIR__ . '/../public/exercises/teen_exercises.php';
require_once __DIR__ . '/../public/exercises/adult_exercises.php';
require_once __DIR__ . '/../public/exercises/mature_exercises.php';
require_once __DIR__ . '/../public/exercises/senior_exercises.php';
$warmupFile = __DIR__ . '/../public/exercises/warmup.php';
if (is_file($warmupFile)) {
  require_once $warmupFile;
}

function exerciseLibraryHealthKey(string $healthCondition): string {
  $hc = strtolower(trim($healthCondition));
  if ($hc === 'joint_pain') return 'joints';
  if ($hc === 'joints') return 'joints';
  if ($hc === 'injury') return 'injury';
  if ($hc === 'chronic') return 'chronic';
  if ($hc === 'normal') return '';
  return $hc;
}

function exerciseLibraryGenderKey(string $gender): string {
  $g = strtolower(trim($gender));
  if ($g === 'male' || $g === 'm') return 'male';
  if ($g === 'female' || $g === 'f') return 'female';
  return 'both';
}

function exerciseLibraryPickByAge(int $age): array {
  if (function_exists('isTeen') && isTeen($age)) return getTeenExerciseLibrary();
  if (function_exists('isAdult') && isAdult($age)) return getAdultExerciseLibrary();
  if (function_exists('isMature') && isMature($age)) return getMatureExerciseLibrary();
  return getSeniorExerciseLibrary();
}

function exerciseLibrarySlug(string $s): string {
  $s = strtolower(trim($s));
  $s = preg_replace('/[^a-z0-9_\-]+/i', '_', $s);
  $s = preg_replace('/_+/', '_', (string)$s);
  return trim((string)$s, '_');
}

function exerciseLibraryFallbackVideoMap(): array {
  return [
    'pushups' => [
      'male' => 'https://www.youtube.com/watch?v=gNrnY9eaq-Y',
      'female' => 'https://www.youtube.com/watch?v=_x71MC6rKQw'
    ],
    'squats' => [
      'male' => 'https://www.youtube.com/watch?v=rT0vyHTBw-A',
      'female' => 'https://www.youtube.com/shorts/rmKOhmPtJFk'
    ],
    'lunges' => [
      'male' => 'https://www.youtube.com/watch?v=Nopu1DelXwE',
      'female' => 'https://www.youtube.com/shorts/ShJPetMefGw'
    ],
    'plank' => [
      'male' => 'https://www.youtube.com/watch?v=xe2MXatLTUw',
      'female' => 'https://www.youtube.com/watch?v=RfilUpGylpw'
    ],
    'side_plank' => [
      'male' => 'https://www.youtube.com/watch?v=Wv4oj31H8SU',
      'female' => 'https://www.youtube.com/shorts/aQm1Ki0-vt8'
    ],
    'crunches' => [
      'male' => 'https://www.youtube.com/watch?v=Fdbqt66rl6A',
      'female' => 'https://www.youtube.com/watch?v=zaxkSoSwKo4'
    ],
    'ab_workout' => [
      'male' => 'https://www.youtube.com/watch?v=Fdbqt66rl6A',
      'female' => 'https://www.youtube.com/watch?v=zaxkSoSwKo4'
    ],
    'jumping_jacks' => [
      'male' => 'https://www.youtube.com/watch?v=636IhyuvN-4',
      'female' => 'https://www.youtube.com/shorts/yg3KQQn3QWg'
    ],
    'pullups' => [
      'male' => 'https://www.youtube.com/shorts/Rd3qjnacfCs',
      'female' => 'https://www.youtube.com/watch?v=7a0yRnU8LQU'
    ],
    'bird_dog' => [
      'male' => 'https://www.youtube.com/shorts/dAQ7hVe4x3g',
      'female' => 'https://www.youtube.com/shorts/D-_-W9nQDM8'
    ],
    'cat_cow' => [
      'male' => 'https://www.youtube.com/shorts/Yetvc-6pkS4',
      'female' => 'https://www.youtube.com/shorts/2of247Kt0tU'
    ],
    'running_in_place' => [
      'male' => 'https://www.youtube.com/shorts/KZ7gDPdRkbU',
      'female' => 'https://www.youtube.com/shorts/Wq1uXRw-3w4'
    ],
    'high_knees' => [
      'male' => 'https://www.youtube.com/shorts/ZXik5WCOyiM',
      'female' => 'https://www.youtube.com/shorts/AuUWHiEsCd8'
    ],
    'burpees' => [
      'male' => 'https://www.youtube.com/shorts/6ktzcUwumCY',
      'female' => 'https://www.youtube.com/shorts/oUOeCtL0lg4'
    ],
    'mountain_climbers' => [
      'male' => 'https://www.youtube.com/shorts/2J62zI7hhlA',
      'female' => 'https://www.youtube.com/shorts/5hmOtXAofpk'
    ],
    'balance_exercises' => [
      'male' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
      'female' => 'https://www.youtube.com/shorts/6u1FkpsISec'
    ],
  ];
}

function exerciseLibraryFallbackVideoUrl(array $ex, string $gender): string {
  $map = exerciseLibraryFallbackVideoMap();

  $key = (string)($ex['id'] ?? '');
  if ($key === '') $key = (string)($ex['name_en'] ?? '');
  if ($key === '') $key = (string)($ex['name'] ?? '');
  $key = exerciseLibrarySlug($key);

  if ($key === '' || !isset($map[$key]) || !is_array($map[$key])) return '';

  $row = $map[$key];
  if ($gender === 'male' && isset($row['male']) && is_string($row['male']) && $row['male'] !== '') return $row['male'];
  if ($gender === 'female' && isset($row['female']) && is_string($row['female']) && $row['female'] !== '') return $row['female'];

  if (isset($row['male']) && is_string($row['male']) && $row['male'] !== '') return $row['male'];
  if (isset($row['female']) && is_string($row['female']) && $row['female'] !== '') return $row['female'];
  return '';
}

function exerciseLibraryVideoUrl(array $ex, string $gender): string {
  if ($gender === 'male' && isset($ex['video_url_male']) && is_string($ex['video_url_male']) && $ex['video_url_male'] !== '') {
    return $ex['video_url_male'];
  }
  if ($gender === 'female' && isset($ex['video_url_female']) && is_string($ex['video_url_female']) && $ex['video_url_female'] !== '') {
    return $ex['video_url_female'];
  }
  if (isset($ex['videoUrl']) && is_string($ex['videoUrl']) && $ex['videoUrl'] !== '') return $ex['videoUrl'];
  if (isset($ex['video_url']) && is_string($ex['video_url']) && $ex['video_url'] !== '') return $ex['video_url'];

  return exerciseLibraryFallbackVideoUrl($ex, $gender);
}

function exerciseLibraryAllowedForGender(array $ex, string $gender): bool {
  $focus = strtolower(trim((string)($ex['gender_focus'] ?? 'both')));
  if ($focus === '' || $focus === 'both') return true;
  if ($gender === 'both') return true;
  return $focus === $gender;
}

function exerciseLibraryContraindicated(array $ex, string $healthKey): bool {
  if ($healthKey === '') return false;
  if (!isset($ex['contraindications']) || !is_array($ex['contraindications'])) return false;
  foreach ($ex['contraindications'] as $c) {
    if (!is_string($c)) continue;
    if (strtolower(trim($c)) === strtolower($healthKey)) return true;
  }
  return false;
}

function exerciseLibraryEmoji(array $ex): string {
  $cat = strtolower(trim((string)($ex['category'] ?? '')));
  if (str_contains($cat, 'cardio') || str_contains($cat, 'hiit')) return '🏃';
  if (str_contains($cat, 'core')) return '🧘';
  if (str_contains($cat, 'balance')) return '⚖️';
  if (str_contains($cat, 'warmup')) return '🔥';
  if (str_contains($cat, 'safe') || str_contains($cat, 'low_impact')) return '🚶';
  return '🏋️';
}

function exerciseLibraryDifficultyLabel(string $difficulty): string {
  $d = strtolower(trim($difficulty));
  if ($d === 'easy') return 'سهل';
  if ($d === 'medium') return 'متوسط';
  if ($d === 'hard') return 'صعب';
  return $difficulty;
}

function selectExercisesFromLibrary(int $age, string $gender, string $healthCondition, int $limit): array {
  $g = exerciseLibraryGenderKey($gender);
  $hc = exerciseLibraryHealthKey($healthCondition);

  $library = exerciseLibraryPickByAge($age);
  if (!is_array($library)) $library = [];

  $out = [];
  foreach ($library as $ex) {
    if (!is_array($ex)) continue;
    if (!exerciseLibraryAllowedForGender($ex, $g)) continue;
    if (exerciseLibraryContraindicated($ex, $hc)) continue;

    $id = (string)($ex['id'] ?? '');
    if ($id === '') {
      $id = exerciseLibrarySlug((string)($ex['name_en'] ?? $ex['name'] ?? ''));
    }

    $out[] = [
      'id' => $id,
      'name' => (string)($ex['name'] ?? ''),
      'duration' => (string)($ex['duration'] ?? ''),
      'difficulty' => exerciseLibraryDifficultyLabel((string)($ex['difficulty'] ?? '')),
      'image' => exerciseLibraryEmoji($ex),
      'benefits' => (string)($ex['benefits'] ?? ''),
      'aiReason' => 'اقتراح من مكتبة تمارين حسب الفئة العمرية',
      'videoUrl' => exerciseLibraryVideoUrl($ex, $g)
    ];

    if (count($out) >= $limit) break;
  }

  return $out;
}

function selectWarmupFromLibrary(string $gender, int $limit = 2): array {
  $g = exerciseLibraryGenderKey($gender);

  $items = [];
  if (function_exists('getWarmupLibraryByGender')) {
    $items = getWarmupLibraryByGender($g);
  } elseif (function_exists('getWarmupLibrary')) {
    $items = getWarmupLibrary();
  }

  if (!is_array($items)) return [];

  $out = [];
  foreach ($items as $ex) {
    if (!is_array($ex)) continue;
    $out[] = [
      'id' => exerciseLibrarySlug((string)($ex['name_en'] ?? $ex['name'] ?? 'warmup')),
      'name' => (string)($ex['name'] ?? ''),
      'duration' => (string)($ex['duration'] ?? ''),
      'difficulty' => exerciseLibraryDifficultyLabel((string)($ex['difficulty'] ?? '')),
      'image' => '🔥',
      'benefits' => (string)($ex['benefits'] ?? ''),
      'aiReason' => 'إحماء قبل التمرين',
      'videoUrl' => exerciseLibraryVideoUrl($ex, $g)
    ];
    if (count($out) >= $limit) break;
  }

  return $out;
}

function warmupTipsFromLibrary(): array {
  if (function_exists('getWarmupLibrary')) {
    $w = getWarmupLibrary();
    if (is_array($w) && count($w) > 0) {
      return ['ابدأ بإحماء 5-10 دقائق قبل التمرين'];
    }
  }
  return ['ابدأ بإحماء 5-10 دقائق قبل التمرين'];
}
