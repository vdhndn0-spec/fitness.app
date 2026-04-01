<?php
/**
 * Teen Exercise Recommendation Engine (Ages 12-16)
 * 
 * Rules:
 * - Safety first: Health conditions override everything
 * - Age 12-16: Body weight only (no heavy weights)
 * - Gender-specific focus: Boys (upper strength), Girls (balance + flexibility)
 */


// Exercise Categories
const CAT_STRENGTH = 'strength';
const CAT_CARDIO = 'cardio';
const CAT_LOW_IMPACT = 'low_impact';
const CAT_CORE = 'core';

// Difficulty Levels
const LVL_EASY = 'easy';
const LVL_MEDIUM = 'medium';
const LVL_HARD = 'hard';

// Health Conditions
const HC_DIABETES = 'diabetes';
const HC_HEART = 'heart';
const HC_PRESSURE = 'pressure';
const HC_ASTHMA = 'asthma';
const HC_JOINTS = 'joints';
const HC_HEALTHY = 'healthy';

// =====================================================
// 🎬 INTERNAL VIDEO LIBRARY - YOUTUBE SHORTS URLs
// =====================================================
// Structure: 'exercise_name' => ['male' => 'url', 'female' => 'url', 'both' => 'url']
// Add your working YouTube Shorts URLs here
const VIDEO_LIBRARY = [
    // Strength exercises
    'pushups' => [
        'male' => 'https://www.youtube.com/watch?v=gNrnY9eaq-Y',
        'female' => 'https://www.youtube.com/watch?v=_x71MC6rKQw',
        'both' => 'https://www.youtube.com/watch?v=gNrnY9eaq-Y'
    ],
    'squats' => [
        'male' => 'https://www.youtube.com/watch?v=rT0vyHTBw-A',
        'female' => 'https://www.youtube.com/shorts/rmKOhmPtJFk',
        'both' => 'https://www.youtube.com/watch?v=rT0vyHTBw-A'
    ],
    'lunges' => [
        'male' => 'https://www.youtube.com/watch?v=Nopu1DelXwE',
        'female' => 'https://www.youtube.com/shorts/ShJPetMefGw',
        'both' => ''
    ],
    
    // Core exercises
    'plank' => [
        'male' => 'https://www.youtube.com/watch?v=xe2MXatLTUw',
        'female' => 'https://www.youtube.com/watch?v=RfilUpGylpw',
        'both' => 'https://www.youtube.com/watch?v=xe2MXatLTUw'
    ],
    'side_plank' => [
        'male' => 'https://www.youtube.com/watch?v=Wv4oj31H8SU',
        'female' => 'https://www.youtube.com/shorts/aQm1Ki0-vt8',
        'both' => ''
    ],
    'crunches' => [
        'male' => 'https://www.youtube.com/watch?v=Fdbqt66rl6A', 
        'female' => 'https://www.youtube.com/watch?v=zaxkSoSwKo4', 
        'both' => ''
    ],
    
    // Cardio exercises
    'jumping_jacks' => [
        'male' => 'https://www.youtube.com/watch?v=636IhyuvN-4', 
        'female' => 'https://www.youtube.com/shorts/yg3KQQn3QWg', 
        'both' => ''
    ],
    'high_knees' => [
        'male' => 'https://www.youtube.com/shorts/ZXik5WCOyiM',
        'female' => 'https://www.youtube.com/shorts/AuUWHiEsCd8',
        'both' => ''
    ],
    'burpees' => [
        'male' => 'https://www.youtube.com/shorts/6ktzcUwumCY', 
        'female' => 'https://www.youtube.com/shorts/oUOeCtL0lg4', 
        'both' => 'https://www.youtube.com/shorts/6ktzcUwumCY'
    ],
    'mountain_climbers' => [
        'male' => 'https://www.youtube.com/shorts/2J62zI7hhlA', 
        'female' => 'https://www.youtube.com/shorts/5hmOtXAofpk', 
        'both' => 'https://www.youtube.com/shorts/2J62zI7hhlA'
    ],
    
    // Low impact exercises
    'walking' => [
        'male' => '', 
        'female' => '', 
        'both' => ''
    ],
    'stretching' => [
        'male' => '', 
        'female' => '', 
        'both' => ''
    ],
    'breathing' => [
        'male' => '', 
        'female' => '', 
        'both' => ''
    ],
];

// Helper function to get video URL based on exercise and gender
function getVideoUrl(string $exerciseKey, string $gender = 'both'): string {
    $library = VIDEO_LIBRARY;
    
    if (!isset($library[$exerciseKey])) {
        return '';
    }
    
    // Try to get gender-specific URL first
    if ($gender === 'male' && !empty($library[$exerciseKey]['male'])) {
        return $library[$exerciseKey]['male'];
    }
    
    if ($gender === 'female' && !empty($library[$exerciseKey]['female'])) {
        return $library[$exerciseKey]['female'];
    }
    
    // Fallback to 'both' or empty string
    return $library[$exerciseKey]['both'] ?? '';
}

// =====================================================

