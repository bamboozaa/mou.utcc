@extends('layouts.app2')
@section('title', 'MOU')

@section('importcss')
    @parent
    {{ Html::style('css/main3.css') }}
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
    <div class="page-wrapper bg-img-1 p-t-165 p-b-100">
        <div class="wrapper wrapper--w720">
            <div class="card card-3">
                <div class="card-body">
                    {{-- <form action="{{ route('search') }}" method="post"> --}}
                    {!! Form::open(['route' => 'search', 'method' => 'GET']) !!}
                        {{-- @csrf --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="subject" placeholder="ชื่อเรื่อง" name="subject">
                            <label for="subject" class="label"><span class="label2">ชื่อเรื่อง</span></label>
                        </div>
                        <div class="row2 row-space mb-3">
                            <div class="col-21">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="start_date" placeholder="mm/dd/yyyy"
                                        name="start_date">
                                    <label for="start_date" class="label"><span class="label2">วันที่</span></label>
                                </div>
                            </div>
                            <div class="col-21">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="input-end" placeholder="mm/dd/yyyy"
                                        name="end_date">
                                    <label for="input-end" class="label"><span class="label2">ถึง</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row2 row-space mb-3">
                            <div class="col-21">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="mou_no" placeholder="เลขที่" name="mou_no">
                                    <label for="mou_no" class="label"><span class="label2">เลขที่</span></label>
                                </div>
                            </div>
                            <div class="col-21">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="mou_year" placeholder="ปี" name="mou_year">
                                    <label for="mou_year" class="label"><span class="label2">ปี</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            {!! Form::select('dep_id', $departments, null, [
                                'class' => 'form-select',
                                'id' => 'sel1',
                                'placeholder' => 'Please Select ...',
                            ]) !!}
                            <label for="sel1" class="label"><span class="label2">หน่วยงานที่ออก</span></label>
                        </div>

                        <button class="btn btn-lg btn-success waves-effect" type="submit">
                            <i class="bi bi-binoculars me-2"></i>
                            ค้นหา
                        </button>
                        <button type="reset" class="btn btn-lg btn-danger waves-effect">
                            <i class="bi bi-x-circle me-2"></i>
                            Reset
                        </button>
                    {{-- </form> --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
