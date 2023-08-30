@extends('admin.report_assets.layout')

@section('reportAssets.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','report_assets']) }}"> Report Assets</a></li>
            </ol>

            <form action="{{ route('report_assets.index', []) }}" method="GET" class="m-0 p-0">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search Report Assets..." value="{{ request()->search }}">
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
                        <th role='columnheader'>Name</th>
                        <th role='columnheader'>Asset</th>
                        <th role='columnheader'>Tanggal Laporan</th>
                        <th role='columnheader'>Nilai Perolehan</th>
                        <th role='columnheader'>Umur Aset</th>
                        <th role='columnheader'>Penyusutan Per Tahun</th>
                        <th role='columnheader'>Nilai Saat Ini</th>
                        <th scope="col" data-label="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach($reportAssets as $reportAsset)
                    <?php $no++; ?>
                    <tr>
                        <td data-label="No">{{ $no }}</td>
                        <td data-label="Name">{{ $reportAsset->name ?: "(blank)" }}</td>
                        <td data-label="Asset"><a href="{{route('assets.show', $reportAsset->asset_id ?: 0)}}" class="text-dark">{{$reportAsset?->asset?->name ?: "(blank)"}}</a></td>
                        <td data-label="Tanggal Laporan">{{ $reportAsset->tanggal_laporan ?: "(blank)" }}</td>
                        <td data-label="Nilai Perolehan">{{ $reportAsset->nilai_perolehan ?: "(blank)" }}</td>
                        <td data-label="Umur Aset">{{ $reportAsset->umur_aset ?: "(blank)" }}</td>
                        <td data-label="Penyusutan Per Tahun">{{ $reportAsset->penyusutan_per_tahun ?: "(blank)" }}</td>
                        <td data-label="Nilai Saat Ini">{{ $reportAsset->nilai_saat_ini ?: "(blank)" }}</td>

                        <td data-label="Actions:" class="text-nowrap">
                            <a href="{{route('report_assets.show', compact('reportAsset'))}}" type="button" class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('report_assets.edit', compact('reportAsset'))}}">@lang('Edit')</a></li>
                                    <li>
                                        <form action="{{route('report_assets.destroy', compact('reportAsset'))}}" method="POST" style="display: inline;" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">@lang('Delete')</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $reportAssets->withQueryString()->links() }}
        </div>
        <div class="text-center my-2">
            <a href="{{ route('report_assets.create', []) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('Create new Report Asset')</a>
        </div>
    </div>
</div>
@endsection