<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="active"><a href="{{ url('home') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <!--<li class="header">Administration</li>-->
            <!-- Optionally, you can add icons to the links -->
            @role('admin')
            <li class="treeview">
                <a href="#"><i class="fa fa-cog"></i> <span>Administration</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/roles') }}"><i class="fa fa-user-times" aria-hidden="true"></i>Roles</a></li>
                </ul>
                
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/membership') }}"><i class="fa fa-credit-card" aria-hidden="true"></i>Membership</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/did') }}"><i class="fa fa-phone"></i>DIDs</a></li>
                </ul>
                
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/extension') }}"><i class="fa fa-phone-square"></i>Extensions</a></li>
                </ul>
                
            </li>
            @endrole
            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>My Account</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
            <li><a href="{{ url('users/account') }}"><i class="fa fa-phone"></i> <span>My Profile Account</span></a></li>
            <li><a href="{{ url('users/contacts') }}"><i class="fa fa-users"></i> <span>My Contacts</span></a></li>
            <li><a href="users/editMy/{{ Auth::user()->id }}"><i class="fa fa-users"></i> <span>My User</span></a></li>
            </ul>
            </li>
           <!-- <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>-->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
