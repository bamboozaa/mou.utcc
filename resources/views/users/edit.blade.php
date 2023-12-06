@extends('layouts.app')
@section('title', 'Edit User')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop

@section('content')

    <div class="container">
        <div class="row mb-3">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('users') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('users') }}" class="btn btn-primary"><i class="bi bi-back"></i> Back</a>
            </div>
        </div>

        <div class="card bg-white">
            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="my-3 row">
                        <div class="col-1"></div>
                        <label for="name" class="col-2 col-form-label">{{ __('ชื่อ - นามสกุล :') }}</label>
                        <div class="col-8">
                            {!! Form::text('fullname', old('name', $user->fullname), ['class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>

                    <div class="my-3 row">
                        <div class="col-1"></div>
                        <label for="department" class="col-2 col-form-label">{{ __('ชื่อหน่วยงาน :') }}</label>
                        <div class="col-8">
                            @php
                                $department = trim(old('name', $user->department));
                                $left_pos = strripos($department, '(') + 1;
                                $department = substr($department, $left_pos, strlen($department));
                                $department = substr($department, 0, strlen($department) - 1);
                                $department = trim($department);
                            @endphp
                            {!! Form::text('department', $department, ['class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>

                    <div class="row my-3">
                        <div class="col-1"></div>
                        {!! Form::label('role', 'สิทธิ์การใช้งาน', ['class' => 'col-2 col-form-label text-nowrap']) !!}
                        {{-- <label for="ext_department" class="col-2 col-form-label text-nowrap">ชื่อหน่วยงาน MOU ภายนอก :</label> --}}
                        <div class="col-auto">
                            {!! Form::select('role', [0 => 'ผู้ใช้งาน', 1 => 'ผู้ดูแลระบบ'], old('name', $user->role), ['class' => 'form-select']) !!}
                        </div>
                        <div class="col-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-5"></div>
                        <button type="submit" class="btn btn-success col-2"><i class="bi bi-arrow-up-circle"></i>
                            Update</button>
                        <div class="col-5"></div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
