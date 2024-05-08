@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Paramètre rotations</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Paramètres</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rotation</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('config.rotations.create')}}" class="card custom-card">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">
                            Formulaire de configuration
                        </div>
                    </div>
                    <div class="card-body row g-2">
                        @if(session('message'))
                            <div class="alert alert-secondary alert-dismissible fade show custom-alert-icon shadow-sm auto-dismiss-alert" role="alert">
                                <svg class="svg-secondary" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>
                                {{session('message')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
                            </div>
                        @endif
                        <div class="col-md-6 col-sm-12 mt-2">
                            <label for="equipeId" class="form-label">Equipe<sup class="text-danger">*</sup> </label>
                            <select name="equipe_id" class="form-select form-select-lg" id="equipeId" required>
                                <option hidden selected>Sélectionnez une equipe...</option>
                                @foreach($equipes as $data)
                                    <option value="{{$data->id}}">{{$data->equipe_libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12 mt-2">
                            <label for="agentId" class="form-label">Agent<sup class="text-danger">*</sup> </label>
                            <select name="agent_id" class="form-select form-select-lg" id="agentId" required>
                                <option hidden selected>Sélectionnez un agent...</option>
                                @foreach($agents as $data)
                                    <option value="{{$data->id}}">{{$data->agent_matricule. ' -- '.$data->agent_nom.' '.$data->agent_postnom.'  '.$data->agent_prenom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-2">
                            <input name="jours" type="text" id="input-days" hidden required>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input all" type="checkbox" id="all">
                                <label for="all" class="form-label">Sélectionnez les jours<sup class="text-danger">*</sup> </label>
                            </div>
                            <div class="mt-1">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input cb-day" type="checkbox" id="inlineCheckbox1" value="Lundi">
                                    <label class="form-check-label" for="inlineCheckbox1">Lundi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input cb-day" type="checkbox" id="inlineCheckbox2" value="Mardi">
                                    <label class="form-check-label" for="inlineCheckbox2">Mardi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input cb-day" type="checkbox" id="inlineCheckbox3" value="Mercredi">
                                    <label class="form-check-label" for="inlineCheckbox3">Mercredi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input cb-day" type="checkbox" id="inlineCheckbox4" value="Jeudi">
                                    <label class="form-check-label" for="inlineCheckbox4">Jeudi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input cb-day" type="checkbox" id="inlineCheckbox5" value="Vendredi">
                                    <label class="form-check-label" for="inlineCheckbox5">Vendredi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input cb-day" type="checkbox" id="inlineCheckbox6" value="Samedi">
                                    <label class="form-check-label" for="inlineCheckbox6">Samedi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input cb-day" type="checkbox" id="inlineCheckbox7" value="Dimanche">
                                    <label class="form-check-label" for="inlineCheckbox7">Dimanche</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-dark me-2" type="reset">Annuler</button>
                        <button class="btn btn-success" type="submit"> <i class="ri-check-double-line"></i> Sauvegarder</button>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Liste des rotations
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Equipe</th>
                                    <th scope="col">Agent</th>
                                    <th scope="col">Direction</th>
                                    <th scope="col">Ministere</th>
                                    <th scope="col">jour</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($rotations as $item)
                                        <tr>
                                            <td>{{$item->equipe->equipe_libelle}}</td>
                                            <td>{{$item->agent->agent_matricule.'|'.$item->agent->agent_nom.' '.$item->agent->agent_postnom.' '.$item->agent->agent_prenom }}</td>
                                            <td>{{$item->direction->direction_libelle}}</td>
                                            <td>{{$item->ministere->ministere_libelle}}</td>
                                            <td>{{$item->jours}}</td>
                                            <td>
                                                <a href="{{url('/delete/rotations/'.$item->id)}}" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i class="ri-delete-bin-line"></i></a>
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

@section("scripts")
    <script src="{{asset('assets/js/app/edition.js')}}"></script>
@endsection
