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
            <li class="active"><a href="{{ url('home') }}"><i class="fa fa-link"></i> <span>Home</span></a></li>
            <!--<li class="header">Administration</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Administration</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/roles') }}">Roles</a></li>
                </ul>
                
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/membership') }}">Membership</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/did') }}">DIDs</a></li>
                </ul>
                
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/extension') }}">Extensions</a></li>
                </ul>
                
            </li>
            
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>My Account</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
            <li><a href="{{ url('users/account') }}"><i class="fa fa-users"></i> <span>My Profile Account</span></a></li>
            <li><a href="{{ url('users/contacts') }}"><i class="fa fa-users"></i> <span>My Contacts</span></a></li>
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
