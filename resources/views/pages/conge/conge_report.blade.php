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
                            Rapport des congés
                        </div>
                        <div class="prism-toggle">
                            <a href="{{url('/conge.attribution')}}" class="btn btn-sm btn-primary" type="button"><i class="ri-add-line me-2"></i>Attribution congé</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive overflow-x-hidden">
                            <table class="table text-nowrap dt-responsive overflow-x-hidden" id="conge_table">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Date création</th>
                                        <th scope="col">Agent concerné</th>
                                        <th scope="col">Date début</th>
                                        <th scope="col">Date Fin</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Nombre jours</th>
                                        <th scope="col">Jrs consommés</th>
                                        <th scope="col">Jrs restant</th>
                                        <th scope="col">Créé par</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($conges as $item)
                                    <tr>
                                        <th scope="row">{{$item->conge_date_creation->format('d/m/Y H:i')}}</th>
                                        <th>{{$item->agent->agent_matricule. ' | '.$item->agent->agent_nom.' '.$item->agent->agent_postnom.'  '.$item->agent->agent_prenom}}</th>
                                        <td>{{$item->conge_date_debut->format('d/m/Y')}}</td>
                                        <td>{{$item->conge_date_fin->format('d/m/Y')}}</td>
                                        <td>{{$item->type->conge_type_libelle}}</td>
                                        <td>{{$item->nb_jours}}</td>
                                        <td>{{$item->jours_consommes}}</td>
                                        <td>{{$item->jours_restants}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ url('/delete/conges/'.$item->id) }}"
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