// Complete Exercise Library for Teens (12-16)
function getTeenExerciseLibrary(): array {
    return [
        // 🔵 Strength (Building Muscles) - Body weight only for teens
        [
            'name' => 'تمارين الضغط',
            'name_en' => 'Push-ups',
            'category' => CAT_STRENGTH,
            'difficulty' => LVL_MEDIUM,
            'target_muscles' => 'الصدر، الكتفين، الترايسبس',
            'duration' => '3 مجموعات × 8-12 تكرار',
            'benefits' => 'بناء قوة الجزء العلوي، تحسين التحمل',
            'instructions' => 'احافظ على ظهر مستقيم، انزل ببطء حتى تلامس صدرك الأرض، ثم اصعد. للمبتدئين: ابدأ بالضغط على الركب.',
            'video_url' => getVideoUrl('pushups'),
            'video_url_male' => getVideoUrl('pushups', 'male'),
            'video_url_female' => getVideoUrl('pushups', 'female'),
            'intensity' => 'medium',
            'gender_focus' => 'both', // But boys focus more
            'contraindications' => [HC_JOINTS], // Modify for joints
            'safe_for' => [HC_HEALTHY, HC_DIABETES],
            'modifications' => [
                HC_JOINTS => 'ضغط معدل (على الركب)',
                'beginner' => 'ضغط على الركب'
            ]
        ],
        [
            'name' => 'سكوات',
            'name_en' => 'Squats',
            'category' => CAT_STRENGTH,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'الفخذين، المؤخرة، الجزء السفلي',
            'duration' => '3 مجموعات × 12-15 تكرار',
            'benefits' => 'بناء قوة الساقين، تحسين الحركة اليومية',
            'instructions' => 'قف بقدمين بعرض الكتفين، انزل كأنك تجلس على كرسي حتى تكون الركبتان بزاوية 90 درجة، ثم اصعد.',
            'video_url' => getVideoUrl('squats'),
            'video_url_male' => getVideoUrl('squats', 'male'),
            'video_url_female' => getVideoUrl('squats', 'female'),
            'intensity' => 'low',
            'gender_focus' => 'both',
            'contraindications' => [],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_JOINTS],
            'modifications' => [
                HC_JOINTS => 'سكوات خفيفة (ربع سكوات)',
                'beginner' => 'سكوات خفيفة'
            ]
        ],
        [
            'name' => 'لانجز',
            'name_en' => 'Lunges',
            'category' => CAT_STRENGTH,
            'difficulty' => LVL_MEDIUM,
            'target_muscles' => 'الفخذين، المؤخرة، التوازن',
            'duration' => '3 مجموعات × 10 لكل رجل',
            'benefits' => 'تقوية الساقين، تحسين التوازن والثبات',
            'instructions' => 'خطوة إلى الأمام برجل واحدة، انزل حتى تكون الركبة الخلفية قريبة من الأرض. اصعد وكرر مع الرجل الأخرى.',
            'video_url' => getVideoUrl('lunges'),
            'video_url_male' => getVideoUrl('lunges', 'male'),
            'video_url_female' => getVideoUrl('lunges', 'female'),
            'intensity' => 'medium',
            'gender_focus' => 'both',
            'contraindications' => [HC_JOINTS],
            'safe_for' => [HC_HEALTHY, HC_DIABETES],
            'modifications' => [
                HC_JOINTS => 'لانجز ثابت (بدون خطوة)',
                'beginner' => 'لانجز ثابت'
            ]
        ],
        [
            'name' => 'بلانك',
            'name_en' => 'Plank',
            'category' => CAT_CORE,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'البطن، الظهر، الكتفين',
            'duration' => '3 مجموعات × 20-30 ثانية',
            'benefits' => 'تقوية العضلة الأساسية، تحسين الوضعية',
            'instructions' => 'استلقِ على بطنك، ارفع جسمك على المرفقين وأصابع القدمين. احافظ على ظهر مستقيم.',
            'video_url' => getVideoUrl('plank'),
            'video_url_male' => getVideoUrl('plank', 'male'),
            'video_url_female' => getVideoUrl('plank', 'female'),
            'intensity' => 'low',
            'gender_focus' => 'both',
            'contraindications' => [],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_JOINTS],
            'modifications' => [
                'beginner' => 'بلانك على الركب'
            ]
        ],
        [
            'name' => 'تمارين البطن',
            'name_en' => 'Crunches',
            'category' => CAT_STRENGTH,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'البطن',
            'duration' => '3 مجموعات × 15-20 تكرار',
            'benefits' => 'تقوية عضلات البطن',
            'instructions' => 'استلقِ على ظهرك مع ثني الركب، ارفع كتفيك عن الأرض باستخدام عضلات بطنك.',
            'video_url' => getVideoUrl('crunches'),
            'video_url_male' => getVideoUrl('crunches', 'male'),
            'video_url_female' => getVideoUrl('crunches', 'female'),
            'intensity' => 'low',
            'gender_focus' => 'both',
            'contraindications' => [HC_HEART, HC_PRESSURE],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_ASTHMA, HC_JOINTS],
            'modifications' => [
                HC_HEART => 'تمارين بطن خفيفة جداً',
                'beginner' => 'كرنش خفيف'
            ]
        ],
        [
            'name' => 'جاك القفز',
            'name_en' => 'Jumping Jacks',
            'category' => CAT_CARDIO,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'كامل الجسم',
            'duration' => '45 ثانية',
            'benefits' => 'رفع معدل ضربات القلب، حرق السعرات',
            'instructions' => 'قف بقدمين معاً ويديك على الجانب. اقفز وفتح قدميك ورفع يديك. كرر بسرعة.',
            'video_url' => getVideoUrl('jumping_jacks'),
            'video_url_male' => getVideoUrl('jumping_jacks', 'male'),
            'video_url_female' => getVideoUrl('jumping_jacks', 'female'),
            'intensity' => 'high',
            'gender_focus' => 'both',
            'contraindications' => [HC_JOINTS, HC_HEART, HC_PRESSURE, HC_ASTHMA],
            'safe_for' => [HC_HEALTHY, HC_DIABETES],
            'modifications' => [
                HC_JOINTS => 'جاك بدون قفز (خطوة جانبية)',
                HC_DIABETES => 'جاك متوسط السرعة'
            ]
        ],
        [
            'name' => 'جري في المكان',
            'name_en' => 'Running in Place',
            'category' => CAT_CARDIO,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'الساقين، القلب',
            'duration' => '1-2 دقيقة',
            'benefits' => 'تحسين اللياقة القلبية، حرق الدهون',
            'instructions' => 'اركض في مكانك مع رفع الركب. حافظ على وتيرة منتظمة.',
            'video_url' => 'https://www.youtube.com/shorts/KZ7gDPdRkbU',
            'video_url_male' => 'https://www.youtube.com/shorts/KZ7gDPdRkbU',
            'video_url_female' => 'https://www.youtube.com/shorts/Wq1uXRw-3w4',
            'intensity' => 'medium',
            'gender_focus' => 'both',
            'contraindications' => [HC_JOINTS, HC_HEART, HC_PRESSURE, HC_ASTHMA],
            'safe_for' => [HC_HEALTHY, HC_DIABETES],
            'modifications' => [
                HC_JOINTS => 'هرولة خفيفة في المكان',
                HC_DIABETES => 'جري متوسط'
            ]
        ],
        [
            'name' => 'رفع الركب',
            'name_en' => 'High Knees',
            'category' => CAT_CARDIO,
            'difficulty' => LVL_MEDIUM,
            'target_muscles' => 'الساقين، البطن',
            'duration' => '30-45 ثانية',
            'benefits' => 'تقوية الساقين، رفع معدل الحرق',
            'instructions' => 'اركض في المكان مع رفع ركبتيك عالية (فوق الخصر إن أمكن).',
            'video_url' => 'https://www.youtube.com/shorts/ZXik5WCOyiM',
            'video_url_male' => 'https://www.youtube.com/shorts/ZXik5WCOyiM',
            'video_url_female' => 'https://www.youtube.com/shorts/AuUWHiEsCd8',
            'intensity' => 'high',
            'gender_focus' => 'both',
            'contraindications' => [HC_JOINTS, HC_HEART, HC_PRESSURE, HC_ASTHMA],
            'safe_for' => [HC_HEALTHY],
            'modifications' => [
                HC_JOINTS => 'رفع ركب خفيف',
                'beginner' => 'رفع ركب متوسط'
            ]
        ],
        [
            'name' => 'متسلقي الجبال',
            'name_en' => 'Mountain Climbers',
            'category' => CAT_CARDIO,
            'difficulty' => LVL_HARD,
            'target_muscles' => 'البطن، الساقين، الكتفين',
            'duration' => '30-45 ثانية',
            'benefits' => 'تمرين كامل للجسم، حرق سريع',
            'instructions' => 'وضعية الضغط، اجلب ركبتك نحو صدرك بالتناوب بسرعة.',
            'video_url' => getVideoUrl('mountain_climbers'),
            'video_url_male' => getVideoUrl('mountain_climbers', 'male'),
            'video_url_female' => getVideoUrl('mountain_climbers', 'female'),
            'intensity' => 'very_high',
            'gender_focus' => 'both',
            'contraindications' => [HC_JOINTS, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_DIABETES],
            'safe_for' => [HC_HEALTHY],
            'modifications' => [
                'beginner' => 'متسلقين بطيئين'
            ]
        ],
        [
            'name' => 'نط الحبل',
            'name_en' => 'Jump Rope',
            'category' => CAT_CARDIO,
            'difficulty' => LVL_MEDIUM,
            'target_muscles' => 'الساقين، الكتفين',
            'duration' => '2-3 دقيقة',
            'benefits' => 'تحسين التنسيق، حرق عالي',
            'instructions' => 'اقفز فوق الحبل بقدمين معاً أو بالتناوب. حافظ على إيقاع منتظم.',
            'video_url' => 'https://www.youtube.com/watch?v=uL4Whc_Jf2Q',
            'intensity' => 'high',
            'gender_focus' => 'both',
            'contraindications' => [HC_JOINTS, HC_HEART, HC_PRESSURE, HC_ASTHMA],
            'safe_for' => [HC_HEALTHY, HC_DIABETES],
            'modifications' => [
                HC_JOINTS => 'نط خفيف بدون حبل (تقليد)',
                HC_DIABETES => 'نط متوسط'
            ]
        ],
        [
            'name' => 'القفزات الاحترافية',
            'name_en' => 'Burpees',
            'category' => CAT_CARDIO,
            'difficulty' => LVL_HARD,
            'target_muscles' => 'كامل الجسم',
            'duration' => '10-15 تكرار',
            'benefits' => 'تمرين HIIT قوي، حرق سريع جداً',
            'instructions' => 'من وضع الوقوف، انزل للضغط، اعود، ثم اقفز للأعلى.',
            'video_url' => getVideoUrl('burpees'),
            'video_url_male' => getVideoUrl('burpees', 'male'),
            'video_url_female' => getVideoUrl('burpees', 'female'),
            'intensity' => 'very_high',
            'gender_focus' => 'both',
            'contraindications' => [HC_JOINTS, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_DIABETES],
            'safe_for' => [HC_HEALTHY],
            'modifications' => [
                'beginner' => 'بيربي بدون قفز'
            ]
        ],
        
        // 🟡 Low Impact (Safe for joints/health conditions)
        [
            'name' => 'مشي',
            'name_en' => 'Walking',
            'category' => CAT_LOW_IMPACT,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'الساقين',
            'duration' => '10-15 دقيقة',
            'benefits' => 'أمان للمفاصل، مناسب للقلب والضغط',
            'instructions' => 'امشِ بخطوات منتظمة ومتوسطة السرعة. حافظ على ظهر مستقيم.',
            'video_url' => 'https://www.youtube.com/watch?v=8UaT8gXJuGc',
            'intensity' => 'very_low',
            'gender_focus' => 'both',
            'contraindications' => [],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_JOINTS],
            'modifications' => []
        ],
        [
            'name' => 'سكوات خفيف',
            'name_en' => 'Light Squats',
            'category' => CAT_LOW_IMPACT,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'الفخذين',
            'duration' => '2 مجموعات × 10 تكرار',
            'benefits' => 'تقوية خفيفة للساقين بدون ضغط على المفاصل',
            'instructions' => 'انزل بربع المدى فقط (ربع سكوات). لا تثني الركبتين كثيراً.',
            'video_url' => 'https://www.youtube.com/watch?v=a9KSfaSVG4U',
            'intensity' => 'very_low',
            'gender_focus' => 'both',
            'contraindications' => [],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_JOINTS],
            'modifications' => []
        ],
        [
            'name' => 'تمارين إطالة',
            'name_en' => 'Stretching',
            'category' => CAT_LOW_IMPACT,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'كامل الجسم',
            'duration' => '5-10 دقيقة',
            'benefits' => 'تحسين المرونة، تخفيف آلام المفاصل',
            'instructions' => 'إطالات خفيفة للرقبة، الكتفين، الظهر، والساقين.',
            'video_url' => 'https://www.youtube.com/watch?v=3z9cK9W4x1A',
            'intensity' => 'very_low',
            'gender_focus' => 'both',
            'contraindications' => [],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_JOINTS],
            'modifications' => []
        ],
        [
            'name' => 'تمارين تنفس',
            'name_en' => 'Breathing Exercises',
            'category' => CAT_LOW_IMPACT,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'الرئتين، البطن',
            'duration' => '3-5 دقيقة',
            'benefits' => 'تحسين السيطرة على الربو، الاسترخاء',
            'instructions' => 'تنفس عميق من الأنف 4 ثوانٍ، احبس 4 ثوانٍ، اخرج 4 ثوانٍ.',
            'video_url' => 'https://www.youtube.com/watch?v=8a9N7rM_NbI',
            'intensity' => 'very_low',
            'gender_focus' => 'both',
            'contraindications' => [],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_JOINTS],
            'modifications' => []
        ],
        
        // 🟣 Core & Balance
        [
            'name' => 'بيرد دوج',
            'name_en' => 'Bird Dog',
            'category' => CAT_CORE,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'الظهر، البطن، التوازن',
            'duration' => '2 مجموعات × 8 لكل جانب',
            'benefits' => 'تقوية الظهر، تحسين التوازن',
            'instructions' => 'على يديك وركبتيك، امدد يد ورجل بالتناوب مع الحفاظ على التوازن.',
            'video_url' => 'https://www.youtube.com/watch?v=wiFNA3sqj3k',
            'intensity' => 'low',
            'gender_focus' => 'both',
            'contraindications' => [],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_JOINTS],
            'modifications' => [
                'beginner' => 'بيرد دوج ثابت'
            ]
        ],
        [
            'name' => 'تمارين توازن',
            'name_en' => 'Balance Exercises',
            'category' => CAT_CORE,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'الكاحل، القدم',
            'duration' => '2 دقيقة',
            'benefits' => 'تحسين التوازن، تقوية الكاحل',
            'instructions' => 'قف على رجل واحدة لـ 30 ثانية، ثم غيّر. استخدم حائط للدعم إن احتجت.',
            'video_url' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
            'video_url_male' => 'https://www.youtube.com/shorts/TMcXm4EjzAc',
            'video_url_female' => 'https://www.youtube.com/shorts/6u1FkpsISec',
            'intensity' => 'low',
            'gender_focus' => 'both',
            'contraindications' => [HC_JOINTS],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA],
            'modifications' => [
                HC_JOINTS => 'توازن بدون قفز'
            ]
        ],
        [
            'name' => 'كات كاو',
            'name_en' => 'Cat Cow',
            'category' => CAT_CORE,
            'difficulty' => LVL_EASY,
            'target_muscles' => 'الظهر، البطن',
            'duration' => '1-2 دقيقة',
            'benefits' => 'تخفيف آلام الظهر، تحسين المرونة',
            'instructions' => 'على يديك وركبتيك، انحنِ ظهرك للأعلى (كات) ثم للأسفل (كاو).',
            'video_url' => 'https://www.youtube.com/shorts/Yetvc-6pkS4',
            'video_url_male' => 'https://www.youtube.com/shorts/Yetvc-6pkS4',
            'video_url_female' => 'https://www.youtube.com/shorts/2of247Kt0tU',
            'intensity' => 'very_low',
            'gender_focus' => 'both',
            'contraindications' => [],
            'safe_for' => [HC_HEALTHY, HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA, HC_JOINTS],
            'modifications' => []
        ]
    ];
}

