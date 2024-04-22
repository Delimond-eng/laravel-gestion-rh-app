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
                        <div class="input-group w-50">
                            <input type="text" class="form-control form-control-sm" placeholder="Recherche agents...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap">
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
                                </tr>
                                </thead>
                                <tbody>

                                @foreach(range(1, 10) as $iteration)
                                    <tr>
                                        <th scope="row">0394939BA</th>
                                        <td>Bukasa</td>
                                        <td>Tshitoko</td>
                                        <td>Laurent</td>
                                        <td>M</td>
                                        <td>+243834894400</td>
                                        <td>laurent16@gmail.com</td>
                                        <td>Kinshasa</td>
                                        <td>Bureau 02</td>
                                        <td>Assistant</td>
                                        <td>Agent</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">

                                                <a href="javascript:void(0);"
                                                   class="btn btn-icon btn-sm btn-info rounded-pill"><i
                                                        class="ri-edit-line"></i></a>
                                                <a href="javascript:void(0);"
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

