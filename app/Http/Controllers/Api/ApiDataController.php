<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Content;
use App\Models\Achievement;
use App\Models\Setting;
use App\Models\Lead;
use App\Models\Student;
use App\Models\LiaClass;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Letter;
use App\Models\Announcement;
use App\Models\Placement;
use App\Models\Material;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Facility;
use App\Models\Period;
use App\Models\User;

class ApiDataController extends Controller
{
    public function getPublicPrograms() { return response()->json(['data' => Program::all()]); }
    public function getPublicNews() { return response()->json(['data' => Content::all()]); }
    public function getPublicAchievements() { return response()->json(['data' => Achievement::all()]); }
    public function getPublicSettings() { return response()->json(['data' => Setting::first()]); }

    public function submitLead(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);
        $lead = Lead::create([
            'id' => 'lead-' . time(),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'program_interest' => $request->input('program', 'GEYL'),
            'source' => 'Website',
            'status' => 'Baru',
            'note' => $request->input('note'),
        ]);
        return response()->json(['message' => 'Pendaftaran prospek berhasil dikirim! Tim LIA Gayungsari akan menghubungi Anda.', 'data' => $lead]);
    }

    // Portal Siswa & Orang Tua Endpoint
    public function getStudentProfile(Request $request) {
        $nis = $request->query('nis', '202601001');
        $student = Student::where('student_no', $nis)->orWhere('id', $nis)->first() ?: Student::first();
        $class = LiaClass::first();
        $invoices = Invoice::where('student_name', 'LIKE', '%' . ($student->name ?? '') . '%')->get();
        $announcements = Announcement::all();

        return response()->json([
            'student' => $student,
            'class' => $class,
            'invoices' => $invoices,
            'announcements' => $announcements,
            'scores' => [
                'listening' => 88,
                'speaking' => 90,
                'reading' => 85,
                'writing' => 87,
                'final_grade' => 'A (Excellent)',
            ],
            'attendance_rate' => '95%',
        ]);
    }

    // Generic REST resource endpoints
    public function getStudents() { return response()->json(['data' => Student::all()]); }
    public function getClasses() { return response()->json(['data' => LiaClass::all()]); }
    public function getLeads() { return response()->json(['data' => Lead::all()]); }
    public function getEmployees() { return response()->json(['data' => Employee::all()]); }
    public function getInvoices() { return response()->json(['data' => Invoice::all()]); }
    public function getPayments() { return response()->json(['data' => Payment::all()]); }
    public function getExpenses() { return response()->json(['data' => Expense::all()]); }
    public function getAccounts() { return response()->json(['data' => Account::all()]); }
    public function getJournals() { return response()->json(['data' => Journal::all()]); }
    public function getLetters() { return response()->json(['data' => Letter::all()]); }
    public function getAnnouncements() { return response()->json(['data' => Announcement::all()]); }
    public function getPlacements() { return response()->json(['data' => Placement::all()]); }
    public function getMaterials() { return response()->json(['data' => Material::all()]); }
    public function getAssignments() { return response()->json(['data' => Assignment::all()]); }
    public function getAttendance() { return response()->json(['data' => Attendance::all()]); }
    public function getFacilities() { return response()->json(['data' => Facility::all()]); }
    public function getPeriods() { return response()->json(['data' => Period::all()]); }
    public function getUsers() { return response()->json(['data' => User::all()]); }
}
