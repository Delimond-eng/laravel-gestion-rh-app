@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css')}}">
@endsection

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
                        <!--<div class="input-group w-50">
                            <input type="text" class="form-control form-control-sm" placeholder="Recherche agents...">
                        </div>-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap" id="agent_table">
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
    <script src="{{asset('https://code.jquery.com/jquery-3.6.1.min.js')}}" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- DATATABLES CDN JS -->
    <script src="{{asset('https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js')}}"></script>

    <script src="{{asset('assets/js/app/init_datatables.js')}}"></script>
@endsection

