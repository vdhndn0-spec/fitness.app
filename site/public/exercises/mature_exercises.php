<?php
/**
 * Mature Adult Exercise Recommendation System (Ages 30-50)
 * Balance between effectiveness and safety, focus on joints and heart health
 */

// Constants
const LVL_EASY_MATURE = 'easy';
const LVL_MEDIUM_MATURE = 'medium';
const LVL_HARD_MATURE = 'hard';

const CAT_STRENGTH_MATURE = 'strength';
const CAT_CARDIO_MATURE = 'cardio';
const CAT_LOW_IMPACT_MATURE = 'low_impact';
const CAT_CORE_MATURE = 'core';
const CAT_BACK_MATURE = 'back';

const HC_HEALTHY_MATURE = '';
const HC_DIABETES_MATURE = 'diabetes';
const HC_HEART_MATURE = 'heart';
const HC_PRESSURE_MATURE = 'pressure';
const HC_ASTHMA_MATURE = 'asthma';
const HC_JOINT_MATURE = 'joint';

/**
 * Check if user is a mature adult (30-50 years)
 */
function isMature(int $age): bool {
    return $age >= 30 && $age <= 50;
}

/**
 * Get complete mature exercise library - focus on safety and joint protection
 */
function getMatureExerciseLibrary(): array {
    return [
        // ====== STRENGTH (Safe) ======
        [
            'id' => 'pushups',
            'name' => 'تمارين الضغط',
            'name_en' => 'Push-ups',
            'category' => CAT_STRENGTH_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '3 مجموعات × 10-12',
            'target_muscles' => 'الصدر، الكتفين، الذراعين',
            'benefits' => 'بناء قوة الجسم العلوي',
            'instructions' => 'احافظ على ظهر مستقيم، انزل ببطء حتى تلامس صدرك الأرض، ثم اصعد. للمبتدئين: ابدأ بالضغط على الركب.',
            'video_url' => '',
            'video_url_female' => 'https://www.youtube.com/watch?v=_x71MC6rKQw',
            'contraindications' => [HC_HEART_MATURE, HC_PRESSURE_MATURE],
            'modifications' => [
                HC_DIABETES_MATURE => 'أداء بطيء مع راحة 60 ثانية',
                HC_ASTHMA_MATURE => 'تجنب الإجهاد، راقب التنفس',
                HC_JOINT_MATURE => 'ضغط مائل أو على الركبتين',
                'beginner' => 'على الركبتين'
            ],
            'gender_focus' => 'male',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'squats',
            'name' => 'السكوات',
            'name_en' => 'Squats',
            'category' => CAT_STRENGTH_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '3 مجموعات × 15',
            'target_muscles' => 'الفخذين، الأرداف، الساقين',
            'benefits' => 'تقوية الجسم السفلي',
            'instructions' => 'قف بقدمين بعرض الكتفين، انزل كأنك تجلس على كرسي حتى تكون الركبتان بزاوية 90 درجة، ثم اصعد.',
            'video_url' => '',
            'contraindications' => [HC_JOINT_MATURE],
            'modifications' => [
                HC_JOINT_MATURE => 'سكوات نصفية فقط',
                HC_PRESSURE_MATURE => 'أداء بطيء دون شد',
                HC_HEART_MATURE => 'أداء مريح بدون إجهاد',
                'beginner' => 'مع كرسي للدعم'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'lunges',
            'name' => 'اللانجز',
            'name_en' => 'Lunges',
            'category' => CAT_STRENGTH_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '3 مجموعات × 10 لكل رجل',
            'target_muscles' => 'الفخذين، الأرداف',
            'benefits' => 'توازن وقوة الساقين',
            'instructions' => 'خطوة إلى الأمام برجل واحدة، انزل حتى تكون الركبة الخلفية قريبة من الأرض. اصعد وكرر مع الرجل الأخرى.',
            'video_url' => 'https://www.youtube.com/shorts/Nopu1DelXwE',
            'video_url_male' => 'https://www.youtube.com/shorts/Nopu1DelXwE',
            'video_url_female' => 'https://www.youtube.com/shorts/ShJPetMefGw',
            'contraindications' => [HC_JOINT_MATURE],
            'modifications' => [
                HC_JOINT_MATURE => 'خطوات صغيرة ثابتة',
                HC_PRESSURE_MATURE => 'أداء بطيء جداً',
                'beginner' => 'مع تثبيت جانبي'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'plank',
            'name' => 'البلانك',
            'name_en' => 'Plank',
            'category' => CAT_CORE_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '3 × 30-45 ثانية',
            'target_muscles' => 'البطن، الظهر، الكور',
            'benefits' => 'تقوية عضلات الكور',
            'instructions' => 'استلقِ على بطنك، ارفع جسمك على المرفقين وأصابع القدمين. احافظ على ظهر مستقيم.',
            'video_url' => '',
            'video_url_female' => 'https://www.youtube.com/shorts/RfilUpGylpw',
            'contraindications' => [HC_HEART_MATURE, HC_PRESSURE_MATURE],
            'modifications' => [
                HC_DIABETES_MATURE => '20-30 ثانية مع راحة',
                HC_ASTHMA_MATURE => 'تجنب حبس النفس',
                HC_JOINT_MATURE => 'بلانك على الركبتين',
                'beginner' => '15-20 ثانية'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'ab_workout',
            'name' => 'تمارين البطن',
            'name_en' => 'Ab Workout',
            'category' => CAT_CORE_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '3 مجموعات × 12',
            'target_muscles' => 'البطن',
            'benefits' => 'تقوية عضلات البطن',
            'video_url' => 'https://www.youtube.com/shorts/Fdbqt66rl6A',
            'video_url_male' => 'https://www.youtube.com/shorts/Fdbqt66rl6A',
            'video_url_female' => 'https://www.youtube.com/watch?v=zaxkSoSwKo4',
            'contraindications' => [HC_HEART_MATURE],
            'modifications' => [
                HC_PRESSURE_MATURE => 'أداء بطيء',
                HC_JOINT_MATURE => 'بطن بسيطة بدون قفز',
                'beginner' => '8-10 تكرارات'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'back_exercises',
            'name' => 'تمارين ظهر خفيفة',
            'name_en' => 'Light Back Exercises',
            'category' => CAT_BACK_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '3 مجموعات × 12',
            'target_muscles' => 'الظهر، الكور',
            'benefits' => 'تقوية الظهر والوقاية من الألم',
            'contraindications' => [HC_HEART_MATURE, HC_JOINT_MATURE],
            'modifications' => [
                HC_PRESSURE_MATURE => 'بدون حمل أوزان',
                'beginner' => 'بطيء مع التركيز على الشكل'
            ],
            'gender_focus' => 'male',
            'intensity' => 'moderate'
        ],

        // ====== CARDIO (Moderate) ======
        [
            'id' => 'brisk_walking',
            'name' => 'مشي سريع',
            'name_en' => 'Brisk Walking',
            'category' => CAT_CARDIO_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '15-20 دقيقة',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'تحسين القلب والدورة الدموية',
            'contraindications' => [HC_HEART_MATURE, HC_JOINT_MATURE],
            'modifications' => [
                HC_DIABETES_MATURE => 'مشي معتدل 10 دقائق',
                HC_HEART_MATURE => 'مشي مريح 5-10 دقائق',
                HC_PRESSURE_MATURE => 'مشي بطيء',
                HC_ASTHMA_MATURE => 'مشي في هواء نظيف',
                'beginner' => 'مشي عادي 10 دقائق'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'light_jogging',
            'name' => 'جري خفيف',
            'name_en' => 'Light Jogging',
            'category' => CAT_CARDIO_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '10-15 دقيقة',
            'target_muscles' => 'الساقين، القلب',
            'benefits' => 'تقوية القلب بدون إجهاد',
            'contraindications' => [HC_HEART_MATURE, HC_PRESSURE_MATURE, HC_JOINT_MATURE, HC_ASTHMA_MATURE],
            'modifications' => [
                HC_DIABETES_MATURE => 'هرولة خفيفة 5 دقائق',
                'beginner' => 'مشي سريع'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'light_jumping_jacks',
            'name' => 'جمبنج جاكس خفيف',
            'name_en' => 'Light Jumping Jacks',
            'category' => CAT_CARDIO_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '30 ثانية',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'رفع معدل ضربات القلب',
            'video_url' => 'https://www.youtube.com/shorts/636IhyuvN-4',
            'video_url_male' => 'https://www.youtube.com/shorts/636IhyuvN-4',
            'video_url_female' => 'https://www.youtube.com/shorts/yg3KQQn3QWg',
            'contraindications' => [HC_HEART_MATURE, HC_PRESSURE_MATURE, HC_JOINT_MATURE, HC_ASTHMA_MATURE],
            'modifications' => [
                HC_DIABETES_MATURE => '20 ثانية معيّنة',
                'beginner' => 'خطوات جانبية بدون قفز'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'stationary_bike',
            'name' => 'دراجة ثابتة',
            'name_en' => 'Stationary Bike',
            'category' => CAT_CARDIO_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '15-20 دقيقة',
            'target_muscles' => 'الساقين، القلب',
            'benefits' => 'كارديو منخفض الضغط على المفاصل',
            'contraindications' => [HC_HEART_MATURE],
            'modifications' => [
                HC_JOINT_MATURE => 'مقاومة خفيفة',
                HC_PRESSURE_MATURE => 'بطيء مع مراقبة النبض',
                'beginner' => '10 دقائق خفيفة'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'step_exercise',
            'name' => 'تمارين الدرج',
            'name_en' => 'Step Exercise',
            'category' => CAT_CARDIO_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '10 دقيقة',
            'target_muscles' => 'الساقين، الأرداف',
            'benefits' => 'كارديو + تقوية',
            'contraindications' => [HC_HEART_MATURE, HC_JOINT_MATURE],
            'modifications' => [
                HC_PRESSURE_MATURE => 'بطيء على درج واحد',
                HC_DIABETES_MATURE => '5 دقائق مع راحة',
                'beginner' => 'خطوات صغيرة'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],

        // ====== LOW IMPACT (Very Important) ======
        [
            'id' => 'walking',
            'name' => 'المشي',
            'name_en' => 'Walking',
            'category' => CAT_LOW_IMPACT_MATURE,
            'difficulty' => LVL_EASY_MATURE,
            'duration' => '15-20 دقيقة',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'تحسين الدورة الدموية والمفاصل',
            'contraindications' => [],
            'modifications' => [
                HC_DIABETES_MATURE => 'مشي معتدل 10 دقائق',
                HC_HEART_MATURE => 'مشي بطيء 10 دقائق',
                HC_PRESSURE_MATURE => 'مشي مريح',
                HC_JOINT_MATURE => 'مشي على أسطح ناعمة'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'light_squats',
            'name' => 'سكوات خفيف',
            'name_en' => 'Light Squats',
            'category' => CAT_LOW_IMPACT_MATURE,
            'difficulty' => LVL_EASY_MATURE,
            'duration' => '3 مجموعات × 10',
            'target_muscles' => 'الفخذين',
            'benefits' => 'تقوية خفيفة للمفاصل',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_MATURE => 'نصف سكوات فقط',
                HC_HEART_MATURE => 'بطيء ومريح',
                'beginner' => 'مع كرسي'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'stretching',
            'name' => 'تمارين إطالة',
            'name_en' => 'Stretching',
            'category' => CAT_LOW_IMPACT_MATURE,
            'difficulty' => LVL_EASY_MATURE,
            'duration' => '10-15 دقيقة',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'مرونة واسترخاء ووقاية من الإصابات',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_MATURE => 'إطالات خفيفة جداً',
                'beginner' => 'إطالات بسيطة'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'breathing',
            'name' => 'تمارين تنفس',
            'name_en' => 'Breathing Exercises',
            'category' => CAT_LOW_IMPACT_MATURE,
            'difficulty' => LVL_EASY_MATURE,
            'duration' => '5-10 دقيقة',
            'target_muscles' => 'الرئتين، الكور',
            'benefits' => 'تحسين التنفس والاسترخاء',
            'contraindications' => [],
            'modifications' => [
                HC_ASTHMA_MATURE => 'تنفس بطيء عميق',
                HC_HEART_MATURE => 'تنفس مريح'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],

        // ====== BALANCE & CORE ======
        [
            'id' => 'bird_dog',
            'name' => 'بيرد دوج',
            'name_en' => 'Bird Dog',
            'category' => CAT_CORE_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '3 مجموعات × 8 لكل جانب',
            'target_muscles' => 'الكور، الظهر',
            'benefits' => 'توازن واستقرار العمود الفقري',
            'video_url' => 'https://www.youtube.com/shorts/dAQ7hVe4x3g',
            'video_url_male' => 'https://www.youtube.com/shorts/dAQ7hVe4x3g',
            'video_url_female' => 'https://www.youtube.com/shorts/D-_-W9nQDM8',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_MATURE => 'أطراف صغيرة فقط',
                'beginner' => 'ثبات بطيء'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ],
        [
            'id' => 'cat_cow',
            'name' => 'كات كاو',
            'name_en' => 'Cat Cow',
            'category' => CAT_CORE_MATURE,
            'difficulty' => LVL_EASY_MATURE,
            'duration' => '10 تكرارات',
            'target_muscles' => 'الظهر، البطن',
            'benefits' => 'مرونة العمود الفقري',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_MATURE => 'حركات صغيرة جداً'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low',
            'instructions' => 'قف بقدمين بعرض الكتفين، انزل ببطء حتى تكون الركبتان بزاوية 90 درجة، ثم اصعد.',
            'video_url' => 'https://www.youtube.com/shorts/Yetvc-6pkS4',
            'video_url_male' => 'https://www.youtube.com/shorts/Yetvc-6pkS4',
            'video_url_female' => 'https://www.youtube.com/shorts/2of247Kt0tU'
        ],
        [
            'id' => 'balance_exercises',
            'name' => 'تمارين توازن',
            'name_en' => 'Balance Exercises',
            'category' => CAT_CORE_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '5-8 دقيقة',
            'target_muscles' => 'الكور، الساقين',
            'benefits' => 'تحسين التوازن ومنع السقوط',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_MATURE => 'وقوف متوازن بجانب حائط',
                'beginner' => 'بجانب حائط للأمان'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate',
            'instructions' => 'قف بقدمين بعرض الكتفين، انزل ببطء حتى تكون الركبتان بزاوية 90 درجة، ثم اصعد.',
            'video_url' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
            'video_url_male' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
            'video_url_female' => 'https://www.youtube.com/shorts/6u1FkpsISec'
        ],

        // ====== LIGHT CARDIO FOR ATHLETIC (No extreme intensity) ======
        [
            'id' => 'moderate_jog',
            'name' => 'جري متوسط',
            'name_en' => 'Moderate Jog',
            'category' => CAT_CARDIO_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '15-20 دقيقة',
            'target_muscles' => 'الساقين، القلب',
            'benefits' => 'تقوية القلب بحذر',
            'contraindications' => [HC_HEART_MATURE, HC_PRESSURE_MATURE, HC_JOINT_MATURE, HC_ASTHMA_MATURE, HC_DIABETES_MATURE],
            'modifications' => [
                'beginner' => 'مشي سريع'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate',
            'instructions' => 'قف بقدمين بعرض الكتفين، انزل ببطء حتى تكون الركبتان بزاوية 90 درجة، ثم اصعد.',
            'video_url' => 'https://www.youtube.com/watch?v=a9KSfaSVG4U'
        ],
        [
            'id' => 'light_mountain_climbers',
            'name' => 'ماونتن كلايمرز خفيف',
            'name_en' => 'Light Mountain Climbers',
            'category' => CAT_CARDIO_MATURE,
            'difficulty' => LVL_MEDIUM_MATURE,
            'duration' => '20 ثانية',
            'target_muscles' => 'البطن، الكتفين',
            'benefits' => 'كارديو خفيف',
            'contraindications' => [HC_HEART_MATURE, HC_PRESSURE_MATURE, HC_JOINT_MATURE, HC_ASTHMA_MATURE],
            'modifications' => [
                'beginner' => 'بطيء جداً'
            ],
            'gender_focus' => 'both',
            'intensity' => 'moderate'
        ]
    ];
}

/**
 * Filter exercises by health condition for mature adults
 * Very conservative - safety first
 */
function filterSafeMatureExercises(array $exercises, string $healthCondition): array {
    return array_filter($exercises, function($ex) use ($healthCondition) {
        // If healthy, allow all but still filter out extreme intensity
        if (empty($healthCondition) || $healthCondition === 'healthy') {
            // For mature adults, even healthy ones avoid extreme intensity
            return ($ex['intensity'] ?? '') !== 'high';
        }

        // Check contraindications
        if (in_array($healthCondition, $ex['contraindications'] ?? [])) {
            return false;
        }

        // Chronic conditions: only low impact and safe exercises
        if (in_array($healthCondition, [HC_DIABETES_MATURE, HC_HEART_MATURE, HC_PRESSURE_MATURE, HC_ASTHMA_MATURE])) {
            // Only low intensity for chronic conditions
            if (($ex['intensity'] ?? '') !== 'low') {
                return false;
            }
            // No cardio except walking
            if ($ex['category'] === CAT_CARDIO_MATURE && $ex['id'] !== 'walking') {
                return false;
            }
        }

        // Joint issues: only low impact
        if ($healthCondition === HC_JOINT_MATURE) {
            if ($ex['category'] !== CAT_LOW_IMPACT_MATURE && $ex['category'] !== CAT_CORE_MATURE) {
                return false;
            }
            // No jumping or high impact
            if (str_contains($ex['name'], 'قفز') || str_contains($ex['name'], 'جري')) {
                return false;
            }
        }

        return true;
    });
}

/**
 * Get exercises by category for mature adults
 */
function getMatureExercisesByCategory(array $exercises, string $category): array {
    return array_values(array_filter($exercises, fn($ex) => $ex['category'] === $category));
}

function normalizeMatureExerciseKey(array $exercise): string {
    $key = (string)($exercise['name_en'] ?? $exercise['name'] ?? $exercise['id'] ?? '');
    $key = strtolower(trim($key));
    $key = preg_replace('/[^a-z0-9]+/', '_', $key);
    return trim((string)$key, '_');
}

function selectMaturePreferredExercises(array $exercises, array $preferredKeys, int $limit): array {
    $result = [];
    $seen = [];

    foreach ($exercises as $ex) {
        if (!is_array($ex)) continue;
        $key = normalizeMatureExerciseKey($ex);
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
        $key = normalizeMatureExerciseKey($ex);
        if ($key === '' || !isset($seen[$key])) continue;
        $result[] = $seen[$key];
        unset($seen[$key]);
        if (count($result) >= $limit) break;
    }

    return $result;
}

function pickMatureExercisesByKeys(array $exercises, array $keys): array {
    $want = array_fill_keys($keys, true);
    $out = [];
    foreach ($exercises as $ex) {
        if (!is_array($ex)) continue;
        $k = normalizeMatureExerciseKey($ex);
        if ($k !== '' && isset($want[$k])) {
            $out[] = $ex;
        }
    }
    return $out;
}

function normalizeMatureGender(string $gender): string {
    $g = strtolower(trim($gender));
    if ($g === 'ذكر' || $g === 'male' || $g === 'm' || $g === 'man' || $g === 'boy') return 'male';
    if ($g === 'انثى' || $g === 'أنثى' || $g === 'female' || $g === 'f' || $g === 'woman' || $g === 'girl') return 'female';
    return $g;
}

function normalizeMatureFitnessLevel(string $fitnessLevel): string {
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

function normalizeMatureGoal(string $goal): string {
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

function normalizeMatureHealthCondition(string $healthCondition): string {
    $hc = strtolower(trim($healthCondition));
    $map = [
        '' => '',
        'healthy' => '',
        'normal' => '',
        'سليم' => '',
        'diabetes' => HC_DIABETES_MATURE,
        'سكر' => HC_DIABETES_MATURE,
        'سكري' => HC_DIABETES_MATURE,
        'heart' => HC_HEART_MATURE,
        'قلب' => HC_HEART_MATURE,
        'pressure' => HC_PRESSURE_MATURE,
        'ضغط' => HC_PRESSURE_MATURE,
        'asthma' => HC_ASTHMA_MATURE,
        'ربو' => HC_ASTHMA_MATURE,
        'joint' => HC_JOINT_MATURE,
        'joints' => HC_JOINT_MATURE,
        'joint_pain' => HC_JOINT_MATURE,
        'المفاصل' => HC_JOINT_MATURE,
        'آلام مفاصل' => HC_JOINT_MATURE,
        'الم مفاصل' => HC_JOINT_MATURE,
        'chronic' => 'chronic',
        'مزمن' => 'chronic',
        'امراض مزمنه' => 'chronic',
        'أمراض مزمنة' => 'chronic',
    ];
    return $map[$hc] ?? $hc;
}

function maturePreferredOrderByScenario(string $healthCondition, string $goal, string $fitnessLevel, string $gender): array {
    $hc = normalizeMatureHealthCondition($healthCondition);
    $goal = normalizeMatureGoal($goal);
    $level = normalizeMatureFitnessLevel($fitnessLevel);
    $g = normalizeMatureGender($gender);

    // Health overrides (any goal)
    if ($hc === HC_JOINT_MATURE) {
        return ['light_squats', 'plank', 'stretching', 'bird_dog', 'cat_cow'];
    }
    if ($hc === 'chronic' || in_array($hc, [HC_DIABETES_MATURE, HC_HEART_MATURE, HC_PRESSURE_MATURE, HC_ASTHMA_MATURE], true)) {
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
        // intermediate/advanced
        return ['push_ups', 'squats', 'lunges', 'plank', 'light_back_exercises'];
    }

    // Healthy weight loss
    if ($goal === 'weight_loss') {
        if ($level === 'beginner') {
            return ['brisk_walking', 'light_jumping_jacks', 'squats', 'plank', 'step_exercise'];
        }
        if ($level === 'intermediate') {
            return ['brisk_walking', 'light_jogging', 'step_exercise', 'squats', 'plank'];
        }
        // advanced (no extreme intensity)
        return ['moderate_jog', 'light_jumping_jacks', 'light_mountain_climbers', 'squats', 'plank'];
    }

    // Gender fallback focus
    if ($g === 'male') {
        return ['push_ups', 'squats', 'lunges', 'plank', 'light_back_exercises'];
    }
    if ($g === 'female') {
        return ['squats', 'lunges', 'plank', 'balance_exercises', 'stretching'];
    }

    return [];
}

/**
 * Generate safety notes for mature adults
 * Emphasize warm-up and joint protection
 */
function generateMatureSafetyNotes(string $healthCondition, string $fitnessLevel): array {
    $notes = [];

    // Essential notes for all mature adults
    $notes[] = '🔥 الإحماء ضروري - لا تتخطاه أبداً';
    $notes[] = '🧘 التمدد بعد التمرين مهم للغاية';
    $notes[] = '⚠️ توقف فوراً عند أي ألم أو ضيق';

    if ($healthCondition === HC_DIABETES_MATURE) {
        $notes[] = 'راقب مستوى السكر قبل وبعد التمرين';
        $notes[] = 'تجنب الجهد الشديد تماماً';
        $notes[] = 'احتفظ بمصدر سكر سريع';
    }

    if ($healthCondition === HC_HEART_MATURE) {
        $notes[] = 'تجنب أي تمارين شاقة';
        $notes[] = 'راقب ضربات القلب (ماكس 130 نبضة)';
        $notes[] = 'توقف عند أي ألم صدري أو دوخة';
    }

    if ($healthCondition === HC_PRESSURE_MATURE) {
        $notes[] = 'لا تحمل أوزان ثقيلة';
        $notes[] = 'لا تمسك النفس أثناء التمرين';
        $notes[] = 'راقب ضغطك قبل التمرين';
    }

    if ($healthCondition === HC_ASTHMA_MATURE) {
        $notes[] = 'احتفظ بجهاز الربو بالقرب';
        $notes[] = 'تجنب الجو البارد أو المغبر';
        $notes[] = 'تنفس بعمق وبهدوء';
    }

    if ($healthCondition === HC_JOINT_MATURE) {
        $notes[] = 'تجنب القفز والحركات المفاجئة';
        $notes[] = 'استخدم أسطح ناعمة ومريحة';
        $notes[] = 'ركز على تمارين المياه إن أمكن';
    }

    if ($fitnessLevel === 'beginner') {
        $notes[] = 'ابدأ ببطء وزد تدريجياً';
        $notes[] = 'ركز على الشكل الصحيح';
    }

    return $notes;
}

/**
 * Main recommendation function for mature adults (30-50)
 * Conservative approach - safety over intensity
 */
function getMatureExerciseRecommendation(array $profile): array {
    $age = (int)($profile['age'] ?? 0);
    $gender = normalizeMatureGender((string)($profile['gender'] ?? ''));
    $healthCondition = normalizeMatureHealthCondition((string)($profile['health_condition'] ?? ''));
    $fitnessLevel = normalizeMatureFitnessLevel((string)($profile['fitness_level'] ?? ''));
    $goal = normalizeMatureGoal((string)($profile['goal'] ?? ''));
    $timeAvailable = (int)($profile['time_available'] ?? 30);

    // Get all exercises
    $allExercises = getMatureExerciseLibrary();

    // Step 1: Filter by health condition (SAFETY FIRST - very conservative)
    $safeExercises = filterSafeMatureExercises($allExercises, $healthCondition);

    // Step 2: Determine difficulty - conservative for mature adults
    $targetDifficulty = match($fitnessLevel) {
        'beginner', '' => LVL_EASY_MATURE,
        'intermediate' => LVL_MEDIUM_MATURE,
        'advanced' => LVL_MEDIUM_MATURE, // Even advanced mature adults stick to medium
        default => LVL_MEDIUM_MATURE
    };

    // Chronic conditions or joints: force easy
    if ($healthCondition === 'chronic' || in_array($healthCondition, [HC_DIABETES_MATURE, HC_HEART_MATURE, HC_PRESSURE_MATURE, HC_ASTHMA_MATURE, HC_JOINT_MATURE], true)) {
        $targetDifficulty = LVL_EASY_MATURE;
    }

    // Step 3: Filter by goal
    $selectedExercises = [];

    // Health overrides goal
    if ($healthCondition === HC_JOINT_MATURE) {
        $lowImpact = getMatureExercisesByCategory($safeExercises, CAT_LOW_IMPACT_MATURE);
        $core = getMatureExercisesByCategory($safeExercises, CAT_CORE_MATURE);
        $selectedExercises = array_merge($lowImpact, $core);
    } elseif ($healthCondition === 'chronic' || in_array($healthCondition, [HC_DIABETES_MATURE, HC_HEART_MATURE, HC_PRESSURE_MATURE, HC_ASTHMA_MATURE], true)) {
        $lowImpact = getMatureExercisesByCategory($safeExercises, CAT_LOW_IMPACT_MATURE);
        $core = getMatureExercisesByCategory($safeExercises, CAT_CORE_MATURE);
        $selectedExercises = array_merge($lowImpact, $core);
    }

    if (count($selectedExercises) === 0) switch ($goal) {
        case 'muscle': // بناء عضلات - moderate strength focus
            $strength = getMatureExercisesByCategory($safeExercises, CAT_STRENGTH_MATURE);
            $core = getMatureExercisesByCategory($safeExercises, CAT_CORE_MATURE);
            $back = getMatureExercisesByCategory($safeExercises, CAT_BACK_MATURE);
            $selectedExercises = array_merge($strength, $core, $back);
            break;

        case 'weight_loss': // تخسيس - moderate cardio focus
            $cardio = getMatureExercisesByCategory($safeExercises, CAT_CARDIO_MATURE);
            // Filter to only moderate intensity for weight loss
            $cardio = array_filter($cardio, fn($ex) => ($ex['intensity'] ?? '') !== 'high');
            $core = getMatureExercisesByCategory($safeExercises, CAT_CORE_MATURE);
            $selectedExercises = array_merge($cardio, $core);
            break;

        case 'balance': // توازن - focus on core and low impact
            $core = getMatureExercisesByCategory($safeExercises, CAT_CORE_MATURE);
            $lowImpact = getMatureExercisesByCategory($safeExercises, CAT_LOW_IMPACT_MATURE);
            $selectedExercises = array_merge($core, $lowImpact);
            break;

        default: // Mix - balanced approach
            $strength = getMatureExercisesByCategory($safeExercises, CAT_STRENGTH_MATURE);
            $cardio = getMatureExercisesByCategory($safeExercises, CAT_CARDIO_MATURE);
            $core = getMatureExercisesByCategory($safeExercises, CAT_CORE_MATURE);
            // Limit cardio to moderate for mature adults
            $cardio = array_filter($cardio, fn($ex) => ($ex['intensity'] ?? '') !== 'high');
            $selectedExercises = array_merge($strength, $cardio, $core);
    }

    // Step 4: Sort by difficulty (easiest first)
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

    $preferredOrder = maturePreferredOrderByScenario($healthCondition, $goal, $fitnessLevel, $gender);
    $usedPreferredOrder = (count($preferredOrder) > 0);
    if (count($preferredOrder) > 0) {
        $mustInclude = pickMatureExercisesByKeys($safeExercises, $preferredOrder);
        if (count($mustInclude) > 0) {
            $selectedExercises = array_merge($selectedExercises, $mustInclude);
        }
        $selectedExercises = selectMaturePreferredExercises($selectedExercises, $preferredOrder, $exerciseCount);
    }

    $finalExercises = array_slice($selectedExercises, 0, $exerciseCount);

    // Step 6: Gender-specific prioritization
    if (!$usedPreferredOrder && $gender === 'male') {
        // Prioritize upper body strength and back
        usort($finalExercises, function($a, $b) {
            $aIsUpper = str_contains($a['target_muscles'] ?? '', 'الصدر') ||
                       str_contains($a['target_muscles'] ?? '', 'الظهر') ||
                       $a['category'] === CAT_BACK_MATURE;
            $bIsUpper = str_contains($b['target_muscles'] ?? '', 'الصدر') ||
                       str_contains($b['target_muscles'] ?? '', 'الظهر') ||
                       $b['category'] === CAT_BACK_MATURE;
            return $bIsUpper <=> $aIsUpper;
        });
    } elseif (!$usedPreferredOrder && $gender === 'female') {
        // Prioritize lower body, balance, and flexibility
        usort($finalExercises, function($a, $b) {
            $aIsLower = str_contains($a['target_muscles'] ?? '', 'الفخذين') ||
                       str_contains($a['target_muscles'] ?? '', 'الأرداف') ||
                       $a['name'] === 'تمارين توازن' ||
                       $a['name'] === 'تمارين إطالة';
            $bIsLower = str_contains($b['target_muscles'] ?? '', 'الفخذين') ||
                       str_contains($b['target_muscles'] ?? '', 'الأرداف') ||
                       $b['name'] === 'تمارين توازن' ||
                       $b['name'] === 'تمارين إطالة';
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
        'safety_notes' => generateMatureSafetyNotes($healthCondition, $fitnessLevel)
    ];
}
