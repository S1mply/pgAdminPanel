@extends('dashboard')

@section('content')
    <link href="{{ asset("cssjs/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Проекты</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Клиент</th>
                                <th>Метрика</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{$project->project_name}}</td>
                                    <td>{{$project->name}}</td>
                                    <td><a class="btn btn-block btn-primary" href="https://metrika.yandex.ru/dashboard?id={{$project->yandex_metrika}}">Перейти</a></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Action</button>
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                                                <th>Название</th>
                                                                <th>Клиент</th>
                                                                <th>Метрика</th>
                                                                <th>Действия</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@stop