// Safety Filter: Remove dangerous exercises for health conditions
function filterSafeExercises(array $exercises, string $healthCondition): array {
    if ($healthCondition === HC_HEALTHY || empty($healthCondition)) {
        return $exercises;
    }

    if ($healthCondition === 'joint_pain') {
        $healthCondition = HC_JOINTS;
    }
    
    return array_filter($exercises, function($ex) use ($healthCondition) {
        // Check if exercise has contraindications for this health condition
        $isDangerous = in_array($healthCondition, $ex['contraindications'] ?? []);
        $intensity = $ex['intensity'] ?? '';
        $category = $ex['category'] ?? '';
        
        // For diabetes: avoid very high intensity
        if ($healthCondition === HC_DIABETES && $intensity === 'very_high') {
            return false;
        }
        
        // For heart/pressure/asthma: avoid high intensity and jumping
        if (in_array($healthCondition, [HC_HEART, HC_PRESSURE, HC_ASTHMA], true)) {
            if ($intensity === 'high' || $intensity === 'very_high') {
                return false;
            }
        }

        // Generic chronic: safe low/medium only
        if ($healthCondition === 'chronic') {
            if ($intensity === 'high' || $intensity === 'very_high') {
                return false;
            }
            if ($category === CAT_CARDIO && ($intensity === 'medium' || $intensity === 'high' || $intensity === 'very_high')) {
                return false;
            }
        }
        
        // For joints: avoid jumping and high impact
        if ($healthCondition === HC_JOINTS) {
            if ($category === CAT_CARDIO && ($intensity === 'high' || $intensity === 'very_high')) {
                return false;
            }
        }
        
        return !$isDangerous;
    });
}

