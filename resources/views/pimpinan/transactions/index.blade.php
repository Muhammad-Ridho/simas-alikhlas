@extends('pimpinan.transactions.layout')

@section('transactions.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','transactions']) }}"> Transactions</a></li>
            </ol>

            <form action="{{ route('transactions.index', []) }}" method="GET" class="m-0 p-0">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search Transactions..." value="{{ request()->search }}">
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> @lang('Go!')</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive table-hover">
                <thead role="rowgroup">
                    <tr role="row">
                        <th role='columnheader'>No</th>
                        <th role='columnheader'>Asset</th>
                        <th role='columnheader'>Tgl Transaksi</th>
                        <th role='columnheader'>Jns Transaksi</th>
                        <th role='columnheader'>Nilai Transaksi</th>
                        <th role='columnheader'>Keterangan</th>
                        <!-- <th scope="col" data-label="Actions">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach($transactions as $transaction)
                    <?php $no++; ?>
                    <tr>
                        <td data-label="No">{{ $no }}</td>
                        <td data-label="Asset"><a href="{{route('assets.show', $transaction->asset_id ?: 0)}}" class="text-dark">{{$transaction?->asset?->name ?: "(blank)"}}</a></td>
                        <td data-label="Tgl Transaksi">{{ $transaction->tgl_transaksi ?: "(blank)" }}</td>
                        <td data-label="Jns Transaksi">{{ $transaction->jns_transaksi ?: "(blank)" }}</td>
                        <td data-label="Nilai Transaksi">Rp. {{ number_format($transaction->nilai_transaksi, 0, ',', '.') }}</td>
                        <td data-label="Keterangan">{{ Str::limit($transaction->keterangan, 50) ?: "(blank)"}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $transactions->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection