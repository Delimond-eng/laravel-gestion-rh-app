@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">HORAIRE TRAVAIL</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Paramètres</a></li>
                        <li class="breadcrumb-item active" aria-current="page">HoraireTravail</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-md-5">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Formulaire de création
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12">
                            <label for="Heure_Debut" class="form-label">Heure du Debut <sup class="text-danger">*</sup> </label>
                            <input type="time" name="libelle" class="form-control" id="libelle" placeholder="Choisir l'heure " required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="Heure_Fin" class="form-label">Heure de Fin <sup class="text-danger">*</sup> </label>
                            <input type="time" name="libelle" class="form-control" id="libelle" placeholder="Choisir l'heure " required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="Heure_Retard" class="form-label">Heure de retard <sup class="text-danger">*</sup> </label>
                            <input type="time" name="libelle" class="form-control" id="libelle" placeholder="Choisir l'heure " required>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="nombreRetard" class="form-label">Nombre de retard <sup class="text-danger">*</sup> </label>
                            <input type="text" name="libelle" class="form-control" id="libelle" placeholder="Saisir la notification..." required>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="secretariatId" class="form-label">Direction<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="secretariatId">
                                <option hidden selected>Sélectionnez une direction...</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="secretariatId" class="form-label">Secrétariat<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="secretariatId">
                                <option hidden selected>Sélectionnez un secrétariat...</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-dark me-2" type="reset">Annuler</button>
                        <button class="btn btn-primary" type="submit"> <i class="ri-add-line"></i> Sauvegarder</button>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Horaire du travail
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Heure debut </th>
                                    <th scope="col">Heure Fin</th>
                                    <th scope="col">Heure Retard</th>
                                    <th scope="col">Notification</th>
                                    <th scope="col">Direction</th>
                                    <th scope="col">Secretariat</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach(range(1, 26) as $iteration)
                                        <tr>
                                            <td>Heure debut {{$iteration}}</td>
                                            <td>Heure Fin {{$iteration}}</td>
                                            <td>Heure Retard {{$iteration}}</td>
                                            <td>Notification {{$iteration}}</td>
                                            <td>Direction {{$iteration}}</td>
                                            <td>Secretariat {{$iteration}}</td>
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
