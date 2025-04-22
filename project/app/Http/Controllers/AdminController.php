<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Session;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display the admin dashboard
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Get user counts
        $membersCount = User::where('role', 'Member')->count();
        $trainersCount = User::where('role', 'Trainer')->count();
        
        // Get session count
        $sessionsCount = Session::whereDate('date', '>=', Carbon::today())->count();
        
        // Get revenue data - monthly revenue
        $revenue = Payment::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->where('status', 'paid')
            ->sum('amount');
            
        // Get recent payments
        $recentPayments = Payment::with('subscription.user')
            ->where('status', 'paid')
            ->latest('date')
            ->take(5)
            ->get();
            
        // Get recent users
        $recentUsers = User::latest('registrationDate')
            ->take(5)
            ->get();
            
        // Get upcoming sessions
        $upcomingSessions = Session::with('trainer')
            ->where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('start_time')
            ->take(5)
            ->get();
            
        // Get subscription statistics
        $activeSubscriptionsCount = Subscription::where('status', 'active')
            ->where('end_date', '>=', Carbon::today())
            ->count();
            
        $expiringSubscriptionsCount = Subscription::where('status', 'active')
            ->whereBetween('end_date', [Carbon::today(), Carbon::today()->addDays(30)])
            ->count();
            
        $expiredSubscriptionsCount = Subscription::where('status', 'active')
            ->where('end_date', '<', Carbon::today())
            ->count();
            
        // Calculate subscription type percentages
        $totalSubscriptions = $activeSubscriptionsCount > 0 ? $activeSubscriptionsCount : 1;
        
        $basicSubscriptionsCount = Subscription::where('status', 'active')
            ->where('end_date', '>=', Carbon::today())
            ->where('type', 'Basic')
            ->count();
            
        $premiumSubscriptionsCount = Subscription::where('status', 'active')
            ->where('end_date', '>=', Carbon::today())
            ->where('type', 'Premium')
            ->count();
            
        $eliteSubscriptionsCount = Subscription::where('status', 'active')
            ->where('end_date', '>=', Carbon::today())
            ->where('type', 'Elite')
            ->count();
            
        $basicSubscriptionsPercentage = round(($basicSubscriptionsCount / $totalSubscriptions) * 100);
        $premiumSubscriptionsPercentage = round(($premiumSubscriptionsCount / $totalSubscriptions) * 100);
        $eliteSubscriptionsPercentage = round(($eliteSubscriptionsCount / $totalSubscriptions) * 100);
        
        return view('dashboards.admin', compact(
            'membersCount',
            'trainersCount',
            'sessionsCount',
            'revenue',
            'recentPayments',
            'recentUsers',
            'upcomingSessions',
            'activeSubscriptionsCount',
            'expiringSubscriptionsCount',
            'expiredSubscriptionsCount',
            'basicSubscriptionsPercentage',
            'premiumSubscriptionsPercentage',
            'eliteSubscriptionsPercentage'
        ));
    }
    
    /**
     * Display list of all users
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function users(Request $request)
    {
        $query = User::query();
        
        // Apply search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Apply status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Apply role filter
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }
        
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->latest('registrationDate');
                    break;
                case 'oldest':
                    $query->oldest('registrationDate');
                    break;
                case 'name_asc':
                    $query->orderBy('firstname')->orderBy('lastname');
                    break;
                case 'name_desc':
                    $query->orderBy('firstname', 'desc')->orderBy('lastname', 'desc');
                    break;
                default:
                    $query->latest('registrationDate');
            }
        } else {
            $query->latest('registrationDate');
        }
        
        $users = $query->paginate(15);
        
        return view('admin.users', compact('users'));
    }
    
    /**
     * Show form to create a new user
     *
     * @return \Illuminate\View\View
     */
    public function createUser()
    {
        return view('admin.users.create');
    }
    
    /**
     * Store a new user in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:Member,Trainer,Receptionist,Administrator',
            'status' => 'required|in:active,inactive',
        ]);
        
        // Hash the password
        $validated['password'] = bcrypt($validated['password']);
        $validated['registrationDate'] = now();
        
        User::create($validated);
        
        return redirect()->route('admin.users')
            ->with('success', 'User created successfully');
    }
    
    /**
     * Show form to edit a user
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    
    /**
     * Update the specified user
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:Member,Trainer,Receptionist,Administrator',
            'status' => 'required|in:active,inactive',
        ]);
        
        // Only update password if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            
            $validated['password'] = bcrypt($request->password);
        }
        
        $user->update($validated);
        
        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully');
    }
    
    /**
     * Delete the specified user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyUser(User $user)
    {
        // Instead of actually deleting, we can set the user as inactive
        // This ensures we don't lose data that might be connected to this user
        $user->update([
            'status' => 'inactive',
            'deletionDate' => now()
        ]);
        
        // If you want to actually delete the user:
        // $user->delete();
        
        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully');
    }
    
    /**
     * Generate member report
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function memberReport(Request $request)
    {
        // Get member stats
        $totalMembers = User::where('role', 'Member')->count();
        $activeMembers = User::where('role', 'Member')->where('status', 'active')->count();
        $inactiveMembers = User::where('role', 'Member')->where('status', 'inactive')->count();
        
        // Get members with active subscriptions
        $membersWithSubscriptions = User::where('role', 'Member')
            ->whereHas('subscriptions', function($query) {
                $query->where('status', 'active')
                    ->where('end_date', '>=', Carbon::today());
            })
            ->count();
            
        // Get new members this month
        $newMembersThisMonth = User::where('role', 'Member')
            ->whereMonth('registrationDate', Carbon::now()->month)
            ->whereYear('registrationDate', Carbon::now()->year)
            ->count();
            
        // Get monthly member registration data for chart
        $monthlySummary = User::where('role', 'Member')
            ->whereYear('registrationDate', Carbon::now()->year)
            ->selectRaw('MONTH(registrationDate) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function($item) {
                return [
                    'month' => Carbon::create(null, $item->month, 1)->format('M'),
                    'count' => $item->count
                ];
            });
            
        // Get members by subscription type
        $membersBySubscriptionType = Subscription::where('status', 'active')
            ->where('end_date', '>=', Carbon::today())
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get();
            
        // Get most active members (most attendances this month)
        $mostActiveMembers = User::where('role', 'Member')
            ->withCount(['attendances' => function($query) {
                $query->whereMonth('date', Carbon::now()->month)
                    ->whereYear('date', Carbon::now()->year);
            }])
            ->orderBy('attendances_count', 'desc')
            ->take(10)
            ->get();
            
        return view('admin.reports.members', compact(
            'totalMembers',
            'activeMembers',
            'inactiveMembers',
            'membersWithSubscriptions',
            'newMembersThisMonth',
            'monthlySummary',
            'membersBySubscriptionType',
            'mostActiveMembers'
        ));
    }
    
    /**
     * Generate session report
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function sessionReport(Request $request)
    {
        // Get session stats
        $totalSessions = Session::count();
        $upcomingSessions = Session::where('date', '>=', Carbon::today())->count();
        $completedSessions = Session::where('date', '<', Carbon::today())->count();
        
        // Get today's sessions
        $todaySessions = Session::with(['trainer', 'attendances'])
            ->whereDate('date', Carbon::today())
            ->orderBy('start_time')
            ->get();
            
        // Get sessions by type for chart
        $sessionsByType = Session::selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get();
            
        // Get most popular sessions (most attendances)
        $popularSessions = Session::withCount('attendances')
            ->orderBy('attendances_count', 'desc')
            ->take(10)
            ->get();
            
        // Get sessions by trainer
        $sessionsByTrainer = Session::with('trainer')
            ->selectRaw('trainer_id, COUNT(*) as count')
            ->groupBy('trainer_id')
            ->orderBy('count', 'desc')
            ->get();
            
        // Get monthly session data for chart
        $monthlySessions = Session::whereYear('date', Carbon::now()->year)
            ->selectRaw('MONTH(date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function($item) {
                return [
                    'month' => Carbon::create(null, $item->month, 1)->format('M'),
                    'count' => $item->count
                ];
            });
            
        return view('admin.reports.sessions', compact(
            'totalSessions',
            'upcomingSessions',
            'completedSessions',
            'todaySessions',
            'sessionsByType',
            'popularSessions',
            'sessionsByTrainer',
            'monthlySessions'
        ));
    }
    
    /**
     * Generate revenue report
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function revenueReport(Request $request)
    {
        // Set default period and time range
        $period = $request->input('period', 'monthly');
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);
        
        // Build query based on period
        $query = Payment::where('status', 'paid');
        
        if ($period === 'monthly') {
            $query->whereYear('date', $year)
                  ->whereMonth('date', $month);
            $periodLabel = Carbon::createFromDate($year, $month, 1)->format('F Y');
        } elseif ($period === 'yearly') {
            $query->whereYear('date', $year);
            $periodLabel = $year;
        } elseif ($period === 'all') {
            $periodLabel = 'All Time';
        }
        
        // Calculate total revenue
        $totalRevenue = $query->sum('amount');
        $paymentCount = $query->count();
        $averagePayment = $paymentCount > 0 ? $totalRevenue / $paymentCount : 0;
        
        // Get revenue by payment method
        $revenueByMethod = Payment::where('status', 'paid')
            ->when($period === 'monthly', function($q) use ($year, $month) {
                return $q->whereYear('date', $year)->whereMonth('date', $month);
            })
            ->when($period === 'yearly', function($q) use ($year) {
                return $q->whereYear('date', $year);
            })
            ->selectRaw('method, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('method')
            ->get();
            
        // Get revenue by subscription type
        $revenueByType = DB::table('payments')
            ->join('subscriptions', 'payments.subscription_id', '=', 'subscriptions.id')
            ->select('subscriptions.type', DB::raw('COUNT(*) as count'), DB::raw('SUM(payments.amount) as total'))
            ->where('payments.status', 'paid')
            ->when($period === 'monthly', function($q) use ($year, $month) {
                return $q->whereYear('payments.date', $year)->whereMonth('payments.date', $month);
            })
            ->when($period === 'yearly', function($q) use ($year) {
                return $q->whereYear('payments.date', $year);
            })
            ->groupBy('subscriptions.type')
            ->get();
            
        // Get monthly revenue data for chart
        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereYear('date', $year)
            ->selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function($item) {
                return [
                    'month' => Carbon::create(null, $item->month, 1)->format('M'),
                    'total' => $item->total
                ];
            });
            
        // Get recent payments
        $recentPayments = Payment::with('subscription.user')
            ->where('status', 'paid')
            ->latest('date')
            ->take(10)
            ->get();
            
        return view('admin.reports.revenues', compact(
            'period',
            'year',
            'month',
            'periodLabel',
            'totalRevenue',
            'paymentCount',
            'averagePayment',
            'revenueByMethod',
            'revenueByType',
            'monthlyRevenue',
            'recentPayments'
        ));
    }

    /**
     * Export data as CSV
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportData(Request $request)
    {
        $type = $request->input('type', 'members');
        $filename = $type . '_' . Carbon::now()->format('Y-m-d') . '.csv';
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        
        $columns = [];
        $query = null;
        
        switch($type) {
            case 'members':
                $columns = ['ID', 'First Name', 'Last Name', 'Email', 'Status', 'Registration Date', 'Role'];
                $query = User::where('role', 'Member')->orderBy('id');
                break;
                
            case 'users':
                $columns = ['ID', 'First Name', 'Last Name', 'Email', 'Status', 'Registration Date', 'Role'];
                $query = User::orderBy('id');
                break;
                
            case 'trainers':
                $columns = ['ID', 'First Name', 'Last Name', 'Email', 'Status', 'Registration Date'];
                $query = User::where('role', 'Trainer')->orderBy('id');
                break;
                
            case 'subscriptions':
                $columns = ['ID', 'Member', 'Type', 'Price', 'Start Date', 'End Date', 'Status'];
                $query = Subscription::with('user')->orderBy('id');
                break;
                
            case 'payments':
                $columns = ['ID', 'Member', 'Subscription', 'Amount', 'Date', 'Method', 'Status'];
                $query = Payment::with('subscription.user')->orderBy('id');
                break;
                
            case 'sessions':
                $columns = ['ID', 'Title', 'Type', 'Level', 'Capacity', 'Date', 'Start Time', 'End Time', 'Trainer'];
                $query = Session::with('trainer')->orderBy('id');
                break;
                
            case 'attendance':
                $columns = ['ID', 'Member', 'Session', 'Date', 'Entry Time', 'Exit Time', 'Check-in Method'];
                $query = Attendance::with(['user', 'session'])->orderBy('id');
                break;
        }
        
        $callback = function() use ($query, $columns, $type) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            $query->chunk(200, function($items) use ($file, $type) {
                foreach($items as $item) {
                    $row = [];
                    
                    switch($type) {
                        case 'members':
                        case 'users':
                        case 'trainers':
                            $row = [
                                $item->id,
                                $item->firstname,
                                $item->lastname,
                                $item->email,
                                $item->status,
                                $item->registrationDate ? $item->registrationDate->format('Y-m-d') : '',
                                $item->role
                            ];
                            break;
                            
                        case 'subscriptions':
                            $row = [
                                $item->id,
                                $item->user ? $item->user->firstname . ' ' . $item->user->lastname : 'Unknown',
                                $item->type,
                                $item->price,
                                $item->start_date->format('Y-m-d'),
                                $item->end_date->format('Y-m-d'),
                                $item->status
                            ];
                            break;
                            
                        case 'payments':
                            $userName = 'Unknown';
                            if ($item->subscription && $item->subscription->user) {
                                $userName = $item->subscription->user->firstname . ' ' . $item->subscription->user->lastname;
                            }
                            
                            $row = [
                                $item->id,
                                $userName,
                                $item->subscription ? $item->subscription->type : 'Unknown',
                                $item->amount,
                                $item->date->format('Y-m-d'),
                                $item->method,
                                $item->status
                            ];
                            break;
                            
                        case 'sessions':
                            $row = [
                                $item->id,
                                $item->title,
                                $item->type,
                                $item->level,
                                $item->max_capacity,
                                $item->date->format('Y-m-d'),
                                $item->start_time->format('H:i:s'),
                                $item->end_time->format('H:i:s'),
                                $item->trainer ? $item->trainer->firstname . ' ' . $item->trainer->lastname : 'Unknown'
                            ];
                            break;
                            
                        case 'attendance':
                            $row = [
                                $item->id,
                                $item->user ? $item->user->firstname . ' ' . $item->user->lastname : 'Unknown',
                                $item->session ? $item->session->title : 'Unknown',
                                $item->date->format('Y-m-d'),
                                $item->entry_time ? $item->entry_time->format('H:i:s') : '',
                                $item->exit_time ? $item->exit_time->format('H:i:s') : '',
                                $item->check_in_method
                            ];
                            break;
                    }
                    
                    fputcsv($file, $row);
                }
            });
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}