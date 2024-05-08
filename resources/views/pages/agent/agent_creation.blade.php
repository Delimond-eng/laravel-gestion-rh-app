@section('styles')
    <link rel="stylesheet" href="{{asset('assets/libs/select2/css/select2.min.css')}}">
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Création agents</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Agents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Création</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-xl-12">
                <form id="agent-form" method="POST" action="{{route('agents.create')}}" class="card custom-card">
                    @csrf
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Veuillez saisir les infos requises pour créer un agent
                        </div>
                        <div class="prism-toggle">
                            <a href="{{url('/agents')}}" class="btn btn-sm btn-primary-light" type="button">Voir liste des agents<i class="ri-arrow-drop-right-line ms-2 d-inline-block align-middle"></i></a>
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
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <label for="matricule" class="form-label">Matricule <sup class="text-danger">*</sup> </label>
                                <input type="text" name="matricule" class="form-control" id="matricule" placeholder="Saisir le matricule..." required>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <label for="nom" class="form-label">Nom <sup class="text-danger">*</sup></label>
                                <input type="text" name="nom" class="form-control" id="nom" placeholder="Saisir le nom..." required>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <label for="postnom" class="form-label">Postnom <sup class="text-danger">*</sup></label>
                                <input type="text" name="postnom" class="form-control" id="postnom" placeholder="Saisir le postnom..." required>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <label for="prenom" class="form-label">Prenom <sup class="text-danger">*</sup></label>
                                <input name="prenom" type="text" class="form-control" id="prenom" placeholder="Saisir le prenom..." required>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <label for="genre" class="form-label">Genre <sup class="text-danger">*</sup></label>
                                <select id="genre" name="genre" class="form-select form-select-lg" required>
                                    <option hidden selected label="Sélectionnez un genre"></option>
                                    <option value="M">Masculin</option>
                                    <option value="M">Féminin</option>
                                </select>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <label for="telephone" class="form-label">Téléphone<sup class="text-danger">*</sup></label>
                                <input type="tel" name="telephone" class="form-control" id="telephone" placeholder="Saisir le téléphone..." required>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Saisir le téléphone..." required>
                            </div>

                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                                <label for="adresse" class="form-label">Adresse<sup class="text-danger">*</sup></label>
                                <input type="text" name="adresse" id="adresse" class="form-control" placeholder="ex: n°039, metallurgy. Tamac. Gombe.">
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="province-select" class="form-label">Province<sup class="text-danger">*</sup></label>
                                <select class="form-control" name="province_id" id="province-select" required>
                                    <option hidden selected>Sélectionnez une province...</option>
                                    @foreach($config['provinces'] as $province)
                                        <option value="{{$province->id}}">{{$province->province_libelle}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="ministere-select" class="form-label">Ministère<sup class="text-danger">*</sup></label>
                                <select class="form-control" name="ministere_id" id="ministere-select" required>
                                    <option hidden selected>Sélectionnez un ministère...</option>
                                    @foreach($config['ministeres'] as $data)
                                        <option value="{{$data->id}}">{{$data->ministere_libelle}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="secretariat-select" class="form-label">Secrétariat<sup class="text-danger">*</sup></label>
                                <select class="form-control" name="secretariat_id" id="secretariat-select" required>
                                    <option hidden selected>Sélectionnez un secrétariat...</option>
                                </select>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="direction-select" class="form-label">Direction<sup class="text-danger">*</sup></label>
                                <select class="form-control" name="direction_id" id="direction-select" required>
                                    <option hidden selected>Sélectionnez une direction...</option>
                                </select>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="division-select" class="form-label">Division<sup class="text-danger">*</sup></label>
                                <select class="form-control" name="division_id" id="division-select" required>
                                    <option hidden selected>Sélectionnez une direction...</option>
                                </select>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="bureau-select" class="form-label">Bureau<sup class="text-danger">*</sup></label>
                                <select class="form-control" name="bureau_id" id="bureau-select"  required>
                                    <option hidden selected>Sélectionnez un bureau...</option>
                                </select>
                            </div>


                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="fonction-select" class="form-label">Fonction<sup class="text-danger">*</sup></label>
                                <select name="fonction_id" class="form-control" id="fonction-select"  required>
                                    <option hidden selected>Sélectionnez une fonction...</option>
                                    @foreach($config['fonctions'] as $fonction)
                                        <option value="{{$fonction->id}}">{{$fonction->fonction_libelle}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="grade-select" class="form-label">Grade<sup class="text-danger">*</sup></label>
                                <select class="form-control" id="grade-select" name="grade_id" required>
                                    <option hidden selected>Sélectionnez une grade...</option>
                                    @foreach($config['grades'] as $grade)
                                        <option value="{{$grade->id}}">{{$grade->grade_libelle}}</option>
                                    @endforeach
                                </select>
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
