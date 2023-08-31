@extends('admin.departments.layout')

@section('department.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <div class="text-center my-2 m-2">
                <a href="{{ route('departments.create', []) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('Tambah Data')</a>
            </div>
            <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','departments']) }}"> Department</a></li>
            </ol>

            <form action="{{ route('departments.index', []) }}" method="GET" class="m-0 p-0">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search Department..." value="{{ request()->search }}">
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
                        <th scope="col" data-label="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach($departments as $department)
                    <?php $no++; ?>

                    <tr>
                        <td data-label="Name">{{ $no }}</td>
                        <td data-label="Name">{{ $department->name ?: "(blank)" }}</td>

                        <td data-label="Actions:" class="text-nowrap">
                            <a href="{{route('departments.show', compact('department'))}}" type="button" class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('departments.edit', compact('department'))}}">@lang('Edit')</a></li>
                                    <li>
                                        <form action="{{route('departments.destroy', compact('department'))}}" method="POST" style="display: inline;" class="m-0 p-0">
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

            {{ $departments->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection