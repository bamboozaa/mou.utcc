@extends('layouts.app')
@section('title', 'All MOU')

@section('importcss')
    @parent
    {{ Html::style('css/main2.css') }}

    <style>
    .btn-search {
        height: 100%;
        width: 100%;
        background: #4272d7;
        white-space: nowrap;
        border-radius: .5px;
        font-size: 20px;
        color: #fff;
        transition: all .2s ease-out, color .2s ease-out;
        border: 0;
        cursor: pointer;
    }
    </style>
@stop

@section('importjs')
    @parent

    <script type="module">
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif
    </script>

@stop

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">MOU</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ route('mous.create') }}" class="btn btn-primary"><i
                        class="bi bi-plus-square me-1"></i>{{ __('Create New') }}</a>
                {{-- <a href="{{ route('export.csv') }}" class="btn btn-primary"><i class="bi bi-filetype-csv me-1"></i>{{ __('Export to CSV') }}</a> --}}
            </div>
        </div>

        <div class="card bg-white">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <form method="POST" action="{{ route('mous.show_dep') }}" enctype="multipart/form-data">
                                @csrf
                                <section class="pb-4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                {!! Form::select(
                                                    'dep_id', $departments, null,
                                                    [
                                                        'class' => 'form-select border-0 mb-1 px-4 py-4 rounded shadow',
                                                        'placeholder' => '--- กรุณาเลือก หน่วยงานต้นเรื่อง ---',
                                                        'id' => 'dep_id',
                                                    ],
                                                ) !!}
                                            </div>
                                            <div class="col-lg-3 d-grid">
                                                <div class="card border-0">
                                                    <div class="card-body p-0">
                                                        <button class="btn-search border-0 mb-1 rounded shadow" type="submit">{{ __('ค้นหา') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                            <tr>
                                <th scope="col" class="text-center text-nowrap">เลขที่/ปี</th>
                                <th scope="col" class="text-nowrap">เรื่อง</th>
                                <th scope="col" class="text-nowrap">{{ __('หน่วยงานต้นเรื่อง') }}</th>
                                <th scope="col" class="text-nowrap">วันที่ประกาศ</th>
                                <th scope="col" class="text-nowrap">วันสิ้นสุด</th>
                                <th scope="col" class="text-nowrap text-center">Download</th>
                                @if (Auth::user()->role === 1)
                                    <th scope="col" class="text-nowrap text-center">Action</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($MOUs) > 0)
                                @foreach ($MOUs as $MOU)
                                    <tr>
                                        <td class="text-center">{{ $MOU->mou_no . '/' . $MOU->mou_year }}</td>
                                        <td>{{ $MOU->subject }}</td>
                                        <td class="text-nowrap">{{ $MOU->department_name['dep_name'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($MOU->start_date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($MOU->end_date)->format('d/m/Y') }}</td>
                                        <td class="text-center"><a href="{{ url('uploads/' . $MOU->file_path) }}"
                                                target="_blank"><i id="iconupload" class="bi bi-filetype-pdf"></i></a></td>
                                        @if (Auth::user()->role === 1)
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('mous.show', $MOU->mou_id) }}"
                                                    class="btn btn-info btn-sm">Info</a>
                                                <a href="{{ route('mous.edit', $MOU->mou_id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">ไม่พบข้อมูลที่ท่านต้องการค้นหาในขณะนี้</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div class="card bg-white my-3">
            <div class="card-body">
                <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control mb-3" name="file" accept=".csv">
                    <button type="submit" class="btn btn-primary">{{ __('Import CSV') }}</button>
                </form>
            </div>
        </div> --}}
    </div>

@endsection

@section('footer')

    @include('footer')

@endsection
