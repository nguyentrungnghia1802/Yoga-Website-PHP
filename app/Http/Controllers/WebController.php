<?php

namespace App\Http\Controllers;

use App\Models\YogaClass;
use App\Models\Teacher;
use App\Models\Customer;
use App\Models\Registration;
use App\Enums\RegistrationStatus;
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
        // Show only confirmed registrations. In real app, filter by logged-in user.
        $registrations = Registration::with(['class.teacher'])
                                   ->where('status', RegistrationStatus::CONFIRMED->value)
                                   ->latest()
                                   ->get();
        return view('pages.registered_classes', compact('registrations'));
    }

    public function registeredClassDetail($id)
    {
        $class = YogaClass::with('teacher')->findOrFail($id);
        $members = Customer::whereHas('registrations', function($q) use ($id) {
            $q->where('class_id', $id)
              ->where('status', RegistrationStatus::CONFIRMED->value);
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
        
        // Get confirmed registrations for this class
        $confirmedRegistrations = Registration::with('customer')
            ->where('class_id', $id)
            ->where('status', RegistrationStatus::CONFIRMED->value)
            ->get();
        
        $registeredStudents = $confirmedRegistrations->map(function($registration) {
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

    public function register(Request $request)
    {
        $classes = YogaClass::with('teacher')->get();
        $customers = Customer::get();
        $selectedClassId = $request->get('class_id');
        return view('pages.register', compact('classes', 'customers', 'selectedClassId'));
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
                'task' => 'Develop UI for user site, integrate with API (listen for trigger)',
                'image' => 'tu.jpg'
            ],
            [
                'avatar' => '👨‍💻',
                'name' => 'Hoàng Trọng Lực',
                'role' => 'Frontend (Admin site)',
                'id' => 'K23DTCN542',
                'task' => 'Develop UI for admin site, integrate with API',
                'image' => 'luc.jpg'
            ],
            [
                'avatar' => '👩‍💻',
                'name' => 'Nguyễn Thị Thu Hương',
                'role' => 'Backend (User + Admin), DB Design',
                'id' => 'K23DTCN539',
                'task' => 'Develop backend APIs for both admin and user site, design DB',
                'image' => 'huong.jpg'
            ],
            [
                'avatar' => '👨‍💻',
                'name' => 'Vũ Huy Năng',
                'role' => 'Frontend (User site)',
                'id' => 'K23DTCN543',
                'task' => 'Develop UI for user site, integrate with API',
                'image' => 'hung.jpg'
            ],
            [
                'avatar' => '👨‍💻',
                'name' => 'Nguyễn Trung Hiếu',
                'role' => 'Frontend (Admin site)',
                'id' => 'K23DTCN536',
                'task' => 'Develop UI for admin site, integrate with API',
                'image' => 'hieu.jpg'
            ],
        ];
        $project = [
            'weeks' => 8,
            'features' => 15,
            'files' => 50,
            'lines' => 1000,
            'goal' => 'Phát triển một hệ thống quản lý trung tâm Yoga/Gym toàn diện, hỗ trợ đăng ký lớp học, quản lý thành viên, và các tính năng quản trị cho nhân viên. Hệ thống được thiết kế với giao diện thân thiện và dễ sử dụng.',
            'tech' => ['Laravel','PHP','HTML5','CSS3','JavaScript','MySQL','Bootstrap'],
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
            'package_months' => 'required|in:1,3,6,12',
        ]);

        // Find or create customer
        $customer = Customer::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'birthday' => '1990-01-01', // Default birthday since field is required
                'gender' => $request->gender ?? 'female',
                'address' => null,
                'note' => null,
            ]
        );

        // Get class and calculate discount
        $class = YogaClass::find($request->class_id);
        $packageMonths = $request->package_months;
        
        // Discount rates based on package
        $discountRates = [
            1 => 0,    // 1 month: 0% discount
            3 => 5,    // 3 months: 5% discount
            6 => 10,   // 6 months: 10% discount
            12 => 15   // 12 months: 15% discount
        ];
        
        $monthlyPrice = $class->price;
        $totalPrice = $monthlyPrice * $packageMonths; // Tổng giá cho tất cả tháng
        $discountRate = $discountRates[$packageMonths] ?? 0;
        $discountAmount = ($totalPrice * $discountRate) / 100;
        $finalPrice = $totalPrice - $discountAmount;

        // Create registration with PENDING status
        $registration = Registration::create([
            'customer_id' => $customer->id,
            'class_id' => $request->class_id,
            'package_months' => $packageMonths,
            'discount' => $discountAmount,
            'final_price' => $finalPrice,
            'status' => RegistrationStatus::PENDING->value,
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
        return view('admin.classes', compact('classes'));
    }

    public function adminTeachers()
    {
        $teachers = Teacher::latest()->paginate(15);
        return view('admin.teachers', compact('teachers'));
    }

    public function adminRegistrations()
    {
        $registrations = Registration::with(['customer', 'class.teacher'])->latest()->paginate(15);
        return view('admin.registrations', compact('registrations'));
    }

    public function teachers()
    {
        $teachers = Teacher::with('classes')->get();
        return view('pages.teachers', compact('teachers'));
    }

    public function teacherDetail($id)
    {
        $teacher = Teacher::with('classes')->findOrFail($id);
        return view('pages.teacher_detail', compact('teacher'));
    }
}
