<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->decimal('tax_rate', 5, 2)->default(0.11);
            $table->string('logo_url')->nullable();
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('segment')->nullable();
            $table->integer('level_count')->default(4);
            $table->string('duration')->nullable();
            $table->decimal('fee_per_period', 12, 2)->default(1250000);
            $table->timestamps();
        });

        Schema::create('periods', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('code')->unique();
            $table->string('name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('category')->default('Ruang Kelas');
            $table->string('location')->nullable();
            $table->integer('capacity')->default(20);
            $table->string('condition')->default('Baik');
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nip')->nullable();
            $table->string('name');
            $table->string('role');
            $table->string('employment_status')->default('Tetap');
            $table->string('programs')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('student_no')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('parent_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('code')->unique();
            $table->string('program_code');
            $table->string('level');
            $table->string('teacher_name')->nullable();
            $table->string('schedule_days')->nullable();
            $table->string('schedule_time')->nullable();
            $table->integer('quota')->default(20);
            $table->integer('filled')->default(0);
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('program_interest')->default('GEYL');
            $table->string('source')->default('Website');
            $table->string('status')->default('Baru');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('placements', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('lead_id')->nullable();
            $table->string('participant_name');
            $table->date('test_date')->nullable();
            $table->string('test_time')->nullable();
            $table->integer('score')->nullable();
            $table->string('recommended_level')->nullable();
            $table->string('status')->default('Menunggu Test');
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('invoice_no')->unique();
            $table->string('student_name');
            $table->decimal('amount', 12, 2);
            $table->decimal('balance', 12, 2);
            $table->string('status')->default('Belum Lunas');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('payment_no')->unique();
            $table->string('invoice_id')->nullable();
            $table->string('student_name');
            $table->decimal('amount_paid', 12, 2);
            $table->string('payment_method')->default('Transfer Kas');
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('document_no')->nullable();
            $table->string('vendor')->nullable();
            $table->string('category')->default('Operasional');
            $table->decimal('amount', 12, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('type')->default('Berita');
            $table->string('title');
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->string('image_url')->nullable();
            $table->string('status')->default('Terbit');
            $table->timestamps();
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->string('year')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('materials', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->string('program_code')->nullable();
            $table->string('level')->nullable();
            $table->string('file_url')->nullable();
            $table->timestamps();
        });

        Schema::create('assignments', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('class_id')->nullable();
            $table->string('title');
            $table->date('due_date')->nullable();
            $table->integer('max_score')->default(100);
            $table->timestamps();
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('class_id');
            $table->string('student_id');
            $table->integer('meeting_no')->default(1);
            $table->string('status')->default('Hadir');
            $table->timestamps();
        });

        Schema::create('letters', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('letter_number');
            $table->string('type')->default('Keluar');
            $table->string('subject');
            $table->string('recipient')->nullable();
            $table->timestamps();
        });

        Schema::create('announcements', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->string('target_role')->default('Semua');
            $table->text('body')->nullable();
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('type');
            $table->decimal('balance', 14, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('journals', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('journal_no')->unique();
            $table->date('entry_date');
            $table->string('description');
            $table->decimal('amount', 14, 2);
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_name');
            $table->string('action');
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('journals');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('letters');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('placements');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('students');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('periods');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('settings');
    }
};
