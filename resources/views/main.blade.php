@extends('layouts.app')
@section('title', 'Home MOU')

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
        <div class="p-5 mb-4 rounded-3 page-header">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Custom jumbotron</h1>
                <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in
                    previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your
                    liking.</p>
                {{-- <button class="btn btn-primary btn-lg" type="button">Example button</button> --}}
            </div>
        </div>
    </div>

@endsection

@section('footer')

    @include('footer')

@endsection
