@extends('layouts.presensi')
@section('content')
<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            <img src="assets/img/sample/avatar/logopoliban.jpg" alt="avatar" class="imaged w64">
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ ucwords(strtolower($user->nama_lengkap)) }}</h2>
            <br>
            <span id="user-role">{{ ucwords(strtolower($user->jabatan))}}</span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="item-menu text-center">
                        <h2 id="current-date"></h2>
                        <h3 id="current-time"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="presensi-container text-center">
                        </div>
                        <table class="table-presensi mt-3">
                            <thead>
                                <h2>Presensi</h2>
                                <tr>
                                    <th>Nama Pegawai</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $pegawaiSaatIni = '';
                                @endphp
                                @foreach ($presensiRecords as $record)
                                    {{-- @if ($pegawaiSaatIni != $user->nama_lengkap)
                                        @php
                                            $pegawaiSaatIni = $user->nama_lengkap;
                                        @endphp
                                    @endif --}}
                                    <tr>
                                        <td>{{ ucwords(strtolower($user->nama_lengkap)) }}</td>
                                        <td>Datang</td>
                                        <td>{{ $record->jam_in ?: '-' }} <br>
                                            {{ $record->tgl_presensi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ ucwords(strtolower($user->nama_lengkap)) }}</td>
                                        <td>Pulang</td>
                                        <td> {{ $record->jam_out ?: '-' }} <br>
                                            {{ $record->tgl_presensi }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content mt-2" style="margin-bottom:100px;">
        <div class="card-body text-center" style="font-style: italic; opacity: 0.75;">
            Sistem Presensi GIS Karyawan &copy; 2024
        </div>
    </div>
</div>
@endsection
