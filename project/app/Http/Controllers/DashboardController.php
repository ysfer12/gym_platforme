<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Trainer\TrainerController;
use App\Http\Controllers\Receptionist\ReceptionistController;
use App\Http\Controllers\Member\MemberController;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard appropriate for the user's role.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Redirect to the appropriate dashboard based on user role
        if ($user->isAdmin()) {
            return app(AdminController::class)->dashboard();
        } elseif ($user->isTrainer()) {
            return app(TrainerController::class)->dashboard();
        } elseif ($user->isReceptionist()) {
            return app(ReceptionistController::class)->dashboard();
        } else {
            return app(MemberController::class)->dashboard();
        }
    }

    /**
     * Redirect to user management (admin only)
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        return app(Admin\UserController::class)->index();
    }

    /**
     * Redirect to create user form (admin only)
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        return app(Admin\UserController::class)->create();
    }

    /**
     * Redirect to store user logic (admin only)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        return app(Admin\UserController::class)->store($request);
    }

    /**
     * Redirect to edit user form (admin only)
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUser($user)
    {
        return app(Admin\UserController::class)->edit($user);
    }

    /**
     * Redirect to update user logic (admin only)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $user)
    {
        return app(Admin\UserController::class)->update($request, $user);
    }

    /**
     * Redirect to destroy user logic (admin only)
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($user)
    {
        return app(Admin\UserController::class)->destroy($user);
    }

    /**
     * Redirect to member report (admin only)
     *
     * @return \Illuminate\Http\Response
     */
    public function memberReport()
    {
        return app(Admin\AdminController::class)->memberReport();
    }

    /**
     * Redirect to session report (admin only)
     *
     * @return \Illuminate\Http\Response
     */
    public function sessionReport()
    {
        return app(Admin\AdminController::class)->sessionReport();
    }

    /**
     * Redirect to revenue report (admin only)
     *
     * @return \Illuminate\Http\Response
     */
    public function revenueReport()
    {
        return app(Admin\AdminController::class)->revenueReport();
    }

    /**
     * Redirect to members listing (receptionist only)
     *
     * @return \Illuminate\Http\Response
     */
    public function members()
    {
        return app(Receptionist\ReceptionistController::class)->members();
    }
}