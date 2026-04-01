<?php
require __DIR__ . '/adult_exercises.php';

function runScenario(array $p, string $label): void {
    echo "=== {$label} ===\n";
    $r = getAdultExerciseRecommendation($p);
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
    'age' => 22,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'beginner',
    'goal' => 'muscle',
    'time_available' => 30,
], '22 male healthy beginner muscle 30');

runScenario([
    'age' => 22,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'beginner',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '22 male healthy beginner weight_loss 30');

runScenario([
    'age' => 24,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'intermediate',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '24 male healthy intermediate weight_loss 30');

runScenario([
    'age' => 26,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'advanced',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '26 male healthy advanced weight_loss 30');

runScenario([
    'age' => 26,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'advanced',
    'goal' => 'muscle',
    'time_available' => 30,
], '26 male healthy advanced muscle 30');

runScenario([
    'age' => 23,
    'gender' => 'female',
    'health_condition' => 'joint_pain',
    'fitness_level' => 'advanced',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '23 female joints advanced anygoal 30');

runScenario([
    'age' => 23,
    'gender' => 'female',
    'health_condition' => 'heart',
    'fitness_level' => 'intermediate',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '23 female heart intermediate weight_loss 30');

runScenario([
    'age' => 23,
    'gender' => 'female',
    'health_condition' => 'normal',
    'fitness_level' => 'intermediate',
    'goal' => 'balance',
    'time_available' => 30,
], '23 female healthy balance 30');
