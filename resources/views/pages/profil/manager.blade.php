@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Gestion des accès utilisateurs</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Profil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">utilisateurs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-md-6">
                <form method="post" id="user-form" action="{{route('users.store')}}" class="card custom-card">
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
                        <input type="text" name="id" value="{{isset($user) ? $user->id : ''}}" hidden>
                        <div class="col-md-12 col-sm-12">
                            <label for="username" class="form-label">Nom d'utilisateur<sup class="text-danger">*</sup> </label>
                            <input type="text" name="name" class="form-control" id="username" placeholder="Saisir le nom d'utilisateur...ex:Gaston delimond" required>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="email" class="form-label">Email<sup class="text-danger">*</sup> </label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Saisir l'adresse email de l'utilisateur..." required>
                        </div>



                        <div class="col-md-12 col-sm-12 mt-2">
                            <label for="access" class="form-label">Role(accès)<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="access-select" name="role" required>
                                <option hidden selected>Sélectionnez un rôle utilisateur...</option>
                                <option value="superadmin">Super administrateur</option>
                                <option value="ministre">Ministre</option>
                                <option value="secretaire">Sécretaire</option>
                                <option value="directeur">Directeur</option>
                                <option value="drh">DRH</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-2 d-none" id="ministereSection">
                            <label for="ministere-select"  class="form-label">Ministère<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="ministere-select" name="ministere_id">
                                <option hidden selected>Sélectionnez un ministere...</option>
                                @foreach($ministeres as $item)
                                    <option value="{{$item->id}}">{{$item->ministere_libelle}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-2 d-none" id="secretariatSection">
                            <label for="secretariat-select"  class="form-label">Sécretariat<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="secretariat-select" name="secretariat_id">
                                <option selected hidden>Sélectionnez un sécretariat...</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-2 d-none" id="directionSection">
                            <label for="direction-select"  class="form-label">Direction<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="direction-select" name="direction_id">
                                <option selected hidden>Sélectionnez une direction...</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="password" class="form-label">Mot de passe<sup class="text-danger">*</sup> </label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Saisir le mot de passe de l'utilisateur..." required>
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
                            Liste des bureaux
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rôle</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{$user->name}}</th>
                                            <th scope="row">{{$user->email}}</th>
                                            <th scope="row">{{$user->role}}</th>
                                            <td>
                                                <div class="hstack gap-2 fs-15">
                                                    <a href="{{ url('/delete/users/'.$user->id) }}"
                                                       class="btn btn-icon btn-sm btn-dark rounded-pill"><i
                                                            class="ri-delete-bin-4-line"></i></a>
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
    <script src="{{asset('assets/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/js/app/user.js')}}"></script>
@endsection


