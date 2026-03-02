<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get students like the controller does
$students = App\Models\Student::with(['branch', 'course', 'batch'])
    ->withSum('payments', 'amount')
    ->latest()
    ->limit(5)
    ->get();

foreach ($students as $s) {
    echo "ID: " . $s->id . " | Roll: " . $s->roll_number . " | Name: " . $s->name . " | final_fee: " . $s->final_fee . " | paid: " . ($s->payments_sum_amount ?? 0) . "\n";
}
