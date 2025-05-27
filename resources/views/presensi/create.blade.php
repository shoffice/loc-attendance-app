@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Presensi Karyawan</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<style>
    #map {
        height: 420px;
        }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <input type="hidden" id="lokasi">
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if (($cek > 0) && ($presensiToday->jam_out))
                <button id="takeabsen" class="btn btn-danger btn-block" disabled>
                    <ion-icon name="pin-outline"></ion-icon>
                    Sampai Bertemu Besok!
                </button>
            @elseif ($cek > 0)
                <button id="takeabsen" class="btn btn-danger btn-block">
                    <ion-icon name="pin-outline"></ion-icon>
                    Presensi Pulang
                </button>
            @else
                <button id="takeabsen" class="btn btn-primary btn-block">
                    <ion-icon name="pin-outline"></ion-icon>
                    Presensi Masuk
                </button>
            @endif
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
    <div class="card-body text-center" style="font-style: italic; opacity: 0.75;">
        Sistem Presensi GIS Karyawan &copy; 2024
    </div>
@endsection

@push('myscript')
<script>
    var lokasi = document.getElementById('lokasi');
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }

    function successCallback(position){
        lokasi.value = position.coords.latitude + "," + position.coords.longitude;
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        // var circle = L.circle([-3.334774685353028, 114.57052711904666], {
        var circle = L.circle([-3.295591456650143, 114.58193773680566], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 50
        }).addTo(map);
    }

    function errorCallback(){

    }

    $("#takeabsen").click(function(e){
        var lokasi = $("#lokasi").val();
        $.ajax({
            type:'POST',
            url:'/presensi/store',
            data:{
                _token:"{{ csrf_token () }}",
                lokasi:lokasi
            },
            cache:false,
            success:function(respond){
                var status = respond.split("|");
                if (status [0] == "success") {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: status[1],
                        icon: 'success',
                    })
                    setTimeout("location.href='/dashboard'", 3000);
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: status[1],
                        icon: 'error',
                        confirmButtonText: 'Oke'
                })
            }
        }
        });
    });
</script>
@endpush
