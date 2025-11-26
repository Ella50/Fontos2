<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/teszt">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/names">Nevek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/names/manage/surname">Családnevek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>

        @auth
        <li>
          <a class="nav-link" href="/profile">Profil</a>
        </li>
        @endauth
      </ul>

<!--Authentication-->

      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Kijelentkezés ({{ Auth::user()->name }})</a>
            <form id="form-logout" method="post" action="/logout">
              @csrf <!--ezt a tokent küldi el a form-->
            </form>
          </li>
        @else 
          <li class="nav-item"> <!--Aki nincs bejelentkezve:-->
            <a class="nav-link" href="/login">Bejelentkezés</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Regisztráció</a>
          </li>
        @endauth
      </ul>

    </div>
  </div>
</nav>