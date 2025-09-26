<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin/assets/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::guard('admin')->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('admin/dashboard') }}"><i class="fa fa-circle-o"></i>
                            Dashboard</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Home Banner</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('admin/home-banner') }}"><i class="fa fa-circle-o"></i>
                            Home Banner</a>
                    </li>
                </ul>
            </li>



            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('admin/user-management') }}"><i class="fa fa-circle-o"></i>
                            User</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-book"></i> <span>Contact Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('admin/contact-management') }}"><i class="fa fa-circle-o"></i>
                            Contact Details</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-image"></i> <span>Gallary Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="{{ url('admin/gallary-management') }}">
                            <i class="fa fa-circle-o"></i> Gallary
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pencil-square-o"></i> <span>Blog Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <a href="{{ route('blog-categories-list') }}"
                                    class="link-light d-inline-flex text-decoration-none rounded">
                                    Blogs Categories List
                                </a>
                    <li>
                        <a href="{{ route('blogs-list') }}"
                                    class="link-light d-inline-flex text-decoration-none rounded">
                                    Blogs List
                                </a>
                    </li>
                </ul>
            </li>

            <!-- <li class="dropdown">
                <a href="#" class="collapsed nav-link" data-bs-toggle="collapse" data-bs-target="#collapseZ"
                    aria-expanded="false" aria-controls="collapseZ">
                    <span data-feather="briefcase"></span><span> Blog Management</span>
                    <i class="bi bi-chevron-right rotate-icon"></i>
                </a>
                <div id="collapseZ" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <ul>
                            <li>
                                <a href="{{ route('blog-categories-list') }}"
                                    class="link-light d-inline-flex text-decoration-none rounded">
                                    Blogs Categories List
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('blogs-list') }}"
                                    class="link-light d-inline-flex text-decoration-none rounded">
                                    Blogs List
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li> -->


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i> <span>Event Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('admin/event-management') ? 'active' : '' }}">
                        <a href="{{ url('admin/event-management') }}">
                            <i class="fa fa-calendar-check-o"></i> Event
                        </a>
                    </li>
                </ul>


            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Enquiry Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('admin/enquiry-management') ? 'active' : '' }}">
                        <a href="{{ url('admin/enquiry-management') }}">
                            <i class="fa fa-calendar-check-o"></i> Enquiry
                        </a>
                    </li>
                </ul>
            </li>

            {{-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Map Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('admin/map-management') ? 'active' : '' }}">
                        <a href="{{ url('admin/map-management') }}">
                            <i class="fa fa-calendar-check-o"></i> Map
                        </a>
                    </li>
                </ul>
            </li> --}}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Comment Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('admin/comment-management') ? 'active' : '' }}">
                        <a href="{{ url('admin/comment-management') }}">
                            <i class="fa fa-calendar-check-o"></i> Comment
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
