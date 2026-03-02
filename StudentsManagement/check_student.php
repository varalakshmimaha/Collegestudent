<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$student = App\Models\Student::find(1);
echo "Student ID: 1 (Arjun Mehta)\n";
echo "tuition_fee: " . $student->tuition_fee . "\n";
echo "admission_fee: " . $student->admission_fee . "\n";
echo "exam_fee: " . $student->exam_fee . "\n";
echo "hostel_fee: " . $student->hostel_fee . "\n";
echo "bus_fee: " . $student->bus_fee . "\n";
echo "total_fee: " . $student->total_fee . "\n";
echo "discount: " . $student->discount . "\n";
echo "final_fee: " . $student->final_fee . "\n";
echo "payable_now (accessor): " . $student->payable_now . "\n";
echo "paid_amount (accessor): " . $student->paid_amount . "\n";
echo "balance (accessor): " . $student->balance . "\n";
echo "fee_status: " . $student->fee_status . "\n";
