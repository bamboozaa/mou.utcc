@extends('layouts.app')
@section('title', 'All Users')

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
        <div class="row">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-square"></i>
                    {{ __(' Create New Department') }}
                </a>
            </div>
        </div>

        <div class="card bg-white">
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center text-nowrap">{{ __('No.') }}</th>
                                <th scope="col" class="text-nowrap">{{ __('ชื่อผู้ใช้งาน') }}</th>
                                <th scope="col" class="text-nowrap">{{ __('หน่วยงาน') }}</th>
                                <th scope="col" class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $user->fullname }}</td>
                                        <td>
                                            @php
                                                $department = trim($user->department);
                                                $left_pos = strripos($department, '(') + 1;
                                                $department = substr($department, $left_pos, strlen($department));
                                                $department = substr($department, 0, strlen($department) - 1);
                                                $department = trim($department);
                                            @endphp
                                            {{ $department }}
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            {{-- <form action="{{ route('users.destroy', $user->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this department?')">Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="4">{{ __('ไม่พบข้อมูลที่ท่านต้องการค้นหาในขณะนี้') }}</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('footer')

    @include('footer')

@endsection
