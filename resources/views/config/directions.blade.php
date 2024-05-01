@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Directions</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Paramètres</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Directions</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="{{route('config.create.directions')}}" class="card custom-card">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">
                            Formulaire de création
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
                        <input type="text" name="id" value="{{isset($direction) ? $direction->id : ''}}" hidden>
                        <div class="col-md-12 col-sm-12">
                            <label for="libelle" class="form-label">Libellé direction<sup class="text-danger">*</sup> </label>
                            <input type="text" value="{{isset($direction) ? $direction->direction_libelle : ''}}" name="libelle" class="form-control" id="libelle" placeholder="Saisir le libellé de la direction..." required>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="secretariatId" class="form-label">Secrétariat<sup class="text-danger">*</sup> </label>
                            <select  name="secretariat_id" class="form-select form-select-lg" id="secretariatId">
                                <option hidden selected>Sélectionnez un secrétariat...</option>
                                @foreach($secretariats as $secretariat)
                                    <option value="{{$secretariat->id}}">{{$secretariat->secretariat_libelle}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="desc" class="form-label">Description<sup class="text-muted">(Optionnelle)</sup> </label>
                            <textarea  name="description" id="desc" class="form-control" placeholder="Entrez une description...">{{isset($direction) ? $direction->description : ''}}</textarea>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-dark me-2" type="reset">Annuler</button>
                        <button class="btn btn-success" type="submit"> <i class="ri-check-double-line"></i> Sauvegarder</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6">

                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Liste des directions
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Libellé</th>
                                    <th scope="col">Secrétariat</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($directions as $item)
                                        <tr>
                                            <td>{{$item->direction_libelle}}</td>
                                            <td>{{$item->secretariat->secretariat_libelle}}</td>
                                            <td>
                                                <a href="{{url('/directions/'.$item->id)}}" class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i class="ri-edit-line"></i></a>
                                                <a href="{{url('/delete/directions/'.$item->id)}}" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i class="ri-delete-bin-line"></i></a>
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
