@extends('layouts.app')
@section('title', 'Create New MOU')

@section('importcss')
    @parent
    {{ Html::style('css/main2.css') }}

@stop

@section('importjs')
    @parent

@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('mous') }}">MOU</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create MOU</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('mous') }}" class="btn btn-primary mb-2"><i class="bi bi-back"></i> Back</a>
            </div>
        </div>

        <div class="card bg-white">
            <div class="card-body">
                <form method="POST" action="{{ route('mous.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="my-3 row">
                        <div class="col-1"></div>
                        <label for="mou_no" class="col-2 col-form-label">เลขที่ :</label>
                        <div class="col-auto">
                            {!! Form::text('mou_no', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-auto">
                            <span class="form-text">
                                /
                            </span>
                        </div>
                        <div class="col-auto">
                            {!! Form::text('mou_year', $currentYear, ['class' => 'form-control', 'readonly']) !!}
                        </div>
                    </div>
                    <div class="my-3 row">
                        <div class="col-1"></div>
                        <label for="subject" class="col-2 col-form-label">ชื่อเรื่อง :</label>
                        <div class="col-8">
                            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row my-3">
                        <div class="col-1"></div>
                        <label for="ext_department" class="col-2 col-form-label text-nowrap">ชื่อหน่วยงาน MOU ภายนอก
                            :</label>
                        <div class="col-8">
                            {!! Form::text('ext_department', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row my-3">
                        <div class="col-1"></div>
                        <label for="departments" class="col-2 col-form-label">หน่วยงานต้นเรื่อง :</label>
                        <div class="col-auto">
                            {!! Form::select('dep_id', $departments, null, [
                                'class' => 'form-select',
                                'placeholder' => 'Please Select ...',
                            ]) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row my-3">
                        <div class="col-1"></div>
                        <label for="country" class="col-2 col-form-label">ประเทศ :</label>
                        <div class="col-auto">
                            {!! Form::select('ct_code', $countries, 'THA', [
                                'class' => 'form-select',
                                'placeholder' => 'Please Select ...',
                            ]) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row my-3">
                        <div class="col-1"></div>
                        <label for="start_date" class="col-2 col-form-label">วันเริ่มต้น :</label>
                        {{-- {!! Form::datetime-local('start_date', null, ['id' => 'start_date', 'class' => 'form-control my-3']) !!} --}}
                        <div class="col-3">
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <label for="end_date" class="col-2 col-form-label">วันสิ้นสุด :</label>
                        <div class="col-3">
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <div class="col-1"></div>
                    </div>

                    <div class="row my-3">
                        <div class="col-1"></div>
                        <label for="status" class="col-2 col-form-label">สถานะ :</label>
                        <div class="col-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                    value="1" checked>
                                <label class="form-check-label" for="inlineRadio1">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2"
                                    value="0">
                                <label class="form-check-label" for="inlineRadio2">Not Active</label>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>

                    <div class="row my-3">
                        <div class="col-1"></div>
                        <label for="file" class="col-2 col-form-label">เอกสารแนบ :</label>
                        <div class="col-8">
                            {!! Form::file('file', ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-3"></div>
                        <button type="submit" class="btn btn-primary col-2"><i class="bi bi-floppy"></i> บันทึก</button>
                        <div class="col-1"></div>
                        <!-- Reset Button -->
                        <button type="reset" class="btn btn-secondary col-2"><i class="bi bi-x-circle"></i>
                            Reset</button>
                        <div class="col-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
