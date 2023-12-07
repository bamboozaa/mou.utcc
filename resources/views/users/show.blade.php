@extends('layouts.app')
@section('title', 'Show User')

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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{ url('users') }}">Users</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
                <div class="card bg-white">
                    <div class="card-header"><i class="bi bi-person-badge fs-5"></i>{{ __(' User Profile') }}</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-end">{{ __('ชื่อ สกุล :') }}</th>
                                <td>{{ old('name', $user->fullname) }}</td>
                            </tr>
                            <tr>
                                <th class="text-end">{{ __('หน่วยงาน :') }}</th>

                                <td>
                                    @php
                                        $department = trim(old('name', $user->department));
                                        $left_pos = strripos($department, '(') + 1;
                                        $department = substr($department, $left_pos, strlen($department));
                                        $department = substr($department, 0, strlen($department) - 1);
                                        $department = trim($department);
                                    @endphp
                                    {{ $department }}
                                </td>
                            <tr>
                                <th class="text-end">{{ __('อีเมล์ :') }}</th>
                                <td>{{ old('name', $user->email) }}</td>

                            </tr>
                            <tr>
                                <th class="text-end">{{ __('สิทธิ์ผู้ใช้งานระบบ :') }}</th>
                                <td>
                                    @if (old('name', $user->role === 0))
                                        {{ __('ผู้ใช้งานระบบ') }}
                                    @elseif (old('name', $user->role === 1))
                                        {{ __('ผู้ดูแลระบบ') }}
                                    @endif
                                </td>
                            </tr>
                            </tr>
                        </table>

                        {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
