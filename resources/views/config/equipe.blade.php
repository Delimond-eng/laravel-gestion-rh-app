@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Equipes</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Paramètres</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Equipes</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Formulaire de création
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12">
                            <label for="equipe" class="form-label">Libellé Equipe<sup class="text-danger">*</sup> </label>
                            <input type="text" name="libelle" class="form-control" id="libelle" placeholder="Saisir l'equipe..." required>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="secretariatId" class="form-label">Direction<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="secretariatId">
                                <option hidden selected>Sélectionnez une direction...</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="secretariatId" class="form-label">Direction<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="secretariatId">
                                <option hidden selected>Sélectionnez une direction...</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="ministereId" class="form-label">secretariat<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="secretariatId">
                                <option hidden selected>Sélectionnez un secretariat...</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="ministereId" class="form-label">Ministere<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="ministere">
                                <option hidden selected>Sélectionnez un ministere...</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-dark me-2" type="reset">Annuler</button>
                        <button class="btn btn-success" type="submit"> <i class="ri-add-line"></i> Sauvegarder</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Liste des equipes
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Equipe</th>
                                    <th scope="col">Direction</th>
                                    <th scope="col">Secretariat</th>
                                    <th scope="col">Ministere</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach(range(1, 26) as $iteration)
                                        <tr>
                                            <td>Equipe {{$iteration}}</td>
                                            <td>Direction {{$iteration}}</td>
                                            <td>Secretariat {{$iteration}}</td>
                                            <td>ministere {{$iteration}}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i class="ri-edit-line"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i class="ri-delete-bin-line"></i></a>
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
