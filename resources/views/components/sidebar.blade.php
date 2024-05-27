<aside class="app-sidebar sticky" id="sidebar">
    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="/" class="header-logo">
            <!--<img src="assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
            <img src="assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
            <img src="assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
            <img src="assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
            <img src="assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-white">
            <img src="assets/images/brand-logos/toggle-white.png" alt="logo" class="toggle-white">
            -->
            <h1 class="desktop-dark text-primary text-uppercase fs-5 fw-bold">Gestion <span class="text-white">RH</span></h1>
            <h1 class="toggle-dark text-primary fs-5 fw-bold">RH</h1>
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">
        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Menu principal</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{url('/')}}" class="side-menu__item">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Tableau de bord</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-group side-menu__icon"></i>
                        <span class="side-menu__label">Agents</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{url('/agents.create')}}" class="side-menu__item">Création agents</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('/agents')}}" class="side-menu__item">Liste des agents</a>
                        </li>

                    </ul>
                </li>
                <!-- End::slide -->


                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-time-five side-menu__icon"></i>
                        <span class="side-menu__label">Présences & absences</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="javascript:void(0);"  class="side-menu__item">Rapport des présences</a>
                        </li>
                        <li class="slide">
                            <a href="aboutus.html" class="side-menu__item">Rapport des absences</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('/absences.manager')}}" class="side-menu__item">Absences justifiés</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-calendar-edit side-menu__icon"></i>
                        <span class="side-menu__label">Congés</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{url('/conge.reports')}}" class="side-menu__item">Rapport des congés</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('/conge.attribution')}}" class="side-menu__item">Attribution congé</a>
                        </li>
                    </ul>
                </li>

                <li class="slide">
                    <a href="{{url('/rotations') }}" class="side-menu__item">
                        <i class="ri-arrow-left-right-line side-menu__icon"></i>
                        <span class="side-menu__label">Rotations</span>
                    </a>
                </li>
                <!-- End::slide -->



                @if(Auth::user()->role === 'superadmin')

                    <!-- Start::slide__category -->
                    <li class="slide__category"><span class="category-name">Configuration</span></li>
                    <!-- End::slide__category -->

                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="{{url('/users.manager')}}" class="side-menu__item">
                            <i class="bx bxs-user-account side-menu__icon"></i>
                            <span class="side-menu__label">Gestion utilisateurs</span>
                        </a>
                    </li>
                @endif
                <!-- End::slide -->



                <!-- Start::slide -->
                @if(Auth::user()->role === 'superadmin')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-cog side-menu__icon"></i>
                        <span class="side-menu__label">Paramètres</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Entités
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="{{url('/provinces')}}" class="side-menu__item">Provinces</a>
                                </li>
                                <li class="slide">
                                    <a href="{{url('/ministeres')}}" class="side-menu__item">Ministères</a>
                                </li>
                                <li class="slide">
                                    <a href="{{url('/secretariats')}}" class="side-menu__item">Sécretariats</a>
                                </li>
                                <li class="slide">
                                    <a href="{{url('/directions')}}" class="side-menu__item">Directions</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('/divisions') }}" class="side-menu__item">Divisions</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('/bureaux') }}" class="side-menu__item">Bureaux</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('/grades') }}" class="side-menu__item">Grades</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('/fonctions') }}" class="side-menu__item">Fonctions</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Planning & congé
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="{{ url('/horaires') }}" class="side-menu__item">Horaires de travail</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('/equipe') }}" class="side-menu__item">Equipes</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ url('/type_conge') }}" class="side-menu__item">Type congés</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- End::slide -->


            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
