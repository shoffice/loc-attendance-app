<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/dashboard" class="item {{request()->is('dashboard') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="/presensi/create" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="location-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="#" class="item" onclick="document.getElementById('logout-form').submit();">
        <div class="col">
            <form id="logout-form" action="/proseslogout" method="GET" style="display: none;">
                @csrf
            </form>
            <ion-icon name="log-out-outline" style="color: black;"></ion-icon>
            <strong>Logout</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->
