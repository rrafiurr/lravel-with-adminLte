<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionMedia;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::with('user')->orderBy('date','desc')->get();
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
        return view('transactions/create');
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
        // $data->user_id = Auth::id();
        
        $data->save();

        return $data;

        // Transaction
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
