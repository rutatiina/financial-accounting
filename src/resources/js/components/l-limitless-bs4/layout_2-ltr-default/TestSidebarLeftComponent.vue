<template>

    <!-- Secondary sidebar -->
    <div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md border-right-0">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-secondary-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            <span class="font-weight-semibold">Secondary sidebar</span>
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content ">
            <div id="rg-sidebar-secondary-fixed-content-scroll" class="position-fixed h-100" style="width: 16.875rem; overflow: hidden;">
                <div>

                    <!-- Sub navigation -->
                    <div class="card mb-2">
                        <!--
                        <div class="card-header bg-transparent header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">Navigation</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>
                        -->

                        <div class="card-body p-0">
                            <ul class="nav nav-sidebar" data-nav-type="accordion">
                                <li class="nav-item-header">Actions</li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="icon-googleplus5"></i> Create task</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="icon-portfolio"></i> Create project</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="icon-compose"></i> Edit task list</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-user-plus"></i>
                                        Assign users
                                        <span class="badge bg-primary badge-pill ml-auto">94 online</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="icon-collaboration"></i> Create team</a>
                                </li>
                                <li class="nav-item-header">Navigate</li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="icon-files-empty"></i> All tasks</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-file-plus"></i>
                                        Active tasks
                                        <span class="badge bg-dark badge-pill ml-auto">28</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="icon-file-check"></i> Closed tasks</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-reading"></i>
                                        Assigned to me
                                        <span class="badge bg-info badge-pill ml-auto">86</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-make-group"></i>
                                        Assigned to my team
                                        <span class="badge bg-danger badge-pill ml-auto">47</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="icon-cog3"></i> Settings</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sub navigation -->


                    <!-- Online users -->
                    <div class="card">
                        <div class="card-header bg-transparent header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">Online users</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="#" class="media-title font-weight-semibold">John Alexander</a>
                                        <span class="font-size-xs text-muted d-block">Santa Ana, CA.</span>
                                    </div>
                                    <div class="ml-3 align-self-center">
                                        <span class="badge badge-mark border-success"></span>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="#" class="media-title font-weight-semibold">Jeremy Victorino</a>
                                        <span class="font-size-xs text-muted d-block">Dowagiac, MI.</span>
                                    </div>
                                    <div class="ml-3 align-self-center">
                                        <span class="badge badge-mark border-danger"></span>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="#" class="media-title font-weight-semibold">Margo Baker</a>
                                        <span class="font-size-xs text-muted d-block">Kasaan, AK.</span>
                                    </div>
                                    <div class="ml-3 align-self-center">
                                        <span class="badge badge-mark border-success"></span>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="#" class="media-title font-weight-semibold">Beatrix Diaz</a>
                                        <span class="font-size-xs text-muted d-block">Neenah, WI.</span>
                                    </div>
                                    <div class="ml-3 align-self-center">
                                        <span class="badge badge-mark border-warning"></span>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="#" class="media-title font-weight-semibold">Richard Vango</a>
                                        <span class="font-size-xs text-muted d-block">Grapevine, TX.</span>
                                    </div>
                                    <div class="ml-3 align-self-center">
                                        <span class="badge badge-mark border-grey-400"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /online-users -->


                    <!-- Latest updates -->
                    <div class="card">
                        <div class="card-header bg-transparent header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">Latest updates</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon">
                                            <i class="icon-git-pull-request"></i>
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        Drop the IE <a href="#">specific hacks</a> for temporal inputs
                                        <div class="text-muted font-size-sm">4 minutes ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#" class="btn bg-transparent border-warning text-warning rounded-round border-2 btn-icon">
                                            <i class="icon-git-commit"></i>
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        Add full font overrides for popovers and tooltips
                                        <div class="text-muted font-size-sm">36 minutes ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#" class="btn bg-transparent border-info text-info rounded-round border-2 btn-icon">
                                            <i class="icon-git-branch"></i>
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <a href="#">Chris Arney</a> created a new <span class="font-weight-semibold">Design</span> branch
                                        <div class="text-muted font-size-sm">2 hours ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#" class="btn bg-transparent border-success text-success rounded-round border-2 btn-icon">
                                            <i class="icon-git-merge"></i>
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <a href="#">Eugene Kopyov</a> merged <span class="font-weight-semibold">Master</span> and <span class="font-weight-semibold">Dev</span> branches
                                        <div class="text-muted font-size-sm">Dec 18, 18:36</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon">
                                            <i class="icon-git-pull-request"></i>
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        Have Carousel ignore keyboard events
                                        <div class="text-muted font-size-sm">Dec 12, 05:46</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /latest updates -->


                    <!-- Filter -->
                    <div class="card">
                        <div class="card-header bg-transparent header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">Filter</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="#">
                                <div class="form-group">
                                    <div class="form-check form-check-right">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-input-styled" checked data-fouc>
                                            Free People
                                        </label>
                                    </div>

                                    <div class="form-check form-check-right">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-input-styled" data-fouc>
                                            GAP
                                        </label>
                                    </div>

                                    <div class="form-check form-check-right">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-input-styled" checked data-fouc>
                                            Lane Bryant
                                        </label>
                                    </div>

                                    <div class="form-check form-check-right">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-input-styled" checked data-fouc>
                                            Ralph Lauren
                                        </label>
                                    </div>

                                    <div class="form-check form-check-right">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-input-styled" data-fouc>
                                            Liz Claiborne
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /filter -->


                    <!-- Contacts -->
                    <div class="card">
                        <div class="card-header bg-transparent header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">Contacts</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="mr-3 position-relative">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                        <span class="badge badge-info badge-pill badge-float">6</span>
                                    </a>

                                    <div class="media-body align-self-center">
                                        Rebecca Jameson
                                    </div>

                                    <div class="ml-3 align-self-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-default dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-more2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
                                                <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
                                                <a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="mr-3 position-relative">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                        <span class="badge badge-info badge-pill badge-float">9</span>
                                    </a>

                                    <div class="media-body align-self-center">
                                        Walter Sommers
                                    </div>

                                    <div class="ml-3 align-self-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-default dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-more2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
                                                <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
                                                <a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </a>

                                    <div class="media-body align-self-center">
                                        Otto Gerwald
                                    </div>

                                    <div class="ml-3 align-self-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-default dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-more2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
                                                <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
                                                <a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </a>

                                    <div class="media-body align-self-center">
                                        Vince Satmann
                                    </div>

                                    <div class="ml-3 align-self-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-default dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-more2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
                                                <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
                                                <a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </a>

                                    <div class="media-body align-self-center">
                                        Jason Leroy
                                    </div>

                                    <div class="ml-3 align-self-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-default dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-more2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
                                                <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
                                                <a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /contacts -->

                </div>
            </div>

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /secondary sidebar -->


</template>

<script>

    export default {
        name: 'AccountingPackageTestSidebarLeft',
        mounted() {
            console.log('Component mounted :: AccountingPackageTestSidebarLeft')
        }
    }
</script>
