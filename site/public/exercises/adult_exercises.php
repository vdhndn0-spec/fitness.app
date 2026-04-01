<?php
/**
 * Adult Exercise Recommendation System (Ages 18-30)
 * Supports higher intensity (HIIT for healthy users) with clear safety rules
 */
 
// Constants
const LVL_EASY_ADULT = 'easy';
const LVL_MEDIUM_ADULT = 'medium';
const LVL_HARD_ADULT = 'hard';
 
const CAT_STRENGTH_ADULT = 'strength';
const CAT_CARDIO_ADULT = 'cardio';
const CAT_LOW_IMPACT_ADULT = 'low_impact';
const CAT_CORE_ADULT = 'core';
const CAT_HIIT_ADULT = 'hiit';
 
const HC_HEALTHY_ADULT = '';
const HC_DIABETES_ADULT = 'diabetes';
const HC_HEART_ADULT = 'heart';
const HC_PRESSURE_ADULT = 'pressure';
const HC_ASTHMA_ADULT = 'asthma';
const HC_JOINT_ADULT = 'joint';
 
/**
 * Check if user is an adult (18-30 years)
 */
function isAdult(int $age): bool {
    return $age >= 18 && $age <= 30;
}
 
/**
 * Get complete adult exercise library
 */
function getAdultExerciseLibrary(): array {
    return [
        // ====== STRENGTH ======
        [
            'id' => 'pushups',
            'name' => 'تمارين الضغط',
            'name_en' => 'Push-ups',
            'category' => CAT_STRENGTH_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '3 مجموعات × 12-15',
            'target_muscles' => 'الصدر، الكتفين، الذراعين',
            'benefits' => 'بناء قوة الجسم العلوي',
            'video_url_female' => 'https://www.youtube.com/watch?v=_x71MC6rKQw',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT],
            'modifications' => [
                HC_DIABETES_ADULT => 'أداء بطيء مع راحة 60 ثانية بين المجموعات',
                HC_ASTHMA_ADULT => 'تجنب الإجهاد الشديد، راقب التنفس',
                HC_JOINT_ADULT => 'استخدم نسخة مائلة لتخفيف الضغط على المفاصل',
                'beginner' => 'ابدأ بالضغط على الركبتين'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'squats',
            'name' => 'السكوات',
            'name_en' => 'Squats',
            'category' => CAT_STRENGTH_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '3 مجموعات × 20',
            'target_muscles' => 'الفخذين، الأرداف، الساقين',
            'benefits' => 'تقوية الجسم السفلي',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_ADULT => 'سكوات نصفية فقط',
                HC_PRESSURE_ADULT => 'أداء بطيء دون شد',
                'beginner' => 'سكوات نصفية مع كرسي'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'lunges',
            'name' => 'اللانجز',
            'name_en' => 'Lunges',
            'category' => CAT_STRENGTH_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '3 مجموعات × 12 لكل رجل',
            'target_muscles' => 'الفخذين، الأرداف',
            'benefits' => 'توازن وقوة الساقين',
            'video_url' => 'https://www.youtube.com/shorts/Nopu1DelXwE',
            'video_url_male' => 'https://www.youtube.com/shorts/Nopu1DelXwE',
            'video_url_female' => 'https://www.youtube.com/shorts/ShJPetMefGw',
            'contraindications' => [HC_JOINT_ADULT],
            'modifications' => [
                HC_JOINT_ADULT => 'خطوات خفيفة ثابتة دون نزول عميق',
                HC_PRESSURE_ADULT => 'أداء بطيء',
                'beginner' => 'خطوات صغيرة'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'plank',
            'name' => 'البلانك',
            'name_en' => 'Plank',
            'category' => CAT_CORE_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '3 × 45-60 ثانية',
            'target_muscles' => 'البطن، الظهر، الكور',
            'benefits' => 'تقوية عضلات الكور',
            'video_url_female' => 'https://www.youtube.com/shorts/RfilUpGylpw',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT],
            'modifications' => [
                HC_DIABETES_ADULT => '30 ثانية مع راحة كافية',
                HC_ASTHMA_ADULT => 'تجنب حبس النفس',
                HC_JOINT_ADULT => 'بلانك على الركبتين',
                'beginner' => '20 ثانية'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'side_plank',
            'name' => 'البلانك الجانبي',
            'name_en' => 'Side Plank',
            'category' => CAT_CORE_ADULT,
            'difficulty' => LVL_HARD_ADULT,
            'duration' => '3 × 30 ثانية لكل جانب',
            'target_muscles' => 'عضلات البطن الجانبية، الكور',
            'benefits' => 'تقوية الجانبين',
            'video_url' => 'https://www.youtube.com/watch?v=Wv4oj31H8SU',
            'video_url_male' => 'https://www.youtube.com/watch?v=Wv4oj31H8SU',
            'video_url_female' => 'https://www.youtube.com/shorts/aQm1Ki0-vt8',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT],
            'modifications' => [
                HC_JOINT_ADULT => 'بلانك جانبي على الركبة',
                'beginner' => '20 ثانية'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'ab_workout',
            'name' => 'تمارين البطن',
            'name_en' => 'Ab Workout',
            'category' => CAT_CORE_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '3 مجموعات × 15',
            'target_muscles' => 'البطن',
            'benefits' => 'تقوية عضلات البطن',
            'video_url' => 'https://www.youtube.com/shorts/Fdbqt66rl6A',
            'video_url_male' => 'https://www.youtube.com/shorts/Fdbqt66rl6A',
            'video_url_female' => 'https://www.youtube.com/watch?v=zaxkSoSwKo4',
            'contraindications' => [HC_HEART_ADULT],
            'modifications' => [
                HC_PRESSURE_ADULT => 'أداء بطيء',
                'beginner' => '10 تكرارات'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'pullups',
            'name' => 'تمرين العقلة',
            'name_en' => 'Pull-ups',
            'category' => CAT_STRENGTH_ADULT,
            'difficulty' => LVL_HARD_ADULT,
            'duration' => '3 مجموعات × 5-10',
            'target_muscles' => 'الظهر، البايسبس، الكتفين',
            'benefits' => 'بناء قوة الجسم العلوي',
            'video_url' => 'https://www.youtube.com/shorts/Rd3qjnacfCs',
            'video_url_male' => 'https://www.youtube.com/shorts/Rd3qjnacfCs',
            'video_url_female' => 'https://www.youtube.com/watch?v=7a0yRnU8LQU',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_JOINT_ADULT],
            'modifications' => [
                'beginner' => 'استخدم مساعدة أو عقلة منخفضة'
            ],
            'gender_focus' => 'male',
            'is_hiit' => false
        ],
 
        // ====== CARDIO / HIIT ======
        [
            'id' => 'jumping_jacks',
            'name' => 'جمبنج جاكس',
            'name_en' => 'Jumping Jacks',
            'category' => CAT_CARDIO_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '45 ثانية',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'رفع معدل ضربات القلب',
            'video_url' => 'https://www.youtube.com/shorts/636IhyuvN-4',
            'video_url_male' => 'https://www.youtube.com/shorts/636IhyuvN-4',
            'video_url_female' => 'https://www.youtube.com/shorts/yg3KQQn3QWg',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_JOINT_ADULT],
            'modifications' => [
                HC_DIABETES_ADULT => '30 ثانية معيّنة',
                HC_ASTHMA_ADULT => '20 ثانية مع راحة',
                'beginner' => 'خطوات جانبية بدون قفز'
            ],
            'gender_focus' => 'both',
            'is_hiit' => true
        ],
        [
            'id' => 'high_knees',
            'name' => 'هاي نيز',
            'name_en' => 'High Knees',
            'category' => CAT_CARDIO_ADULT,
            'difficulty' => LVL_HARD_ADULT,
            'duration' => '30 ثانية',
            'target_muscles' => 'البطن، الفخذين',
            'benefits' => 'حرق سريع للسعرات',
            'video_url' => 'https://www.youtube.com/shorts/ZXik5WCOyiM',
            'video_url_male' => 'https://www.youtube.com/shorts/ZXik5WCOyiM',
            'video_url_female' => 'https://www.youtube.com/shorts/AuUWHiEsCd8',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_JOINT_ADULT, HC_ASTHMA_ADULT],
            'modifications' => [
                HC_DIABETES_ADULT => 'رفع ركبة واحدة كل 2 ثانية',
                'beginner' => 'رفع ركب ببطء'
            ],
            'gender_focus' => 'both',
            'is_hiit' => true
        ],
        [
            'id' => 'mountain_climbers',
            'name' => 'ماونتن كلايمرز',
            'name_en' => 'Mountain Climbers',
            'category' => CAT_CARDIO_ADULT,
            'difficulty' => LVL_HARD_ADULT,
            'duration' => '30 ثانية',
            'target_muscles' => 'البطن، الكتفين، الكور',
            'benefits' => 'حرق شديد + تقوية الكور',
            'video_url' => 'https://www.youtube.com/shorts/2J62zI7hhlA',
            'video_url_male' => 'https://www.youtube.com/shorts/2J62zI7hhlA',
            'video_url_female' => 'https://www.youtube.com/shorts/5hmOtXAofpk',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_JOINT_ADULT],
            'modifications' => [
                HC_DIABETES_ADULT => 'حركة بطيئة 20 ثانية',
                'beginner' => 'بطيء مع إراحة'
            ],
            'gender_focus' => 'both',
            'is_hiit' => true
        ],
        [
            'id' => 'burpees',
            'name' => 'بيربيز',
            'name_en' => 'Burpees',
            'category' => CAT_HIIT_ADULT,
            'difficulty' => LVL_HARD_ADULT,
            'duration' => '10-15 تكرار',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'حرق مكثف للسعرات',
            'video_url' => 'https://www.youtube.com/shorts/6ktzcUwumCY',
            'video_url_male' => 'https://www.youtube.com/shorts/6ktzcUwumCY',
            'video_url_female' => 'https://www.youtube.com/shorts/oUOeCtL0lg4',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_JOINT_ADULT, HC_ASTHMA_ADULT, HC_DIABETES_ADULT],
            'modifications' => [
                'beginner' => 'بيربيز من دون قفز'
            ],
            'gender_focus' => 'both',
            'is_hiit' => true
        ],
        [
            'id' => 'jump_rope',
            'name' => 'نط الحبل',
            'name_en' => 'Jump Rope',
            'category' => CAT_CARDIO_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '3 دقائق',
            'target_muscles' => 'الساقين، الكور',
            'benefits' => 'تحسين التناسق وحرق السعرات',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_JOINT_ADULT],
            'modifications' => [
                HC_ASTHMA_ADULT => '1 دقيقة مع راحة',
                'beginner' => 'نط ببطء'
            ],
            'gender_focus' => 'both',
            'is_hiit' => true
        ],
        [
            'id' => 'running_in_place',
            'name' => 'جري في المكان',
            'name_en' => 'Running in Place',
            'category' => CAT_CARDIO_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '3 دقائق',
            'target_muscles' => 'الساقين، الكور',
            'benefits' => 'كارديو منخفض التأثير',
            'video_url' => 'https://www.youtube.com/shorts/Wq1uXRw-3w4',
            'video_url_male' => 'https://www.youtube.com/shorts/KZ7gDPdRkbU',
            'video_url_female' => 'https://www.youtube.com/shorts/Wq1uXRw-3w4',
            'contraindications' => [HC_HEART_ADULT, HC_JOINT_ADULT],
            'modifications' => [
                HC_PRESSURE_ADULT => 'بطيء مع مراقبة النبض',
                HC_ASTHMA_ADULT => '1 دقيقة مع راحة',
                'beginner' => 'هرولة خفيفة'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],

        [
            'id' => 'fast_running',
            'name' => 'جري سريع',
            'name_en' => 'Fast Running',
            'category' => CAT_HIIT_ADULT,
            'difficulty' => LVL_HARD_ADULT,
            'duration' => '45-60 ثانية',
            'target_muscles' => 'الساقين، القلب',
            'benefits' => 'رفع اللياقة + حرق عالي',
            'contraindications' => [HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_ASTHMA_ADULT, HC_JOINT_ADULT, HC_DIABETES_ADULT],
            'modifications' => [
                'beginner' => 'هرولة متوسطة بدلاً من الجري السريع'
            ],
            'gender_focus' => 'both',
            'is_hiit' => true
        ],
 
        // ====== LOW IMPACT ======
        [
            'id' => 'walking',
            'name' => 'المشي',
            'name_en' => 'Walking',
            'category' => CAT_LOW_IMPACT_ADULT,
            'difficulty' => LVL_EASY_ADULT,
            'duration' => '10-15 دقيقة',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'تحسين الدورة الدموية',
            'contraindications' => [],
            'modifications' => [
                HC_DIABETES_ADULT => 'مشي معتدل 10 دقائق',
                HC_HEART_ADULT => 'مشي بطيء 5-10 دقائق',
                HC_PRESSURE_ADULT => 'مشي مريح'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'light_squats',
            'name' => 'سكوات خفيف',
            'name_en' => 'Light Squats',
            'category' => CAT_LOW_IMPACT_ADULT,
            'difficulty' => LVL_EASY_ADULT,
            'duration' => '3 مجموعات × 10',
            'target_muscles' => 'الفخذين',
            'benefits' => 'تقوية خفيفة للمفاصل',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_ADULT => 'نصف سكوات فقط',
                'beginner' => 'مع كرسي'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'stretching',
            'name' => 'تمارين إطالة',
            'name_en' => 'Stretching',
            'category' => CAT_LOW_IMPACT_ADULT,
            'difficulty' => LVL_EASY_ADULT,
            'duration' => '10 دقائق',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'مرونة واسترخاء',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_ADULT => 'إطالات خفيفة فقط',
                'beginner' => 'إطالات بسيطة'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'breathing',
            'name' => 'تمارين تنفس',
            'name_en' => 'Breathing Exercises',
            'category' => CAT_LOW_IMPACT_ADULT,
            'difficulty' => LVL_EASY_ADULT,
            'duration' => '5 دقائق',
            'target_muscles' => 'الرئتين، الكور',
            'benefits' => 'تحسين التنفس والاسترخاء',
            'contraindications' => [],
            'modifications' => [
                HC_ASTHMA_ADULT => 'تنفس بطيء عميق'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
 
        // ====== BALANCE / CORE ======
        [
            'id' => 'bird_dog',
            'name' => 'بيرد دوج',
            'name_en' => 'Bird Dog',
            'category' => CAT_CORE_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '3 مجموعات × 10 لكل جانب',
            'target_muscles' => 'الكور، الظهر',
            'benefits' => 'توازن واستقرار',
            'video_url' => 'https://www.youtube.com/shorts/dAQ7hVe4x3g',
            'video_url_male' => 'https://www.youtube.com/shorts/dAQ7hVe4x3g',
            'video_url_female' => 'https://www.youtube.com/shorts/D-_-W9nQDM8',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_ADULT => 'أرجل صغيرة فقط',
                'beginner' => 'إحسان الأطراف'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'cat_cow',
            'name' => 'كات كاو',
            'name_en' => 'Cat Cow',
            'category' => CAT_CORE_ADULT,
            'difficulty' => LVL_EASY_ADULT,
            'duration' => '10 تكرارات',
            'target_muscles' => 'الظهر، البطن',
            'benefits' => 'مرونة العمود الفقري',
            'video_url' => 'https://www.youtube.com/shorts/2of247Kt0tU',
            'video_url_male' => 'https://www.youtube.com/shorts/Yetvc-6pkS4',
            'video_url_female' => 'https://www.youtube.com/shorts/2of247Kt0tU',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_ADULT => 'حركات صغيرة فقط'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ],
        [
            'id' => 'balance_exercises',
            'name' => 'تمارين توازن',
            'name_en' => 'Balance Exercises',
            'category' => CAT_CORE_ADULT,
            'difficulty' => LVL_MEDIUM_ADULT,
            'duration' => '5 دقائق',
            'target_muscles' => 'الكور، الساقين',
            'benefits' => 'تحسين التوازن',
            'video_url' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
            'video_url_male' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
            'video_url_female' => 'https://www.youtube.com/shorts/6u1FkpsISec',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_ADULT => 'وقوف متوازن فقط',
                'beginner' => 'بجانب حائط'
            ],
            'gender_focus' => 'both',
            'is_hiit' => false
        ]
    ];
}
 
/**
 * Filter exercises by health condition for adults
 */
function filterSafeAdultExercises(array $exercises, string $healthCondition): array {
    return array_filter($exercises, function($ex) use ($healthCondition) {
        // If healthy, all exercises allowed
        if (empty($healthCondition) || $healthCondition === 'healthy') {
            return true;
        }
 
        // Check contraindications
        if (in_array($healthCondition, $ex['contraindications'] ?? [])) {
            return false;
        }
 
        // Chronic conditions: no HIIT
        if (in_array($healthCondition, [HC_DIABETES_ADULT, HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_ASTHMA_ADULT])) {
            if ($ex['is_hiit'] ?? false) {
                return false;
            }
        }
 
        // Joint issues: no jumping
        if ($healthCondition === HC_JOINT_ADULT) {
            if (str_contains($ex['name'], 'قفز') || str_contains($ex['name'], 'نط')) {
                return false;
            }
            if ($ex['category'] === CAT_HIIT_ADULT) {
                return false;
            }
        }
 
        return true;
    });
}
 
/**
 * Get exercises by category for adults
 */
function getAdultExercisesByCategory(array $exercises, string $category): array {
    return array_values(array_filter($exercises, fn($ex) => $ex['category'] === $category));
}

function normalizeAdultExerciseKey(array $exercise): string {
    $key = (string)($exercise['name_en'] ?? $exercise['name'] ?? $exercise['id'] ?? '');
    $key = strtolower(trim($key));
    $key = preg_replace('/[^a-z0-9]+/', '_', $key);
    return trim((string)$key, '_');
}

function selectAdultPreferredExercises(array $exercises, array $preferredKeys, int $limit): array {
    $result = [];
    $seen = [];

    foreach ($exercises as $ex) {
        if (!is_array($ex)) continue;
        $key = normalizeAdultExerciseKey($ex);
        if ($key !== '') {
            $seen[$key] = $ex;
        }
    }

    foreach ($preferredKeys as $k) {
        if (isset($seen[$k])) {
            $result[] = $seen[$k];
            unset($seen[$k]);
            if (count($result) >= $limit) return $result;
        }
    }

    foreach ($exercises as $ex) {
        if (!is_array($ex)) continue;
        $key = normalizeAdultExerciseKey($ex);
        if ($key === '' || !isset($seen[$key])) continue;
        $result[] = $seen[$key];
        unset($seen[$key]);
        if (count($result) >= $limit) break;
    }

    return $result;
}

function pickAdultExercisesByKeys(array $exercises, array $keys): array {
    $want = array_fill_keys($keys, true);
    $out = [];
    foreach ($exercises as $ex) {
        if (!is_array($ex)) continue;
        $k = normalizeAdultExerciseKey($ex);
        if ($k !== '' && isset($want[$k])) {
            $out[] = $ex;
        }
    }
    return $out;
}

function normalizeAdultGender(string $gender): string {
    $g = strtolower(trim($gender));
    if ($g === 'ذكر' || $g === 'male' || $g === 'm' || $g === 'man' || $g === 'boy') return 'male';
    if ($g === 'انثى' || $g === 'أنثى' || $g === 'female' || $g === 'f' || $g === 'woman' || $g === 'girl') return 'female';
    return $g;
}

function normalizeAdultFitnessLevel(string $fitnessLevel): string {
    $lvl = strtolower(trim($fitnessLevel));
    $map = [
        'beginner' => 'beginner',
        'intermediate' => 'intermediate',
        'advanced' => 'advanced',
        'easy' => 'beginner',
        'medium' => 'intermediate',
        'hard' => 'advanced',
        'لا امارس' => 'beginner',
        'لا أمارس' => 'beginner',
        'مبتدئ' => 'beginner',
        'متوسط' => 'intermediate',
        'رياضي' => 'advanced',
        'متقدم' => 'advanced',
    ];
    return $map[$lvl] ?? $lvl;
}

function normalizeAdultGoal(string $goal): string {
    $g = strtolower(trim($goal));
    $map = [
        'muscle' => 'muscle',
        'muscle_gain' => 'muscle',
        'build_muscle' => 'muscle',
        'weight_loss' => 'weight_loss',
        'lose_weight' => 'weight_loss',
        'balance' => 'balance',
        'general_fitness' => 'balance',
        'mix' => 'balance',
        'بناء عضلات' => 'muscle',
        'تخسيس' => 'weight_loss',
        'إنقاص وزن' => 'weight_loss',
        'انقاص وزن' => 'weight_loss',
        'توازن' => 'balance',
        'لياقة' => 'balance',
        'لياقة عامة' => 'balance',
    ];
    return $map[$g] ?? $g;
}

function normalizeAdultHealthCondition(string $healthCondition): string {
    $hc = strtolower(trim($healthCondition));
    $map = [
        '' => '',
        'healthy' => '',
        'normal' => '',
        'سليم' => '',
        'diabetes' => HC_DIABETES_ADULT,
        'سكر' => HC_DIABETES_ADULT,
        'سكري' => HC_DIABETES_ADULT,
        'heart' => HC_HEART_ADULT,
        'قلب' => HC_HEART_ADULT,
        'pressure' => HC_PRESSURE_ADULT,
        'ضغط' => HC_PRESSURE_ADULT,
        'asthma' => HC_ASTHMA_ADULT,
        'ربو' => HC_ASTHMA_ADULT,
        'joint' => HC_JOINT_ADULT,
        'joints' => HC_JOINT_ADULT,
        'joint_pain' => HC_JOINT_ADULT,
        'المفاصل' => HC_JOINT_ADULT,
        'آلام مفاصل' => HC_JOINT_ADULT,
        'الم مفاصل' => HC_JOINT_ADULT,
        'chronic' => 'chronic',
        'مزمن' => 'chronic',
        'امراض مزمنه' => 'chronic',
        'أمراض مزمنة' => 'chronic',
    ];
    return $map[$hc] ?? $hc;
}

function adultPreferredOrderByScenario(string $healthCondition, string $goal, string $fitnessLevel, string $gender): array {
    $hc = normalizeAdultHealthCondition($healthCondition);
    $goal = normalizeAdultGoal($goal);
    $level = normalizeAdultFitnessLevel($fitnessLevel);
    $g = normalizeAdultGender($gender);

    // Health overrides (any goal)
    if ($hc === HC_JOINT_ADULT) {
        return ['light_squats', 'plank', 'stretching', 'bird_dog', 'cat_cow'];
    }

    if ($hc === 'chronic' || in_array($hc, [HC_DIABETES_ADULT, HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_ASTHMA_ADULT], true)) {
        return ['walking', 'breathing_exercises', 'light_squats', 'plank', 'stretching'];
    }

    // Goal balance
    if ($goal === 'balance') {
        return ['plank', 'bird_dog', 'balance_exercises', 'squats', 'stretching'];
    }

    // Healthy muscle
    if ($goal === 'muscle') {
        if ($level === 'beginner') {
            return ['push_ups', 'squats', 'lunges', 'plank', 'ab_workout'];
        }
        if ($level === 'intermediate') {
            return ['push_ups', 'squats', 'lunges', 'plank', 'side_plank'];
        }
        // advanced
        return ['push_ups', 'squats', 'lunges', 'plank', 'pull_ups'];
    }

    // Healthy weight loss
    if ($goal === 'weight_loss') {
        if ($level === 'beginner') {
            return ['jumping_jacks', 'running_in_place', 'high_knees', 'squats', 'plank'];
        }
        if ($level === 'intermediate') {
            return ['mountain_climbers', 'high_knees', 'jumping_jacks', 'squats', 'plank'];
        }
        // advanced HIIT
        return ['burpees', 'mountain_climbers', 'high_knees', 'jumping_jacks', 'fast_running'];
    }

    // Gender fallback focus
    if ($g === 'male') {
        return ['push_ups', 'pull_ups', 'squats', 'lunges', 'plank'];
    }
    if ($g === 'female') {
        return ['squats', 'lunges', 'plank', 'balance_exercises', 'stretching'];
    }

    return [];
}
 
/**
 * Generate safety notes for adults
 */
function generateAdultSafetyNotes(string $healthCondition, string $fitnessLevel): array {
    $notes = [];
 
    if ($healthCondition === HC_DIABETES_ADULT) {
        $notes[] = 'راقب مستوى السكر قبل وبعد التمرين';
        $notes[] = 'تجنب الجهد الشديد (HIIT)';
        $notes[] = 'احتفظ بمصدر سكر سريع بالقرب منك';
    }
 
    if ($healthCondition === HC_HEART_ADULT) {
        $notes[] = 'تجنب تمارين الشدة العالية تماماً';
        $notes[] = 'راقب ضربات القلب (ماكس 140 نبضة)';
        $notes[] = 'توقف فوراً عند أي ألم صدري';
    }
 
    if ($healthCondition === HC_PRESSURE_ADULT) {
        $notes[] = 'تجنب حمل الأثقال الثقيلة';
        $notes[] = 'لا تمسك النفس أثناء التمرين';
        $notes[] = 'راقب ضغطك قبل التمرين';
    }
 
    if ($healthCondition === HC_ASTHMA_ADULT) {
        $notes[] = 'احتفظ بجهاز الربو بالقرب منك';
        $notes[] = 'تجنب الجو البارد أو المغبر';
        $notes[] = 'استخدم بخاخ الوقاية إذا لزم الأمر';
    }
 
    if ($healthCondition === HC_JOINT_ADULT) {
        $notes[] = 'تجنب القفز والحركات المفاجئة';
        $notes[] = 'استخدم أسطح ناعمة';
        $notes[] = 'توقف عند أي ألم مفصلي';
    }
 
    if ($fitnessLevel === 'beginner') {
        $notes[] = 'ابدأ ببطء وزد الشدة تدريجياً';
        $notes[] = 'ركز على الشكل الصحيح أكثر من السرعة';
    }
 
    return $notes;
}
 
/**
 * Main recommendation function for adults (18-30)
 */
function getAdultExerciseRecommendation(array $profile): array {
    $age = (int)($profile['age'] ?? 0);
    $gender = normalizeAdultGender((string)($profile['gender'] ?? ''));
    $healthCondition = normalizeAdultHealthCondition((string)($profile['health_condition'] ?? ''));
    $fitnessLevel = normalizeAdultFitnessLevel((string)($profile['fitness_level'] ?? ''));
    $goal = normalizeAdultGoal((string)($profile['goal'] ?? ''));
    $timeAvailable = (int)($profile['time_available'] ?? 30);
 
    // Get all exercises
    $allExercises = getAdultExerciseLibrary();
 
    // Step 1: Filter by health condition (SAFETY FIRST)
    $safeExercises = filterSafeAdultExercises($allExercises, $healthCondition);
 
    // Step 2: Determine difficulty
    $targetDifficulty = match($fitnessLevel) {
        'beginner', '' => LVL_EASY_ADULT,
        'intermediate' => LVL_MEDIUM_ADULT,
        'advanced' => LVL_HARD_ADULT,
        default => LVL_MEDIUM_ADULT
    };
 
    // Chronic conditions: force easy
    if ($healthCondition === 'chronic' || in_array($healthCondition, [HC_DIABETES_ADULT, HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_ASTHMA_ADULT], true)) {
        $targetDifficulty = LVL_EASY_ADULT;
    }
 
    // Step 3: Filter by goal
    $selectedExercises = [];
 
    // Health overrides goal
    if ($healthCondition === HC_JOINT_ADULT) {
        $lowImpact = getAdultExercisesByCategory($safeExercises, CAT_LOW_IMPACT_ADULT);
        $core = getAdultExercisesByCategory($safeExercises, CAT_CORE_ADULT);
        $selectedExercises = array_merge($lowImpact, $core);
    } elseif ($healthCondition === 'chronic' || in_array($healthCondition, [HC_DIABETES_ADULT, HC_HEART_ADULT, HC_PRESSURE_ADULT, HC_ASTHMA_ADULT], true)) {
        $lowImpact = getAdultExercisesByCategory($safeExercises, CAT_LOW_IMPACT_ADULT);
        $core = getAdultExercisesByCategory($safeExercises, CAT_CORE_ADULT);
        $selectedExercises = array_merge($lowImpact, $core);
    }

    if (count($selectedExercises) === 0) switch ($goal) {
        case 'muscle': // بناء عضلات
            $strength = getAdultExercisesByCategory($safeExercises, CAT_STRENGTH_ADULT);
            $core = getAdultExercisesByCategory($safeExercises, CAT_CORE_ADULT);
            // Exclude HIIT for muscle building focus
            $selectedExercises = array_merge($strength, $core);
            // Add pull-ups for men if available and healthy
            if ($gender === 'male' && empty($healthCondition)) {
                $pullups = array_values(array_filter($safeExercises, fn($ex) => $ex['id'] === 'pullups'));
                $selectedExercises = array_merge($pullups, $selectedExercises);
            }
            break;
 
        case 'weight_loss': // تخسيس
            // HIIT allowed for healthy adults
            if (empty($healthCondition)) {
                $hiit = getAdultExercisesByCategory($safeExercises, CAT_HIIT_ADULT);
                $cardio = getAdultExercisesByCategory($safeExercises, CAT_CARDIO_ADULT);
                $selectedExercises = array_merge($hiit, $cardio);
            } else {
                // No HIIT for chronic conditions
                $cardio = getAdultExercisesByCategory($safeExercises, CAT_CARDIO_ADULT);
                // Filter out high intensity for chronic conditions
                $cardio = array_filter($cardio, fn($ex) => !$ex['is_hiit']);
                $core = getAdultExercisesByCategory($safeExercises, CAT_CORE_ADULT);
                $selectedExercises = array_merge($cardio, $core);
            }
            break;
 
        case 'balance': // توازن
            $core = getAdultExercisesByCategory($safeExercises, CAT_CORE_ADULT);
            $lowImpact = getAdultExercisesByCategory($safeExercises, CAT_LOW_IMPACT_ADULT);
            $selectedExercises = array_merge($core, $lowImpact);
            break;
 
        default: // Mix
            if (empty($healthCondition) && $fitnessLevel === 'advanced') {
                // Include HIIT for healthy advanced users
                $strength = getAdultExercisesByCategory($safeExercises, CAT_STRENGTH_ADULT);
                $hiit = getAdultExercisesByCategory($safeExercises, CAT_HIIT_ADULT);
                $core = getAdultExercisesByCategory($safeExercises, CAT_CORE_ADULT);
                $selectedExercises = array_merge($strength, $hiit, $core);
            } else {
                $strength = getAdultExercisesByCategory($safeExercises, CAT_STRENGTH_ADULT);
                $cardio = getAdultExercisesByCategory($safeExercises, CAT_CARDIO_ADULT);
                $core = getAdultExercisesByCategory($safeExercises, CAT_CORE_ADULT);
                $selectedExercises = array_merge($strength, $cardio, $core);
            }
    }
 
    // Step 4: Sort by difficulty
    usort($selectedExercises, function($a, $b) use ($targetDifficulty) {
        $diffOrder = ['easy' => 1, 'medium' => 2, 'hard' => 3];
        $aDiff = $diffOrder[$a['difficulty']] ?? 2;
        $bDiff = $diffOrder[$b['difficulty']] ?? 2;
        return $aDiff - $bDiff;
    });
 
    // Step 5: Select based on time
    // 15 min = 3 exercises, 30 min = 5 exercises, 45+ min = 7 exercises
    $exerciseCount = match(true) {
        $timeAvailable <= 15 => 3,
        $timeAvailable <= 30 => 5,
        default => 7
    };
 
    $preferredOrder = adultPreferredOrderByScenario($healthCondition, $goal, $fitnessLevel, $gender);
    $usedPreferredOrder = (count($preferredOrder) > 0);
    if (count($preferredOrder) > 0) {
        $mustInclude = pickAdultExercisesByKeys($safeExercises, $preferredOrder);
        if (count($mustInclude) > 0) {
            $selectedExercises = array_merge($selectedExercises, $mustInclude);
        }
        $selectedExercises = selectAdultPreferredExercises($selectedExercises, $preferredOrder, $exerciseCount);
    }

    $finalExercises = array_slice($selectedExercises, 0, $exerciseCount);

    // Step 6: Gender-specific prioritization
    if (!$usedPreferredOrder && $gender === 'male') {
        // Prioritize upper body strength
        usort($finalExercises, function($a, $b) {
            $aIsUpper = str_contains($a['target_muscles'] ?? '', 'الصدر') ||
                       str_contains($a['target_muscles'] ?? '', 'الظهر');
            $bIsUpper = str_contains($b['target_muscles'] ?? '', 'الصدر') ||
                       str_contains($b['target_muscles'] ?? '', 'الظهر');
            return $bIsUpper <=> $aIsUpper;
        });
    } elseif (!$usedPreferredOrder && $gender === 'female') {
        // Prioritize lower body and core
        usort($finalExercises, function($a, $b) {
            $aIsLower = str_contains($a['target_muscles'] ?? '', 'الفخذين') ||
                       str_contains($a['target_muscles'] ?? '', 'الأرداف');
            $bIsLower = str_contains($b['target_muscles'] ?? '', 'الفخذين') ||
                       str_contains($b['target_muscles'] ?? '', 'الأرداف');
            return $bIsLower <=> $aIsLower;
        });
    }
 
    // Step 7: Add modifications and notes
    foreach ($finalExercises as &$ex) {
        if (isset($ex['modifications'][$healthCondition])) {
            $ex['modification_note'] = $ex['modifications'][$healthCondition];
        }
        if ($fitnessLevel === 'beginner' && isset($ex['modifications']['beginner'])) {
            $ex['modification_note'] = $ex['modifications']['beginner'];
        }
    }
 
    return [
        'exercises' => $finalExercises,
        'total_duration' => $timeAvailable,
        'difficulty' => $targetDifficulty,
        'goal' => $goal,
        'health_condition' => $healthCondition,
        'safety_notes' => generateAdultSafetyNotes($healthCondition, $fitnessLevel)
    ];
}
