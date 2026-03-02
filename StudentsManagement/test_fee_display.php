<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get a student with paid amount to test display
$student = App\Models\Student::find(230); // Meera Gupta with partial payment

echo "Testing Fee Display for Student ID 230 (Meera Gupta):\n";
echo "============================================================\n";
echo "tuition_fee: " . $student->tuition_fee . "\n";
echo "admission_fee: " . $student->admission_fee . "\n";
echo "exam_fee: " . $student->exam_fee . "\n";
echo "hostel_fee: " . $student->hostel_fee . "\n";
echo "bus_fee: " . $student->bus_fee . "\n";
echo "total_fee: " . $student->total_fee . "\n";
echo "discount: " . $student->discount . "\n";
echo "final_fee: " . $student->final_fee . "\n";
echo "payable_now: " . $student->payable_now . "\n";
echo "paid_amount: " . $student->paid_amount . "\n";
echo "balance: " . $student->balance . "\n";
echo "fee_status: " . $student->fee_status . "\n";
echo "============================================================\n";
echo "View should display: Tuition ₹" . number_format($student->tuition_fee, 2) . ", \nAdmission ₹" . number_format($student->admission_fee, 2) . ", \nFinal Fee ₹" . number_format($student->final_fee, 2) . "\n";
