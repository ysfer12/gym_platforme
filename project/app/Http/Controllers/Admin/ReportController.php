<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Session;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Administrator']);
    }

    /**
     * Display the reports dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
     * Generate financial report
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function financialReport(Request $request)
    {
        // Set default date range if not provided
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->subMonths(6)->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();
        
        // Get revenue for the period
        $totalRevenue = Payment::whereBetween('date', [$startDate, $endDate])
            ->where('status', 'paid')
            ->sum('amount');
        
        // Get current month revenue
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        
        $currentMonthRevenue = Payment::whereBetween('date', [$currentMonthStart, $currentMonthEnd])
            ->where('status', 'paid')
            ->sum('amount');
        
        // Get previous month revenue
        $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        
        $previousMonthRevenue = Payment::whereBetween('date', [$previousMonthStart, $previousMonthEnd])
            ->where('status', 'paid')
            ->sum('amount');
        
        // Calculate growth percentage
        $growthPercentage = 0;
        if ($previousMonthRevenue > 0) {
            $growthPercentage = round((($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100, 1);
        }
        
        // Get revenue by month
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
            $monthEnd = Carbon::now()->subMonths($i)->endOfMonth();
            $monthLabel = $monthStart->format('M Y');
            
            $revenue = Payment::whereBetween('date', [$monthStart, $monthEnd])
                ->where('status', 'paid')
                ->sum('amount');
            
            $monthlyRevenue[$monthLabel] = $revenue;
        }
        
        // Get revenue by subscription type
        $revenueByType = Payment::join('subscriptions', 'payments.subscription_id', '=', 'subscriptions.id')
            ->whereBetween('payments.date', [$startDate, $endDate])
            ->where('payments.status', 'paid')
            ->select('subscriptions.type', DB::raw('SUM(payments.amount) as total'))
            ->groupBy('subscriptions.type')
            ->orderBy('total', 'desc')
            ->get();
        
        // If no revenue by type data, provide default
        if ($revenueByType->isEmpty()) {
            $revenueByType = collect([
                ['type' => 'Basic', 'total' => 0],
                ['type' => 'Premium', 'total' => 0],
                ['type' => 'Elite', 'total' => 0]
            ]);
        }
        
        // Get revenue by payment method
        $revenueByMethod = Payment::whereBetween('date', [$startDate, $endDate])
            ->where('status', 'paid')
            ->select('method', DB::raw('SUM(amount) as total'))
            ->groupBy('method')
            ->orderBy('total', 'desc')
            ->get();
        
        // If no revenue by method data, provide default
        if ($revenueByMethod->isEmpty()) {
            $revenueByMethod = collect([
                ['method' => 'Credit Card', 'total' => 0],
                ['method' => 'Cash', 'total' => 0],
                ['method' => 'Bank Transfer', 'total' => 0],
                ['method' => 'Stripe', 'total' => 0]
            ]);
        }
        
        // Get new subscriptions count by month
        $newSubscriptionsByMonth = [];
        $renewalsByMonth = [];
        $transactionsByMonth = [];
        
        foreach ($monthlyRevenue as $month => $revenue) {
            $monthDate = Carbon::parse('01 ' . $month);
            $monthStart = $monthDate->startOfMonth();
            $monthEnd = $monthDate->endOfMonth();
            
            $newSubscriptionsByMonth[$month] = Subscription::whereBetween('start_date', [$monthStart, $monthEnd])
                ->count();
            
            $renewalsByMonth[$month] = Subscription::whereBetween('end_date', [$monthStart, $monthEnd])
                ->where('status', 'renewed')
                ->count();
            
            $transactionsByMonth[$month] = Payment::whereBetween('date', [$monthStart, $monthEnd])
                ->where('status', 'paid')
                ->count();
        }
        
        // Calculate financial metrics
        $activeMembers = User::where('role', 'Member')
            ->where('status', 'Active')
            ->count();
        
        $avgRevenuePerMember = 0;
        if ($activeMembers > 0) {
            $avgRevenuePerMember = $currentMonthRevenue / $activeMembers;
        }
        
        // Average membership duration in months (placeholder calculation)
        $avgMembershipDuration = 12; // Default value, you might want to calculate this based on real data
        
        // Lifetime Value calculation
        $memberLTV = $avgRevenuePerMember * $avgMembershipDuration;
        
        // Monthly Recurring Revenue
        $monthlyRecurringRevenue = Subscription::join('users', 'subscriptions.user_id', '=', 'users.id')
            ->where('users.role', 'Member')
            ->where('users.status', 'Active')
            ->where('subscriptions.status', 'active')
            ->where('subscriptions.end_date', '>=', now())
            ->sum('subscriptions.price') / 12; // Assuming annual subscriptions divided by 12 for monthly value
        
        // Calculate average monthly growth rate for projections
        $avgMonthlyGrowthRate = 0;
        $revenueValues = array_values($monthlyRevenue);
        
        for ($i = 1; $i < count($revenueValues); $i++) {
            if ($revenueValues[$i - 1] > 0) {
                $monthGrowth = (($revenueValues[$i] - $revenueValues[$i - 1]) / $revenueValues[$i - 1]) * 100;
                $avgMonthlyGrowthRate += $monthGrowth;
            }
        }
        
        if (count($revenueValues) > 1) {
            $avgMonthlyGrowthRate = $avgMonthlyGrowthRate / (count($revenueValues) - 1);
        }
        
        return view('admin.reports.revenues', compact(
            'startDate',
            'endDate',
            'totalRevenue',
            'currentMonthRevenue',
            'previousMonthRevenue',
            'growthPercentage',
            'monthlyRevenue',
            'revenueByType',
            'revenueByMethod',
            'newSubscriptionsByMonth',
            'renewalsByMonth',
            'transactionsByMonth',
            'avgRevenuePerMember',
            'memberLTV',
            'monthlyRecurringRevenue',
            'avgMonthlyGrowthRate'
        ));
    }

    /**
     * Generate member activity report
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function memberActivityReport(Request $request)
    {
        // Set default date range if not provided
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->subMonths(3)->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();
        
        // Get all members
        $members = User::where('role', 'Member')->get();
        
        // Get active and inactive members count
        $activeMembers = User::where('role', 'Member')->where('status', 'Active')->count();
        $inactiveMembers = User::where('role', 'Member')->where('status', 'Inactive')->count();
        
        // Get new members this month
        $newMembers = User::where('role', 'Member')
            ->whereMonth('registrationDate', Carbon::now()->month)
            ->whereYear('registrationDate', Carbon::now()->year)
            ->count();
        
        // Get monthly signups for the last 12 months
        $monthlySignups = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->format('M Y');
            
            $count = User::where('role', 'Member')
                ->whereMonth('registrationDate', $date->month)
                ->whereYear('registrationDate', $date->year)
                ->count();
            
            $monthlySignups[$month] = $count;
        }
        
        // Get members by subscription type
        $membersBySubscriptionType = Subscription::join('users', 'subscriptions.user_id', '=', 'users.id')
            ->where('users.role', 'Member')
            ->where('subscriptions.status', 'active')
            ->select('subscriptions.type', DB::raw('count(distinct users.id) as count'))
            ->groupBy('subscriptions.type')
            ->get();
        
        // If no subscription data, provide default
        if ($membersBySubscriptionType->isEmpty()) {
            $membersBySubscriptionType = collect([
                ['type' => 'Basic', 'count' => 0],
                ['type' => 'Premium', 'count' => 0],
                ['type' => 'Elite', 'count' => 0],
                ['type' => 'None', 'count' => 0]
            ]);
        }
        
        // Get members with most attendance
        $membersWithMostAttendance = User::where('role', 'Member')
        ->select(DB::raw('users.*, (SELECT COUNT(*) FROM attendances 
                                WHERE users.id = attendances.user_id 
                                AND date BETWEEN \'' . $startDate->toDateString() . '\' AND \'' . $endDate->toDateString() . '\') as attendances_count'))
        ->orderByRaw('(SELECT COUNT(*) FROM attendances 
                      WHERE users.id = attendances.user_id 
                      AND date BETWEEN \'' . $startDate->toDateString() . '\' AND \'' . $endDate->toDateString() . '\') DESC')
        ->limit(10)
        ->get();
        
        // Calculate activity levels
        $highlyActiveCount = User::where('role', 'Member')
        ->select(DB::raw('users.*, (SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') as attendance_count'))
        ->whereRaw('(SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') >= 10')
        ->count();
        
        $activeCount = User::where('role', 'Member')
    ->select(DB::raw('users.*, (SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') as attendance_count'))
    ->whereRaw('(SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') >= 5')
    ->whereRaw('(SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') < 10')
    ->count();

$moderatelyActiveCount = User::where('role', 'Member')
    ->select(DB::raw('users.*, (SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') as attendance_count'))
    ->whereRaw('(SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') >= 2')
    ->whereRaw('(SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') < 5')
    ->count();

$lowActiveCount = User::where('role', 'Member')
    ->select(DB::raw('users.*, (SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') as attendance_count'))
    ->whereRaw('(SELECT COUNT(*) FROM attendances WHERE users.id = attendances.user_id AND EXTRACT(MONTH FROM date) = ' . Carbon::now()->month . ' AND EXTRACT(YEAR FROM date) = ' . Carbon::now()->year . ') < 2')
    ->count();
        
        $activityLevels = [
            $highlyActiveCount,
            $activeCount,
            $moderatelyActiveCount,
            $lowActiveCount
        ];
        
        // Calculate average membership duration in months
        $avgMembershipMonths = 0;
        $members->each(function($member) use (&$avgMembershipMonths) {
            $registrationDate = Carbon::parse($member->registrationDate);
            $monthsDiff = $registrationDate->diffInMonths(Carbon::now());
            $avgMembershipMonths += $monthsDiff;
        });
        
        if ($members->count() > 0) {
            $avgMembershipMonths = round($avgMembershipMonths / $members->count(), 1);
        }
        
        // Calculate renewal rate
        $renewalRate = 70; // Default value as placeholder
        
// Calculate last 6 months' subscription renewals
        $totalExpired = Subscription::where('end_date', '<', Carbon::now())
            ->where('end_date', '>=', Carbon::now()->subMonths(6))
            ->count();
        
        $totalRenewed = Subscription::where('end_date', '<', Carbon::now())
            ->where('end_date', '>=', Carbon::now()->subMonths(6))
            ->where('status', 'renewed')
            ->count();
        
        if ($totalExpired > 0) {
            $renewalRate = round(($totalRenewed / $totalExpired) * 100, 1);
        }
        
        // Calculate churn rate
        $churnRate = 100 - $renewalRate;
        
        // Retention by month for chart
        $retentionByMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('M Y');
            // Calculate or set a reasonable retention value for this month
            $retentionByMonth[$month] = rand(60, 95); // Random values for placeholder
        }
        
        return view('admin.reports.members', compact(
            'members',
            'activeMembers',
            'inactiveMembers',
            'newMembers',
            'monthlySignups',
            'membersBySubscriptionType',
            'membersWithMostAttendance',
            'activityLevels',
            'avgMembershipMonths',
            'renewalRate',
            'churnRate',
            'retentionByMonth'
        ));
    }

    /**
     * Generate session report
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function sessionReport(Request $request)
    {
        // Set default date range if not provided
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->subMonth()->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();
        
        // Get sessions for the period
        $sessions = Session::with(['trainer', 'attendances'])
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
        
        // Get total attendance
        $totalAttendance = Attendance::whereBetween('date', [$startDate, $endDate])->count();
        
        // Calculate average capacity percentage
        $totalCapacity = $sessions->sum('max_capacity');
        $avgCapacityPercentage = 0;
        
        if ($totalCapacity > 0) {
            $avgCapacityPercentage = ($totalAttendance / $totalCapacity) * 100;
        }
        
        // Get sessions by time of day
        $morningSessionsCount = $sessions->filter(function($session) {
            $startTime = Carbon::parse($session->start_time);
            return $startTime->hour >= 6 && $startTime->hour < 12;
        })->count();
        
        $afternoonSessionsCount = $sessions->filter(function($session) {
            $startTime = Carbon::parse($session->start_time);
            return $startTime->hour >= 12 && $startTime->hour < 17;
        })->count();
        
        $eveningSessionsCount = $sessions->filter(function($session) {
            $startTime = Carbon::parse($session->start_time);
            return $startTime->hour >= 17 && $startTime->hour < 22;
        })->count();
        
        // Get sessions by type
        $sessionsByType = $sessions->groupBy('type')
            ->map(function($group) {
                return [
                    'type' => $group->first()->type,
                    'count' => $group->count()
                ];
            })->values();
        
        // Add any missing session types with count 0
        $allTypes = ['Cardio', 'Strength', 'Yoga', 'HIIT', 'Pilates', 'Cycling', 'Zumba', 'CrossFit'];
        $existingTypes = $sessionsByType->pluck('type')->toArray();
        
        foreach ($allTypes as $type) {
            if (!in_array($type, $existingTypes)) {
                $sessionsByType->push(['type' => $type, 'count' => 0]);
            }
        }
        
        // Calculate attendance by day of week - FIX HERE
        $attendanceByDay = [0, 0, 0, 0, 0, 0, 0]; // Mon to Sun
        
        // Using PostgreSQL EXTRACT(DOW) instead of MySQL DAYOFWEEK
        // DOW in PostgreSQL: 0 = Sunday, 1 = Monday, ..., 6 = Saturday
        $attendanceByDayData = Attendance::join('sessions', 'attendances.session_id', '=', 'sessions.id')
            ->whereBetween('attendances.date', [$startDate, $endDate])
            ->select(DB::raw('EXTRACT(DOW FROM attendances.date) as day_of_week'), DB::raw('count(*) as count'))
            ->groupBy('day_of_week')
            ->get();
        
        foreach ($attendanceByDayData as $item) {
            // Convert PostgreSQL DOW (0=Sunday) to our array index (0=Monday)
            $index = ($item->day_of_week + 6) % 7; // This shifts Sunday from 0 to 6
            $attendanceByDay[$index] = $item->count;
        }
        
        // Get sessions by trainer
        $sessionsByTrainer = Session::whereBetween('date', [$startDate, $endDate])
            ->with('trainer')
            ->select('trainer_id', DB::raw('count(*) as count'))
            ->groupBy('trainer_id')
            ->get();
        
        // Calculate attendance by trainer
        $trainerAttendance = [];
        $trainerCapacity = [];
        $trainerPopularTypes = [];
        
        foreach ($sessionsByTrainer as $trainerData) {
            $trainerSessions = Session::where('trainer_id', $trainerData->trainer_id)
                ->whereBetween('date', [$startDate, $endDate])
                ->with('attendances')
                ->get();
            
            $trainerAttendance[$trainerData->trainer_id] = $trainerSessions->sum(function($session) {
                return $session->attendances->count();
            });
            
            $trainerCapacity[$trainerData->trainer_id] = $trainerSessions->sum('max_capacity');
            
            $typeCount = $trainerSessions->groupBy('type')
                ->map(function($group) {
                    return $group->count();
                })
                ->sortDesc()
                ->take(3); // Top 3 session types
            
            $trainerPopularTypes[$trainerData->trainer_id] = $typeCount;
        }
        
        // Get most popular sessions
        $popularSessions = Session::whereBetween('date', [$startDate, $endDate])
            ->with(['trainer', 'attendances'])
            ->withCount('attendances')
            ->orderBy('attendances_count', 'desc')
            ->limit(10)
            ->get();
        
        // Calculate attendance by hour
        $attendanceByHour = [];
        $sessionsByHour = [];
        
        for ($hour = 6; $hour < 22; $hour++) {
            $hourSessions = $sessions->filter(function($session) use ($hour) {
                $startHour = Carbon::parse($session->start_time)->hour;
                return $startHour == $hour;
            });
            
            $hourAttendanceCount = 0;
            foreach ($hourSessions as $session) {
                $hourAttendanceCount += $session->attendances->count();
            }
            
            $hourSessionCount = $hourSessions->count();
            $avgAttendance = $hourSessionCount > 0 ? $hourAttendanceCount / $hourSessionCount : 0;
            
            $timeLabel = sprintf("%02d:00", $hour);
            $attendanceByHour[$timeLabel] = $avgAttendance;
            $sessionsByHour[$timeLabel] = $hourSessionCount;
        }
        
        return view('admin.reports.sessions', compact(
            'sessions',
            'totalAttendance',
            'avgCapacityPercentage',
            'morningSessionsCount',
            'afternoonSessionsCount',
            'eveningSessionsCount',
            'sessionsByType',
            'attendanceByDay',
            'sessionsByTrainer',
            'trainerAttendance',
            'trainerCapacity',
            'trainerPopularTypes',
            'popularSessions',
            'attendanceByHour',
            'sessionsByHour',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Generate membership trends report
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function membershipTrendsReport(Request $request)
    {
        // Set default year if not provided
        $year = $request->year ? intval($request->year) : date('Y');
        
        // Get new members by month for the year
        $newMembers = User::where('role', 'Member')
            ->whereYear('registrationDate', $year)
            ->select(DB::raw('MONTH(registrationDate) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Format for chart display
        $monthLabels = [];
        $newMembersData = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthLabels[] = date('F', mktime(0, 0, 0, $i, 1));
            
            $monthData = $newMembers->firstWhere('month', $i);
            $newMembersData[] = $monthData ? $monthData->count : 0;
        }
        
        // Get total members count at start of year
        $startOfYear = Carbon::createFromDate($year, 1, 1)->startOfDay();
        $membersAtStartOfYear = User::where('role', 'Member')
            ->where('registrationDate', '<', $startOfYear)
            ->count();
        
        // Calculate member growth throughout the year
        $cumulativeMemberCount = [$membersAtStartOfYear];
        $runningTotal = $membersAtStartOfYear;
        
        for ($i = 0; $i < count($newMembersData); $i++) {
            $runningTotal += $newMembersData[$i];
            $cumulativeMemberCount[] = $runningTotal;
        }
        
        // Get cancellations by month
        $cancellations = User::where('role', 'Member')
            ->whereYear('deletionDate', $year)
            ->select(DB::raw('MONTH(deletionDate) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Format for chart display
        $cancellationsData = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $cancellations->firstWhere('month', $i);
            $cancellationsData[] = $monthData ? $monthData->count : 0;
        }
        
        // Get retention rate
        $retentionRate = [];
        for ($i = 0; $i < 12; $i++) {
            if ($i > 0 && $cumulativeMemberCount[$i] > 0) {
                $rate = 100 - (($cancellationsData[$i] / $cumulativeMemberCount[$i]) * 100);
                $retentionRate[] = round($rate, 2);
            } else {
                $retentionRate[] = 100;
            }
        }
        
        // Get members by subscription type
        $membersByType = Subscription::join('users', 'subscriptions.user_id', '=', 'users.id')
            ->where('users.role', 'Member')
            ->where('subscriptions.status', 'active')
            ->where('subscriptions.end_date', '>=', now())
            ->select('subscriptions.type', DB::raw('count(distinct users.id) as count'))
            ->groupBy('subscriptions.type')
            ->get();
        
        // Get member demographics
        $memberDemographics = [
            'total' => User::where('role', 'Member')->count(),
            'active' => User::where('role', 'Member')->where('status', 'Active')->count(),
            'inactive' => User::where('role', 'Member')->where('status', 'Inactive')->count(),
            'newThisYear' => User::where('role', 'Member')->whereYear('registrationDate', $year)->count(),
            'lost' => User::where('role', 'Member')->whereYear('deletionDate', $year)->count(),
        ];
        
        return view('admin.reports.membership-trends', compact(
            'year',
            'monthLabels',
            'newMembersData',
            'cumulativeMemberCount',
            'cancellationsData',
            'retentionRate',
            'membersByType',
            'memberDemographics'
        ));
    }

    /**
     * Generate trainer performance report
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function trainerPerformanceReport(Request $request)
    {
        // Set default date range if not provided
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->subMonths(3)->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();
        
        // Get all trainers
        $trainers = User::where('role', 'Trainer')->get();
        
        // Get sessions count by trainer
        $sessionsByTrainer = Session::whereBetween('date', [$startDate, $endDate])
            ->select('trainer_id', DB::raw('count(*) as sessions_count'))
            ->groupBy('trainer_id')
            ->get()
            ->keyBy('trainer_id');
        
        // Get attendance count by trainer
        $attendanceByTrainer = Attendance::join('sessions', 'attendances.session_id', '=', 'sessions.id')
            ->whereBetween('attendances.date', [$startDate, $endDate])
            ->select('sessions.trainer_id', DB::raw('count(*) as attendance_count'))
            ->groupBy('sessions.trainer_id')
            ->get()
            ->keyBy('trainer_id');
        
        // Calculate average attendance per session
        $trainerPerformance = [];
        
        foreach ($trainers as $trainer) {
            $sessionsCount = $sessionsByTrainer[$trainer->id]['sessions_count'] ?? 0;
            $attendanceCount = $attendanceByTrainer[$trainer->id]['attendance_count'] ?? 0;
            
            $avgAttendance = $sessionsCount > 0 ? $attendanceCount / $sessionsCount : 0;
            
            $trainerPerformance[] = [
                'id' => $trainer->id,
                'name' => $trainer->firstname . ' ' . $trainer->lastname,
                'sessions_count' => $sessionsCount,
                'attendance_count' => $attendanceCount,
                'avg_attendance' => round($avgAttendance, 2),
            ];
        }
        
        // Sort by attendance count (descending)
        usort($trainerPerformance, function($a, $b) {
            return $b['attendance_count'] <=> $a['attendance_count'];
        });
        
        // Get session types by trainer
        $sessionTypesByTrainer = Session::whereBetween('date', [$startDate, $endDate])
            ->select('trainer_id', 'type', DB::raw('count(*) as count'))
            ->groupBy('trainer_id', 'type')
            ->get();
        
        // Group session types by trainer
        $trainerSessionTypes = [];
        
        foreach ($sessionTypesByTrainer as $record) {
            if (!isset($trainerSessionTypes[$record->trainer_id])) {
                $trainerSessionTypes[$record->trainer_id] = [];
            }
            
            $trainerSessionTypes[$record->trainer_id][$record->type] = $record->count;
        }
        
        return view('admin.reports.trainer-performance', compact(
            'startDate',
            'endDate',
            'trainerPerformance',
            'trainerSessionTypes'
        ));
    }

    /**
     * Generate custom report
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function customReport(Request $request)
    {
        // Validate report parameters
        $request->validate([
            'report_type' => 'required|in:member,revenue,attendance,subscription',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'grouping' => 'required|in:daily,weekly,monthly'
        ]);
        
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        
        $reportData = [];
        $chartLabels = [];
        $chartData = [];
        
        // Define SQL date format based on grouping
        $dateFormat = $request->grouping === 'daily' ? '%Y-%m-%d' :
                     ($request->grouping === 'weekly' ? '%Y-%u' : '%Y-%m');
        
        // Label format for display
        $labelFormat = $request->grouping === 'daily' ? 'M d, Y' :
                      ($request->grouping === 'weekly' ? '\WW, Y' : 'M Y');
        
        switch ($request->report_type) {
            case 'member':
                // New member registrations
                $reportData = User::where('role', 'Member')
                    ->whereBetween('registrationDate', [$startDate, $endDate])
                    ->select(DB::raw("DATE_FORMAT(registrationDate, '{$dateFormat}') as date_group"), 
                             DB::raw('count(*) as count'))
                    ->groupBy('date_group')
                    ->orderBy('date_group')
                    ->get();
                
                foreach ($reportData as $item) {
                    if ($request->grouping === 'weekly') {
                        // Parse year and week number
                        list($year, $week) = explode('-', $item->date_group);
                        $date = Carbon::now()->setISODate($year, $week);
                    } else if ($request->grouping === 'monthly') {
                        // Parse year and month
                        list($year, $month) = explode('-', $item->date_group);
                        $date = Carbon::createFromDate($year, $month, 1);
                    } else {
                        // Daily - direct parse
                        $date = Carbon::parse($item->date_group);
                    }
                    
                    $chartLabels[] = $date->format($labelFormat);
                    $chartData[] = $item->count;
                }
                break;
                
            case 'revenue':
                // Revenue
                $reportData = Payment::where('status', 'paid')
                    ->whereBetween('date', [$startDate, $endDate])
                    ->select(DB::raw("DATE_FORMAT(date, '{$dateFormat}') as date_group"), 
                             DB::raw('sum(amount) as total'))
                    ->groupBy('date_group')
                    ->orderBy('date_group')
                    ->get();
                
                foreach ($reportData as $item) {
                    if ($request->grouping === 'weekly') {
                        list($year, $week) = explode('-', $item->date_group);
                        $date = Carbon::now()->setISODate($year, $week);
                    } else if ($request->grouping === 'monthly') {
                        list($year, $month) = explode('-', $item->date_group);
                        $date = Carbon::createFromDate($year, $month, 1);
                    } else {
                        $date = Carbon::parse($item->date_group);
                    }
                    
                    $chartLabels[] = $date->format($labelFormat);
                    $chartData[] = $item->total;
                }
                break;
                
            case 'attendance':
                // Attendance
                $reportData = Attendance::whereBetween('date', [$startDate, $endDate])
                    ->select(DB::raw("DATE_FORMAT(date, '{$dateFormat}') as date_group"), 
                             DB::raw('count(*) as count'))
                    ->groupBy('date_group')
                    ->orderBy('date_group')
                    ->get();
                
                foreach ($reportData as $item) {
                    if ($request->grouping === 'weekly') {
                        list($year, $week) = explode('-', $item->date_group);
                        $date = Carbon::now()->setISODate($year, $week);
                    } else if ($request->grouping === 'monthly') {
                        list($year, $month) = explode('-', $item->date_group);
                        $date = Carbon::createFromDate($year, $month, 1);
                    } else {
                        $date = Carbon::parse($item->date_group);
                    }
                    
                    $chartLabels[] = $date->format($labelFormat);
                    $chartData[] = $item->count;
                }
                break;
                
            case 'subscription':
                // New subscriptions
                $reportData = Subscription::whereBetween('start_date', [$startDate, $endDate])
                    ->select(DB::raw("DATE_FORMAT(start_date, '{$dateFormat}') as date_group"), 
                             DB::raw('count(*) as count'))
                    ->groupBy('date_group')
                    ->orderBy('date_group')
                    ->get();
                
                foreach ($reportData as $item) {
                    if ($request->grouping === 'weekly') {
                        list($year, $week) = explode('-', $item->date_group);
                        $date = Carbon::now()->setISODate($year, $week);
                    } else if ($request->grouping === 'monthly') {
                        list($year, $month) = explode('-', $item->date_group);
                        $date = Carbon::createFromDate($year, $month, 1);
                    } else {
                        $date = Carbon::parse($item->date_group);
                    }
                    
                    $chartLabels[] = $date->format($labelFormat);
                    $chartData[] = $item->count;
                }
                break;
        }
        
        $reportTitle = ucfirst($request->report_type) . ' Report - ' . 
                       ucfirst($request->grouping) . ' (' . 
                       $startDate->format('M d, Y') . ' - ' . 
                       $endDate->format('M d, Y') . ')';
        
        return view('admin.reports.custom', compact(
            'reportTitle',
            'reportData',
            'chartLabels',
            'chartData',
            'request'
        ));
    }

    /**
     * Export a report to CSV
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportReport(Request $request)
    {
        // Validate export parameters
        $request->validate([
            'report_type' => 'required|in:members,payments,attendance,subscriptions,sessions',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        
        $fileName = $request->report_type . '_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];
        
        $callback = function() use ($request, $startDate, $endDate) {
            $file = fopen('php://output', 'w');
            
            switch ($request->report_type) {
                case 'members':
                    // Export members list
                    $headers = ['ID', 'First Name', 'Last Name', 'Email', 'Registration Date', 'Status'];
                    fputcsv($file, $headers);
                    
                    User::where('role', 'Member')
                        ->whereBetween('registrationDate', [$startDate, $endDate])
                        ->chunk(100, function($members) use ($file) {
                            foreach ($members as $member) {
                                fputcsv($file, [
                                    $member->id,
                                    $member->firstname,
                                    $member->lastname,
                                    $member->email,
                                    $member->registrationDate,
                                    $member->status,
                                ]);
                            }
                        });
                    break;
                    
                case 'payments':
                    // Export payments
                    $headers = ['ID', 'Date', 'Member', 'Amount', 'Method', 'Status', 'Subscription Type'];
                    fputcsv($file, $headers);
                    
                    Payment::with(['subscription.user'])
                        ->whereBetween('date', [$startDate, $endDate])
                        ->chunk(100, function($payments) use ($file) {
                            foreach ($payments as $payment) {
                                fputcsv($file, [
                                    $payment->id,
                                    $payment->date,
                                    $payment->subscription->user->firstname . ' ' . $payment->subscription->user->lastname,
                                    $payment->amount,
                                    $payment->method,
                                    $payment->status,
                                    $payment->subscription->type,
                                ]);
                            }
                        });
                    break;
                    
                case 'attendance':
                    // Export attendance
                    $headers = ['ID', 'Date', 'Member', 'Session', 'Entry Time', 'Exit Time', 'Check-in Method'];
                    fputcsv($file, $headers);
                    
                    Attendance::with(['user', 'session'])
                        ->whereBetween('date', [$startDate, $endDate])
                        ->chunk(100, function($attendances) use ($file) {
                            foreach ($attendances as $attendance) {
                                fputcsv($file, [
                                    $attendance->id,
                                    $attendance->date,
                                    $attendance->user->firstname . ' ' . $attendance->user->lastname,
                                    $attendance->session->title,
                                    $attendance->entry_time,
                                    $attendance->exit_time,
                                    $attendance->check_in_method,
                                ]);
                            }
                        });
                    break;
                    
                case 'subscriptions':
                    // Export subscriptions
                    $headers = ['ID', 'Member', 'Type', 'Start Date', 'End Date', 'Price', 'Status', 'Payment Method'];
                    fputcsv($file, $headers);
                    
                    Subscription::with('user')
                        ->whereBetween('start_date', [$startDate, $endDate])
                        ->chunk(100, function($subscriptions) use ($file) {
                            foreach ($subscriptions as $subscription) {
                                fputcsv($file, [
                                    $subscription->id,
                                    $subscription->user->firstname . ' ' . $subscription->user->lastname,
                                    $subscription->type,
                                    $subscription->start_date,
                                    $subscription->end_date,
                                    $subscription->price,
                                    $subscription->status,
                                    $subscription->payment_method,
                                ]);
                            }
                        });
                    break;
                    
                case 'sessions':
                    // Export sessions
                    $headers = ['ID', 'Title', 'Type', 'Date', 'Start Time', 'End Time', 'Trainer', 'Capacity', 'Attendance Count'];
                    fputcsv($file, $headers);
                    
                    Session::with(['trainer', 'attendances'])
                        ->whereBetween('date', [$startDate, $endDate])
                        ->chunk(100, function($sessions) use ($file) {
                            foreach ($sessions as $session) {
                                fputcsv($file, [
                                    $session->id,
                                    $session->title,
                                    $session->type,
                                    $session->date,
                                    $session->start_time,
                                    $session->end_time,
                                    $session->trainer->firstname . ' ' . $session->trainer->lastname,
                                    $session->max_capacity,
                                    $session->attendances->count(),
                                ]);
                            }
                        });
                    break;
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}