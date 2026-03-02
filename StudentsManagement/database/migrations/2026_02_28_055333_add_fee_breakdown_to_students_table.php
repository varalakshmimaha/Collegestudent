<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->decimal('tuition_fee', 10, 2)->default(0)->after('total_fee');
            $table->decimal('admission_fee', 10, 2)->default(0)->after('tuition_fee');
            $table->decimal('exam_fee', 10, 2)->nullable()->default(0)->after('admission_fee');
            $table->decimal('hostel_fee', 10, 2)->nullable()->default(0)->after('exam_fee');
            $table->decimal('bus_fee', 10, 2)->nullable()->default(0)->after('hostel_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['tuition_fee', 'admission_fee', 'exam_fee', 'hostel_fee', 'bus_fee']);
        });
    }
};
