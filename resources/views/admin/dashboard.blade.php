@extends('layouts.navbar')

@section('title', 'Dashboard Prosera')

@section('breadcrumb', 'Dashboard')

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

            </div>

        </div>

    </div>


@endsection

@section('javascript')
    <script src="/js/pages/dashboard.js"></script>
    {{-- Chart  --}}
    {{-- <script type="text/javascript" src="/assets/js/plugins/visualization/echarts/echarts.js"></script> --}}
    {{-- <script type="text/javascript" src="/assets/js/plugins/visualization/echarts/chart/line.js"></script> --}}
    <script type="text/javascript" src="assets/js/plugins/visualization/c3/c3.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
@endsection
