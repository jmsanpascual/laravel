@section('links')
<style>
  /* Compliment for the navbar fixed top */
  body {
    padding-top: 55px;
  }
</style>
@endsection

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button class="navbar-toggle btn navbar-btn" type="button" ng-init="isCollapsed = true" ng-click="isCollapsed = !isCollapsed">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="padding:0;">
        <img alt="Brand" src="{{ asset('img/logo.png') }}" style="height: 50px;">
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
