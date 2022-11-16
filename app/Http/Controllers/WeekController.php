<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserTimeTransaction;
use App\Models\Week;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    public function index(Request $request)
    {
        if($request->user){
            $user_id = $request->user;
        }
        $weeks = Week::get();
        $users = User::get();
        
        $paid_weeks = UserTimeTransaction::with('weeks')->where('user_id',$user_id)->get();
        $paid=[];
        foreach($paid_weeks as $r)
        {
            $paid[$r->week_id][] = $r;
        }
        return view('week/index',compact('weeks','paid','users'));
    }
    public function report(Request $request)
    {
        $date = date('Y-m-d');
        $data=[];
        $users = User::get();
        foreach($users as $r)
        {
            $data[$r->id] = 0;
        }
        $week_count = Week::where('date_to','<=',$date)->count();
        $total_amount = $week_count*10;
        
        $user_amount = Transaction::get();

        
        foreach ($user_amount as $r) {
            $data[$r->user_id] = $data[$r->user_id] + $r->amount;
        }

        if($request->user){
            $user_id = $request->user;
        }
        $list = [];
        return view('week/report',compact('data','users','total_amount'));
    }
}
