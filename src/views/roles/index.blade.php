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
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Yetkiler</a></h1>




                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Rol Listesi</h3>
                </div>
            <div class="card-body row-list-table">
                <div class="table-responsive" style="margin-top: 4%">

                    <table class="responsive table table-hover table-bordered" id="myTab">
                        <thead class="thead-dark">
                            <tr>
                                <th>Rol</th>
                                <th>Yetkiler</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($roles as $role)
                                <tr>

                                    <td>{{ $role->name }}</td>

                                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                    <td>
                                        <a href="{{ URL::to('yonetim/permission/roles/'.$role->id.'/edit') }}"
                                           class="btn btn-warning"><span class="fas fa-edit"></span></a>



                                    </td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                        {!! Form::submit('Sil', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>


                    <a href="{{ route('roles.create') }}" class="btn btn-primary">Rol Ekle</a>

                    <hr>
                </div>
            </div>

    </section>


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

                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/a5734b29083/i18n/Turkish.json"
                },
           responsive: true,

            });
        } );
    </script>
    @endsection
