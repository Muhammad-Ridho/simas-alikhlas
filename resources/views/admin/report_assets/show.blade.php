@extends('admin.report_assets.layout')

@section('reportAssets.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','report_assets']) }}"> Report Assets</a></li>
                <li class="breadcrumb-item">@lang('Report Asset') #{{$reportAsset->id}}</li>
            </ol>

            <a href="{{ route('report_assets.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">ID:</th>
                        <td>{{$reportAsset->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Name:</th>
                        <td>{{ $reportAsset->name ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Asset:</th>
                        <td><a href="{{route('assets.show', $reportAsset->asset_id ?: 0)}}" class="text-dark">{{$reportAsset?->asset?->name ?: "(blank)"}}</a></td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Laporan:</th>
                        <td>{{ $reportAsset->tanggal_laporan ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nilai Perolehan:</th>
                        <td>{{ $reportAsset->nilai_perolehan ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Umur Aset:</th>
                        <td>{{ $reportAsset->umur_aset ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Penyusutan Per Tahun:</th>
                        <td>{{ $reportAsset->penyusutan_per_tahun ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nilai Saat Ini:</th>
                        <td>{{ $reportAsset->nilai_saat_ini ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Created at</th>
                        <td>{{Carbon\Carbon::parse($reportAsset->created_at)->format('d/m/Y H:i:s')}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Updated at</th>
                        <td>{{Carbon\Carbon::parse($reportAsset->updated_at)->format('d/m/Y H:i:s')}}</td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
            <a href="{{ route('report_assets.edit', compact('reportAsset')) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
            <form action="{{ route('report_assets.destroy', compact('reportAsset')) }}" method="POST" class="m-0 p-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
            </form>
        </div>
    </div>
</div>
@endsection