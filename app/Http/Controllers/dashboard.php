<?php

namespace App\Http\Controllers;

use App\Models\apiLog;
use App\Models\Peserta;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;

class dashboard extends Controller
{

    function __construct(){
        $this->middleware("auth");
    }

    public function index(){

        $today = Carbon::now();
        $todayDate = $today->toDateString();
        $day_1 = Carbon::now()->subDays(1);
        $day_2 = Carbon::now()->subDays(2);
        $day_3 =Carbon::now()->subDays(3);


        $jumlahPeserta = Peserta::where("id_users",Auth::user()->id)->count();
        $jumlahKuis = Quiz::where("user_id",Auth::user()->id)->count();
        
        $jumlahRequestToday = apiLog::where("id_user",Auth::user()->id)->whereDate('created_at',$todayDate)->count();
        
        $jumlahReq_day_1 = apiLog::where("id_user",Auth::user()->id)->whereDate('created_at',$day_1->toDateString())->count();
        $jumlahReq_day_2 = apiLog::where("id_user",Auth::user()->id)->whereDate('created_at',$day_2->toDateString())->count();
        $jumlahReq_day_3 = apiLog::where("id_user",Auth::user()->id)->whereDate('created_at',$day_3->toDateString())->count();


        $data["jumlahPeserta"] = $jumlahPeserta;
        $data["jumlahKuis"] = $jumlahKuis;
        $data["jumlahRequestToday"] = $jumlahRequestToday;
        $data["jumlah_request_per_hari"][0] =  [$today->format("d M"),$jumlahRequestToday];
        $data["jumlah_request_per_hari"][1] =  [$day_1->format("d M"),$jumlahReq_day_1];
        $data["jumlah_request_per_hari"][2] =  [$day_2->format("d M"),$jumlahReq_day_2];
        $data["jumlah_request_per_hari"][3] =  [$day_3->format("d M"),$jumlahReq_day_3];

        // dd($data);

        

        return view("pages.dashboard.index",compact('data'));
    }



    
}
