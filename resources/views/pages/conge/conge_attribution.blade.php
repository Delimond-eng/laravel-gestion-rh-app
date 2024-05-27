@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/select2/css/select2.min.css')}}">
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Attribution congé</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Congé</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Attribution</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start:: row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <form id="agent-form" method="POST" action="{{route('conge.attribution.create')}}" class="card custom-card">
                @csrf
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Veuillez saisir les infos requises pour attribuer un congé
                    </div>
                    <div class="prism-toggle">
                        <a href="{{url('/conge.reports')}}" class="btn btn-sm btn-primary-light" type="button">Voir les rapports de congé<i class="ri-arrow-drop-right-line ms-2 d-inline-block align-middle"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('message'))
                    <div class="alert alert-secondary alert-dismissible fade show custom-alert-icon shadow-sm auto-dismiss-alert" role="alert">
                        <svg class="svg-secondary" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>
                        {{session('message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
                    </div>
                    @endif
                    <div class="row g-2">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            <label for="start_at" class="form-label">Date du debut <sup class="text-danger">*</sup> </label>
                            <input type="date" name="date_debut" class="form-control" id="start_at"  required>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            <label for="nb_days" class="form-label">Nombre des jours <sup class="text-danger">*</sup></label>
                            <input type="number" name="nb_jours" class="form-control" id="nb_days" placeholder="Entrez le nombre de jours"  required>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <label for="type" class="form-label">Type de congé<sup class="text-danger">*</sup></label>
                            <select class="form-select" name="type_id" id="type" required>
                                <option hidden selected>Sélectionnez un type de congé...</option>
                                @foreach($types as $data)
                                    <option value="{{$data->id}}">{{$data->conge_type_libelle}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="agentId" class="form-label">Agent concerné<sup class="text-danger">*</sup></label>
                            <select name="agent_id" class="form-select form-select-lg" id="agentId" required>
                                <option hidden selected>Sélectionnez un agent...</option>
                                @foreach($agents as $data)
                                    <option value="{{$data->id}}">{{$data->agent_matricule. ' -- '.$data->agent_nom.' '.$data->agent_postnom.'  '.$data->agent_prenom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="motif" class="form-label">Raison du congé<sup class="text-danger">*</sup></label>
                            <textarea name="motif" id="motif" class="form-control" placeholder="Entrez la raison de l'attribution du congé !" ></textarea>
                        </div>

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="reset" class="btn btn-dark me-2">Annuler</button>
                    <button type="submit" class="btn btn-success"> <i class="ri-check-double-line"></i> Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End:: row-1 -->
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/app/agent.js')}}"></script>
@endsection

