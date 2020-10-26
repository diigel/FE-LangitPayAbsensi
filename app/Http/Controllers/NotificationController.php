<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
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

    public function register(Request $request)
    {
        $auth = Auth::user();

        try {
            $user = User::find($auth->id);
            $user->fcm_token = $request->token;
            $user->save();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json([
                'message' => 'Failed update token'
            ], 200);
        }

        return response()->json([
            'message' => 'User token updated successfully'
        ], 200);
    }
}
