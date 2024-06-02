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
            <h1 class="page-title fw-semibold fs-18 mb-0">Liste des agents</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Agents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste</li>
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
                            Liste des agents
                        </div>
                        <div class="prism-toggle">
                            <a href="/agents.create" class="btn btn-sm btn-primary" type="button"><i class="ri-add-line me-2"></i>Création agent</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive overflow-x-hidden">
                            <table class="table text-nowrap dt-responsive overflow-x-hidden" id="agent_table">
                                <thead class="table-primary">
                                <tr>
                                    <th scope="col">Matricule</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Postnom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Province</th>
                                    <th scope="col">Ministère</th>
                                    <th scope="col">Secrétariat</th>
                                    <th scope="col">Direction</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">Bureau</th>
                                    <th scope="col">Fonction</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($agents as $agent)
                                    <tr>
                                        <th scope="row">{{$agent->agent_matricule}}</th>
                                        <td>{{$agent->agent_nom}}</td>
                                        <td>{{$agent->agent_postnom}}</td>
                                        <td>{{$agent->agent_prenom}}</td>
                                        <td>{{$agent->agent_genre}}</td>
                                        <td>{{$agent->agent_telephone}}</td>
                                        <td>{{$agent->agent_email}}</td>
                                        <td>{{$agent->province->province_libelle}}</td>
                                        <td>{{$agent->ministere->ministere_libelle}}</td>
                                        <td>{{$agent->secretariat->secretariat_libelle}}</td>
                                        <td>{{$agent->direction->direction_libelle}}</td>
                                        <td>{{$agent->division->division_libelle}}</td>
                                        <td>{{$agent->bureau->bureau_libelle}}</td>
                                        <td>{{$agent->fonction->fonction_libelle}}</td>
                                        <td>{{$agent->grade->grade_libelle}}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">

                                                <a href="javascript:void(0);"
                                                   class="btn btn-icon btn-sm btn-info rounded-pill"><i
                                                        class="ri-edit-line"></i></a>
                                                <a href="{{ url('/agent.delete/'.$agent->id) }}"
                                                   class="btn btn-icon btn-sm btn-danger rounded-pill"><i
                                                        class="ri-delete-bin-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
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

