@extends('layouts.app')
@section('title', 'Show MOU')

@section('importcss')
    @parent
    {{ Html::style('css/main2.css') }}
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
        <div class="row">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('mous') }}">MOU</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Show MOU</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('mous') }}" class="btn btn-primary"><i class="bi bi-back"></i> Back</a>
            </div>
        </div>

        <div class="row my-3">
            <div class="table-responsivd">
                <table class="table">
                    <tr>
                        <td style="background-color: #f3f3f3; width: 1%;" class="text-nowrap">เลขที่</td>
                        <td>{{ $MOU->mou_no . '/' . $MOU->mou_year }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f3f3f3; width: 1%;" class="text-nowrap">เรื่อง</td>
                        <td>{{ $MOU->subject }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f3f3f3; width: 1%;" class="text-nowrap">ชื่อหน่วยงาน MOU ภายนอก</td>
                        <td>{{ $MOU->ext_department }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f3f3f3; width: 1%;" class="text-nowrap">หน่วยงานต้นเรื่อง</td>
                        <td>{{ $MOU->department_name['dep_name'] }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f3f3f3; width: 1%;" class="text-nowrap">วันเริ่มต้น</td>
                        <td>{{ \Carbon\Carbon::parse($MOU->start_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f3f3f3; width: 1%;" class="text-nowrap">วันสิ้นสุด</td>
                        <td>{{ \Carbon\Carbon::parse($MOU->end_date)->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-9">
                <h2>กิจกรรม MOU</h2>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ route('activities.create', ['mou_id' => $MOU->mou_id]) }}" class="btn btn-primary mb-2"><i
                        class="bi bi-floppy"></i> บันทึกกิจกรรม</a>
            </div>
        </div>
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ \Carbon\Carbon::parse(now())->format('m') == 1 >= 6 ? 'active' : '' }}"
                        id="activity1-tab" data-bs-toggle="tab" data-bs-target="#activity1" type="button" role="tab"
                        aria-controls="activity1" aria-selected="true">รายงานกิจกรรม รอบที่ 1 (ไตรมาส ที่ 1 - 2)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ \Carbon\Carbon::parse(now())->format('m') == 7 <= 12 ? 'active' : '' }}"
                        id="activity2-tab" data-bs-toggle="tab" data-bs-target="#activity2" type="button" role="tab"
                        aria-controls="activity2" aria-selected="false">รายงานกิจกรรม รอบที่ 2 (ไตรมาส ที่ 3 - 4)</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ \Carbon\Carbon::parse(now())->format('m') == 1 >= 6 ? 'show active' : '' }}"
                    id="activity1" role="tabpanel" aria-labelledby="activity1-tab">

                    <div class="row">
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-nowrap">No.</th>
                                        <th scope="col" class="text-nowrap">รายงานกิจกรรม</th>
                                        <th scope="col" class="text-nowrap">วันที่บันทึก</th>
                                        <th scope="col" class="text-nowrap">เอกสารแนบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($activities1) > 0)
                                        @foreach ($activities1 as $key => $activity1)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $activity1->activity_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($activity1->created_at)->format('d/m/Y') }}
                                                </td>
                                                <td><a href="{{ url('uploads/activities/' . $activity1->file_path) }}"
                                                        target="_blank"><i id="iconupload"
                                                            class="bi bi-filetype-pdf"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">ไม่พบข้อมูลที่ท่านต้องการค้นหาในขณะนี้</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade {{ \Carbon\Carbon::parse(now())->format('m') == 7 <= 12 ? 'show active' : '' }}"
                    id="activity2" role="tabpanel" aria-labelledby="activity2-tab">

                    <div class="row">
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-nowrap">No.</th>
                                        <th scope="col" class="text-nowrap">ชื่อกิจกรรม</th>
                                        <th scope="col" class="text-nowrap">วันที่บันทึก</th>
                                        <th scope="col" class="text-nowrap">เอกสารแนบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($activities2) > 0)
                                        @foreach ($activities2 as $key => $activity2)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $activity2->activity_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($activity2->created_at)->format('d/m/Y') }}
                                                </td>
                                                <td><a href="{{ url('uploads/activities/' . $activity2->file_path) }}"
                                                        target="_blank"><i id="iconupload"
                                                            class="bi bi-filetype-pdf"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">ไม่พบข้อมูลที่ท่านต้องการค้นหาในขณะนี้</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
