@extends('dashboard')

@section('content')
    <p class="project_id" style="display: none">{{$project->yandex_metrika}}</p>
    <div class="row">
        <div class="col-xs-12">
            <p style="text-align: center;font-size: 20px;">Статистика проекта <b>{{$project->project_name}}</b><br> Полная <a href="https://metrika.yandex.ru/dashboard?id={{$project->yandex_metrika}}">статистика</a></p>
            <div class="col-md-12">
                <!-- LINE CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="row" style="margin-left: 20px;">
                            <div class="btn-group" style="float: left; padding-right: 20px;">
                                <button type="button" class="btn btn-info" id="today">Сегодня</button>
                                <button type="button" class="btn btn-info" id="yesterday">Вчера</button>
                                <button type="button" class="btn btn-info" id="week">Неделя</button>
                                <button type="button" class="btn btn-info" id="month">Месяц</button>
                                <button type="button" class="btn btn-info" id="quarter">Квартал</button>
                                <button type="button" class="btn btn-info" id="year">Год</button>
                            </div>
                            <div class="input-group" style="width: 250px;">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right active" id="reservation"  placeholder="Введите дату">
                            </div>
                        </div>

                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-3">
                            <h3>Посетители</h3><br>
                            <h2 style="margin-top: -20px" id="visitors"></h2>
                        </div>
                        <div class="col-md-9">
                            <div class="chart">
                                <div class="chart" id="line-chart" style="height: 300px;"></div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-3">
                            <h3>Новые посетители</h3><br>
                            <h2 style="margin-top: -20px" id="new_visitors"></h2>
                        </div>
                        <div class="col-md-9">
                            <div class="chart">
                                <div class="chart" id="line-chart2" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <p><h4>Адрес страницы</h4></p>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th width="420">Адрес страницы</th>
                                        <th>Просмотры</th>
                                    </tr>
                                </thead>
                                <tbody id="entrance">
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <p><h4>Последняя поисковая фраза</h4></p>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <table>
                                <thead>
                                <tr>
                                    <th width="420">Последняя поисковая фраза</th>
                                    <th>Визиты</th>
                                </tr>
                                </thead>
                                <tbody id="phrases">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="box-body">
                                <div class="col-md-4">
                                    <h3>Отказы</h3><br>
                                    <h2 style="margin-top: -20px" id="denial"></h2>
                                </div>
                                <div class="col-md-8">
                                    <div class="chart">
                                        <div class="chart" id="line-chart3" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="box-body">
                                <div class="col-md-4">
                                    <h3>Время на сайте</h3><br>
                                    <h2 style="margin-top: -20px" id="visit_time"></h2>
                                </div>
                                <div class="col-md-8">
                                    <div class="chart">
                                        <div class="chart" id="line-chart4" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="box-body">
                                <div class="col-md-4">
                                    <h3>Глубина просмотра</h3><br>
                                    <h2 style="margin-top: -20px" id="depth"></h2>
                                </div>
                                <div class="col-md-8">
                                    <div class="chart">
                                        <div class="chart" id="line-chart5" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div><!--
            <div class="col-md-12">

                    <div class="col-md-4">
                        <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Источник трафика</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart" style="height: 100px;"></canvas>
                            <div style="margin: 0 auto">
                                <ul style="margin: 0 auto; width:300px;margin-top: 40px;">
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы по рекламе</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Прямые заходы</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы из поисковых систем</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Внутренние переходы</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы по ссылкам на сайтах</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-md-4">
                        <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Тип устройства</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart2" style="height: 100px;"></canvas><br><br>
                            <div style="margin: 0 auto">
                                <ul style="margin: 0 auto; width:300px;margin-top: 40px;">
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы по рекламе</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Прямые заходы</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы из поисковых систем</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Внутренние переходы</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы по ссылкам на сайтах</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-md-4">
                        <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Возраст</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart3" style="height: 100px;"></canvas><br><br>
                            <div style="margin: 0 auto">
                                <ul style="margin: 0 auto; width:300px;margin-top: 40px;">
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы по рекламе</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Прямые заходы</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы из поисковых систем</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Внутренние переходы</p></li>
                                    <li style="list-style-type: none;"><div id="circle" style="background-color: red;width: 10px;height: 10px;border-radius:10px;float: left;margin-top: 5px;"></div><p style="margin-left: 15px;">Переходы по ссылкам на сайтах</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>

    </div>






    <script src="{{ asset("cssjs/project_state.js")}}" type="text/javascript"></script>

@stop