// Get exercises by category
function getExercisesByCategory(array $exercises, string $category): array {
    return array_filter($exercises, fn($ex) => $ex['category'] === $category);
}

// Get exercises by difficulty
function getExercisesByDifficulty(array $exercises, string $difficulty): array {
    return array_filter($exercises, fn($ex) => $ex['difficulty'] === $difficulty);
}

function normalizeTeenExerciseKey(array $exercise): string {
    $key = (string)($exercise['name_en'] ?? $exercise['name'] ?? '');
    $key = strtolower(trim($key));
    $key = preg_replace('/[^a-z0-9]+/', '_', $key);
    return trim((string)$key, '_');
}

function selectTeenPreferredExercises(array $exercises, array $preferredKeys, int $limit): array {
    $result = [];
    $seen = [];

    foreach ($exercises as $ex) {
        $key = normalizeTeenExerciseKey($ex);
        if ($key !== '') {
            $seen[$key] = $ex;
        }
    }

    foreach ($preferredKeys as $k) {
        if (isset($seen[$k])) {
            $result[] = $seen[$k];
            unset($seen[$k]);
            if (count($result) >= $limit) {
                return $result;
            }
        }
    }

    foreach ($exercises as $ex) {
        $key = normalizeTeenExerciseKey($ex);
        if ($key === '') continue;
        if (!isset($seen[$key])) continue;
        $result[] = $seen[$key];
        unset($seen[$key]);
        if (count($result) >= $limit) {
            break;
        }
    }

    return $result;
}

