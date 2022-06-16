<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;

class LogController extends Controller
{
    public static function logAction($action)
    {
        Log::create([
            'user_id' => session('user_id'),
            'action' => $action,
            'timestamp' => Carbon::now()
        ]);
    }
}
