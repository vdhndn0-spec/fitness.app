(function () {
  function qs(sel) { return document.querySelector(sel); }

  function readCompletedExerciseIds() {
    try {
      const raw = localStorage.getItem('fitness_completed_exercises');
      if (!raw) return [];
      const arr = JSON.parse(raw);
      return Array.isArray(arr) ? arr.map(String) : [];
    } catch (e) {
      return [];
    }
  }

  function writeCompletedExerciseIds(ids) {
    try {
      localStorage.setItem('fitness_completed_exercises', JSON.stringify(ids));
    } catch (e) {
      // ignore
    }
  }

  function markExerciseDone(exerciseId) {
    const id = String(exerciseId || '').trim();
    if (!id) return false;
    const ids = readCompletedExerciseIds();
    if (ids.indexOf(id) !== -1) return false;
    ids.push(id);
    writeCompletedExerciseIds(ids);
    return true;
  }

  // Local exercise database - ONLY used as fallback if Gemini fails
  const fallbackExercises = [
    { name: 'المشي السريع', duration: '30 دقيقة', difficulty: 'سهل', image: '🚶', benefits: 'حرق السعرات وتحسين صحة القلب' },
    { name: 'السباحة الخفيفة', duration: '20 دقيقة', difficulty: 'سهل', image: '🏊', benefits: 'تمرين شامل للجسم دون ضغط على المفاصل' },
    { name: 'تمارين الضغط', duration: '3 مجموعات × 10', difficulty: 'متوسط', image: '💪', benefits: 'تقوية الصدر والذراعين' },
    { name: 'البلانك', duration: '3 × 30 ثانية', difficulty: 'متوسط', image: '🧘', benefits: 'تقوية عضلات البطن والظهر' }
  ];

  async function fetchAIResults(data) {
    try {
      const resp = await fetch('api/ai_recommend.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ data: data })
      });

      const json = await resp.json().catch(function () { return null; });
      if (!resp.ok || !json || !json.ok || !json.results) {
        const msg = (json && json.error) ? json.error : 'فشل الاتصال بالذكاء الاصطناعي';
        throw new Error(msg);
      }

      return json.results;
    } catch (e) {
      return null; // Return null to indicate Gemini failed
    }
  }

  function calculateBMI(weightKg, heightCm) {
    const h = heightCm / 100;
    return (weightKg / (h * h));
  }

  function analyzeBMI(bmi) {
    if (bmi < 18.5) return { status: 'نحيف', className: 'text-primary', recommendation: 'تحتاج لتمارين بناء عضلات مع تغذية جيدة لزيادة الوزن الصحي' };
    if (bmi < 25) return { status: 'وزن طبيعي', className: 'text-success', recommendation: 'وزنك مثالي! حافظ على لياقتك بتمارين متوازنة' };
    if (bmi < 30) return { status: 'وزن زائد', className: 'text-warning', recommendation: 'ينصح بالتركيز على تمارين الكارديو وضبط النظام الغذائي' };
    return { status: 'سمنة', className: 'text-danger', recommendation: 'يجب البدء بتمارين خفيفة منخفضة التأثير واستشارة طبيب' };
  }

  function generateTips(data, bmi) {
    const tips = [];
    if (bmi > 25) {
      tips.push('ابدأ بالتمارين الخفيفة وزد الشدة تدريجياً لتجنب الإرهاق');
      tips.push('شرب الماء بكميات كافية (3 لتر يومياً) يعزز عملية الحرق');
    }
    if (data.fitnessLevel === 'beginner') {
      tips.push('الراحة لا تقل أهمية عن التمرين، خذ يوم راحة بعد كل يومين تمرين');
      tips.push('لا تهمل تمارين الإحماء (5-10 دقائق) لتجنب الإصابات');
    }
    if (data.healthCondition === 'joint_pain') {
      tips.push('استبدل الجري بالمشي السريع أو السباحة لتخفيف الضغط على المفاصل');
      tips.push('توقف فوراً إذا شعرت بألم حاد في المفاصل');
    }
    tips.push('النوم الجيد (7-8 ساعات) هو الوقت الذي يبني فيه جسمك العضلات');
    return tips;
  }

  // Exercise-specific tips/warnings based on exercise name
  function getExerciseTips(exerciseName, healthCondition) {
    const name = (exerciseName || '').toLowerCase();
    const tips = [];
    
    // Running tips
    if (name.indexOf('جري') !== -1 || name.indexOf('ركض') !== -1 || name.indexOf('مشي') !== -1) {
      tips.push('ابدأ ببطء وزد السرعة تدريجياً');
      tips.push('حافظ على استقامة الظهر أثناء الجري');
      if (healthCondition === 'joint_pain') {
        tips.push('⚠️ تجنب الجري على الأسطح الصلبة، استبدله بالمشي السريع');
      }
    }
    
    // Swimming tips
    if (name.indexOf('سباحة') !== -1) {
      tips.push('تأكد من الإحماء الجيد قبل الدخول للماء');
      tips.push('اشرب ماء قبل السباحة لتجنب الجفاف');
    }
    
    // Push-ups tips
    if (name.indexOf('ضغط') !== -1 || name.indexOf('_push') !== -1) {
      tips.push('حافظ على جسمك مستقيماً من الرأس للكعبين');
      tips.push('لا تخفض صدرك أكثر من مستوى المرفقين');
      if (healthCondition === 'back_pain') {
        tips.push('⚠️ استبدل الضغط العادي بالضغط على الركبتين لتخفيف الضغط على الظهر');
      }
    }
    
    // Squats tips
    if (name.indexOf('سكوات') !== -1 || name.indexOf('قرفصاء') !== -1 || name.indexOf('squat') !== -1) {
      tips.push('ركبتك لا يجب أن تتجاوز أصابع القدمين');
      tips.push('حافظ على ظهرك مستقيماً أثناء النزول');
      if (healthCondition === 'knee_pain') {
        tips.push('⚠️ لا تنزل بعمق كامل، قف عند زاوية 90 درجة');
      }
    }
    
    // Plank tips
    if (name.indexOf('بلانك') !== -1 || name.indexOf('plank') !== -1) {
      tips.push('شد عضلات بطنك ولا تدع ظهرك ينحني');
      tips.push('تنفس بشكل طبيعي ولا تحبس أنفاسك');
    }
    
    // Weight lifting tips
    if (name.indexOf('حديد') !== -1 || name.indexOf('دمبل') !== -1 || name.indexOf('_weights') !== -1) {
      tips.push('ابدأ بأوزان خفيفة وركز على التقنية الصحيحة');
      tips.push('لا ترمِ الأوزان بقوة عند الانتهاء');
      if (healthCondition === 'back_pain') {
        tips.push('⚠️ تجنب رفع الأوزان الثقيلة فوق الرأس');
      }
    }
    
    // Cycling tips
    if (name.indexOf('عجلة') !== -1 || name.indexOf('دراجة') !== -1 || name.indexOf('cyc') !== -1) {
      tips.push('اضبط ارتفاع المقعد بحيث تبقى ركبتك مائلة قليلاً عند الوضعية السفلى');
      tips.push('حافظ على وضعية مريحة للظهر');
    }
    
    // Stretching/Yoga tips
    if (name.indexOf('تمدد') !== -1 || name.indexOf('يوغا') !== -1 || name.indexOf('yoga') !== -1) {
      tips.push('لا تتجاوز حدود مرونتك، التمدد يجب أن يكون مريحاً وليس مؤلماً');
      tips.push('حافظ على كل تمدد لمدة 15-30 ثانية');
    }
    
    // HIIT tips
    if (name.indexOf('هيت') !== -1 || name.indexOf('hiit') !== -1 || name.indexOf('تبويب') !== -1) {
      tips.push('تأكد من الإحماء الجيد قبل البدء');
      tips.push('إذا شعرت بدوخة أو ألم صدر، توقف فوراً');
      if (healthCondition === 'heart_condition') {
        tips.push('⚠️ استشر طبيبك قبل ممارسة تمارين HIIT');
      }
    }
    
    // General tips if no specific tips matched
    if (tips.length === 0) {
      tips.push('ركز على التقنية الصحيحة أكثر من السرعة');
      tips.push('توقف فوراً إذا شعرت بألم حاد');
    }
    
    return tips;
  }
  function createFallbackResults(data, bmi) {
    const bmiAnalysis = analyzeBMI(bmi);
    const limit = data.timeAvailable === '15' ? 3 : (data.timeAvailable === '30' ? 5 : 4);
    
    // Select appropriate fallback exercises based on health condition
    let selected = fallbackExercises.slice(0, limit);
    
    // Filter out high impact exercises for joint pain
    if (data.healthCondition === 'joint_pain') {
      selected = selected.filter(function(ex) {
        return ex.name.indexOf('المشي') !== -1 || ex.name.indexOf('السباحة') !== -1;
      });
      // Add more gentle exercises if filtered too much
      if (selected.length < 2) {
        selected.push({ name: 'تمارين الماء', duration: '20 دقيقة', difficulty: 'سهل', image: '💧', benefits: 'آمن تماماً للمفاصل' });
      }
    }

    return {
      bmi: bmi.toFixed(1),
      bmiAnalysis: bmiAnalysis,
      exercises: selected.map(function(ex) {
        return {
          name: ex.name,
          duration: ex.duration,
          difficulty: ex.difficulty,
          image: ex.image,
          benefits: ex.benefits,
          aiReason: 'اقتراح احتياطي (الذكاء الاصطناعي غير متاح)'
        };
      }),
      tips: generateTips(data, bmi)
    };
  }

  // Main function to get recommendations - TRIES GEMINI FIRST
  async function suggestExercises(data) {
    const bmi = calculateBMI(Number(data.weight), Number(data.height));
    
    // Try Gemini first
    const geminiResults = await fetchGeminiResults(data);
    
    if (geminiResults && geminiResults.exercises && geminiResults.exercises.length > 0) {
      // Gemini succeeded - return AI-generated results
      return {
        bmi: geminiResults.bmi || bmi.toFixed(1),
        bmiAnalysis: geminiResults.bmiAnalysis || analyzeBMI(bmi),
        exercises: geminiResults.exercises,
        tips: geminiResults.tips || generateTips(data, bmi)
      };
    }
    
    // Gemini failed - use fallback local exercises
    return createFallbackResults(data, bmi);
  }

  function renderResults(payload) {
    const root = qs('#resultsRoot');
    if (!root) return;

    const goalLabel = payload.data.goal === 'weight_loss' ? 'تخسيس' : payload.data.goal === 'muscle_gain' ? 'عضلات' : payload.data.goal === 'flexibility' ? 'مرونة' : 'لياقة';
    const levelLabel = payload.data.fitnessLevel === 'beginner' ? 'مبتدئ' : payload.data.fitnessLevel === 'intermediate' ? 'متوسط' : 'متقدم';

    const badgeClass = payload.results.bmiAnalysis.className;

    function exerciseDetailsUrl(ex) {
      const qs = new URLSearchParams();
      qs.set('id', ex.id || '');
      qs.set('name', ex.name || '');
      qs.set('duration', ex.duration || '');
      qs.set('difficulty', ex.difficulty || '');
      qs.set('benefits', ex.benefits || '');
      qs.set('videoUrl', ex.videoUrl || '');
      return 'exercise.php?' + qs.toString();
    }

    function getExerciseTipHtml(ex) {
      const tips = getExerciseTips(ex.name, payload.data.healthCondition);
      if (!tips || tips.length === 0) return '';
      const tipItems = tips.map(function(t) {
        const isWarning = t.indexOf('⚠️') !== -1;
        const alertClass = isWarning ? 'alert alert-warning py-1 px-2 small mb-1' : 'alert alert-info py-1 px-2 small mb-1';
        return '<div class="' + alertClass + '">' + t + '</div>';
      }).join('');
      return '<div class="mt-2">' + tipItems + '</div>';
    }

    const warmupCards = [];

    const exCards = payload.results.exercises.map(function (ex) {
      const diffClass = ex.difficulty.indexOf('سهل') !== -1 ? 'success' : (ex.difficulty === 'متوسط' ? 'warning' : 'danger');
      const href = exerciseDetailsUrl(ex);
      return (
        '<div class="col-md-6 col-lg-4">' +
          '<a class="card h-100 card-hover text-decoration-none text-reset" href="' + href + '">' +
            '<div class="card-body">' +
              '<div class="d-flex align-items-start justify-content-between gap-2">' +
                '<div>' +
                  '<div class="fw-bold">' + ex.name + '</div>' +
                '</div>' +
                '<span class="badge text-bg-' + diffClass + '">' + ex.difficulty + '</span>' +
              '</div>' +
              '<div class="mt-3 small text-muted badge-soft rounded px-2 py-1 d-inline-block">⏱ ' + ex.duration + '</div>' +
              '<div class="mt-2 small"><span class="fw-bold text-success">الفائدة:</span> ' + ex.benefits + '</div>' +
              (ex.aiReason ? '<div class="mt-2 small text-muted">' + ex.aiReason + '</div>' : '') +
              getExerciseTipHtml(ex) +
            '</div>' +
          '</a>' +
        '</div>'
      );
    }).join('');

    const tips = payload.results.tips.map(function (t) {
      return '<li class="list-group-item">' + t + '</li>';
    }).join('');

    const completedCount = readCompletedExerciseIds().length;
    const totalCount = (payload.results && Array.isArray(payload.results.exercises)) ? payload.results.exercises.length : 0;
    const progressPct = totalCount > 0 ? Math.min(100, Math.round((completedCount / totalCount) * 100)) : 0;

    root.innerHTML = (
      '<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">' +
        '<div>' +
          '<h2 class="h3 fw-bold mb-1">برنامجك جاهز، ' + (payload.data.name || '') + '</h2>' +
          '<div class="text-muted small">تاريخ الإنشاء: ' + new Date().toLocaleDateString('ar-EG') + '</div>' +
        '</div>' +
      '</div>' +

      '<div class="row g-3 mb-4">' +
        '<div class="col-md-4">' +
          '<div class="card h-100">' +
            '<div class="card-body text-center">' +
              '<div class="text-muted fw-bold">مؤشر الكتلة (BMI)</div>' +
              '<div class="display-6 fw-bold mt-2">' + payload.results.bmi + '</div>' +
              '<div class="mt-2 fw-bold ' + badgeClass + '">' + payload.results.bmiAnalysis.status + '</div>' +
            '</div>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-8">' +
          '<div class="card h-100">' +
            '<div class="card-body">' +
              '<div class="fw-bold mb-2">تحليل الحالة</div>' +
              '<div class="alert alert-warning mb-3">' + payload.results.bmiAnalysis.recommendation + '</div>' +
              '<div class="row g-2 small">' +
                '<div class="col-6 col-md-3"><div class="p-2 bg-light rounded"><div class="text-muted">الوزن</div><div class="fw-bold">' + payload.data.weight + ' كجم</div></div></div>' +
                '<div class="col-6 col-md-3"><div class="p-2 bg-light rounded"><div class="text-muted">الطول</div><div class="fw-bold">' + payload.data.height + ' سم</div></div></div>' +
                '<div class="col-6 col-md-3"><div class="p-2 bg-light rounded"><div class="text-muted">الهدف</div><div class="fw-bold">' + goalLabel + '</div></div></div>' +
                '<div class="col-6 col-md-3"><div class="p-2 bg-light rounded"><div class="text-muted">المستوى</div><div class="fw-bold">' + levelLabel + '</div></div></div>' +
              '</div>' +
            '</div>' +
          '</div>' +
        '</div>' +
      '</div>' +

      '<div class="card mb-4 border-warning">' +
        '<div class="card-body">' +
          '<div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">' +
            '<div>' +
              '<h3 class="h5 fw-bold m-0">🔥 الإحماء</h3>' +
              '<p class="text-muted small mb-0 mt-1">ضروري قبل التمرين لتجنب الإصابات وتحسين الأداء</p>' +
            '</div>' +
            '<a class="btn btn-warning fw-bold" href="warmup-detail.php?gender=' + (payload.data.gender || 'male') + '">ابدأ الإحماء</a>' +
          '</div>' +
        '</div>' +
      '</div>' +

      '<div class="mb-4">' +
        '<div class="d-flex align-items-center justify-content-between mb-3">' +
          '<h3 class="h4 fw-bold m-0">جدول التمارين المقترح</h3>' +
        '</div>' +
        '<div class="row g-3">' + exCards + '</div>' +
      '</div>' +

      '<div class="card mb-4" id="progress">' +
        '<div class="card-body">' +
          '<div class="d-flex flex-wrap justify-content-between align-items-center gap-2">' +
            '<div class="fw-bold">التقدم</div>' +
            '<div class="text-muted small">' + completedCount + ' / ' + totalCount + '</div>' +
          '</div>' +
          '<div class="progress mt-3" role="progressbar" aria-label="progress" aria-valuenow="' + progressPct + '" aria-valuemin="0" aria-valuemax="100">' +
            '<div class="progress-bar bg-success" style="width:' + progressPct + '%"></div>' +
          '</div>' +
          '<div class="small text-muted mt-2">عند الضغط على "تم" داخل صفحة التمرين سيزيد التقدم تلقائيًا.</div>' +
        '</div>' +
      '</div>' +

      '<div class="card">' +
        '<div class="card-body">' +
          '<h3 class="h5 fw-bold">نصائح لنجاح خطتك</h3>' +
          '<ul class="list-group list-group-flush mt-2">' + tips + '</ul>' +
        '</div>' +
      '</div>'
    );
  }

  window.fitnessMarkExerciseDone = function (exerciseId) {
    return markExerciseDone(exerciseId);
  };

  function setupChronicConditionUI(form) {
    if (!form) return;
    const hcSelect = form.elements.namedItem('healthCondition');
    const chronicDetails = document.getElementById('chronicDetails');
    const chronicSelect = form.elements.namedItem('chronicCondition');

    if (!(hcSelect instanceof HTMLSelectElement) || !chronicDetails) return;

    const sync = function () {
      const isChronic = hcSelect.value === 'chronic';
      chronicDetails.style.display = isChronic ? '' : 'none';
      if (!isChronic && chronicSelect && 'value' in chronicSelect) {
        chronicSelect.value = '';
      }
    };

    hcSelect.addEventListener('change', sync);
    sync();
  }

  document.addEventListener('submit', function (e) {
    const form = e.target;
    if (!(form instanceof HTMLFormElement)) return;
    if (form.id !== 'assessmentForm') return;

    e.preventDefault();

    const data = {
      name: form.name.value.trim(),
      age: form.age.value,
      gender: form.gender.value,
      weight: form.weight.value,
      height: form.height.value,
      fitnessLevel: form.fitnessLevel.value,
      healthCondition: form.healthCondition.value,
      goal: form.goal.value,
      timeAvailable: form.timeAvailable.value
    };

    const chronicSelect = form.elements.namedItem('chronicCondition');
    if (data.healthCondition === 'chronic' && chronicSelect && 'value' in chronicSelect) {
      const chronicValue = String(chronicSelect.value || '').trim();
      if (!chronicValue) {
        alert('من فضلك اختر نوع المرض المزمن');
        if (chronicSelect instanceof HTMLElement) chronicSelect.focus();
        return;
      }
      if (chronicValue) {
        data.healthCondition = chronicValue;
      }
    }

    sessionStorage.setItem('fitness_assessment_data', JSON.stringify(data));

    sessionStorage.setItem('fitness_assessment_results', JSON.stringify({
      bmi: '',
      bmiAnalysis: { status: 'جاري التحليل...', className: 'text-primary', recommendation: 'جاري توليد خطة التمارين بالذكاء الاصطناعي...' },
      exercises: [],
      tips: []
    }));

    (async function () {
      try {
        // Save to database first if user is logged in
        const saveRes = await fetch('api/save_assessment.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'same-origin',
          body: JSON.stringify(data)
        });
        try {
          const saveJson = await saveRes.json();
          sessionStorage.setItem('fitness_last_save_assessment', JSON.stringify(saveJson));
        } catch (e) {
          // ignore
        }
      } catch (e) {
        // Continue even if save fails
      }

      try {
        const ai = await fetchAIResults(data);
        if (!ai) {
          throw new Error('لم يتم الحصول على اقتراحات من الذكاء الاصطناعي');
        }
        sessionStorage.setItem('fitness_assessment_results', JSON.stringify(ai));
        window.location.href = 'results.php';
      } catch (err) {
        const msg = err && err.message ? err.message : 'فشل توليد الاقتراحات بالذكاء الاصطناعي';
        const fallbackResults = createFallbackResults(data, calculateBMI(Number(data.weight), Number(data.height)));
        fallbackResults.bmiAnalysis.status = 'الذكاء الاصطناعي غير متاح';
        fallbackResults.bmiAnalysis.recommendation = msg + '. تم عرض اقتراحات احتياطية.';
        sessionStorage.setItem('fitness_assessment_results', JSON.stringify(fallbackResults));
        window.location.href = 'results.php';
      }
    })();
  });

  document.addEventListener('DOMContentLoaded', function () {
    const assessmentForm = qs('#assessmentForm');
    if (assessmentForm instanceof HTMLFormElement) {
      setupChronicConditionUI(assessmentForm);
    }

    const root = qs('#resultsRoot');
    if (!root) return;

    const dataStr = sessionStorage.getItem('fitness_assessment_data');
    const resStr = sessionStorage.getItem('fitness_assessment_results');

    if (!dataStr || !resStr || resStr === 'null') {
      root.innerHTML = '<div class="alert alert-info">لا توجد نتائج بعد. ابدأ من صفحة التقييم.</div><a class="btn btn-success fw-bold" href="assessment.php">اذهب للتقييم</a>';
      return;
    }

    const payload = {
      data: JSON.parse(dataStr),
      results: JSON.parse(resStr)
    };

    (async function () {
      try {
        if (!payload.results || !payload.results.exercises) {
          renderResults(payload);
          return;
        }

        if (!payload.results.warmup) {
          const fresh = await fetchAIResults(payload.data);
          if (fresh) {
            payload.results = fresh;
            sessionStorage.setItem('fitness_assessment_results', JSON.stringify(fresh));
          }
        }
      } catch (e) {
        // ignore and render whatever is cached
      }

      renderResults(payload);
    })();
  });
})();