function teenPreferredOrderByScenario(string $healthCondition, string $goal, string $fitnessLevel, string $gender): array {
    $hc = strtolower(trim($healthCondition));
    if ($hc === 'joint_pain') $hc = HC_JOINTS;

    $g = strtolower(trim($gender));
    $level = strtolower(trim($fitnessLevel));
    if ($level === '') $level = 'beginner';

    // Health overrides (any goal)
    if ($hc === HC_JOINTS) {
        return ['light_squats', 'plank', 'stretching', 'bird_dog', 'cat_cow'];
    }

    if (in_array($hc, [HC_HEART, HC_PRESSURE, HC_ASTHMA], true)) {
        return ['walking', 'breathing_exercises', 'light_squats', 'plank', 'stretching'];
    }

    // Chronic generic fallback
    if ($hc === 'chronic') {
        return ['walking', 'breathing_exercises', 'light_squats', 'plank', 'stretching'];
    }

    // Diabetes scenarios
    if ($hc === HC_DIABETES) {
        if ($goal === 'muscle') {
            return ['squats', 'plank', 'lunges', 'crunches', 'push_ups'];
        }
        if ($goal === 'weight_loss') {
            return ['walking', 'running_in_place', 'jumping_jacks', 'squats', 'plank'];
        }
        // Mix / balance
        return ['squats', 'plank', 'bird_dog', 'stretching', 'lunges'];
    }

    // Healthy scenarios
    if ($goal === 'muscle') {
        if ($level === 'beginner') {
            // requested: Push-ups, Squats, Lunges, Plank, Crunches
            return ['push_ups', 'squats', 'lunges', 'plank', 'crunches'];
        }
        if ($level === 'intermediate') {
            // requested: Push-ups, Squats, Lunges, Plank, Side Plank
            return ['push_ups', 'squats', 'lunges', 'plank', 'side_plank'];
        }
        // advanced
        return ['push_ups', 'squats', 'lunges', 'plank', 'side_plank'];
    }

    if ($goal === 'weight_loss') {
        if ($level === 'beginner') {
            // requested: Jumping Jacks, Running in Place, High Knees, Squats, Plank
            return ['jumping_jacks', 'running_in_place', 'high_knees', 'squats', 'plank'];
        }
        if ($level === 'advanced') {
            // requested: Mountain Climbers, High Knees, Burpees, Jumping Jacks, Fast Running
            // Fast running not in library; use Running in Place
            return ['mountain_climbers', 'high_knees', 'burpees', 'jumping_jacks', 'running_in_place'];
        }
        // intermediate
        return ['jumping_jacks', 'running_in_place', 'high_knees', 'jump_rope', 'plank'];
    }

    // Balance / general fitness
    if ($goal === 'balance') {
        return ['plank', 'bird_dog', 'balance_exercises', 'squats', 'stretching'];
    }

    // Gender focus adjustments (applied only if goal isn't already handled)
    if ($g === 'male') {
        return ['push_ups', 'squats', 'lunges', 'plank', 'crunches'];
    }

    if ($g === 'female') {
        return ['squats', 'plank', 'balance_exercises', 'stretching', 'lunges'];
    }

    return [];
}

