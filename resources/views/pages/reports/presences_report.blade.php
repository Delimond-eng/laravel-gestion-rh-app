@section('styles')
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css')}}">
@endsection


@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Rapports des presences</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Présences</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rapports</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title">
                            Rapports des présences des agents
                        </div>
                        <div class="d-flex align-items-center align-content-center ">
                            <h4 class="me-2 fs-10">Du</h4>
                            <input type="date" class="form-control form-control-sm">
                            <h4 class="mx-2 fs-10">Au</h4>
                            <input type="date" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive overflow-x-hidden">
                            <table class="table text-nowrap dt-responsive overflow-x-hidden" id="reports_table">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Post-nom</th>
                                        <th>Prénom</th>
                                        <th>Genre</th>
                                        <th>Téléphone</th>
                                        <th>Email</th>
                                        <th>Adresse</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr class="bg-blue-transparent">
                                            <td colspan="9" class="text-center font-weight-bold">Date: {{ $report['date'] }}</td>
                                        </tr>
                                        @foreach ($report['agents'] as $agent)
                                            <tr>
                                                <td>{{ $agent['agent_matricule'] }}</td>
                                                <td>{{ $agent['agent_nom'] }}</td>
                                                <td>{{ $agent['agent_postnom'] }}</td>
                                                <td>{{ $agent['agent_prenom'] }}</td>
                                                <td>{{ $agent['agent_genre'] }}</td>
                                                <td>{{ $agent['agent_telephone'] }}</td>
                                                <td>{{ $agent['agent_email'] }}</td>
                                                <td>{{ $agent['agent_adresse'] }}</td>
                                                <td>{{ $agent['status'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: row-1 -->
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/app/init_datatables.js')}}"></script>
@endsection
