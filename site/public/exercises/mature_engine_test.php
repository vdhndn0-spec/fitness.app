<?php
require __DIR__ . '/mature_exercises.php';

function runScenario(array $p, string $label): void {
    echo "=== {$label} ===\n";
    $r = getMatureExerciseRecommendation($p);
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
    'age' => 35,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'beginner',
    'goal' => 'muscle',
    'time_available' => 30,
], '35 male healthy beginner muscle 30');

runScenario([
    'age' => 35,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'beginner',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '35 male healthy beginner weight_loss 30');

runScenario([
    'age' => 38,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'intermediate',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '38 male healthy intermediate weight_loss 30');

runScenario([
    'age' => 40,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'advanced',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '40 male healthy advanced weight_loss 30');

runScenario([
    'age' => 42,
    'gender' => 'female',
    'health_condition' => 'joint_pain',
    'fitness_level' => 'advanced',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '42 female joints advanced anygoal 30');

runScenario([
    'age' => 45,
    'gender' => 'female',
    'health_condition' => 'heart',
    'fitness_level' => 'intermediate',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '45 female heart intermediate anygoal 30');

runScenario([
    'age' => 39,
    'gender' => 'female',
    'health_condition' => 'normal',
    'fitness_level' => 'intermediate',
    'goal' => 'balance',
    'time_available' => 30,
], '39 female healthy balance 30');
