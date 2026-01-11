<!-- NAVBAR WITH LOGO -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
            SUPER GOLD LOTTERY
        </a>

        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('schemes') }}">Schemes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('old-resault') }}">Old Results</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('about-us') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('contract-us') }}">Contract Us</a></li>
                
            </ul>
        </div>
    </div>
</nav>

