@extends('layouts.app3')
@section('title', 'MOU')

@section('importcss')
    @parent
    {{-- {{ Html::style('css/main3.css') }} --}}
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
{{-- {{ dd($data) }} --}}

    <div class="container">
        <div class="row mb-3">
            <div class="col-md-9">

            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="bi bi-arrow-left-circle me-2"></i>Back</a>
            </div>
        </div>
        <table id="example" class="table table-striped table-hover table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th>เลขที่</th>
                    <th>เรื่อง</th>
                    <th>วันที่</th>
                    <th>หน่วยงาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $mou)
                <tr>
                    <td><a href="{{ url('uploads/' . $mou->file_path) }}" target="_blank">{{ $mou->mou_no . '/' . $mou->mou_year }}</a></td>
                    <td>{{ $mou->subject }}</td>
                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($mou->start_date)->format('d/m/Y') }}</td>
                    <td class="text-nowrap">{{ $mou->department_name['dep_name'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- {{ $data->appends(request()->except('page'))->links() }} --}}
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
