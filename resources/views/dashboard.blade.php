@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <p class="fw-semibold fs-18 mb-0">Bienvenue, {{Auth::user()->name}} !</p>
                <span class="fs-semibold text-muted">Le Tableau de bord !</span>
            </div>
            <div class="btn-list mt-md-0 mt-2">
                <select class="form-control d-none d-sm-none d-lg-block d-xxl-block">
                    <option value="Tout">Tout</option>
                    <option value="Tout">Direction</option>
                    <option value="Tout">Province</option>
                    <option value="Tout">Secrétariat</option>
                </select>
            </div>
        </div>
        <!-- End::page-header -->

        <!-- Start::row-1 -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card custom-card crm-highlight-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="fw-semibold fs-18 text-fixed-white mb-2">Statistiques globales des présences</div>

                                                <span class="d-block fw-semibold mt-1"><a class="text-fixed-white" href="javascript:void(0);"><u>Voir détails</u></a></span>
                                            </div>
                                            <div>
                                                <div id="crm-main"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header justify-content-between">
                                    <div class="card-title">
                                        Statistiques simplifiées
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown" aria-expanded="false">
                                            Voir tout<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">Aujourd'hui</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Cette semaine</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Dernière semaine</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="progress-stacked progress-animate progress-xs mb-4">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <ul class="list-unstyled mb-0 pt-2 crm-deals-status">

                                        <li class="success">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>Presences</div>
                                                <div class="fs-12 text-muted">7478323 agents</div>
                                            </div>
                                        </li>
                                        <li class="warning">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>Retards</div>
                                                <div class="fs-12 text-muted">84939 agents</div>
                                            </div>
                                        </li>
                                        <li class="danger">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>Absences</div>
                                                <div class="fs-12 text-muted">39948</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-xxl-6 col-lg-6 col-md-6">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex align-items-top justify-content-between">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-primary">
                                                    <i class="ti ti-users fs-16"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill ms-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <div>
                                                        <p class="text-muted mb-0">Nbre total des agents</p>
                                                        <h4 class="fw-semibold fs-5 mt-1">4005043</h4>
                                                    </div>
                                                    <div id="crm-total-customers"></div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-1">
                                                    <div>
                                                        <a class="text-primary" href="javascript:void(0);">Voir détails<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-6 col-md-6">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex align-items-top justify-content-between">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-success">
                                                    <i class="ti ti-user-check fs-16"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill ms-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <div>
                                                        <p class="text-muted mb-0">Les agents présents</p>
                                                        <h4 class="fw-semibold fs-5 mt-1">239403</h4>
                                                    </div>
                                                    <div id="crm-total-revenue"></div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-1">
                                                    <div>
                                                        <a class="text-secondary" href="javascript:void(0);">Voir détails<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-6 col-md-6">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex align-items-top justify-content-between">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-warning">
                                                    <i class="ri-timer-line fs-16"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill ms-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <div>
                                                        <p class="text-muted mb-0">Les retards</p>
                                                        <h4 class="fw-semibold fs-5 mt-1">38830</h4>
                                                    </div>
                                                    <div id="crm-conversion-ratio"></div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-1">
                                                    <div>
                                                        <a class="text-success" href="javascript:void(0);">Voir détails<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-6 col-md-6">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex align-items-top justify-content-between">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-danger">
                                                    <i class="bx bx-timer fs-16"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill ms-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <div>
                                                        <p class="text-muted mb-0">Absences</p>
                                                        <h4 class="fw-semibold mt-1">44758</h4>
                                                    </div>
                                                    <div id="crm-total-deals"></div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-1">
                                                    <div>
                                                        <a class="text-warning" href="javascript:void(0);">Voir détails<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End::row-1 -->
    </div>
@endsection

