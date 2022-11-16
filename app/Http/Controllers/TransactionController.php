<?php

namespace App\Http\Controllers;

use App\Models\Week;
use Illuminate\Http\Request;
use App\Models\TransactionMedia;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserTimeTransaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('user','transaction_medias')->orderBy('id','desc')->get();
        return view('transactions/index',compact('transactions'));
    }
    public function list()
    {
        return view('transactions/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction_media = TransactionMedia::get();
        $users = User::orderBy('id','desc')->get();
        return view('transactions/create',compact('users','transaction_media'));
    }
    public function get_transaction_media() {
        return TransactionMedia::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transaction_approve(Request $request)
    {
        $this->validate($request, [
            ' transaction_id' => 'required',
            'status' => 'required'
        ]);

        $transaction = Transaction::find($request->transaction_id);
        $transaction->status = $request->status;
        return $transaction->save();
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'amount' => 'required',
            'proof' => 'required',
            'transaction_medias_id' => 'required'
        ]);

        $data = new Transaction;

        $data->date = date('Y-m-d');
        $data->amount = $request->amount;
        $data->transaction_medias_id = $request->transaction_medias_id;
        $data->proof = $request->proof;
        $data->status = 1;
        $data->user_id = $request->user_id;
        
        $data->save();

        $this->user_time_transaction($data);
        // return $data;

        return redirect('/transactions');
    }

    public function user_time_transaction($transaction)
    {
        $user_last_time_transaction = UserTimeTransaction::where('user_id',$transaction->user_id)->orderBy('id','desc')->first();
        // dd($user_last_time_transaction);
        $user= User::find($transaction->user_id);
        $installmentAmount = ($user->donation_amount == 0 || !$user->donation_amount)?10:$user->donation_amount;
        
        $transactionAmount = $transaction->amount;

        $lastPaidWeekId = ($user_last_time_transaction)?$user_last_time_transaction->week_id:0;
        $lastPaidAmount = ($user_last_time_transaction)?$user_last_time_transaction->amount:0;

        $has_due = false;
        if($lastPaidAmount > 0 && $lastPaidAmount < $installmentAmount)
        {
            $data_amount = $installmentAmount - $lastPaidAmount;
            $lastPaidAmount = 0;
            $weeks = Week::where('id','>=',$lastPaidWeekId)->get();
            $has_due = true;
        }
        else{
            $weeks = Week::where('id','>',$lastPaidWeekId)->get();
        }
        foreach($weeks as $r)
        {
            if($has_due)
            {
                $has_due = false;
            }
            else{
                $data_amount= ($transactionAmount > $installmentAmount)? $installmentAmount : $transactionAmount ;
                // echo $data_amount." = ";
            }
            $data = new UserTimeTransaction;
            
            $data->user_id = $user->id;
            $data->week_id = $r->id;
            $data->date = $transaction->date;
            $data->amount = $data_amount; 
            $data->transaction_id = $transaction->id;

            $data->save();

            // echo $transactionAmount."<>";
            $transactionAmount = $transactionAmount - $data_amount;
            // echo $transactionAmount."<br>";

            if($transactionAmount <= 0){
                break;
            }
        }
        return true;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
