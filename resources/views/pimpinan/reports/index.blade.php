@extends('pimpinan.reports.layout')

@section('reports.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','reports']) }}"> Reports</a></li>
            </ol>

            <form action="{{ route('reports.index', []) }}" method="GET" class="m-0 p-0">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search Reports..." value="{{ request()->search }}">
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
                        <th role='columnheader'>Tanggal Laporan</th>
                        <th role='columnheader'>Nilai Perolehan</th>
                        <th role='columnheader'>Umur Aset</th>
                        <th role='columnheader'>Penyusutan Per Tahun</th>
                        <th role='columnheader'>Nilai Saat Ini</th>
                        <th role='columnheader'>Keterangan</th>
                        <!-- <th scope="col" data-label="Actions">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach($reports as $report)
                    <?php $no++; ?>
                    <tr>
                        <td data-label="No">{{ $no }}</td>
                        <td data-label="Asset"><a href="{{route('assets.show', $report->asset_id ?: 0)}}" class="text-dark">{{$report?->asset?->name ?: "(blank)"}}</a></td>
                        <td data-label="Tanggal Laporan">{{ $report->tanggal_laporan ?: "(blank)" }}</td>
                        <td data-label="Nilai Perolehan">Rp. {{ number_format($report->nilai_perolehan, 0, ',', '.') }}</td>
                        <td data-label="Umur Aset">{{ $report->umur_aset ?: "(blank)" }}</td>
                        <td data-label="Penyusutan Per Tahun">Rp. {{ number_format($report->penyusutan_per_tahun, 0, ',', '.') }}</td>
                        <td data-label="Nilai Saat Ini">Rp. {{ number_format($report->nilai_saat_ini, 0, ',', '.') }}</td>
                        <td data-label="Keterangan">{{ Str::limit($report->keterangan, 50) ?: "(blank)"}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $reports->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection