<?php
require __DIR__ . '/teen_exercises.php';

function runScenario(array $p, string $label): void {
    echo "=== {$label} ===\n";
    $r = getTeenExerciseRecommendation($p);
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
    'age' => 15,
    'gender' => 'male',
    'health_condition' => 'diabetes',
    'fitness_level' => 'beginner',
    'goal' => 'muscle',
    'time_available' => 30,
], '15 male diabetes beginner muscle 30');

runScenario([
    'age' => 15,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'beginner',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '15 male normal beginner weight_loss 30');

runScenario([
    'age' => 15,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'beginner',
    'goal' => 'muscle',
    'time_available' => 30,
], '15 male normal beginner muscle 30');

runScenario([
    'age' => 15,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'intermediate',
    'goal' => 'muscle',
    'time_available' => 30,
], '15 male normal intermediate muscle 30');

runScenario([
    'age' => 15,
    'gender' => 'male',
    'health_condition' => 'normal',
    'fitness_level' => 'advanced',
    'goal' => 'weight_loss',
    'time_available' => 30,
], '15 male normal advanced weight_loss 30');

runScenario([
    'age' => 15,
    'gender' => 'female',
    'health_condition' => 'joint_pain',
    'fitness_level' => 'advanced',
    'goal' => 'muscle',
    'time_available' => 30,
], '15 female joint_pain advanced muscle 30');

runScenario([
    'age' => 15,
    'gender' => 'female',
    'health_condition' => 'heart',
    'fitness_level' => 'beginner',
    'goal' => 'muscle',
    'time_available' => 30,
], '15 female heart beginner muscle 30');
