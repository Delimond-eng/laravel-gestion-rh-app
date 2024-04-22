@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Ministères</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Paramètres</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ministères</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-md-7">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Formulaire de création
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12">
                            <label for="matricule" class="form-label">Nom du ministère<sup class="text-danger">*</sup> </label>
                            <input type="text" name="libelle" class="form-control" id="libelle" placeholder="Saisir le nom du ministère..." required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="description" class="form-label">Description </label>
                            <textarea name="description" id="description" class="form-control" placeholder="Entrez une description..."></textarea>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-dark me-2" type="reset">Annuler</button>
                        <button class="btn btn-primary" type="submit"> <i class="ri-add-line"></i> Sauvegarder</button>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Liste des ministères
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach(range(1, 26) as $iteration)
                                        <tr>
                                            <td>Ministère {{$iteration}}</td>
                                            <td>
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
