<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Transaction::query()->where("user_id", "=", Auth::user()->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'libelle'=>$request->libelle,
            'amount'=>$request->amount,
            'dates'=>$request->dates,
            'type'=>$request->type,
            'user_id'=> auth()->user()->id
        ]);
        $response = [
            'message'=> 'Transaction creer avec succes',
            'transaction'=> $transaction,
        ];
        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Transaction::find($id));
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
        $transaction = Transaction::find($id);
        $transaction->update([
            'libelle'=>$request->libelle,
            'amount'=>$request->amount,
            'dates'=>$request->dates,
            'type'=>$request->type,
            'user_id'=> auth()->user()->id
        ]);
        $response = [
            'message'=> 'Transaction modifer avec succes',
            'transaction'=> $transaction,
        ];
        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $transaction = Transaction::find($id);
            $transaction->delete();
            $response = [
                'message'=> 'Transaction supprimer avec succes',
            ];
            return response($response);
        } catch (\Throwable $th) {
            return response($response);
        }

    }
}