function pickTeenExercisesByKeys(array $exercises, array $keys): array {
    $want = array_fill_keys($keys, true);
    $out = [];
    foreach ($exercises as $ex) {
        if (!is_array($ex)) continue;
        $k = normalizeTeenExerciseKey($ex);
        if ($k !== '' && isset($want[$k])) {
            $out[] = $ex;
        }
    }
    return $out;
}

function normalizeTeenGender(string $gender): string {
    $g = strtolower(trim($gender));
    if ($g === 'ذكر' || $g === 'male' || $g === 'm' || $g === 'man' || $g === 'boy') return 'male';
    if ($g === 'انثى' || $g === 'أنثى' || $g === 'female' || $g === 'f' || $g === 'woman' || $g === 'girl') return 'female';
    return $g;
}

function normalizeTeenFitnessLevel(string $fitnessLevel): string {
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
        'لا امارس رياضه' => 'beginner',
        'مبتدئ' => 'beginner',
        'متوسط' => 'intermediate',
        'متوسطة' => 'intermediate',
        'رياضي' => 'advanced',
        'متقدم' => 'advanced',
    ];
    return $map[$lvl] ?? $lvl;
}

function normalizeTeenGoal(string $goal): string {
    $g = strtolower(trim($goal));
    $map = [
        'muscle' => 'muscle',
        'build_muscle' => 'muscle',
        'gain' => 'muscle',
        'weight_loss' => 'weight_loss',
        'lose_weight' => 'weight_loss',
        'fat_loss' => 'weight_loss',
        'balance' => 'balance',
        'mix' => 'balance',
        'general' => 'balance',
        'بناء عضلات' => 'muscle',
        'بناء عضلات ' => 'muscle',
        'تخسيس' => 'weight_loss',
        'إنقاص وزن' => 'weight_loss',
        'انقاص وزن' => 'weight_loss',
        'توازن' => 'balance',
        'لياقة' => 'balance',
        'لياقة عامة' => 'balance',
    ];
    return $map[$g] ?? $g;
}

function normalizeTeenHealthCondition(string $healthCondition): string {
    $hc = strtolower(trim($healthCondition));

    $map = [
        '' => HC_HEALTHY,
        'healthy' => HC_HEALTHY,
        'normal' => HC_HEALTHY,
        'سليم' => HC_HEALTHY,
        'لا اعاني' => HC_HEALTHY,
        'لا أعاني' => HC_HEALTHY,
        'diabetes' => HC_DIABETES,
        'سكر' => HC_DIABETES,
        'سكري' => HC_DIABETES,
        'heart' => HC_HEART,
        'قلب' => HC_HEART,
        'pressure' => HC_PRESSURE,
        'ضغط' => HC_PRESSURE,
        'asthma' => HC_ASTHMA,
        'ربو' => HC_ASTHMA,
        'joints' => HC_JOINTS,
        'joint_pain' => HC_JOINTS,
        'المفاصل' => HC_JOINTS,
        'آلام مفاصل' => HC_JOINTS,
        'الم مفاصل' => HC_JOINTS,
        'chronic' => 'chronic',
        'مزمن' => 'chronic',
        'امراض مزمنه' => 'chronic',
        'أمراض مزمنة' => 'chronic',
    ];

    return $map[$hc] ?? $hc;
}

