<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\TrainerServiceInterface;
use App\Services\Interfaces\AttendanceServiceInterface;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    /**
     * @var TrainerServiceInterface
     */
    protected $trainerService;
    
    /**
     * @var AttendanceServiceInterface
     */
    protected $attendanceService;

    /**
     * TrainerController constructor.
     *
     * @param TrainerServiceInterface $trainerService
     * @param AttendanceServiceInterface $attendanceService
     */
    public function __construct(
        TrainerServiceInterface $trainerService,
        AttendanceServiceInterface $attendanceService
    ) {
        $this->trainerService = $trainerService;
        $this->attendanceService = $attendanceService;
    }

    /**
     * Show the trainer dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        $result = $this->trainerService->getDashboardData($user->id);
        
        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }
        
        // Calculate QR data (will be used for client-side generation)
        $qrData = [
            'name' => $user->firstname . ' ' . $user->lastname,
            'trainer_level' => $result['experienceLevel']['level'],
            'gym' => 'FitTrack Gym',
            'id' => 'TRN-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)
        ];
        
        // Combine data for the view
        $viewData = array_merge($result, ['qrData' => $qrData]);
        
        return view('dashboards.trainer', $viewData);
    }
    
    /**
     * Show attendance records for a specific session.
     *
     * @param  int  $session
     * @return \Illuminate\Http\Response
     */
    public function sessionAttendances($session)
    {
        $result = $this->attendanceService->getSessionAttendances($session, Auth::id());
        
        if (!$result['success']) {
            return redirect()->route('trainer.dashboard')
                ->with('error', $result['message']);
        }
        
        return view('trainer.sessions.attendances', [
            'session' => $result['session'],
            'attendances' => $result['attendances']
        ]);
    }
    
    /**
     * Display members in trainer's sessions.
     *
     * @return \Illuminate\Http\Response
     */
    public function members()
    {
        $trainer = Auth::user();
        
        $result = $this->trainerService->getMembers($trainer->id);
        
        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }
        
        return view('trainer.members.index', ['members' => $result['members']]);
    }
    
    /**
     * Display member details and attendance history with the trainer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function memberDetails($id)
    {
        $trainer = Auth::user();
        
        $result = $this->trainerService->getMemberDetails($trainer->id, $id);
        
        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }
        
        return view('trainer.members.show', [
            'member' => $result['member'],
            'attendances' => $result['attendances']
        ]);
    }

    /**
     * Show the trainer profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        
        $result = $this->trainerService->getProfileData($user->id);
        
        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }
        
        // Generate QR data for JS-based QR code
        $qrData = [
            'name' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'trainer_level' => $result['experienceLevel']['level'],
            'sessions_count' => $result['totalSessions'],
            'specialties' => implode(', ', $result['specialties']),
            'gym' => 'FitTrack Gym',
            'verified' => true,
            'id' => 'TRN-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)
        ];
        
        return view('trainer.profile', array_merge($result, [
            'user' => $user,
            'qrData' => $qrData
        ]));
    }

    /**
     * Download trainer badge as an HTML file that can be saved or printed
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadBadge()
    {
        $user = Auth::user();
        
        $result = $this->trainerService->getBadgeData($user->id);
        
        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }
        
        // Generate QR data as JSON
        $qrData = [
            'name' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'trainer_level' => $result['experienceLevel']['level'],
            'sessions_count' => $result['totalSessions'],
            'specialties' => implode(', ', $result['specialties']),
            'gym' => 'FitTrack Gym',
            'verified' => true,
            'id' => 'TRN-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)
        ];
        
        // Return a view that will generate a downloadable badge with JS-based QR code
        return view('trainer.download-badge', array_merge($result, [
            'user' => $user,
            'qrData' => $qrData
        ]));
    }

    /**
     * Show trainer badge full view.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBadge()
    {
        $user = Auth::user();
        
        $profileResult = $this->trainerService->getProfileData($user->id);
        $badgeResult = $this->trainerService->getBadgeData($user->id);
        
        if (!$profileResult['success'] || !$badgeResult['success']) {
            return back()->with('error', 'Failed to get trainer data');
        }
        
        // Generate QR data for JS-based QR code
        $qrData = [
            'name' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'trainer_level' => $badgeResult['experienceLevel']['level'],
            'sessions_count' => $badgeResult['totalSessions'],
            'specialties' => implode(', ', $badgeResult['specialties']),
            'gym' => 'FitTrack Gym',
            'verified' => true,
            'id' => 'TRN-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)
        ];
        
        return view('trainer.badge', array_merge($badgeResult, [
            'user' => $user,
            'totalUniqueMembers' => $profileResult['totalUniqueMembers'],
            'qrData' => $qrData
        ]));
    }
}