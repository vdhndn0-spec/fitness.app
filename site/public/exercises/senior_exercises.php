<?php
/**
 * Senior Exercise Recommendation System (Ages 50+)
 * Maximum safety focus - medical-grade safety rules
 * NO intense exercises, focus on heart, joints, and balance
 */
 
// Constants
const LVL_EASY_SENIOR = 'easy';
const LVL_MEDIUM_SENIOR = 'medium';
 
const CAT_SAFE_SENIOR = 'safe';
const CAT_STRENGTH_LIGHT_SENIOR = 'strength_light';
const CAT_BALANCE_SENIOR = 'balance';
const CAT_CORE_LIGHT_SENIOR = 'core_light';
 
const HC_HEALTHY_SENIOR = '';
const HC_DIABETES_SENIOR = 'diabetes';
const HC_HEART_SENIOR = 'heart';
const HC_PRESSURE_SENIOR = 'pressure';
const HC_ASTHMA_SENIOR = 'asthma';
const HC_JOINT_SENIOR = 'joint';
 
/**
 * Check if user is a senior (50+ years)
 */
function isSenior(int $age): bool {
    return $age >= 50;
}
 
/**
 * Get complete senior exercise library
 * Maximum safety - NO jumping, NO HIIT, light intensity only
 */
function getSeniorExerciseLibrary(): array {
    return [
        // ====== SAFE EXERCISES (Foundation) ======
        [
            'id' => 'walking',
            'name' => 'المشي',
            'name_en' => 'Walking',
            'category' => CAT_SAFE_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '15-20 دقيقة',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'تحسين الدورة الدموية والمفاصل بأمان',

            'contraindications' => [],
            'modifications' => [
                HC_HEART_SENIOR => 'مشي بطيء 10 دقائق مع راحات',
                HC_PRESSURE_SENIOR => 'مشي مريح في مكان مستوٍ',
                HC_JOINT_SENIOR => 'مشي على أسطح ناعمة',
                HC_DIABETES_SENIOR => 'مشي 10 دقائق + فحص سكر',
                HC_ASTHMA_SENIOR => 'مشي في هواء نظيف',
                'beginner' => 'مشي 5 دقائق في المنزل'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'breathing',
            'name' => 'تمارين تنفس',
            'name_en' => 'Breathing Exercises',
            'category' => CAT_SAFE_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '5-10 دقيقة',
            'target_muscles' => 'الرئتين، الكور',
            'benefits' => 'تحسين التنفس والاسترخاء',
            'contraindications' => [],
            'modifications' => [
                HC_ASTHMA_SENIOR => 'تنفس بطيء عميق 5 دقائق',
                HC_HEART_SENIOR => 'تنفس مريح بدون إجهاد',
                'beginner' => '3 دقائق تنفس بسيط'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'stretching',
            'name' => 'تمارين إطالة',
            'name_en' => 'Stretching',
            'category' => CAT_SAFE_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '10-15 دقيقة',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'مرونة ووقاية من الإصابات',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_SENIOR => 'إطالات خفيفة جداً 5 دقائق',
                'beginner' => 'إطالات بسيطة في الكرسي'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'joint_movement',
            'name' => 'تحريك المفاصل',
            'name_en' => 'Joint Mobility',
            'category' => CAT_SAFE_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '5-8 دقيقة',
            'target_muscles' => 'المفاصل',
            'benefits' => 'تحسين حركة المفاصل',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_SENIOR => 'دوران خفيف فقط',
                'beginner' => 'في الكرسي'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
 
        // ====== LIGHT STRENGTH ======
        [
            'id' => 'chair_squats',
            'name' => 'الجلوس والوقوف من الكرسي',
            'name_en' => 'Chair Sit-to-Stand',
            'category' => CAT_STRENGTH_LIGHT_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '3 مجموعات × 5-8',
            'target_muscles' => 'الفخذين، الأرداف',
            'benefits' => 'تقوية الساقين للحياة اليومية',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_SENIOR => '5 مرات فقط مع دعم',
                HC_HEART_SENIOR => 'بطيء مع راحة بين كل مرة',
                HC_PRESSURE_SENIOR => 'بدون إمساك النفس',
                'beginner' => '3 مرات مع كرسي ثقيل'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'light_squats',
            'name' => 'سكوات خفيف',
            'name_en' => 'Light Squats',
            'category' => CAT_STRENGTH_LIGHT_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '2 مجموعات × 8',
            'target_muscles' => 'الفخذين',
            'benefits' => 'تقوية خفيفة للمفاصل',
            'contraindications' => [HC_JOINT_SENIOR],
            'modifications' => [
                HC_JOINT_SENIOR => 'إذا مسموح: نصف سكوات 5 مرات',
                HC_HEART_SENIOR => '5 مرات بطيء',
                'beginner' => 'مع كرسي للدعم'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'wall_pushups',
            'name' => 'ضغط حائط',
            'name_en' => 'Wall Push-ups',
            'category' => CAT_STRENGTH_LIGHT_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '2 مجموعات × 8-10',
            'target_muscles' => 'الصدر، الذراعين',
            'benefits' => 'تقوية الجسم العلوي بأمان',
            'contraindications' => [HC_HEART_SENIOR, HC_PRESSURE_SENIOR],
            'modifications' => [
                HC_HEART_SENIOR => '5 مرات بطيء',
                'beginner' => '5 مرات'
            ],
            'gender_focus' => 'male',
            'intensity' => 'low'
        ],
        [
            'id' => 'arm_raises',
            'name' => 'رفع ذراع خفيف',
            'name_en' => 'Light Arm Raises',
            'category' => CAT_STRENGTH_LIGHT_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '2 مجموعات × 10',
            'target_muscles' => 'الكتفين',
            'benefits' => 'تحسين حركة الكتفين',
            'contraindications' => [HC_PRESSURE_SENIOR],
            'modifications' => [
                'beginner' => 'بدون أوزان'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'light_resistance',
            'name' => 'تمارين مقاومة خفيفة',
            'name_en' => 'Light Resistance',
            'category' => CAT_STRENGTH_LIGHT_SENIOR,
            'difficulty' => LVL_MEDIUM_SENIOR,
            'duration' => '2 مجموعات × 8',
            'target_muscles' => 'كامل الجسم',
            'benefits' => 'تقوية عضلية خفيفة',
            'contraindications' => [HC_HEART_SENIOR, HC_PRESSURE_SENIOR, HC_JOINT_SENIOR],
            'modifications' => [
                HC_DIABETES_SENIOR => 'بطيء 5 مرات',
                'beginner' => 'بشريط مقاومة خفيف'
            ],
            'gender_focus' => 'male',
            'intensity' => 'low'
        ],
 
        // ====== BALANCE (Very Important for Seniors) ======
        [
            'id' => 'one_leg_stand',
            'name' => 'الوقوف على قدم واحدة',
            'name_en' => 'One Leg Stand',
            'category' => CAT_BALANCE_SENIOR,
            'difficulty' => LVL_MEDIUM_SENIOR,
            'duration' => '3 × 10 ثوانٍ لكل قدم',
            'target_muscles' => 'الكور، الساقين',
            'benefits' => 'تحسين التوازن ومنع السقوط',
            'contraindications' => [HC_JOINT_SENIOR],
            'modifications' => [
                HC_JOINT_SENIOR => 'بجانب حائط للأمان',
                'beginner' => 'بجانب حائط 5 ثوانٍ'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'heel_to_toe',
            'name' => 'المشي بخط مستقيم',
            'name_en' => 'Heel-to-Toe Walk',
            'category' => CAT_BALANCE_SENIOR,
            'difficulty' => LVL_MEDIUM_SENIOR,
            'duration' => '10 خطوات',
            'target_muscles' => 'الكور، الساقين',
            'benefits' => 'تحسين التوازن الديناميكي',
            'contraindications' => [HC_JOINT_SENIOR],
            'modifications' => [
                HC_JOINT_SENIOR => 'بجانب حائط',
                'beginner' => '5 خطوات بجانب حائط'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'balance_exercises',
            'name' => 'تمارين توازن',
            'name_en' => 'Balance Exercises',
            'category' => CAT_BALANCE_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '5 دقائق',
            'target_muscles' => 'الكور',
            'benefits' => 'ثبات وتوازن عام',
            'video_url' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
            'video_url_male' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
            'video_url_female' => 'https://www.youtube.com/shorts/6u1FkpsISec',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_SENIOR => 'في الكرسي',
                'beginner' => 'بجانب حائط'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
 
        // ====== LIGHT CORE ======
        [
            'id' => 'light_plank',
            'name' => 'بلانك خفيف',
            'name_en' => 'Light Plank',
            'category' => CAT_CORE_LIGHT_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '2 × 10-15 ثانية',
            'target_muscles' => 'البطن، الظهر',
            'benefits' => 'تقوية الكور بدون ضغط',
            'video_url_female' => 'https://www.youtube.com/shorts/RfilUpGylpw',
            'contraindications' => [HC_HEART_SENIOR, HC_PRESSURE_SENIOR],
            'modifications' => [
                HC_HEART_SENIOR => '5 ثوانٍ فقط',
                'beginner' => 'على الركبتين'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'bird_dog',
            'name' => 'بيرد دوج',
            'name_en' => 'Bird Dog',
            'category' => CAT_CORE_LIGHT_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '2 مجموعات × 5 لكل جانب',
            'target_muscles' => 'الكور، الظهر',
            'benefits' => 'استقرار العمود الفقري',
            'video_url' => 'https://www.youtube.com/shorts/dAQ7hVe4x3g',
            'video_url_male' => 'https://www.youtube.com/shorts/dAQ7hVe4x3g',
            'video_url_female' => 'https://www.youtube.com/shorts/D-_-W9nQDM8',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_SENIOR => 'أطراف صغيرة',
                'beginner' => 'يد واحدة فقط'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
        [
            'id' => 'cat_cow',
            'name' => 'كات كاو',
            'name_en' => 'Cat Cow',
            'category' => CAT_CORE_LIGHT_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '8 تكرارات',
            'target_muscles' => 'الظهر',
            'benefits' => 'مرونة العمود الفقري',
            'contraindications' => [],
            'modifications' => [
                HC_JOINT_SENIOR => 'حركات صغيرة',
                'beginner' => 'في الكرسي'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ],
 
        // ====== STEP (Light) ======
        [
            'id' => 'light_step',
            'name' => 'step خفيف',
            'name_en' => 'Light Step Exercise',
            'category' => CAT_SAFE_SENIOR,
            'difficulty' => LVL_EASY_SENIOR,
            'duration' => '5 دقائق',
            'target_muscles' => 'الساقين',
            'benefits' => 'كارديو خفيف',
            'contraindications' => [HC_HEART_SENIOR, HC_JOINT_SENIOR],
            'modifications' => [
                HC_PRESSURE_SENIOR => 'بطيء على درج واحد',
                'beginner' => 'خطوة واحدة فقط'
            ],
            'gender_focus' => 'both',
            'intensity' => 'low'
        ]
    ];
}
 
/**
 * Filter exercises by health condition for seniors
 * ULTRA CONSERVATIVE - safety is paramount
 */
function filterSafeSeniorExercises(array $exercises, string $healthCondition): array {
    return array_filter($exercises, function($ex) use ($healthCondition) {
        // For seniors, only LOW intensity exercises allowed
        if (($ex['intensity'] ?? '') !== 'low') {
            return false;
        }
 
        // If healthy, allow all low intensity
        if (empty($healthCondition) || $healthCondition === 'healthy') {
            return true;
        }
 
        // Check contraindications
        if (in_array($healthCondition, $ex['contraindications'] ?? [])) {
            return false;
        }
 
        // Chronic conditions: only the safest exercises
        if (in_array($healthCondition, [HC_DIABETES_SENIOR, HC_HEART_SENIOR, HC_PRESSURE_SENIOR, HC_ASTHMA_SENIOR])) {
            // Only allow: walking, breathing, stretching, light movement
            $allowedIds = ['walking', 'breathing', 'stretching', 'joint_movement', 'arm_raises', 'light_squats'];
            if (!in_array($ex['id'], $allowedIds)) {
                return false;
            }
        }
 
        // Joint issues: no weight bearing on joints
        if ($healthCondition === HC_JOINT_SENIOR) {
            $jointSafeIds = ['chair_squats', 'breathing', 'stretching', 'balance_exercises', 'bird_dog', 'cat_cow', 'joint_movement'];
            if (!in_array($ex['id'], $jointSafeIds) && $ex['category'] !== CAT_SAFE_SENIOR) {
                return false;
            }
        }
 
        return true;
    });
}
 
/**
 * Get exercises by category for seniors
 */
function getSeniorExercisesByCategory(array $exercises, string $category): array {
    return array_values(array_filter($exercises, fn($ex) => $ex['category'] === $category));
}

function generateSeniorSafetyNotes(string $healthCondition, string $fitnessLevel): array {
    $hc = normalizeSeniorHealthCondition($healthCondition);
    $lvl = normalizeSeniorFitnessLevel($fitnessLevel);

    $notes = [];
    $notes[] = '⚠️ التمارين خفيفة فقط - لا إجهاد';
    $notes[] = '🔥 الإحماء ضروري جداً';
    $notes[] = '🧘 التمدد بعد التمرين أساسي';
    $notes[] = '⏱️ راحة بين التمارين 30-60 ثانية';
    $notes[] = '🛑 توقف فوراً عند أي ألم أو دوخة';
    $notes[] = '💧 اشرب ماء قبل وبعد التمرين';

    if ($hc === HC_DIABETES_SENIOR) {
        $notes[] = 'افحص السكر قبل التمرين';
        $notes[] = 'احتفظ بسكريات سريعة';
        $notes[] = 'لا تمرن إذا السكر منخفض';
    } elseif ($hc === HC_HEART_SENIOR) {
        $notes[] = 'راقب ضربات القلب (ماكس 120)';
        $notes[] = 'أي ألم صدري = توقف فوري';
        $notes[] = 'تجنب الإجهاد تماماً';
    } elseif ($hc === HC_PRESSURE_SENIOR) {
        $notes[] = 'لا تمسك النفس أثناء التمرين';
        $notes[] = 'راقب ضغطك قبل التمرين';
        $notes[] = 'تجنب الأوضاع المقلوبة';
    } elseif ($hc === HC_ASTHMA_SENIOR) {
        $notes[] = 'احتفظ بجهاز الربو بالقرب';
        $notes[] = 'تنفس بطيء وهادئ';
        $notes[] = 'تجنب الجو البارد';
    } elseif ($hc === HC_JOINT_SENIOR) {
        $notes[] = 'حركات خفيفة فقط';
        $notes[] = 'استخدم دعم للتوازن';
        $notes[] = 'تجنب الوقوف لفترات طويلة';
    }

    if ($lvl === 'beginner') {
        $notes[] = 'ابدأ بنصف التمارين';
        $notes[] = 'زيد تدريجياً كل أسبوع';
    }

    return $notes;
}

function normalizeSeniorExerciseKey(array $exercise): string {
    $key = (string)($exercise['name_en'] ?? $exercise['name'] ?? $exercise['id'] ?? '');
    $key = strtolower(trim($key));
    $key = preg_replace('/[^a-z0-9]+/', '_', $key);
    return trim((string)$key, '_');
}

function selectSeniorPreferredExercises(array $exercises, array $preferredKeys, int $limit): array {
    $result = [];
    $seen = [];

    foreach ($exercises as $ex) {
        if (!is_array($ex)) continue;
        $key = normalizeSeniorExerciseKey($ex);
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
        $key = normalizeSeniorExerciseKey($ex);
        if ($key === '' || !isset($seen[$key])) continue;
        $result[] = $seen[$key];
        unset($seen[$key]);
        if (count($result) >= $limit) break;
    }

    return $result;
}

function pickSeniorExercisesByKeys(array $exercises, array $keys): array {
    $want = array_fill_keys($keys, true);
    $out = [];
    foreach ($exercises as $ex) {
        if (!is_array($ex)) continue;
        $k = normalizeSeniorExerciseKey($ex);
        if ($k !== '' && isset($want[$k])) {
            $out[] = $ex;
        }
    }
    return $out;
}

function normalizeSeniorGender(string $gender): string {
    $g = strtolower(trim($gender));
    if ($g === 'ذكر' || $g === 'male' || $g === 'm' || $g === 'man' || $g === 'boy') return 'male';
    if ($g === 'انثى' || $g === 'أنثى' || $g === 'female' || $g === 'f' || $g === 'woman' || $g === 'girl') return 'female';
    return $g;
}

function normalizeSeniorFitnessLevel(string $fitnessLevel): string {
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

function normalizeSeniorGoal(string $goal): string {
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

function normalizeSeniorHealthCondition(string $healthCondition): string {
    $hc = strtolower(trim($healthCondition));
    $map = [
        '' => '',
        'healthy' => '',
        'normal' => '',
        'سليم' => '',
        'diabetes' => HC_DIABETES_SENIOR,
        'سكر' => HC_DIABETES_SENIOR,
        'سكري' => HC_DIABETES_SENIOR,
        'heart' => HC_HEART_SENIOR,
        'قلب' => HC_HEART_SENIOR,
        'pressure' => HC_PRESSURE_SENIOR,
        'ضغط' => HC_PRESSURE_SENIOR,
        'asthma' => HC_ASTHMA_SENIOR,
        'ربو' => HC_ASTHMA_SENIOR,
        'joint' => HC_JOINT_SENIOR,
        'joints' => HC_JOINT_SENIOR,
        'joint_pain' => HC_JOINT_SENIOR,
        'المفاصل' => HC_JOINT_SENIOR,
        'آلام مفاصل' => HC_JOINT_SENIOR,
        'الم مفاصل' => HC_JOINT_SENIOR,
        'chronic' => 'chronic',
        'مزمن' => 'chronic',
        'امراض مزمنه' => 'chronic',
        'أمراض مزمنة' => 'chronic',
    ];
    return $map[$hc] ?? $hc;
}

function seniorPreferredOrderByScenario(string $healthCondition, string $goal, string $fitnessLevel, string $gender): array {
    $hc = normalizeSeniorHealthCondition($healthCondition);
    $goal = normalizeSeniorGoal($goal);
    $level = normalizeSeniorFitnessLevel($fitnessLevel);
    $g = normalizeSeniorGender($gender);

    // Health overrides (any goal)
    if ($hc === HC_JOINT_SENIOR) {
        return ['chair_sit_to_stand', 'stretching', 'bird_dog', 'cat_cow', 'balance_exercises'];
    }
    if ($hc === 'chronic' || in_array($hc, [HC_DIABETES_SENIOR, HC_HEART_SENIOR, HC_PRESSURE_SENIOR, HC_ASTHMA_SENIOR], true)) {
        return ['walking', 'breathing_exercises', 'light_squats', 'light_arm_raises', 'stretching'];
    }

    // Goal balance
    if ($goal === 'balance') {
        return ['one_leg_stand', 'heel_to_toe_walk', 'bird_dog', 'light_plank', 'stretching'];
    }

    // Healthy muscle
    if ($goal === 'muscle') {
        if ($level === 'beginner') {
            return ['chair_sit_to_stand', 'wall_push_ups', 'light_squats', 'light_arm_raises', 'stretching'];
        }
        return ['wall_push_ups', 'light_squats', 'chair_sit_to_stand', 'light_plank', 'light_resistance'];
    }

    // Healthy weight loss
    if ($goal === 'weight_loss') {
        if ($level === 'beginner') {
            return ['walking', 'breathing_exercises', 'light_squats', 'stretching', 'light_step_exercise'];
        }
        return ['walking', 'light_step_exercise', 'light_squats', 'light_plank', 'stretching'];
    }

    // Gender fallback focus
    if ($g === 'male') {
        return ['wall_push_ups', 'light_squats', 'light_resistance', 'light_plank'];
    }
    if ($g === 'female') {
        return ['light_squats', 'balance_exercises', 'stretching', 'light_arm_raises'];
    }

    return [];
}

/**
 * Main recommendation function for seniors (50+)
 * ULTRA CONSERVATIVE approach - safety is everything
 */
function getSeniorExerciseRecommendation(array $profile): array {
    $age = (int)($profile['age'] ?? 0);
    $gender = normalizeSeniorGender((string)($profile['gender'] ?? ''));
    $healthCondition = normalizeSeniorHealthCondition((string)($profile['health_condition'] ?? ''));
    $fitnessLevel = normalizeSeniorFitnessLevel((string)($profile['fitness_level'] ?? ''));
    $goal = normalizeSeniorGoal((string)($profile['goal'] ?? ''));
    $timeAvailable = (int)($profile['time_available'] ?? 30);

    // Get all exercises
    $allExercises = getSeniorExerciseLibrary();

    // Step 1: Filter by health condition (ULTRA CONSERVATIVE)
    $safeExercises = filterSafeSeniorExercises($allExercises, $healthCondition);

    // Step 2: Force EASY for all seniors
    $targetDifficulty = LVL_EASY_SENIOR;

    // Step 3: Filter by goal - very conservative
    $selectedExercises = [];

    // Health overrides goal
    if ($healthCondition === HC_JOINT_SENIOR) {
        $safe = getSeniorExercisesByCategory($safeExercises, CAT_SAFE_SENIOR);
        $balance = getSeniorExercisesByCategory($safeExercises, CAT_BALANCE_SENIOR);
        $core = getSeniorExercisesByCategory($safeExercises, CAT_CORE_LIGHT_SENIOR);
        $strength = getSeniorExercisesByCategory($safeExercises, CAT_STRENGTH_LIGHT_SENIOR);
        $selectedExercises = array_merge($strength, $balance, $core, $safe);
    } elseif ($healthCondition === 'chronic' || in_array($healthCondition, [HC_DIABETES_SENIOR, HC_HEART_SENIOR, HC_PRESSURE_SENIOR, HC_ASTHMA_SENIOR], true)) {
        $safe = getSeniorExercisesByCategory($safeExercises, CAT_SAFE_SENIOR);
        $strength = getSeniorExercisesByCategory($safeExercises, CAT_STRENGTH_LIGHT_SENIOR);
        $selectedExercises = array_merge($safe, $strength);
    }

    if (count($selectedExercises) === 0) switch ($goal) {
        case 'muscle': // بناء عضلات - light strength only
            $strength = getSeniorExercisesByCategory($safeExercises, CAT_STRENGTH_LIGHT_SENIOR);
            $selectedExercises = array_merge($strength);
            // Add safe foundation exercises
            $safe = getSeniorExercisesByCategory($safeExercises, CAT_SAFE_SENIOR);
            $selectedExercises = array_merge($selectedExercises, $safe);
            break;

        case 'weight_loss': // تخسيس - only walking and safe exercises
            $safe = getSeniorExercisesByCategory($safeExercises, CAT_SAFE_SENIOR);
            $selectedExercises = array_merge($safe);
            break;

        case 'balance': // توازن - focus on balance + core
            $balance = getSeniorExercisesByCategory($safeExercises, CAT_BALANCE_SENIOR);
            $core = getSeniorExercisesByCategory($safeExercises, CAT_CORE_LIGHT_SENIOR);
            $selectedExercises = array_merge($balance, $core);
            // Add safe foundation
            $safe = getSeniorExercisesByCategory($safeExercises, CAT_SAFE_SENIOR);
            $selectedExercises = array_merge($selectedExercises, $safe);
            break;

        default: // Mix - balanced but safe
            $safe = getSeniorExercisesByCategory($safeExercises, CAT_SAFE_SENIOR);
            $strength = array_slice(getSeniorExercisesByCategory($safeExercises, CAT_STRENGTH_LIGHT_SENIOR), 0, 2);
            $balance = array_slice(getSeniorExercisesByCategory($safeExercises, CAT_BALANCE_SENIOR), 0, 2);
            $selectedExercises = array_merge($safe, $strength, $balance);
    }

    // Step 4: Sort - easiest first
    usort($selectedExercises, function($a, $b) {
        $diffOrder = ['easy' => 1, 'medium' => 2, 'hard' => 3];
        $aDiff = $diffOrder[$a['difficulty']] ?? 2;
        $bDiff = $diffOrder[$b['difficulty']] ?? 2;
        return $aDiff - $bDiff;
    });
 
    // Step 5: Select based on time - seniors keep few but complete plans
    // 15 min = 3 exercises, 30 min = 5 exercises
    $exerciseCount = match(true) {
        $timeAvailable <= 15 => 3,
        $timeAvailable <= 30 => 5,
        default => 5
    };

    $preferredOrder = seniorPreferredOrderByScenario($healthCondition, $goal, $fitnessLevel, $gender);
    $usedPreferredOrder = (count($preferredOrder) > 0);
    if (count($preferredOrder) > 0) {
        $mustInclude = pickSeniorExercisesByKeys($safeExercises, $preferredOrder);
        if (count($mustInclude) > 0) {
            $selectedExercises = array_merge($selectedExercises, $mustInclude);
        }
        $selectedExercises = selectSeniorPreferredExercises($selectedExercises, $preferredOrder, $exerciseCount);
    }

    $finalExercises = array_slice($selectedExercises, 0, $exerciseCount);
 
    // Step 6: Gender-specific prioritization - subtle differences
    if (!$usedPreferredOrder && $gender === 'male') {
        // Prioritize strength exercises
        usort($finalExercises, function($a, $b) {
            $aIsStrength = $a['category'] === CAT_STRENGTH_LIGHT_SENIOR;
            $bIsStrength = $b['category'] === CAT_STRENGTH_LIGHT_SENIOR;
            return $bIsStrength <=> $aIsStrength;
        });
    } elseif (!$usedPreferredOrder && $gender === 'female') {
        // Prioritize balance and safe exercises
        usort($finalExercises, function($a, $b) {
            $aIsBalance = $a['category'] === CAT_BALANCE_SENIOR ||
                         $a['category'] === CAT_SAFE_SENIOR;
            $bIsBalance = $b['category'] === CAT_BALANCE_SENIOR ||
                         $b['category'] === CAT_SAFE_SENIOR;
            return $bIsBalance <=> $aIsBalance;
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
        'safety_notes' => generateSeniorSafetyNotes($healthCondition, $fitnessLevel)
    ];
}