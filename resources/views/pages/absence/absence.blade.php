@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Gestion des absences</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Rh</a></li>
                        <li class="breadcrumb-item active" aria-current="page">absences</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-md-6">
                <form method="post" id="absence-form" action="{{route('absence.create')}}" class="card custom-card">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">
                            Absences justifiées
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
                        <input type="text" name="id" value="{{isset($absence) ? $absence->id : ''}}" hidden>

                        <div class="col-md-12 col-sm-12">
                            <label for="motif" class="form-label">Motif<sup class="text-danger">*</sup> </label>
                            <textarea name="motif" class="form-control" cols="20" id="motif" rows="5" placeholder="Saisissez le motif de l'absence..."></textarea>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="agent-select" class="form-label">Agent<sup class="text-danger">*</sup> </label>
                            <select class="form-select form-select-lg" id="agent-select" name="agent_id">
                                <option hidden selected>Sélectionnez un agent...</option>
                                @foreach($agents as $item)
                                    <option value="{{$item->id}}">{{$item->agent_matricule}}|{{$item->agent_nom}} {{$item->agent_prenom}}</option>
                                @endforeach
                            </select>
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
                            Liste des absences
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Agent</th>
                                    <th scope="col">motif</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($absences as $item)
                                    <tr>
                                        <td>{{$item->created_at->format('d/m/Y')}}</td>
                                        <td>{{$item->agent->agent_matricule.'| '.$item->agent->agent_nom.' '.$item->agent->agent_prenom}} </td>
                                        <td>{{$item->absence_motif}}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ url('/delete/absences/'.$item->id) }}"
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



