<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$student = App\Models\Student::find(256);
echo "Student ID: 256 (Varalakshmi M)\n";
echo "Roll: " . $student->roll_number . "\n";
echo "tuition_fee: " . $student->tuition_fee . "\n";
echo "admission_fee: " . $student->admission_fee . "\n";
echo "exam_fee: " . $student->exam_fee . "\n";
echo "hostel_fee: " . $student->hostel_fee . "\n";
echo "bus_fee: " . $student->bus_fee . "\n";
echo "total_fee: " . $student->total_fee . "\n";
echo "discount: " . $student->discount . "\n";
echo "final_fee: " . $student->final_fee . "\n";
echo "training_fee: " . ($student->training_fee ?? 'NULL') . "\n";
echo "after_placement_amount: " . ($student->after_placement_amount ?? 'NULL') . "\n";
echo "after_placement_fee: " . ($student->after_placement_fee ?? 'NULL') . "\n";
