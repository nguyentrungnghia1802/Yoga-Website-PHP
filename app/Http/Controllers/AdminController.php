<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\YogaClass;
use App\Models\Teacher;
use App\Models\Customer;
use App\Models\Registration;
use App\Enums\RegistrationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show admin login page
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Handle admin login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


    // Authenticate only with user_name (users table does not have email column)
    $user = User::where('user_name', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['username' => 'Thông tin đăng nhập không đúng!']);
    }

    // Handle admin logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Đã đăng xuất thành công!');
    }

    // Admin dashboard
    public function dashboard()
    {
        $stats = [
            'classes' => YogaClass::count(),
            'teachers' => Teacher::count(),
            'customers' => Customer::count(),
            'registrations' => Registration::count(),
            'pending_registrations' => Registration::where('status', RegistrationStatus::PENDING->value)->count(),
            'approved_registrations' => Registration::where('status', RegistrationStatus::CONFIRMED->value)->count(),
        ];

        $recentRegistrations = Registration::with(['customer', 'class'])
                                         ->latest()
                                         ->take(5)
                                         ->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations'));
    }

    // Registration Management
    public function registrations(Request $request)
    {
        $query = Registration::with(['customer', 'class.teacher']);
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('customer', function($customerQuery) use ($search) {
                    $customerQuery->where('name', 'like', "%{$search}%")
                                 ->orWhere('email', 'like', "%{$search}%")
                                 ->orWhere('phone', 'like', "%{$search}%");
                })->orWhereHas('class', function($classQuery) use ($search) {
                    $classQuery->where('name', 'like', "%{$search}%");
                });
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', strtoupper($request->status));
        }
        
        $registrations = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $stats = [
            'pending' => Registration::where('status', RegistrationStatus::PENDING->value)->count(),
            'approved' => Registration::where('status', RegistrationStatus::CONFIRMED->value)->count(),
            'rejected' => Registration::where('status', RegistrationStatus::CANCELLED->value)->count(),
        ];
        
        return view('admin.registrations', compact('registrations', 'stats'));
    }

    public function registrationDetail($id)
    {
        $registration = Registration::with(['customer', 'class.teacher'])->findOrFail($id);
        return view('admin.registration_detail', compact('registration'));
    }

    public function approveRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->update(['status' => RegistrationStatus::CONFIRMED]);
        
        return redirect()->route('admin.registrations')
                        ->with('success', 'Đã phê duyệt đăng ký #' . $id . ' thành công!');
    }

    public function rejectRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->update(['status' => RegistrationStatus::CANCELLED]);
        
        return redirect()->route('admin.registrations')
                        ->with('success', 'Đã từ chối đăng ký #' . $id);
    }

    // Class Management
    public function classes(Request $request)
    {
        $query = YogaClass::with('teacher')
                          ->withCount(['registrations' => function($q) {
                              $q->where('status', RegistrationStatus::CONFIRMED->value);
                          }]);
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhereHas('teacher', function($teacherQuery) use ($search) {
                      $teacherQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $classes = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.classes', compact('classes'));
    }

    public function createClass()
    {
        $teachers = Teacher::all();
        return view('admin.class_create', compact('teachers'));
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'teacher_id' => 'required|exists:teachers,id',
            'lich_hoc' => 'required|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        YogaClass::create($request->all());
        
        return redirect()->route('admin.classes')->with('success', 'Đã tạo lớp học thành công!');
    }

    public function classDetail($id)
    {
        $class = YogaClass::with('teacher')->findOrFail($id);
        $registrations = Registration::with('customer')
                                   ->where('class_id', $id)
                                   ->where('status', RegistrationStatus::CONFIRMED->value)
                                   ->get();
        
        return view('admin.class_detail', compact('class', 'registrations'));
    }

    public function editClass($id)
    {
        $class = YogaClass::findOrFail($id);
        $teachers = Teacher::all();
        return view('admin.class_edit', compact('class', 'teachers'));
    }

    public function updateClass(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'teacher_id' => 'required|exists:teachers,id',
            'lich_hoc' => 'required|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        $class = YogaClass::findOrFail($id);
        $class->update($request->all());
        
        return redirect()->route('admin.classes')->with('success', 'Đã cập nhật lớp học thành công!');
    }

    public function deleteClass($id)
    {
        $class = YogaClass::findOrFail($id);
        
        // Check if class has any registrations
        $registrationCount = $class->registrations()->count();
        if ($registrationCount > 0) {
            return redirect()->route('admin.classes')
                           ->with('error', "Không thể xóa lớp học {$class->name} vì đã có {$registrationCount} học viên đăng ký. Vui lòng hủy các đăng ký trước.");
        }
        
        $class->delete();
        
        return redirect()->route('admin.classes')->with('success', 'Đã xóa lớp học thành công!');
    }

    // Customer Management
    public function customers(Request $request)
    {
        $query = Customer::withCount('registrations');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }
        
        $customers = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.customers', compact('customers'));
    }

    public function createCustomer()
    {
        return view('admin.customer_create');
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'email' => 'required|email|max:100|unique:customers,email',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ]);

        Customer::create($request->all());
        
        return redirect()->route('admin.customers')->with('success', 'Đã tạo học viên thành công!');
    }

    public function customerDetail($id)
    {
        $customer = Customer::findOrFail($id);
        $registrations = Registration::with('class.teacher')
                                   ->where('customer_id', $id)
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        
        return view('admin.customer_detail', compact('customer', 'registrations'));
    }

    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customer_edit', compact('customer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20|unique:customers,phone,' . $id,
            'email' => 'required|email|max:100|unique:customers,email,' . $id,
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        
        return redirect()->route('admin.customers')->with('success', 'Đã cập nhật học viên thành công!');
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        
        // Check if customer has any registrations
        $registrationCount = $customer->registrations()->count();
        if ($registrationCount > 0) {
            return redirect()->route('admin.customers')
                           ->with('error', "Không thể xóa học viên {$customer->name} vì đã có {$registrationCount} lượt đăng ký lớp học. Vui lòng xóa các đăng ký trước.");
        }
        
        $customer->delete();
        
        return redirect()->route('admin.customers')->with('success', 'Đã xóa học viên thành công!');
    }

    // Teacher Management
    public function teachers(Request $request)
    {
        $query = Teacher::withCount('classes');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('exp_year', 'like', "%{$search}%");
            });
        }
        
        $teachers = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.teachers', compact('teachers'));
    }

    public function createTeacher()
    {
        return view('admin.teacher_create');
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20|unique:teachers,phone',
            'email' => 'required|email|max:100|unique:teachers,email',
            'birthday' => 'required|date',
            'exp_year' => 'required|integer|min:0',
            'description' => 'required|string|max:255',
            'avatar' => 'nullable|string|max:255',
        ]);

        Teacher::create($request->all());
        
        return redirect()->route('admin.teachers')->with('success', 'Đã tạo giảng viên thành công!');
    }

    public function teacherDetail($id)
    {
        $teacher = Teacher::findOrFail($id);
        $classes = YogaClass::where('teacher_id', $id)->orderBy('created_at', 'desc')->get();
        
        return view('admin.teacher_detail', compact('teacher', 'classes'));
    }

    public function editTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teacher_edit', compact('teacher'));
    }

    public function updateTeacher(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20|unique:teachers,phone,' . $id,
            'email' => 'required|email|max:100|unique:teachers,email,' . $id,
            'birthday' => 'required|date',
            'exp_year' => 'required|integer|min:0',
            'description' => 'required|string|max:255',
            'avatar' => 'nullable|string|max:255',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());
        
        return redirect()->route('admin.teachers')->with('success', 'Đã cập nhật giảng viên thành công!');
    }

    public function deleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        
        // Check if teacher has any classes
        $classCount = $teacher->classes()->count();
        if ($classCount > 0) {
            return redirect()->route('admin.teachers')
                           ->with('error', "Không thể xóa giảng viên {$teacher->name} vì đang dạy {$classCount} lớp học. Vui lòng chuyển các lớp học cho giảng viên khác trước.");
        }
        
        $teacher->delete();
        
        return redirect()->route('admin.teachers')->with('success', 'Đã xóa giảng viên thành công!');    
    }
}