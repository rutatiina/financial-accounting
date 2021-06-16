<!-- Secondary sidebar -->
<div class="sidebar sidebar-secondary sidebar-default">
    <div class="sidebar-content">

        {{--
        <!-- Sidebar search -->
        <div class="sidebar-category">

            <div class="category-content">
                <form action="#">
                    <div class="has-feedback has-feedback-left">
                        <input type="search" class="form-control" placeholder="Search">
                        <div class="form-control-feedback">
                            <i class="icon-search4 text-size-base text-muted"></i>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /sidebar search -->
        --}}


        <!-- Sub navigation -->
        <div class="sidebar-category">

            {{--
            <div class="category-title">
                <span>Navigation</span>
                <ul class="icons-list">
                    <li><a href="#" data-action="collapse"></a></li>
                </ul>
            </div>
            --}}

            <div class="category-content no-padding">
                <ul class="navigation navigation-alt navigation-accordion">
                    <li class="navigation-header">Settings</li>
                    <li><a href="{{route('organisations.index')}}"><i class="icon-profile"></i> Organizations</a></li>
                    <li><a class="active" href=""><i class="icon-menu6"></i> Transaction Entree</a></li>
                    <li><a href=""><i class="icon-file-text3"></i> Transaction Type</a></li>

                    <li class="{{(Request::is('permissions', 'permissions*')) ? 'active' : '' }}">
                        <a href="{{ route('permissions.index') }}"><i class="icon-file-text3"></i> Permissions</a>
                    </li>
                    <li class="{{(Request::is('roles', 'roles*')) ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}"><i class="icon-file-text3"></i> Roles</a>
                    </li>
                    <li class="{{(Request::is('users', 'users*')) ? 'active' : '' }}">
                        <a href=""><i class="icon-file-text3"></i> Users</a>
                    </li>
                    <li class="{{(Request::is('groups', 'groups*')) ? 'active' : '' }}">
                        <a href="{{ route('groups.index') }}"><i class="icon-file-text3"></i> Groups</a>
                    </li>

                    {{--
                    <li><a href="{{url()->current()}}#"><i class="icon-people"></i> Manage User(s)</a></li>
                    <li><a href="{{url()->current()}}#"><i class="icon-key"></i> API</a></li>
                    --}}

                </ul>
            </div>
        </div>
        <!-- /sub navigation -->

    </div>
</div>
<!-- /secondary sidebar -->
