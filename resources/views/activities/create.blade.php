@extends('layouts.app')
@section('title', 'Create New Activity')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}

@stop

@section('importjs')
    @parent

@stop

@section('content')
    {{-- @include('header') --}}

    <div class="container p-4">
        <div class="row">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('mous') }}">MOU</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Activity</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ URL::previous() }}" class="btn btn-primary mb-2"><i class="bi bi-back"></i> Back</a>
            </div>
        </div>

        <div class="card bg-white">
            <div class="card-header">{{ __('Create Department') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('activities.store') }}" enctype="multipart/form-data">
                    @csrf

                    @php
                        foreach ($_GET as $key => $value):
                            ${$key} = $value;
                        endforeach;
                    @endphp

                    <input type="hidden" value="{{ $mou_id }}" name="mou_id">

                    <div class="my-3 row">
                        <div class="col-1"></div>
                        <label for="activity_name" class="col-2 col-form-label">ชื่อกิจกรรม :</label>
                        <div class="col-8">
                            {!! Form::text('activity_name', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>

                    <div class="row my-3">
                        <div class="col-1"></div>
                        <label for="round" class="col-2 col-form-label">รอบที่บันทึกกิจกรรม :</label>
                        <div class="col-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="round" id="inlineRadio1"
                                    value="1"
                                    {{ \Carbon\Carbon::parse(now())->format('m') === 1 || 2 || 3 || 4 || 5 || 6 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">กิจกรรมระหว่างเดือน (ม.ค. - มิ.ย.) รอบที
                                    1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="round" id="inlineRadio2"
                                    value="2"
                                    {{ \Carbon\Carbon::parse(now())->format('m') === 7 || 8 || 9 || 10 || 11 || 12 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">กิจกรรมระหว่างเดือน (ก.ค. - ธ.ค.) รอบที
                                    2</label>
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
                        <button type="reset" class="btn btn-secondary col-2"><i class="bi bi-x-circle"></i> Reset</button>
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
