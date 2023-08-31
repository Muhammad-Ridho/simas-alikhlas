<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Transaction::class, 'transaction');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,)
    {

        $transactions = Transaction::query();

        $transactions->with('asset');

        if (!empty($request->search)) {
            $transactions->where('keterangan', 'like', '%' . $request->search . '%');
        }

        $transactions = $transactions->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $assets = \App\Models\Asset::all();

        return view('admin.transactions.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,)
    {

        $request->validate(["asset_id" => "required", "tgl_transaksi" => "required", "jns_transaksi" => "required", "nilai_transaksi" => "required", "keterangan" => "required"]);

        try {

            $transaction = new Transaction();
            $transaction->asset_id = $request->asset_id;
            $transaction->tgl_transaksi = $request->tgl_transaksi;
            $transaction->jns_transaksi = $request->jns_transaksi;
            $transaction->nilai_transaksi = $request->nilai_transaksi;
            $transaction->keterangan = $request->keterangan;
            $transaction->save();

            return redirect()->route('transactions.index', [])->with('success', __('Transaction created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('transactions.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction,)
    {

        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction,)
    {

        $assets = \App\Models\Asset::all();

        return view('admin.transactions.edit', compact('transaction', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction,)
    {

        $request->validate(["asset_id" => "required", "tgl_transaksi" => "required", "jns_transaksi" => "required", "nilai_transaksi" => "required", "keterangan" => "required"]);

        try {
            $transaction->asset_id = $request->asset_id;
            $transaction->tgl_transaksi = $request->tgl_transaksi;
            $transaction->jns_transaksi = $request->jns_transaksi;
            $transaction->nilai_transaksi = $request->nilai_transaksi;
            $transaction->keterangan = $request->keterangan;
            $transaction->save();

            return redirect()->route('transactions.index', [])->with('success', __('Transaction edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('transactions.edit', compact('transaction'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction,)
    {

        try {
            $transaction->delete();

            return redirect()->route('transactions.index', [])->with('success', __('Transaction deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('transactions.index', [])->with('error', 'Cannot delete Transaction: ' . $e->getMessage());
        }
    }
}
