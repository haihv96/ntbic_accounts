<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false"
            data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
            </li>
            <li class="heading">
                <h3 class="uppercase">Management</h3>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Users</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    @if($sidebarView['ntbic_accounts']['users']['store'])
                        <li class="nav-item  ">
                            <a href="{{route('users.create')}}" class="nav-link ">
                                <span class="title">New</span>
                            </a>
                        </li>
                    @endif

                    @if($sidebarView['ntbic_accounts']['users']['read'])
                        <li>
                            <a href="{{route('users.index')}}" class="nav-link ">
                                <span class="title">List users</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Ntbic Home</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    @if($sidebarView['ntbic_home']['role_permissions']['read'])

                        <li class="nav-item  ">
                            <a href="{{url('management/ntbic-home/roles')}}" class="nav-link ">
                                <span class="title">Roles</span>
                            </a>
                        </li>
                    @endif
                    @if($sidebarView['ntbic_home']['permission']['read'])
                        <li>
                            <a href="{{url('management/ntbic-home/permissions')}}" class="nav-link ">
                                <span class="title">Permissions</span>
                            </a>
                        </li>
                    @endif
                    @if($sidebarView['ntbic_home']['user_roles']['read'])

                        <li>
                            <a href="{{url('management/ntbic-home/user-roles')}}" class="nav-link ">
                                <span class="title">User Has Roles</span>
                            </a>
                        </li>
                    @endif
                    @if($sidebarView['ntbic_home']['user_permissions']['read'])

                        <li>
                            <a href="{{url('management/ntbic-home/user-permissions')}}" class="nav-link ">
                                <span class="title">User Has Permissions</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Ntbic Database</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    @if($sidebarView['ntbic_database']['role_permissions']['read'])

                        <li class="nav-item  ">
                            <a href="{{url('management/ntbic-database/roles')}}" class="nav-link ">
                                <span class="title">Roles</span>
                            </a>
                        </li>
                    @endif
                    @if($sidebarView['ntbic_database']['permission']['read'])

                        <li>
                            <a href="{{url('management/ntbic-database/permissions')}}" class="nav-link ">
                                <span class="title">Permissions</span>
                            </a>
                        </li>
                    @endif
                    @if($sidebarView['ntbic_database']['user_roles']['read'])

                        <li>
                            <a href="{{url('management/ntbic-database/user-roles')}}" class="nav-link ">
                                <span class="title">User Has Roles</span>
                            </a>
                        </li>
                    @endif

                    @if($sidebarView['ntbic_database']['user_permissions']['read'])
                        <li>
                            <a href="{{url('management/ntbic-database/user-permissions')}}"
                               class="nav-link ">
                                <span class="title">User Has Permissions</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</div>