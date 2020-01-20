@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid" >
            <h2 class="no-margin-bottom"  id="h2" style="margin-left: 2%" >&nbsp; Yetki Rol</h2>
        </div>
    </header>
    @if(Session::has('success'))
        <div class="alert alert-success jquery-error-alert">
            <ul>
                <li>{{Session::get('success')}}</li>
            </ul>
        </div>

    @elseif(Session::has('errors'))
        <div class="alert alert-danger jquery-error-alert">
            <ul>
                <li>{{Session::get('errors')}}</li>
            </ul>
        </div>
    @endif
    <style>
        table td{
            background-color: white;
        }
    </style>
    <section class="animated fadeIn">

        <div class="card" style="background-color: white" id="deneme">




       <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roller</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Yetkiler</a></h1>


            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Kullanıcı Listesi</h3>
            </div>
            <div class="card-body row-list-table">
                <div class="table-responsive" style="margin-top: 4%">

                    <table class="responsive table table-hover table-bordered" id="myTab">
                        <thead class="thead-dark">
                <tr>
                    <th>Ad Soyad</th>
                    <th>Email</th>
                    <th>Kayıt Zamanı</th>
                    <th>Kullanıcı Rolü</th>
                    <th style="width: 19%">Seçenekler</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($users as $user)
                    <tr>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at}}</td>
                        <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning pull-left" style="margin-right: 3px;"><span
                                    class="fas fa-edit"></span></a>

                            <button class="btn btn-xl btn-danger" data-placement="top" title="Sil"
                                    onclick="user_delete({{$user->id}})"><span
                                    class="fa fa-trash"></span>
                            </button>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
            </div>

@can('kullanici-ekle')
        <a href="{{ route('users.create') }}" class="btn btn-primary">Kullanıcı Ekle</a>
@endcan
   <br><hr> </div>
  <hr>
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

                responsive: true,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/a5734b29083/i18n/Turkish.json"
                }
            });
        } );
        function user_delete(data_id) {

            $.confirm({

                type: 'red',
                typeAnimated: true,
                icon: 'fa fa-trash',
                title: 'Uyarı!',
                content: 'Kullanıcıyı silmek istiyor musunuz?',

                buttons: {
                    formSubmit: {
                        text: 'Sil',
                        btnClass: 'btn-red',
                        action: function () {

                            var name = this.$content.find('.name').val();
                            var tid = data_id;
                            var ajaxurl = "{{url('/yonetim/permission/users/delete')}}";
                            var token = ' {{csrf_token()}}';
                            console.log(ajaxurl);
                            $.post(ajaxurl, {
                                _token: token,
                                tid: tid
                            }, function (ret) {

                                if (ret == 1) {

                                    $.confirm({
                                        title: 'Bilgi',

                                        type: 'red',
                                        icon: 'fa fa-info-circle',
                                        content: 'Kullanıcı silindi!',
                                        buttons: {
                                            formSubmit: {
                                                text: 'Tamam',
                                                btnClass: 'btn-red',

                                                action: function () {
                                                    window.location.reload()
                                                }
                                            },

                                        },
                                    });


                                } else {
                                    $.alert("Ters giden bir şey oldu. Lütfen tekrar deneyin.")
                                }
                            });

                        }

                    },
                    İptal: function () {
                        //close

                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });

                }

            });

        }
    </script>
    @endsection
