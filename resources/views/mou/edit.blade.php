@extends('layouts.app')
@section('title', 'Edit MOU')

@section('importcss')
    @parent
    {{ Html::style('css/main2.css') }}
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('mous') }}">MOU</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit MOU</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ URL::previous() }}" class="btn btn-primary"><i class="bi bi-back"></i> Back</a>
            </div>
        </div>

        <form method="POST" action="{{ route('mous.update', $MOU->mou_id) }}">
            @csrf
            @method('PATCH')

            <div class="my-3 row">
                <div class="col-1"></div>
                <label for="mou_no" class="col-2 col-form-label">เลขที่ :</label>
                <div class="col-auto">
                    {!! Form::text('mou_no', $MOU->mou_no, ['class' => 'form-control']) !!}
                </div>
                <div class="col-auto">
                    <span class="form-text">
                        /
                    </span>
                </div>
                <div class="col-auto">
                    {!! Form::text('mou_year', $MOU->mou_year, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="my-3 row">
                <div class="col-1"></div>
                <label for="subject" class="col-2 col-form-label">ชื่อเรื่อง :</label>
                <div class="col-8">
                    {!! Form::text('subject', $MOU->subject, ['class' => 'form-control']) !!}
                </div>
                <div class="col-1"></div>
            </div>

            <div class="row my-3">
                <div class="col-1"></div>
                <label for="ext_department" class="col-2 col-form-label text-nowrap">ชื่อหน่วยงาน MOU ภายนอก :</label>
                <div class="col-8">
                    {!! Form::text('ext_department', $MOU->ext_department, ['class' => 'form-control']) !!}
                </div>
                <div class="col-1"></div>
            </div>

            <div class="row my-3">
                <div class="col-1"></div>
                <label for="departments" class="col-2 col-form-label">หน่วยงานต้นเรื่อง :</label>
                <div class="col-auto">
                    {!! Form::select('dep_id', $departments, $MOU->dep_id, [
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
                    {!! Form::select('ct_code', $countries, $MOU->country, [
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
                    <input type="date" class="form-control" name="start_date" value="{{ $MOU->start_date }}">
                </div>
                <label for="end_date" class="col-2 col-form-label">วันสิ้นสุด :</label>
                <div class="col-3">
                    <input type="date" class="form-control" name="end_date" value="{{ $MOU->end_date }}">
                </div>
                <div class="col-1"></div>
            </div>

            <div class="row my-3">
                <div class="col-1"></div>
                <label for="status" class="col-2 col-form-label">สถานะ :</label>
                <div class="col-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" {{ $MOU->status === 1 ? "checked" : "" }} type="radio" name="status" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" {{ $MOU->status === 0 ? "checked" : "" }} type="radio" name="status" id="inlineRadio2" value="0">
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
                    <label class="form-control-label" for="labelfileupload">{{ $MOU->file_path }}</label>
                </div>
                <div class="col-1"></div>
            </div>

            <div class="row">
                <div class="col-5"></div>
                <button type="submit" class="btn btn-success col-2"><i class="bi bi-arrow-up-circle"></i> Update</button>
                <div class="col-5"></div>
            </div>

        </form>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
