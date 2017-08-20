<nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
    <a class="navbar-brand px-demo-brand" href="{{ urlBackend('dashboard/index') }}">Cpanel Admin</a>
    </div>

    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
      <ul class="nav navbar-nav">

        
      </ul>

      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="hidden-md">{{ getUser()->username }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ urlBackend('profile/index') }}"><span class="label label-warning pull-xs-right"><i class="fa fa-asterisk"></i></span>Profile</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('login/logout') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
          </ul>
        </li>
        
        <li class="dropdown">
          <a href="https://google.com" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="px-navbar-icon fa fa-bell font-size-24"></i>
            <span class="px-navbar-icon-label">Income messages</span>
            <span class="px-navbar-label label label-danger" style="padding: 2px;font-size: 11px">25</span>
          </a>
          <div class="dropdown-menu p-a-0">
            <div id="navbar-messages" style="height: 200px; position: relative;">
              <div class="widget-messages-alt-item">
                <div class="widget-messages-alt-avatar font-size-24"><i class="fa fa-envelope"></i></div>
                <a href="#" class="widget-messages-alt-subject text-truncate">Melakukan Upload Data Kerjasama</a>
                <div class="widget-messages-alt-description">from <a href="#">Administrator</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>

              <div class="widget-messages-alt-item">
                <div class="widget-messages-alt-avatar font-size-24"><i class="fa fa-envelope"></i></div>
                <a href="#" class="widget-messages-alt-subject text-truncate">Melakukan Upload Data Usulan Kerjasama</a>
                <div class="widget-messages-alt-description">from <a href="#">User</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>
              <div class="widget-messages-alt-item">
                <div class="widget-messages-alt-avatar font-size-24"><i class="fa fa-envelope"></i></div>
                <a href="#" class="widget-messages-alt-subject text-truncate">Melakukan Upload Data Kerjasama</a>
                <div class="widget-messages-alt-description">from <a href="#">Administrator</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>
            </div>

            <a href="#" class="widget-more-link">MORE MESSAGES</a>
          </div> <!-- / .dropdown-menu -->
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </nav>