@extends('admin.reports.layout')

@section('reports.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','reports']) }}"> Reports</a></li>
                <li class="breadcrumb-item">@lang('Create new')</li>
            </ol>
        </div>

        <div class="card-body">
            <form action="{{ route('reports.store', []) }}" method="POST" class="m-0 p-0">
                <div class="card-body">
                    @csrf
                    <div class="mb-3">
                        <label for="asset_id" class="form-label">Asset:</label>
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <select name="asset_id" id="asset_id" class="form-control form-select flex-grow-1" required>
                                <option value="">Select Asset</option>
                                @foreach($assets as $asset)
                                <option value="{{ $asset->id }}" {{ @old('asset_id') == $asset->id ? "selected" : "" }} tgl-perolehan="{{ $asset->tgl_perolehan }}" data-acquisition="{{ $asset->nilai_perolehan }}">{{ $asset->name }}</option>
                                @endforeach
                            </select>

                            <a class="btn btn-light text-nowrap" href="{{route('assets.create', compact([]))}}"><i class="fa fa-plus-circle"></i> New</a>
                        </div>
                        @if($errors->has('asset_id'))
                        <div class='error small text-danger'>{{$errors->first('asset_id')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_laporan" class="form-label">Tanggal Laporan:</label>
                        <input type="date" name="tanggal_laporan" id="tanggal_laporan" class="form-control" value="{{@old('tanggal_laporan')}}" required readonly/>
                        @if($errors->has('tanggal_laporan'))
                        <div class='error small text-danger'>{{$errors->first('tanggal_laporan')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nilai_perolehan" class="form-label">Nilai Perolehan:</label>
                        <input type="number" name="nilai_perolehan" id="nilai_perolehan" class="form-control" value="{{@old('nilai_perolehan')}}" required readonly/>
                        @if($errors->has('nilai_perolehan'))
                        <div class='error small text-danger'>{{$errors->first('nilai_perolehan')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="umur_aset" class="form-label">Umur Aset:</label>
                        <input type="number" name="umur_aset" id="umur_aset" class="form-control" value="{{@old('umur_aset')}}" required readonly/>
                        @if($errors->has('umur_aset'))
                        <div class='error small text-danger'>{{$errors->first('umur_aset')}}</div>
                        @endif

                        <p id="ket_umur_aset">keterangan Umur Aset</p>
                    </div>
                    <div class="mb-3">
                        <label for="penyusutan_per_tahun" class="form-label">Penyusutan Per Tahun:</label>
                        <input type="number" name="penyusutan_per_tahun" id="penyusutan_per_tahun" class="form-control" value="{{@old('penyusutan_per_tahun')}}" required readonly/>
                        @if($errors->has('penyusutan_per_tahun'))
                        <div class='error small text-danger'>{{$errors->first('penyusutan_per_tahun')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nilai_saat_ini" class="form-label">Nilai Saat Ini:</label>
                        <input type="number" name="nilai_saat_ini" id="nilai_saat_ini" class="form-control" value="{{@old('nilai_saat_ini')}}" required readonly/>
                        @if($errors->has('nilai_saat_ini'))
                        <div class='error small text-danger'>{{$errors->first('nilai_saat_ini')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan:</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" required>{{@old('keterangan')}}</textarea>
                        @if($errors->has('keterangan'))
                        <div class='error small text-danger'>{{$errors->first('keterangan')}}</div>
                        @endif
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('reports.index', []) }}" class="btn btn-light">@lang('Cancel')</a>
                        <button type="submit" class="btn btn-primary">@lang('Create new Report')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const assetDropdown = document.getElementById("asset_id");
        const umurAsetInput = document.getElementById("umur_aset");
        const reportDateInput = document.getElementById("tanggal_laporan");
        const ketUmurAsetElement = document.getElementById("ket_umur_aset");
        const acquisitionInput = document.getElementById("nilai_perolehan");
        const nilaiSaatIniInput = document.getElementById("nilai_saat_ini");
        const penyusutanPertahunInput = document.getElementById("penyusutan_per_tahun");

        // Constants for calculation
        const lifespanInYears = 5; // Lifespan of the asset in years

        assetDropdown.addEventListener("change", function() {
            // Get the selected option
            const selectedOption = assetDropdown.options[assetDropdown.selectedIndex];

            // ============mendapatkan data nilai perolehan============
            const acquisitionValue = selectedOption.getAttribute("data-acquisition");
            // Set values to the input fields
            acquisitionInput.value = acquisitionValue;

            // ============mendapatkan umur aset============
            const acquisitionDate = new Date(selectedOption.getAttribute("tgl-perolehan"));
            // Calculate the age of the asset in years, months, and days
            const ageInYears = (new Date() - acquisitionDate) / (1000 * 60 * 60 * 24 * 365);
            const ageInMonths = ageInYears * 12;
            const ageInDays = ageInYears * 365;

            // Set integer value for age in years on the umur aset input
            const umurAset = Math.floor(ageInYears);
            umurAsetInput.value = umurAset;
            // Set values to the Report Date input
            reportDateInput.value = acquisitionDate.toISOString().slice(0, 10); // Format date as yyyy-mm-dd

            // sett text p id ="ket_umur_aset"
            const years = ageInYears.toFixed(2);
            const months = Math.floor(years * 12);
            const days = Math.floor(years * 365);

            ketUmurAsetElement.textContent = `Umur aset: ${years} tahun setara dengan ${months} bulan atau ${days} hari.`;

            // ============menghitung penyusutan pertahun============
            // Calculate depreciation per year using straight-line method
            const depreciationPertahun = (selectedOption.getAttribute("data-acquisition") - 0) / lifespanInYears;
            penyusutanPertahunInput.value = depreciationPertahun.toFixed(2); // Round to 2 decimal places

            // ============mendapatkan nilai saat ini============
            const currentYearDepreciation = umurAset * depreciationPertahun;
            let currentValue = selectedOption.getAttribute("data-acquisition") - currentYearDepreciation;
            // If current value is negative, set it to 1
            if (currentValue < 0) {
                currentValue = 1;
            }
            nilaiSaatIniInput.value = currentValue.toFixed(2); // Round to 2 decimal places

        });
    });

    // sett tanggal laporan
    document.addEventListener("DOMContentLoaded", function() {
        const reportDateInput = document.getElementById("tanggal_laporan");
        const today = new Date();
        const formattedDate = formatDate(today);

        reportDateInput.value = formattedDate;
    });

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, "0");
        const day = String(date.getDate()).padStart(2, "0");
        return `${year}-${month}-${day}`;
    }
</script>
@endsection