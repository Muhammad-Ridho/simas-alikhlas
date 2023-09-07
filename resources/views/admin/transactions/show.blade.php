@extends('admin.transactions.layout')

@section('transactions.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','transactions']) }}"> Transactions</a></li>
                <li class="breadcrumb-item">@lang('Transaction') #{{$transaction->id}}</li>
            </ol>

            <a href="{{ route('transactions.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">ID:</th>
                        <td>{{$transaction->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Asset:</th>
                        <td><a href="{{route('assets.show', $transaction->asset_id ?: 0)}}" class="text-dark">{{$transaction?->asset?->name ?: "(blank)"}}</a></td>
                    </tr>
                    <tr>
                        <th scope="row">Tgl Transaksi:</th>
                        <td>{{ $transaction->tgl_transaksi ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jns Transaksi:</th>
                        <td>{{ $transaction->jns_transaksi ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nilai Transaksi:</th>
                        <td>{{ $transaction->nilai_transaksi ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Keterangan:</th>
                        <td>{{ Str::limit($transaction->keterangan, 50) ?: "(blank)"}}</td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
            <a href="{{ route('transactions.edit', compact('transaction')) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
            <form action="{{ route('transactions.destroy', compact('transaction')) }}" method="POST" class="m-0 p-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
            </form>
        </div>
    </div>
</div>
@endsection