<?php
require __DIR__ . '/senior_exercises.php';

function runScenario(array $p, string $label): void {
    echo "=== {$label} ===\n";
    $r = getSeniorExerciseRecommendation($p);
    $i = 1;
    foreach (($r['exercises'] ?? []) as $e) {
        $name = $e['name_en'] ?? ($e['name'] ?? '');
        echo $i . ') ' . $name . "\n";
        $i++;
    }
    echo "-- safety_notes --\n";
    foreach (($r['safety_notes'] ?? []) as $n) {
        echo '- ' . $n . "\n";
    }
    echo "\n";
}

runScenario([
    'age' => 55,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'beginner',
    'goal' => 'muscle',
    'time_available' => 30,
], '55 male healthy beginner muscle 30');

runScenario([
    'age' => 55,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'beginner',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '55 male healthy beginner weight_loss 30');

runScenario([
    'age' => 58,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'intermediate',
    'goal' => 'muscle',
    'time_available' => 30,
], '58 male healthy intermediate muscle 30');

runScenario([
    'age' => 58,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'intermediate',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '58 male healthy intermediate weight_loss 30');

runScenario([
    'age' => 62,
    'gender' => 'female',
    'health_condition' => 'joint_pain',
    'fitness_level' => 'advanced',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '62 female joints anygoal 30');

runScenario([
    'age' => 63,
    'gender' => 'female',
    'health_condition' => 'heart',
    'fitness_level' => 'intermediate',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '63 female heart anygoal 30');

runScenario([
    'age' => 60,
    'gender' => 'female',
    'health_condition' => 'normal',
    'fitness_level' => 'intermediate',
    'goal' => 'balance',
    'time_available' => 30,
], '60 female healthy balance 30');
