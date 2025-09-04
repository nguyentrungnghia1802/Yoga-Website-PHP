<?php

namespace App\Http\Controllers;

use App\Models\YogaClass;
use App\Models\Teacher;
use App\Models\Customer;
use App\Models\Registration;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function dashboard()
    {
        $classesCount = YogaClass::count();
        $teachersCount = Teacher::count();
        $membersCount = Customer::count();
        $registrationsCount = Registration::count();

        return view('pages.dashboard', compact(
            'classesCount',
            'teachersCount', 
            'membersCount',
            'registrationsCount'
        ));
    }

    public function classes()
    {
        $classes = YogaClass::with('teacher')->latest()->paginate(12);
        return view('pages.classes', compact('classes'));
    }

    public function team()
    {
        $teachers = Teacher::latest()->paginate(12);
        return view('pages.team', compact('teachers'));
    }

    public function members()
    {
        $customers = Customer::latest()->paginate(12);
        return view('pages.members', compact('customers'));
    }

    public function register()
    {
        $classes = YogaClass::with('teacher')->get();
        $customers = Customer::get();
        return view('pages.register', compact('classes', 'customers'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function authors()
    {
        return view('pages.authors');
    }

    public function login()
    {
        return view('pages.login');
    }

    // Admin routes
    public function adminDashboard()
    {
        $classesCount = YogaClass::count();
        $teachersCount = Teacher::count();
        $membersCount = Customer::count();
        $registrationsCount = Registration::count();

        return view('admin.dashboard', compact(
            'classesCount',
            'teachersCount', 
            'membersCount',
            'registrationsCount'
        ));
    }

    public function adminClasses()
    {
        $classes = YogaClass::with('teacher')->latest()->paginate(15);
        return view('admin.class', compact('classes'));
    }

    public function adminTeachers()
    {
        $teachers = Teacher::latest()->paginate(15);
        return view('admin.teacher', compact('teachers'));
    }

    public function adminRegistrations()
    {
        $registrations = Registration::with(['customer', 'class.teacher'])->latest()->paginate(15);
        return view('admin.register', compact('registrations'));
    }
}
