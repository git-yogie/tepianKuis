<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\apiLog;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class adminController extends Controller
{
    public function index()
    {
        $data["user_count"] = User::count();
        $data["quiz_count"] = Quiz::count();
        $data["api_log"] = apiLog::count();
        $data["peserta_count"] = Peserta::count();


        return view("admin.pages.dashboard",compact("data"));
    }

    public function user(){
        return view("admin.pages.user");
    }

    public function log(Request $request){
        $logPath = storage_path('logs/laravel.log');
        $log = file_get_contents($logPath);
        //request per tanggal;
        if ($request->has('date')) {
            $date = $request->input('date');
            $logContent = File::get($logPath);
            $logContent = preg_split('/\n/', $logContent);
            $logContent = array_reverse($logContent);
            $logContent = array_filter($logContent, function ($line) use ($date) {
                return strpos($line, $date) !== false;
            });
            $logContent = implode("\n", $logContent);
        }else{
            //  log to day
            $logContent = File::get($logPath);
            $logContent = preg_split('/\n/', $logContent);
            $logContent = array_reverse($logContent);
            $logContent = array_filter($logContent, function ($line) {
                return strpos($line, date('Y-m-d')) !== false;
            });
            $logContent = implode("\n", $logContent);
        }
        return view('admin.pages.log', ['logContent' => $logContent]);

        return view("admin.pages.log");
    }

    public function clearLog(){
        $logPath = storage_path('logs/laravel.log');
        File::put($logPath, '');
        return redirect()->back()->with('success', 'Log berhasil dihapus');
    }

}
