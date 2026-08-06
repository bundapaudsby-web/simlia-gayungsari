<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LiaDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Settings
        DB::table('settings')->updateOrInsert(['id' => 'org'], [
            'name' => 'LIA Gayungsari',
            'tagline' => 'The Right English Course for You',
            'phone' => '0896-7821-2026',
            'email' => 'info@liagayungsari.sch.id',
            'address' => 'Jl. Gayungsari Barat No. 12, Surabaya',
            'tax_rate' => 0.11,
            'updated_at' => now(),
        ]);

        // 2. Users
        $users = [
            ['id' => 'usr-001', 'name' => 'Administrator LIA', 'email' => 'admin@liagayungsari.local', 'role' => 'Administrator', 'status' => 'Aktif'],
            ['id' => 'usr-002', 'name' => 'Staf Akademik', 'email' => 'akademik@liagayungsari.local', 'role' => 'Akademik', 'status' => 'Aktif'],
            ['id' => 'usr-003', 'name' => 'Kasir & Keuangan', 'email' => 'keuangan@liagayungsari.local', 'role' => 'Keuangan', 'status' => 'Aktif'],
            ['id' => 'usr-004', 'name' => 'Tim CRM & Intake', 'email' => 'crm@liagayungsari.local', 'role' => 'CRM', 'status' => 'Aktif'],
        ];
        foreach ($users as $u) {
            DB::table('users')->updateOrInsert(['id' => $u['id']], [
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('admin123'),
                'role' => $u['role'],
                'status' => $u['status'],
                'updated_at' => now(),
            ]);
        }

        // 3. Programs
        $programs = [
            ['id' => 'prg-geyl', 'code' => 'GEYL', 'name' => 'General English for Young Learners', 'segment' => 'SD (Kelas 1-6)', 'levels' => 4, 'duration' => '1 Periode', 'fee' => 1250000],
            ['id' => 'prg-get', 'code' => 'GET', 'name' => 'General English for Teens', 'segment' => 'SMP & SMA', 'levels' => 4, 'duration' => '1 Periode', 'fee' => 1350000],
            ['id' => 'prg-gea', 'code' => 'GEA', 'name' => 'General English for Adults', 'segment' => 'Mahasiswa & Umum', 'levels' => 4, 'duration' => '1 Periode', 'fee' => 1450000],
            ['id' => 'prg-cvs', 'code' => 'CVS', 'name' => 'Conversation Short Course', 'segment' => 'Umum', 'levels' => 2, 'duration' => '1 Periode', 'fee' => 1500000],
            ['id' => 'prg-tp', 'code' => 'TP', 'name' => 'TOEFL Preparation', 'segment' => 'Intensif', 'levels' => 2, 'duration' => '1 Periode', 'fee' => 1650000],
        ];
        foreach ($programs as $p) {
            DB::table('programs')->updateOrInsert(['id' => $p['id']], [
                'code' => $p['code'],
                'name' => $p['name'],
                'segment' => $p['segment'],
                'level_count' => $p['levels'],
                'duration' => $p['duration'],
                'fee_per_period' => $p['fee'],
                'updated_at' => now(),
            ]);
        }

        // 4. Employees
        $employees = [
            ['id' => 'emp-001', 'name' => 'Dra. Ani Suryani, M.Pd.', 'role' => 'Kepala Cabang / Manager', 'employment' => 'Tetap', 'programs' => 'Manajemen', 'phone' => '081234567890', 'status' => 'Aktif'],
            ['id' => 'emp-002', 'name' => 'Budi Santoso, S.Pd.', 'role' => 'Pengajar Senior (Instructor)', 'employment' => 'Tetap', 'programs' => 'GEA, TP, CV', 'phone' => '081298765432', 'status' => 'Aktif'],
            ['id' => 'emp-003', 'name' => 'Citra Dewi, S.Hum.', 'role' => 'Pengajar (Instructor)', 'employment' => 'Kontrak', 'programs' => 'GEYL, GET', 'phone' => '085712345678', 'status' => 'Aktif'],
            ['id' => 'emp-004', 'name' => 'Dewi Anggraini, SE', 'role' => 'Staf Keuangan & Kasir', 'employment' => 'Tetap', 'programs' => 'Keuangan', 'phone' => '088198765432', 'status' => 'Aktif'],
        ];
        foreach ($employees as $e) {
            DB::table('employees')->updateOrInsert(['id' => $e['id']], [
                'nip' => $e['id'],
                'name' => $e['name'],
                'role' => $e['role'],
                'employment_status' => $e['employment'],
                'programs' => $e['programs'],
                'phone' => $e['phone'],
                'status' => $e['status'],
                'updated_at' => now(),
            ]);
        }

        // 5. Students
        $students = [
            ['id' => 'std-001', 'studentNo' => '202601001', 'name' => 'Aditya Pratama', 'phone' => '081234111222', 'parent' => 'Bambang Pratama', 'gender' => 'Laki-laki', 'status' => 'Aktif'],
            ['id' => 'std-002', 'studentNo' => '202601002', 'name' => 'Bella Safira', 'phone' => '081234333444', 'parent' => 'Suryo Safira', 'gender' => 'Perempuan', 'status' => 'Aktif'],
            ['id' => 'std-003', 'studentNo' => '202601003', 'name' => 'Cahyo Utomo', 'phone' => '081234555666', 'parent' => 'Dwi Utomo', 'gender' => 'Laki-laki', 'status' => 'Aktif'],
        ];
        foreach ($students as $s) {
            DB::table('students')->updateOrInsert(['id' => $s['id']], [
                'student_no' => $s['studentNo'],
                'name' => $s['name'],
                'phone' => $s['phone'],
                'parent_name' => $s['parent'],
                'gender' => $s['gender'],
                'status' => $s['status'],
                'updated_at' => now(),
            ]);
        }

        // 6. Classes
        $classes = [
            ['id' => 'cls-001', 'code' => 'GEYL-1A-01', 'program' => 'GEYL', 'level' => '1A', 'teacher' => 'Citra Dewi, S.Hum.', 'scheduleDays' => 'Senin & Rabu', 'scheduleTime' => '15:30 - 17:00', 'quota' => 20, 'filled' => 15, 'status' => 'Aktif'],
            ['id' => 'cls-002', 'code' => 'GET-2B-01', 'program' => 'GET', 'level' => '2B', 'teacher' => 'Budi Santoso, S.Pd.', 'scheduleDays' => 'Selasa & Kamis', 'scheduleTime' => '16:00 - 17:30', 'quota' => 20, 'filled' => 18, 'status' => 'Aktif'],
            ['id' => 'cls-003', 'code' => 'GEA-1-01', 'program' => 'GEA', 'level' => '1', 'teacher' => 'Budi Santoso, S.Pd.', 'scheduleDays' => 'Jumat & Sabtu', 'scheduleTime' => '18:30 - 20:00', 'quota' => 20, 'filled' => 12, 'status' => 'Aktif'],
        ];
        foreach ($classes as $c) {
            DB::table('classes')->updateOrInsert(['id' => $c['id']], [
                'code' => $c['code'],
                'program_code' => $c['program'],
                'level' => $c['level'],
                'teacher_name' => $c['teacher'],
                'schedule_days' => $c['scheduleDays'],
                'schedule_time' => $c['scheduleTime'],
                'quota' => $c['quota'],
                'filled' => $c['filled'],
                'status' => $c['status'],
                'updated_at' => now(),
            ]);
        }

        // 7. Leads
        $leads = [
            ['id' => 'lead-001', 'name' => 'Eka Kurniawan', 'phone' => '081299001122', 'program' => 'GEA', 'source' => 'Website', 'status' => 'Baru', 'note' => 'Tertarik kelas malam GEA.'],
            ['id' => 'lead-002', 'name' => 'Fani Rahmawati', 'phone' => '085788990011', 'program' => 'TP', 'source' => 'Instagram', 'status' => 'Prospek', 'note' => 'Membutuhkan skor TOEFL 550.'],
        ];
        foreach ($leads as $l) {
            DB::table('leads')->updateOrInsert(['id' => $l['id']], [
                'name' => $l['name'],
                'phone' => $l['phone'],
                'program_interest' => $l['program'],
                'source' => $l['source'],
                'status' => $l['status'],
                'note' => $l['note'],
                'updated_at' => now(),
            ]);
        }

        // 8. Invoices
        $invoices = [
            ['id' => 'inv-001', 'invoiceNo' => 'INV-2026-001', 'student' => 'Aditya Pratama', 'amount' => 1250000, 'balance' => 0, 'status' => 'Lunas'],
            ['id' => 'inv-002', 'invoiceNo' => 'INV-2026-002', 'student' => 'Bella Safira', 'amount' => 1350000, 'balance' => 350000, 'status' => 'Belum Lunas'],
        ];
        foreach ($invoices as $inv) {
            DB::table('invoices')->updateOrInsert(['id' => $inv['id']], [
                'invoice_no' => $inv['invoiceNo'],
                'student_name' => $inv['student'],
                'amount' => $inv['amount'],
                'balance' => $inv['balance'],
                'status' => $inv['status'],
                'updated_at' => now(),
            ]);
        }

        // 9. Payments
        $payments = [
            ['id' => 'pay-001', 'paymentNo' => 'PAY-2026-001', 'invoiceId' => 'inv-001', 'student' => 'Aditya Pratama', 'amount' => 1250000, 'method' => 'Transfer Bank BCA'],
            ['id' => 'pay-002', 'paymentNo' => 'PAY-2026-002', 'invoiceId' => 'inv-002', 'student' => 'Bella Safira', 'amount' => 1000000, 'method' => 'Tunai Kasir'],
        ];
        foreach ($payments as $pay) {
            DB::table('payments')->updateOrInsert(['id' => $pay['id']], [
                'payment_no' => $pay['paymentNo'],
                'invoice_id' => $pay['invoiceId'],
                'student_name' => $pay['student'],
                'amount_paid' => $pay['amount'],
                'payment_method' => $pay['method'],
                'updated_at' => now(),
            ]);
        }

        // 10. Contents
        $contents = [
            ['id' => 'cnt-001', 'type' => 'Berita', 'title' => 'Pembukaan Pendaftaran Periode 2026/3', 'summary' => 'Pendaftaran siswa baru LB LIA Gayungsari resmi dibuka mulai 1 Agustus 2026.', 'status' => 'Terbit'],
            ['id' => 'cnt-002', 'type' => 'Kegiatan', 'title' => 'English Competition & Festival 2026', 'summary' => 'Lomba Speech & Storytelling antar siswa LIA se-Surabaya.', 'status' => 'Terbit'],
        ];
        foreach ($contents as $cnt) {
            DB::table('contents')->updateOrInsert(['id' => $cnt['id']], [
                'type' => $cnt['type'],
                'title' => $cnt['title'],
                'summary' => $cnt['summary'],
                'status' => $cnt['status'],
                'updated_at' => now(),
            ]);
        }
    }
}
