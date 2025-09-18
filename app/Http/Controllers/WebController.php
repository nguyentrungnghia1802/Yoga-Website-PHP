<?php

namespace App\Http\Controllers;

use App\Models\YogaClass;
use App\Models\Teacher;
use App\Models\Customer;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    // Account registration page
    public function registerAccount()
    {
        return view('pages.register_account');
    }

    // Handle account registration
    public function registerAccountSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer', // default role
        ]);

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Đăng ký tài khoản thành công!');
    }

    // Account login page
    public function loginAccount()
    {
        return view('pages.login_account');
    }

    // Handle account login
    public function loginAccountSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }
        return back()->withErrors(['email' => 'Thông tin đăng nhập không đúng!']);
    }
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

    public function classDetail($id)
    {
        $class = YogaClass::with('teacher')->findOrFail($id);
        
        // Get approved registrations for this class
        $approvedRegistrations = Registration::with('customer')
            ->where('class_id', $id)
            ->where('status', 'APPROVED')
            ->get();
        
        $registeredStudents = $approvedRegistrations->map(function($registration) {
            return $registration->customer;
        });
        
        $availableSlots = $class->quantity - $registeredStudents->count();
        
        return view('pages.class_detail', compact('class', 'registeredStudents', 'availableSlots'));
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
        $authors = [
            [
                'avatar' => '👩‍💼',
                'name' => 'Nguyễn Thị Cẩm Tú',
                'role' => 'Trưởng nhóm - Frontend (User site)',
                'id' => 'K23DTCN549',
                'task' => 'Develop UI for user site, integrate with API (listen for trigger)'
            ],
            [
                'avatar' => '👨‍💻',
                'name' => 'Hoàng Trọng Lực',
                'role' => 'Frontend (Admin site)',
                'id' => 'K23DTCN542',
                'task' => 'Develop UI for admin site, integrate with API'
            ],
            [
                'avatar' => '👩‍💻',
                'name' => 'Nguyễn Thị Thu Hương',
                'role' => 'Backend (User + Admin), DB Design',
                'id' => 'K23DTCN539',
                'task' => 'Develop backend APIs for both admin and user site, design DB'
            ],
            [
                'avatar' => '👨‍💻',
                'name' => 'Vũ Huy Năng',
                'role' => 'Frontend (User site)',
                'id' => 'K23DTCN543',
                'task' => 'Develop UI for user site, integrate with API'
            ],
            [
                'avatar' => '👨‍💻',
                'name' => 'Nguyễn Trung Hiếu',
                'role' => 'Frontend (Admin site)',
                'id' => 'K23DTCN536',
                'task' => 'Develop UI for admin site, integrate with API'
            ],
        ];
        $project = [
            'weeks' => 8,
            'features' => 15,
            'files' => 50,
            'lines' => 1000,
            'goal' => 'Phát triển một hệ thống quản lý trung tâm Yoga/Gym toàn diện, hỗ trợ đăng ký lớp học, quản lý thành viên, và các tính năng quản trị cho nhân viên. Hệ thống được thiết kế với giao diện thân thiện và dễ sử dụng.',
            'tech' => ['Java','JSP/Servlet','HTML5','CSS3','JavaScript','MySQL','Bootstrap'],
            'period' => '8 tuần, từ tháng 1 đến tháng 3 năm 2025',
            'context' => 'Đây là đồ án cuối kỳ môn "Lập trình Web" thuộc chương trình Công nghệ Thông tin. Dự án được thực hiện dưới sự hướng dẫn của giảng viên và áp dụng các kiến thức đã học trong suốt khóa học.'
        ];
        return view('pages.authors', compact('authors','project'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'class_id' => 'required|exists:classes,id',
            'start_date' => 'required|date',
        ]);

        // Find or create customer
        $customer = Customer::where('email', $request->email)
                   ->orWhere('phone', $request->phone)
                   ->first();
        
        if (!$customer) {
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => null,
                'gender' => null,
                'address' => null,
            ]);
        }

        // Create registration with PENDING status
        $registration = Registration::create([
            'customer_id' => $customer->id,
            'class_id' => $request->class_id,
            'package_months' => $request->package_months ?? 1,
            'discount' => 0,
            'final_price' => YogaClass::find($request->class_id)->price,
            'status' => 'PENDING',
            'note' => $request->notes,
        ]);

        return redirect()->route('register')->with('success', 'Đăng ký thành công! Đơn đăng ký của bạn đang chờ xét duyệt. Mã đăng ký: #' . $registration->id);
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
