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
                    <td>{{ $mou->mou_no . '/' . $mou->mou_year }}</td>
                    <td>{{ $mou->subject }}</td>
                    <td class="text-nowrap">{{ $mou->start_date }}</td>
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
