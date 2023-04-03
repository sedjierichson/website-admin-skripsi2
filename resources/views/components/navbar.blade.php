<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #13542D;">
    <div class="container-fluid">
        
        <a class="navbar-brand" href="/home">
          <a href="/home" class="text-decoration-none text-white fw-bold">PRESENSI PT. X</a>
        </a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">  
          
          <li class="nav-item ms-3">
            <a class="nav-link {{ ($navbar === "beranda") ? 'active' : '' }}" aria-current="page" href="/home">Beranda</a>
          </li>

          <li class="nav-item ms-3">
            <a class="nav-link {{ ($navbar === "absensi") ? 'active' : '' }}" aria-current="page" href="/presensi">Presensi</a>
          </li>

          <li class="nav-item ms-3">
            <a class="nav-link {{ ($navbar === "kantor") ? 'active' : '' }}" aria-current="page" href="/kantor">Kantor</a>
          </li>

          <li class="nav-item ms-3">
            <a class="nav-link {{ ($navbar === "perizinan") ? 'active' : '' }}" aria-current="page" href="/perizinan">Perizinan</a>
          </li>
          <li class="nav-item ms-3">
            <a class="nav-link {{ ($navbar === "beacon") ? 'active' : '' }}" aria-current="page" href="/beacon">Beacon</a>
          </li>
          <li class="nav-item ms-3">
            <a class="nav-link {{ ($navbar === "jamkerja") ? 'active' : '' }}" aria-current="page" href="/jamkerja">Jam Kerja</a>
          </li>
          <li class="nav-item ms-3">
            <a class="nav-link {{ ($navbar === "pegawai") ? 'active' : '' }}" aria-current="page" href="/codelogin">Pegawai</a>
          </li>

          

          <li class="nav-item ms-3">
            <a class="nav-link" href="/logout" tabindex="-1" aria-disabled="true">Logout</a>           
          </li>


        </ul>
        <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
  
        </form> -->
      </div>
    </div>
  </nav>