// Main recommendation engine for teens
function getTeenExerciseRecommendation(array $profile): array {
    $age = (int)($profile['age'] ?? 0);
    $gender = normalizeTeenGender((string)($profile['gender'] ?? ''));
    $healthCondition = normalizeTeenHealthCondition((string)($profile['health_condition'] ?? ''));
    $fitnessLevel = normalizeTeenFitnessLevel((string)($profile['fitness_level'] ?? ''));
    $goal = normalizeTeenGoal((string)($profile['goal'] ?? ''));
    $timeAvailable = (int)($profile['time_available'] ?? 30);
    
    // Get all exercises
    $allExercises = getTeenExerciseLibrary();
    
    // Step 1: Filter by health condition (SAFETY FIRST)
    $safeExercises = filterSafeExercises($allExercises, $healthCondition);
    
    // Step 2: Determine difficulty based on fitness level
    $targetDifficulty = match($fitnessLevel) {
        'beginner', '' => LVL_EASY,
        'intermediate' => LVL_MEDIUM,
        'advanced' => LVL_HARD,
        default => LVL_EASY
    };
    
    // Beginners always EASY
    if ($fitnessLevel === 'beginner' || $fitnessLevel === '') {
        $targetDifficulty = LVL_EASY;
    }

    // For chronic conditions, force easy level
    $isChronic = in_array($healthCondition, [HC_DIABETES, HC_HEART, HC_PRESSURE, HC_ASTHMA], true) || ($healthCondition === 'chronic');
    if ($isChronic) {
        $targetDifficulty = LVL_EASY;
    }
    
    // Step 3: Filter by goal
    $selectedExercises = [];

    // Health conditions override goal
    if ($healthCondition === HC_JOINTS) {
        // Low impact + core/balance only
        $lowImpact = getExercisesByCategory($safeExercises, CAT_LOW_IMPACT);
        $core = getExercisesByCategory($safeExercises, CAT_CORE);
        $selectedExercises = array_merge($lowImpact, $core);
        // Avoid anything marked very_high even if slipped through
        $selectedExercises = array_filter($selectedExercises, fn($ex) => (($ex['intensity'] ?? '') !== 'very_high'));
    } elseif (in_array($healthCondition, [HC_HEART, HC_PRESSURE, HC_ASTHMA], true)) {
        // Very safe mix only (no violent jumping)
        $lowImpact = getExercisesByCategory($safeExercises, CAT_LOW_IMPACT);
        $core = getExercisesByCategory($safeExercises, CAT_CORE);
        $selectedExercises = array_merge($lowImpact, $core);
        $selectedExercises = array_filter($selectedExercises, fn($ex) => (($ex['intensity'] ?? '') !== 'very_high'));
    } elseif ($healthCondition === 'chronic') {
        $lowImpact = getExercisesByCategory($safeExercises, CAT_LOW_IMPACT);
        $core = getExercisesByCategory($safeExercises, CAT_CORE);
        $selectedExercises = array_merge($lowImpact, $core);
    }
    
    if (count($selectedExercises) === 0) {
        switch ($goal) {
            case 'muscle': // بناء عضلات
                $strength = getExercisesByCategory($safeExercises, CAT_STRENGTH);
                $core = getExercisesByCategory($safeExercises, CAT_CORE);
                $selectedExercises = array_merge($strength, $core);
                break;
                
            case 'weight_loss': // تخسيس
                $cardio = getExercisesByCategory($safeExercises, CAT_CARDIO);
                // Filter cardio for safety
                if ($fitnessLevel === 'beginner' || !empty($healthCondition)) {
                    $cardio = array_filter($cardio, fn($ex) => $ex['difficulty'] !== LVL_HARD);
                }
                if ($isChronic) {
                    $cardio = array_filter($cardio, fn($ex) => (($ex['intensity'] ?? '') !== 'very_high'));
                }
                $core = getExercisesByCategory($safeExercises, CAT_CORE);
                $selectedExercises = array_merge($cardio, $core);
                break;
                
            case 'balance': // توازن
                $core = getExercisesByCategory($safeExercises, CAT_CORE);
                $lowImpact = getExercisesByCategory($safeExercises, CAT_LOW_IMPACT);
                $selectedExercises = array_merge($core, $lowImpact);
                break;
                
            default: // Mix
                $strength = getExercisesByCategory($safeExercises, CAT_STRENGTH);
                $cardio = getExercisesByCategory($safeExercises, CAT_CARDIO);
                $core = getExercisesByCategory($safeExercises, CAT_CORE);
                $selectedExercises = array_merge($strength, $cardio, $core);
        }
    }
    
    // Step 4: Sort by difficulty (easiest first for beginners)
    usort($selectedExercises, function($a, $b) use ($targetDifficulty) {
        $diffOrder = ['easy' => 1, 'medium' => 2, 'hard' => 3];
        $aDiff = $diffOrder[$a['difficulty']] ?? 2;
        $bDiff = $diffOrder[$b['difficulty']] ?? 2;
        return $aDiff - $bDiff;
    });
    
    // Step 5: Select based on time available
    // 15 min = 3 exercises, 30 min = 5 exercises, 45+ min = 7 exercises
    $exerciseCount = match(true) {
        $timeAvailable <= 15 => 3,
        $timeAvailable <= 30 => 5,
        default => 7
    };

    $preferredOrder = teenPreferredOrderByScenario($healthCondition, $goal, $fitnessLevel, $gender);
    $usedPreferredOrder = (count($preferredOrder) > 0);
    if (count($preferredOrder) > 0) {
        // Ensure preferred exercises exist in pool (some scenarios mix categories like squats in weight-loss)
        $mustInclude = pickTeenExercisesByKeys($safeExercises, $preferredOrder);
        if (count($mustInclude) > 0) {
            $selectedExercises = array_merge($selectedExercises, $mustInclude);
        }
        $selectedExercises = selectTeenPreferredExercises($selectedExercises, $preferredOrder, $exerciseCount);
    }
    
    $finalExercises = array_slice($selectedExercises, 0, $exerciseCount);
    
    // Step 6: Gender-specific adjustments
    if (!$usedPreferredOrder && $gender === 'male') {
        // Prioritize upper body strength for boys
        usort($finalExercises, function($a, $b) {
            $aIsUpper = str_contains($a['target_muscles'] ?? '', 'الصدر') || 
                       str_contains($a['target_muscles'] ?? '', 'الكتفين');
            $bIsUpper = str_contains($b['target_muscles'] ?? '', 'الصدر') || 
                       str_contains($b['target_muscles'] ?? '', 'الكتفين');
            return $bIsUpper <=> $aIsUpper;
        });
    } elseif (!$usedPreferredOrder && $gender === 'female') {
        // Prioritize balance and flexibility for girls
        usort($finalExercises, function($a, $b) {
            $aIsBalance = $a['category'] === CAT_CORE || 
                         str_contains($a['target_muscles'] ?? '', 'التوازن');
            $bIsBalance = $b['category'] === CAT_CORE || 
                         str_contains($b['target_muscles'] ?? '', 'التوازن');
            return $bIsBalance <=> $aIsBalance;
        });
    }
    
    // Step 7: Add safety warnings and modifications
    foreach ($finalExercises as &$ex) {
        // Add modification if needed for health condition
        if (isset($ex['modifications'][$healthCondition])) {
            $ex['modification_note'] = $ex['modifications'][$healthCondition];
        }
        
        // Add beginner modification if applicable
        if ($fitnessLevel === 'beginner' && isset($ex['modifications']['beginner'])) {
            $ex['modification_note'] = $ex['modifications']['beginner'];
        }
        
        // Add gender-specific note
        if ($gender === 'male' && $ex['gender_focus'] === 'both') {
            $ex['gender_note'] = 'ركز على الشكل الصحيح وبناء القوة تدريجياً';
        } elseif ($gender === 'female' && $ex['gender_focus'] === 'both') {
            $ex['gender_note'] = 'ركزي على التوازن والتحكم في الحركة';
        }
    }
    
    return [
        'exercises' => $finalExercises,
        'total_duration' => $timeAvailable,
        'difficulty' => $targetDifficulty,
        'goal' => $goal,
        'health_condition' => $healthCondition,
        'safety_notes' => generateSafetyNotes($healthCondition, $fitnessLevel)
    ];
}

