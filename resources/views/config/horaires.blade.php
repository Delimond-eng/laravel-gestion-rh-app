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
            <div class="col-md-10">
                <form method="POST" action="{{route('config.horaires.create')}}" class="card custom-card">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">
                            Formulaire de création
                        </div>
                    </div>
                    <div class="row g-3 card-body">
                        @if(session('message'))
                            <div class="alert alert-secondary alert-dismissible fade show custom-alert-icon shadow-sm auto-dismiss-alert" role="alert">
                                <svg class="svg-secondary" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>
                                {{session('message')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
                            </div>
                        @endif
                        <div class="col-md-3 col-sm-12">
                            <label for="start_at" class="form-label">Heure du Debut <sup class="text-danger">*</sup> </label>
                            <input type="time" name="heure_debut" class="form-control" id="start_at" placeholder="Choisir l'heure " required>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="end_at" class="form-label">Heure de Fin <sup class="text-danger">*</sup> </label>
                            <input type="time" name="heure_fin" class="form-control" id="end_at" placeholder="Choisir l'heure " required>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="late_at" class="form-label">Heure de retard <sup class="text-danger">*</sup> </label>
                            <input type="time" name="heure_retard" class="form-control" id="late_at" placeholder="Choisir l'heure " required>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="nombreRetard" class="form-label">Nombre de retard <sup class="text-danger">*</sup> </label>
                            <input type="text" name="nbre_retard"  class="form-control" id="nombreRetard" placeholder="cumule de retard pour notifier..." required>
                        </div>

                        <div class="col-md-4 col-sm-12 mt-2">
                            <label for="secretariatId" class="form-label">Secrétariat<sup class="text-danger">*</sup> </label>
                            <select name="secretariat_id" class="form-select form-select-lg" id="secretariatId">
                                <option hidden selected>Sélectionnez un secrétariat...</option>
                                @foreach($secretariats as $data)
                                    <option value="{{$data->id}}">{{$data->secretariat_libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12 mt-2">
                            <label for="directionId" class="form-label">Direction<sup class="text-danger">*</sup> </label>
                            <select name="direction_id" class="form-select form-select-lg" id="directionId">
                                <option hidden selected>Sélectionnez une direction...</option>
                                @foreach($directions as $data)
                                    <option value="{{$data->id}}">{{$data->direction_libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12 mt-2">
                            <label for="ministereId" class="form-label">Ministère<sup class="text-danger">*</sup> </label>
                            <select name="ministere_id" class="form-select form-select-lg" id="ministereId">
                                <option hidden selected>Sélectionnez une direction...</option>
                                @foreach($ministeres as $data)
                                    <option value="{{$data->id}}">{{$data->ministere_libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-dark me-2" type="reset">Annuler</button>
                        <button class="btn btn-primary" type="submit"> <i class="ri-check-double-line"></i> Sauvegarder</button>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
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
                                    <th scope="col">Sécretariat</th>
                                    <th scope="col">Direction</th>
                                    <th scope="col">Ministère</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($horaires as $item)
                                        <tr>
                                            <td>{{$item->heure_debut}}</td>
                                            <td>{{$item->heure_fin}}</td>
                                            <td>{{$item->heure_retard}}</td>
                                            <td>{{$item->nbre_retard_notification}}</td>
                                            <td>{{$item->secretariat->secretariat_libelle}}</td>
                                            <td>{{$item->direction->direction_libelle}}</td>
                                            <td>{{$item->ministere->ministere_libelle}}</td>
                                            <td>
                                                <a href="{{url('/delete/horaires/'.$item->id)}}" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i class="ri-delete-bin-line"></i></a>
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
