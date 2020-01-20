@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid" >
            <h2 class="no-margin-bottom"  id="h2" style="margin-left: 2%" >&nbsp; Yetki Rol</h2>
        </div>
    </header>

    <section class="animated fadeIn">

        <div class="card" style="background-color: white" id="deneme">

            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Kullanıcılar</a>
            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roller</a></h1>


            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Yetki Listesi</h3>
            </div>
            <div class="card-body row-list-table">
                <div class="table-responsive" style="margin-top: 4%">

                    <table class="responsive table table-hover table-bordered" id="myTab">
                        <thead class="thead-dark">
                <tr>
                    <th>Yetkiler</th>
                    <th>Seçenekler</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <a href="{{ URL::to('yonetim/permission/permissions/'.$permission->id.'/edit') }}"
                               class="btn btn-warning pull-left" style="margin-right: 3px;"><span
                                    class="fas fa-edit"></span></a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                            {!! Form::submit('Sil', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('permissions.create') }}" class="btn btn-success">Yetki Ekle</a>
   <hr> </div>


    </div></section>
@endsection
@section('footer')
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTab').DataTable({

                responsive: true,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/a5734b29083/i18n/Turkish.json"
                },
                "autoWidth": false,
                "columnDefs": [
                    { "width": "495px", "targets": 0 },
                    { "width": "100", "targets": 1 },
                ],

            });
        } );
    </script>
    @endsection
