@extends('admin.layouts.admin')

@section('title', 'Reservations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Reservations</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{-- route('admin.reservations.index') --}}">Home</a></li>
            <li class="breadcrumb-item active">Reservations</li>
        </ol>
    </div>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable ui-sortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Sales
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                     style="position: relative; height: 300px;">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="revenue-chart-canvas" height="600"
                                            style="height: 300px; display: block; width: 630px;" width="1260"
                                            class="chartjs-render-monitor"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="sales-chart-canvas" height="0"
                                            style="height: 0px; display: block; width: 0px;" width="0"
                                            class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                To Do List
                            </h3>

                            <div class="card-tools">
                                <ul class="pagination pagination-sm">
                                    <li class="page-item"><a href="#" class="page-link">«</a></li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link">»</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                                    <!-- checkbox -->
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                        <label for="todoCheck1"></label>
                                    </div>
                                    <span class="text">Design a nice theme</span>
                                    <!-- Emphasis label -->
                                    <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>
                                <li class="done">
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" name="todo2" id="todoCheck2" checked="">
                                        <label for="todoCheck2"></label>
                                    </div>
                                    <span class="text">Make the theme responsive</span>
                                    <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                                    <div class="tools">
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>
                                <li>
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" name="todo3" id="todoCheck3">
                                        <label for="todoCheck3"></label>
                                    </div>
                                    <span class="text">Let theme shine like a star</span>
                                    <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                                    <div class="tools">
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>
                                <li>
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" name="todo4" id="todoCheck4">
                                        <label for="todoCheck4"></label>
                                    </div>
                                    <span class="text">Let theme shine like a star</span>
                                    <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                                    <div class="tools">
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>
                                <li>
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" name="todo5" id="todoCheck5">
                                        <label for="todoCheck5"></label>
                                    </div>
                                    <span class="text">Check your messages and notifications</span>
                                    <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                                    <div class="tools">
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>
                                <li>
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" name="todo6" id="todoCheck6">
                                        <label for="todoCheck6"></label>
                                    </div>
                                    <span class="text">Let theme shine like a star</span>
                                    <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                                    <div class="tools">
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add
                                item
                            </button>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable ui-sortable">


                    <!-- solid sales graph -->
                    <div class="card bg-gradient-info">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="fas fa-th mr-1"></i>
                                Sales Graph
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas class="chart chartjs-render-monitor" id="line-chart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block;"
                                    width="868" height="500"></canvas>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div style="display:inline;width:60px;height:60px;">
                                        <canvas width="120" height="120" style="width: 60px; height: 60px;"></canvas>
                                        <input type="text" class="knob" data-readonly="true" value="20" data-width="60"
                                               data-height="60" data-fgcolor="#39CCCC" readonly="readonly"
                                               style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                    </div>

                                    <div class="text-white">Mail-Orders</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div style="display:inline;width:60px;height:60px;">
                                        <canvas width="120" height="120" style="width: 60px; height: 60px;"></canvas>
                                        <input type="text" class="knob" data-readonly="true" value="50" data-width="60"
                                               data-height="60" data-fgcolor="#39CCCC" readonly="readonly"
                                               style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                    </div>

                                    <div class="text-white">Online</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div style="display:inline;width:60px;height:60px;">
                                        <canvas width="120" height="120" style="width: 60px; height: 60px;"></canvas>
                                        <input type="text" class="knob" data-readonly="true" value="30" data-width="60"
                                               data-height="60" data-fgcolor="#39CCCC" readonly="readonly"
                                               style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                    </div>

                                    <div class="text-white">In-Store</div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->

                    <!-- Calendar -->
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%">
                                <div class="bootstrap-datetimepicker-widget usetwentyfour">
                                    <ul class="list-unstyled">
                                        <li class="show">
                                            <div class="datepicker">
                                                <div class="datepicker-days" style="">
                                                    <table class="table table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th class="prev" data-action="previous"><span
                                                                        class="fa fa-chevron-left"
                                                                        title="Previous Month"></span></th>
                                                            <th class="picker-switch" data-action="pickerSwitch"
                                                                colspan="5" title="Select Month">June 2025
                                                            </th>
                                                            <th class="next" data-action="next"><span
                                                                        class="fa fa-chevron-right"
                                                                        title="Next Month"></span></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="dow">Su</th>
                                                            <th class="dow">Mo</th>
                                                            <th class="dow">Tu</th>
                                                            <th class="dow">We</th>
                                                            <th class="dow">Th</th>
                                                            <th class="dow">Fr</th>
                                                            <th class="dow">Sa</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="06/01/2025"
                                                                class="day weekend">1
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/02/2025"
                                                                class="day">2
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/03/2025"
                                                                class="day">3
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/04/2025"
                                                                class="day">4
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/05/2025"
                                                                class="day">5
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/06/2025"
                                                                class="day">6
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/07/2025"
                                                                class="day weekend">7
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="06/08/2025"
                                                                class="day weekend">8
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/09/2025"
                                                                class="day">9
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/10/2025"
                                                                class="day active today">10
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/11/2025"
                                                                class="day">11
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/12/2025"
                                                                class="day">12
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/13/2025"
                                                                class="day">13
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/14/2025"
                                                                class="day weekend">14
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="06/15/2025"
                                                                class="day weekend">15
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/16/2025"
                                                                class="day">16
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/17/2025"
                                                                class="day">17
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/18/2025"
                                                                class="day">18
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/19/2025"
                                                                class="day">19
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/20/2025"
                                                                class="day">20
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/21/2025"
                                                                class="day weekend">21
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="06/22/2025"
                                                                class="day weekend">22
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/23/2025"
                                                                class="day">23
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/24/2025"
                                                                class="day">24
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/25/2025"
                                                                class="day">25
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/26/2025"
                                                                class="day">26
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/27/2025"
                                                                class="day">27
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/28/2025"
                                                                class="day weekend">28
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="06/29/2025"
                                                                class="day weekend">29
                                                            </td>
                                                            <td data-action="selectDay" data-day="06/30/2025"
                                                                class="day">30
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/01/2025"
                                                                class="day new">1
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/02/2025"
                                                                class="day new">2
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/03/2025"
                                                                class="day new">3
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/04/2025"
                                                                class="day new">4
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/05/2025"
                                                                class="day new weekend">5
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="07/06/2025"
                                                                class="day new weekend">6
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/07/2025"
                                                                class="day new">7
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/08/2025"
                                                                class="day new">8
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/09/2025"
                                                                class="day new">9
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/10/2025"
                                                                class="day new">10
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/11/2025"
                                                                class="day new">11
                                                            </td>
                                                            <td data-action="selectDay" data-day="07/12/2025"
                                                                class="day new weekend">12
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="datepicker-months" style="display: none;">
                                                    <table class="table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="prev" data-action="previous"><span
                                                                        class="fa fa-chevron-left"
                                                                        title="Previous Year"></span></th>
                                                            <th class="picker-switch" data-action="pickerSwitch"
                                                                colspan="5" title="Select Year">2025
                                                            </th>
                                                            <th class="next" data-action="next"><span
                                                                        class="fa fa-chevron-right"
                                                                        title="Next Year"></span></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="7"><span data-action="selectMonth"
                                                                                  class="month">Jan</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Feb</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Mar</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Apr</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">May</span><span
                                                                        data-action="selectMonth" class="month active">Jun</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Jul</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Aug</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Sep</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Oct</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Nov</span><span
                                                                        data-action="selectMonth"
                                                                        class="month">Dec</span></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="datepicker-years" style="display: none;">
                                                    <table class="table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="prev" data-action="previous"><span
                                                                        class="fa fa-chevron-left"
                                                                        title="Previous Decade"></span></th>
                                                            <th class="picker-switch" data-action="pickerSwitch"
                                                                colspan="5" title="Select Decade">2020-2029
                                                            </th>
                                                            <th class="next" data-action="next"><span
                                                                        class="fa fa-chevron-right"
                                                                        title="Next Decade"></span></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="7"><span data-action="selectYear"
                                                                                  class="year old">2019</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2020</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2021</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2022</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2023</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2024</span><span
                                                                        data-action="selectYear" class="year active">2025</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2026</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2027</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2028</span><span
                                                                        data-action="selectYear"
                                                                        class="year">2029</span><span
                                                                        data-action="selectYear"
                                                                        class="year old">2030</span></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="datepicker-decades" style="display: none;">
                                                    <table class="table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="prev" data-action="previous"><span
                                                                        class="fa fa-chevron-left"
                                                                        title="Previous Century"></span></th>
                                                            <th class="picker-switch" data-action="pickerSwitch"
                                                                colspan="5">2000-2090
                                                            </th>
                                                            <th class="next" data-action="next"><span
                                                                        class="fa fa-chevron-right"
                                                                        title="Next Century"></span></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="7"><span data-action="selectDecade"
                                                                                  class="decade old"
                                                                                  data-selection="2006">1990</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2006">2000</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2016">2010</span><span
                                                                        data-action="selectDecade" class="decade active"
                                                                        data-selection="2026">2020</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2036">2030</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2046">2040</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2056">2050</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2066">2060</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2076">2070</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2086">2080</span><span
                                                                        data-action="selectDecade" class="decade"
                                                                        data-selection="2096">2090</span><span
                                                                        data-action="selectDecade" class="decade old"
                                                                        data-selection="2106">2100</span></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="picker-switch accordion-toggle"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    {{--    {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection
