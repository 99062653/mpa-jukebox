<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;
use Exception;

class LogController extends Controller
{
    // HEB HET OVERAL VERWIJDERD, want ja naast leukheid is het nutteloos
    public static function logAction($action)
    {
        try {
            Log::create([
                'user_id' => session('user_id'),
                'action' => $action,
                'timestamp' => Carbon::now()
            ]);
        } catch (Exception $e) {
            
        }
    }
}
