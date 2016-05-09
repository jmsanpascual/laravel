@section('links')
<style>
  /* Compliment for the navbar fixed top */
  body {
    padding-top: 55px;
  }

  img {
    width: 169px;
  }

  #custom-bootstrap-menu.navbar-default .navbar-brand {
    color: rgba(119, 119, 119, 1);
  }

  #custom-bootstrap-menu.navbar-default {
      font-size: 14px;
      background-color: rgba(0, 153, 102, 1);
      background: -webkit-linear-gradient(top, rgba(53, 191, 147, 1) 0%, rgba(0, 153, 102, 1) 100%);
      background: linear-gradient(to bottom, rgba(53, 191, 147, 1) 0%, rgba(0, 153, 102, 1) 100%);
      border-width: 1px;
      border-radius: 4px;
  }

  #custom-bootstrap-menu.navbar-default .navbar-nav>li>a {
      color: rgba(0, 0, 0, 1);
      background-color: rgba(248, 248, 248, 0);
  }

  #custom-bootstrap-menu.navbar-default .navbar-nav>li>a:hover,
  #custom-bootstrap-menu.navbar-default .navbar-nav>li>a:focus {
      color: rgba(255, 255, 255, 1);
      background-color: rgba(248, 248, 248, 0);
  }

  #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a,
  #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:hover,
  #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:focus {
      color: rgba(255, 255, 255, 1);
      background-color: rgba(0, 153, 102, 1);
      background: -webkit-linear-gradient(top, rgba(53, 191, 147, 1) 0%, rgba(0, 153, 102, 1) 100%);
      background: linear-gradient(to bottom, rgba(53, 191, 147, 1) 0%, rgba(0, 153, 102, 1) 100%);
  }

  #custom-bootstrap-menu.navbar-default .navbar-toggle {
      border-color: #009966;
  }

  #custom-bootstrap-menu.navbar-default .navbar-toggle:hover,
  #custom-bootstrap-menu.navbar-default .navbar-toggle:focus {
      background-color: #009966;
  }

  #custom-bootstrap-menu.navbar-default .navbar-toggle .icon-bar {
      background-color: #009966;
  }

  #custom-bootstrap-menu.navbar-default .navbar-toggle:hover .icon-bar,
  #custom-bootstrap-menu.navbar-default .navbar-toggle:focus .icon-bar {
      background-color: #009966;
  }
</style>
@endsection

<nav id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button class="navbar-toggle btn navbar-btn" type="button" ng-init="isCollapsed = true" ng-click="isCollapsed = !isCollapsed">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="padding:0;">
        <img alt="Brand" src="{{ asset('img/nav_logo.png') }}" style="height: 50px;">
      </a>
    </div>

    <div class="navbar-collapse" ng-class="{collapse: isCollapsed}">
      <ul class="nav navbar-nav">
        @if (auth()->user()->isAdmin())
          <li><a href="accounts">Accounts</a></li>
        @endif
        <li><a href="dealers">Dealers</a></li>
        <li><a href="#">Couriers</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li uib-dropdown>
          <a uib-dropdown-toggle role="button" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name }}
            <span class="caret"></span>
          </a>
          <ul class="ng-cloak" uib-dropdown-menu>
            <li><a href="logout">Logout</a>
          </ul>
        </li>
      </ul>
    </div> <!-- End of collaps navbar-collapse -->
  </div> <!-- End of container-fluid -->
</nav>
