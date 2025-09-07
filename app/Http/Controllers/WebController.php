<?php

namespace App\Http\Controllers;

use App\Models\YogaClass;
use App\Models\Teacher;
use App\Models\Customer;
use App\Models\Registration;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function registeredClasses(Request $request)
    {
        // For demo, show all registrations. In real app, filter by logged-in user.
        $registrations = Registration::with(['class.teacher'])->get();
        return view('pages.registered_classes', compact('registrations'));
    }

    public function registeredClassDetail($id)
    {
        $class = YogaClass::with('teacher')->findOrFail($id);
        $members = Customer::whereHas('registrations', function($q) use ($id) {
            $q->where('class_id', $id);
        })->get();
        return view('pages.registered_class_detail', compact('class', 'members'));
    }
    public function contactSend(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // You can implement email sending or save to DB here

        return redirect()->route('contact')->with('success', 'Your message has been sent!');
    }
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

    public function loginSubmit(Request $request)
    {
        // Handle login logic here
        return redirect()->route('dashboard')->with('success', 'Login successful!');
    }

    public function registerSubmit(Request $request)
    {
        // Handle registration logic here
        return redirect()->route('register')->with('success', 'Registration submitted successfully!');
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