// Generate safety notes based on health condition
function generateSafetyNotes(string $healthCondition, string $fitnessLevel): array {
    $notes = [];
    
    if ($healthCondition === 'joint_pain') {
        $healthCondition = HC_JOINTS;
    }
    
    // General safety for teens
    $notes[] = 'استخدم أوزان الجسم فقط (لا أوزان ثقيلة)';
    $notes[] = 'توقف فوراً إذا شعرت بألم أو دوار';
    $notes[] = 'اشرب ماء قبل وأثناء وبعد التمرين';
    
    // Health condition specific
    switch ($healthCondition) {
        case HC_DIABETES:
            $notes[] = 'راقب مستوى السكر قبل وبعد التمرين';
            $notes[] = 'تجنب الشدة العالية جداً';
            $notes[] = 'احتفظ بمصدر سكر سريع بالقرب منك';
            break;
            
        case HC_HEART:
            $notes[] = 'لا تجاوز معدل ضربات القلب 140 نبضة/دقيقة';
            $notes[] = 'تجنب الجهد المفاجئ';
            $notes[] = 'استشر طبيبك قبل التمرين المنتظم';
            break;

        case HC_PRESSURE:
            $notes[] = 'لا تمسك النفس أثناء التمرين';
            $notes[] = 'تجنب القفز العنيف والمجهود العالي';
            $notes[] = 'راقب ضغطك قبل وبعد التمرين إذا أمكن';
            break;
            
        case HC_ASTHMA:
            $notes[] = 'احتفظ بجهاز الاستنشاق بالقرب منك';
            $notes[] = 'تجنب التمارين في الهواء البارد أو الملوث';
            $notes[] = 'ابدأ بتمارين التنفس';
            break;
            
        case HC_JOINTS:
            $notes[] = 'تجنب القفز والهبوط القوي';
            $notes[] = 'ركز على التمارين الثابتة';
            $notes[] = 'استخدم فرشاة أو سطح ناعم';
            break;

        case 'chronic':
            $notes[] = 'اختر تمارين خفيفة إلى متوسطة فقط';
            $notes[] = 'تجنب القفز العنيف والتمارين عالية الشدة';
            $notes[] = 'لو لديك أعراض أو دوخة توقف فوراً واستشر طبيب';
            break;
    }
    
    // Fitness level specific
    if ($fitnessLevel === 'beginner') {
        $notes[] = 'ابدأ بـ 50% من الجهد وازداد تدريجياً';
        $notes[] = 'الراحة بين التمارين مهمة جداً';
    }
    
    return $notes;
}

// Check if user is teen (12-16)
function isTeen(int $age): bool {
    return $age >= 12 && $age <= 18;
}

// Get all available goals
function getGoals(): array {
    return [
        'muscle' => 'بناء عضلات',
        'weight_loss' => 'تخسيس',
        'balance' => 'توازن ولياقة عامة'
    ];
}

// Get all fitness levels
function getFitnessLevels(): array {
    return [
        'beginner' => 'مبتدئ (لا أمارس رياضة)',
        'intermediate' => 'متوسط',
        'advanced' => 'رياضي'
    ];
}

// Get health conditions with descriptions
function getHealthConditions(): array {
    return [
        'healthy' => 'لا أعاني من أي مشاكل صحية',
        'diabetes' => 'سكري',
        'heart' => 'مشاكل في القلب',
        'pressure' => 'ضغط',
        'asthma' => 'ربو',
        'joints' => 'آلام في المفاصل'
    ];
}

// Get time options
function getTimeOptions(): array {
    return [
        '15' => '15 دقيقة',
        '30' => '30 دقيقة',
        '45' => '45 دقيقة',
        '60' => '60 دقيقة'
    ];
}
 