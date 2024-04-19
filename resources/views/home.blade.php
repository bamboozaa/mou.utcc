@extends('layouts.app')
@section('title', 'MOU Dashboard')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
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
    @php
        $department = trim(Auth::user()->department);
        $left_pos = strripos($department, '(') + 1;
        $department = substr($department, $left_pos, strlen($department));
        $department = substr($department, 0, strlen($department) - 1);
        $department = trim($department);
        $dep = App\Models\Department::where('dep_name', $department)->get();
        $MOUs = App\Models\MOU::where('dep_id', '=', $dep[0]['dep_id'])->get();
    @endphp
    <div class="container">
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col">

                    <!-- Pretitle -->
                    <h6 class="header-pretitle">
                        Overview
                    </h6>

                    <!-- Title -->
                    <h1 class="header-title">
                        <i class="bi bi-speedometer2"></i>{{ __(' Dashboard') }}
                    </h1>

                </div>
                {{-- <div class="col-auto">

                    <!-- Button -->
                    <a href="#!" class="btn btn-primary lift">
                        Create Report
                    </a>

                </div> --}}
            </div> <!-- / .row -->
        </div>
        <div class="row justify-content-center my-4">
            <div class="col-12 col-lg-6 col-xl">

                <!-- Value  -->
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="row align-items-center gx-0">
                            <div class="col">

                                <!-- Title -->
                                <h6 class="text-uppercase text-body-secondary mb-2">
                                    {{ __('Total MOU') }}
                                </h6>

                                <!-- Heading -->
                                <span class="h2 mb-0">
                                    {{ count($MOUs) }}
                                </span>

                                <!-- Badge -->
                                {{-- <span class="badge text-bg-success-subtle mt-n1">
                                    +3.5%
                                </span> --}}
                            </div>
                            <div class="col-auto">

                                <!-- Icon -->
                                <i class="fs-4 bi bi-handbag text-body-secondary mb-0"></i>
                                {{-- <span class="h2 fe fe-dollar-sign text-body-secondary mb-0"></span> --}}

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

                <!-- Hours -->
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="row align-items-center gx-0">
                            <div class="col">

                                <!-- Title -->
                                <h6 class="text-uppercase text-body-secondary mb-2">
                                    Total hours
                                </h6>

                                <!-- Heading -->
                                <span class="h2 mb-0">
                                    763.5
                                </span>

                            </div>
                            <div class="col-auto">

                                <!-- Icon -->
                                <i class="fs-4 bi bi-briefcase text-body-secondary mb-0"></i>
                                {{-- <span class="h2 fe fe-briefcase text-body-secondary mb-0"></span> --}}

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

                <!-- Exit -->
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="row align-items-center gx-0">
                            <div class="col">

                                <!-- Title -->
                                <h6 class="text-uppercase text-body-secondary mb-2">
                                    Exit %
                                </h6>

                                <!-- Heading -->
                                <span class="h2 mb-0">
                                    35.5%
                                </span>

                            </div>
                            <div class="col-auto">

                                <!-- Chart -->
                                <div class="chart chart-sparkline">
                                    <canvas class="chart-canvas" id="sparklineChart" width="75" height="35"
                                        style="display: block; box-sizing: border-box; height: 35px; width: 75px;"></canvas>
                                </div>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

                <!-- Time -->
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="row align-items-center gx-0">
                            <div class="col">

                                <!-- Title -->
                                <h6 class="text-uppercase text-body-secondary mb-2">
                                    Avg. Time
                                </h6>

                                <!-- Heading -->
                                <span class="h2 mb-0">
                                    2:37
                                </span>

                            </div>
                            <div class="col-auto">

                                <!-- Icon -->
                                <i class="fs-4 bi bi-bell text-body-secondary mb-0"></i>
                                {{-- <span class="h2 fe fe-clock text-body-secondary mb-0"></span> --}}

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

            </div>
        </div>
        {{-- <hr>
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col">
                    <h1 class="header-title">
                        <i class="bi bi-list"></i>{{ __(' รายการ MOU') }}
                    </h1>

                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center text-nowrap">เลขที่/ปี</th>
                                        <th scope="col" class="text-nowrap">เรื่อง</th>
                                        <th scope="col" class="text-nowrap">หน่วยงานต้นเรื่อง</th>
                                        <th scope="col" class="text-nowrap">วันที่ประกาศ</th>
                                        <th scope="col" class="text-nowrap">วันสิ้นสุด</th>
                                        <th scope="col" class="text-nowrap text-center">Download</th>
                                        <th scope="col" class="text-nowrap text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($MOUs) > 0)
                                        @foreach ($MOUs as $MOU)
                                            <tr>
                                                <td class="text-center">{{ $MOU->mou_no . '/' . $MOU->mou_year }}</td>
                                                <td>{{ $MOU->subject }}</td>
                                                <td>{{ $MOU->department_name['dep_name'] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($MOU->start_date)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($MOU->end_date)->format('d/m/Y') }}</td>
                                                <td class="text-center"><a href="{{ url('uploads/' . $MOU->file_path) }}"
                                                        target="_blank"><i id="iconupload"
                                                            class="bi bi-filetype-pdf"></i></a>
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    <a href="{{ route('mous.show', $MOU->mou_id) }}"
                                                        class="btn btn-info btn-sm">{{ __('บันทึกกิจกรรม') }}</a>
                                                </td>
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
            </div>
        </div> --}}
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
