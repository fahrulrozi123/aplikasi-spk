@extends('templates/template')
@section("header_title") ALLOTMENT REPORT @endsection
@section('content')

{{-- FOR EXPORT PURPOSE --}}
<div style='display:none'>
    <img id='imgToExport' src="{{asset('/images/sidebar.png')}}" />
</div>
{{-- FOR EXPORT PURPOSE --}}
<form id="export_excel" action="{{route('reservation.allotment_export_excel')}}" method="post" target="_blank">
    {{ csrf_field() }}
    <input type="hidden" name="allotment_data" id="allotment_data">
</form>
<div class="col-lg-12">
    <div id="room_chart" style="display:none;">

    </div><br>
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label for="field-1" class="control-label">Report Period</label>
                <div class="input-group">
                    <input type="text" class="form-control borderlight" id="report_period" name="report_period"
                        readonly>
                    <span class="input-group-addon borderlight darkfont"><i class="entypo-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 25px">
            <input type="hidden" id="date_start" name="date_start" value="0">
            <input type="hidden" id="date_end" name="date_end" value="0">
            <button onclick="savePDF();" type="button" class="btn btn-horison-gold ">
                <i class="fa fa-file-pdf-o"></i>&ensp;Export to PDF
            </button>
            <button onclick="saveExcel();" type="button" class="btn btn-horison-gold ">
                <i class="fa fa-file-pdf-o"></i>&ensp;Export to Excel
            </button>
        </div>
    </div>

    <hr><br>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary panel-shadow" data-collapsed="0">

                <!-- panel body -->
                <div class="panel-body shadow" id="data_append">

                    <div class="form-group">
                        <h2><b>December 2019</b></h2>
                        <p>Total opened allotment : 200</p>
                        <p class="mt-1-5">Total available allotment : 150</p>

                        <div>
                            <table class="table table-striped table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th class="horisonth">Room Type</th>
                                        <th class="horisonth">1</th>
                                        <th class="horisonth">2</th>
                                        <th class="horisonth">3</th>
                                        <th class="horisonth">4</th>
                                        <th class="horisonth">5</th>
                                        <th class="horisonth">6</th>
                                        <th class="horisonth">7</th>
                                        <th class="horisonth">8</th>
                                        <th class="horisonth">9</th>
                                        <th class="horisonth">10</th>
                                        <th class="horisonth">11</th>
                                        <th class="horisonth">12</th>
                                        <th class="horisonth">13</th>
                                        <th class="horisonth">14</th>
                                        <th class="horisonth">15</th>
                                        <th class="horisonth">16</th>
                                        <th class="horisonth">17</th>
                                        <th class="horisonth">18</th>
                                        <th class="horisonth">19</th>
                                        <th class="horisonth">20</th>
                                        <th class="horisonth">21</th>
                                        <th class="horisonth">22</th>
                                        <th class="horisonth">23</th>
                                        <th class="horisonth">24</th>
                                        <th class="horisonth">25</th>
                                        <th class="horisonth">26</th>
                                        <th class="horisonth">27</th>
                                        <th class="horisonth">28</th>
                                        <th class="horisonth">29</th>
                                        <th class="horisonth">30</th>
                                        <th class="horisonth">31</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Bussines</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Mountain</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Recreational</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="form-group">
                        <h2><b>January 2020</b></h2>
                        <p>Total opened allotment : 200</p>
                        <p class="mt-1-5">Total available allotment : 150</p>

                        <div style="overflow-x:auto;">
                            <table class="table table-striped table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th class="horisonth">Room Type</th>
                                        <th class="horisonth">1</th>
                                        <th class="horisonth">2</th>
                                        <th class="horisonth">3</th>
                                        <th class="horisonth">4</th>
                                        <th class="horisonth">5</th>
                                        <th class="horisonth">6</th>
                                        <th class="horisonth">7</th>
                                        <th class="horisonth">8</th>
                                        <th class="horisonth">9</th>
                                        <th class="horisonth">10</th>
                                        <th class="horisonth">11</th>
                                        <th class="horisonth">12</th>
                                        <th class="horisonth">13</th>
                                        <th class="horisonth">14</th>
                                        <th class="horisonth">15</th>
                                        <th class="horisonth">16</th>
                                        <th class="horisonth">17</th>
                                        <th class="horisonth">18</th>
                                        <th class="horisonth">19</th>
                                        <th class="horisonth">20</th>
                                        <th class="horisonth">21</th>
                                        <th class="horisonth">22</th>
                                        <th class="horisonth">23</th>
                                        <th class="horisonth">24</th>
                                        <th class="horisonth">25</th>
                                        <th class="horisonth">26</th>
                                        <th class="horisonth">27</th>
                                        <th class="horisonth">28</th>
                                        <th class="horisonth">29</th>
                                        <th class="horisonth">30</th>
                                        <th class="horisonth">31</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Bussines</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Mountain</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Recreational</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="form-group">
                        <h2><b>February 2020</b></h2>
                        <p>Total opened allotment : 200</p>
                        <p class="mt-1-5">Total available allotment : 150</p>

                        <div style="overflow-x:auto;">
                            <table class="table table-striped table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th class="horisonth">Room Type</th>
                                        <th class="horisonth">1</th>
                                        <th class="horisonth">2</th>
                                        <th class="horisonth">3</th>
                                        <th class="horisonth">4</th>
                                        <th class="horisonth">5</th>
                                        <th class="horisonth">6</th>
                                        <th class="horisonth">7</th>
                                        <th class="horisonth">8</th>
                                        <th class="horisonth">9</th>
                                        <th class="horisonth">10</th>
                                        <th class="horisonth">11</th>
                                        <th class="horisonth">12</th>
                                        <th class="horisonth">13</th>
                                        <th class="horisonth">14</th>
                                        <th class="horisonth">15</th>
                                        <th class="horisonth">16</th>
                                        <th class="horisonth">17</th>
                                        <th class="horisonth">18</th>
                                        <th class="horisonth">19</th>
                                        <th class="horisonth">20</th>
                                        <th class="horisonth">21</th>
                                        <th class="horisonth">22</th>
                                        <th class="horisonth">23</th>
                                        <th class="horisonth">24</th>
                                        <th class="horisonth">25</th>
                                        <th class="horisonth">26</th>
                                        <th class="horisonth">27</th>
                                        <th class="horisonth">28</th>
                                        <th class="horisonth">29</th>
                                        <th class="horisonth">30</th>
                                        <th class="horisonth">31</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Bussines</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Mountain</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">Deluxe Recreational</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                        <td style="vertical-align:middle" align="center">1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>


</div>

{{-- SCRIPT PDF --}}
<script type="text/javascript">
    var start, end, days, last_month;
    const months = ["January", "February", "March", "April", "May",
        "June", "July", "August", "September", "October", "November", "December"
    ];



    var allotment_data;
    var allotment_total = [];

    var allotment_table = [];

    function get_data(start_date = null, end_date = null) {

        allotment_data = $.ajax({
            type: 'GET',
            url: "{{route('allotment.report_data')}}",
            async: false,
            dataType: 'json',
            data: {
                "start_date": start_date,
                "end_date": end_date
            },
            done: function (results) {

                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;
    }

    function set_all_data() {
        var master_group = [];
        allotment_table = [];
        var dayOne = new Date(start);
        var oneDay = 1000 * 60 * 60 * 24;
        var first = true;
        for (i = 0; i <= days; i++) {
            var nowDay = oneDay * i;
            var dayDate = new Date(dayOne.getTime() + nowDay);
            var dayString = moment(dayDate).format("YYYY-MM-DD");
            var room_index = [];

            if (allotment_table[dayDate.getFullYear()] == null) {
                allotment_table[dayDate.getFullYear()] = [];
                allotment_table[dayDate.getFullYear()]['year'] = dayDate.getFullYear();
                allotment_table[dayDate.getFullYear()]['data'] = [];
            }
            if (allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()] == null) {
                allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()] = [];
                allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['month'] = months[dayDate
                    .getMonth()];
                allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'] = [];
            }
            allotment_data.some(element => {
            var cek = false;

                if (!room_index.includes(element.id)) {
                    room_index.push(element.id);
                }

                if (allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][room_index
                        .indexOf(element.id)
                    ] == null) {
                    allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][room_index
                        .indexOf(element.id)
                    ] = [];
                    allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][room_index
                        .indexOf(element.id)
                    ][
                        'name'
                    ] = element.room_name;
                    allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][room_index
                        .indexOf(element.id)
                    ][
                        'data'
                    ] = [];
                }
                allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][
                    room_index.indexOf(element.id)
                ]['data'][dayDate.getDate()] = [];

                element['allotment'].some(allotment => {

                    if (allotment.allotment_date == dayString) {

                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][
                            room_index.indexOf(element.id)
                        ]['data'][dayDate.getDate()]['date'] = allotment.allotment_date;
                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][
                            room_index.indexOf(element.id)
                        ]['data'][dayDate.getDate()]['opening'] = allotment.allotment_room;
                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][
                                room_index.indexOf(element.id)
                            ]['data'][dayDate.getDate()]['remaining'] = allotment
                            .remaining_allotment;
                        cek = true;
                        return true;
                    }
                });

                if (!cek || (cek && element['allotment'].length == 0)) {
                    var roomDate = new Date();
                    if(element.room_future_availability > 0){
                        roomDate = roomDate.setMonth(roomDate.getMonth() + element.room_future_availability);
                        roomDate = new Date(roomDate);
                    }


                    if(dayDate < roomDate && element.room_future_availability > 0){
                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data']
                        [room_index.indexOf(element.id)]['data'][dayDate.getDate()]['date'] = dayString;
                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][room_index
                            .indexOf(element.id)
                        ][
                            'data'
                        ][dayDate.getDate()]['opening'] = element.room_allotment;
                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][room_index
                            .indexOf(element.id)
                        ][
                            'data'
                        ][dayDate.getDate()]['remaining'] = element.room_allotment;
                    }else{
                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data']
                        [room_index.indexOf(element.id)]['data'][dayDate.getDate()]['date'] = dayString;
                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][room_index
                            .indexOf(element.id)
                        ][
                            'data'
                        ][dayDate.getDate()]['opening'] = 0;
                        allotment_table[dayDate.getFullYear()]['data'][dayDate.getMonth()]['data'][room_index
                            .indexOf(element.id)
                        ][
                            'data'
                        ][dayDate.getDate()]['remaining'] = 0;
                    }



                }
            });
        }


        var html = '';

        allotment_table.forEach(year => {
            year['data'].forEach(month => {
                var thead = '';
                var tbody = '';
                var table_body = '<tbody>';
                var form_group = '<div class="form-group">' +
                    '<h2><b>' + month.month + ' ' + year.year + '</b></h2>';
                var table_head = '<div style="overflow-x:auto;">' +
                    '<table class="table table-striped table-bordered" >' +
                    '<thead>' +
                    '<tr>';
                var first_child1 = true;
                var insert_head = true;
                var opening_allotment = 0;
                var remaining_alltoment = 0;
                month['data'].forEach(room => {
                    var first_child2 = true;
                    room['data'].forEach(function (allotment, index) {
                        if (first_child1) {
                            thead = '<th class="horisonth">Room Type</th>';
                            thead += '<th class="horisonth">' + (index++) + '</th>';
                            first_child1 = false;
                        } else {
                            thead += '<th class="horisonth">' + (index++) + '</th>';
                        }
                        if (first_child2) {
                            tbody =
                                '<tr class="horisontd"><td style="vertical-align:middle" align="center">' +
                                room['name'] + '</td>';
                            first_child2 = false;
                        }
                        tbody +=
                            '<td style="vertical-align:middle" align="center">' +
                            allotment['remaining'] + '</td>';
                        opening_allotment += parseInt(allotment['opening']);
                        remaining_alltoment += parseInt(allotment['remaining']);
                    });
                    if (insert_head) {
                        thead += '</tr></thead>';
                        table_head += thead;
                        insert_head = false;
                    }
                    tbody += '</tr>';
                    table_body += tbody;
                });
                table_body += '</tbody>';
                form_group += '<p>Total opened allotment : ' + opening_allotment + '</p>';
                form_group += '<p class="mt-1-5">Total available allotment : ' +
                    remaining_alltoment + '</p>';
                form_group += table_head;
                form_group += table_body;
                form_group += '</table>';
                form_group += '</div></div>';
                html += form_group;
            });
        });
        $('#data_append').empty();

        $('#data_append').append(html);
        initialize_datatable();


    }

    jQuery(document).ready(function ($) {

        //to set 1 month data for this month
        var startDay = new Date();
        var start_date = new Date(startDay.getFullYear(), startDay.getMonth(), 1);
        var end_date = new Date(startDay.getFullYear(), startDay.getMonth() + 1, 0);
        checking = moment(new Date()).format("YYYY/MM/DD");


        // To calculate the time difference of two dates
        var Difference_In_Time = end_date - start_date;
        // To calculate the no. of days between two dates

        days = Math.floor(Difference_In_Time / (1000 * 3600 * 24));

        $('#date_start').val(moment(start_date).format('DD MMMM YYYY'));
        $('#date_end').val(moment(end_date).format('DD MMMM YYYY'));
        start_date = moment(start_date).format("YYYY/MM/DD");
        end_date = moment(end_date).format("YYYY/MM/DD");
        start = start_date;

        //Initialize datepicker
        var picker = new Litepicker({
            firstDay: 1,
            format: "DD MMMM YYYY",
            lang: 'en-US',
            numberOfMonths: 2,
            numberOfColumns: 2,
            autoApply: true,
            showTooltip: true,
            singleMode: false,
            moduleRanges: true,
            element: document.getElementById('report_period'),
            onSelect: function (date1, date2) {

                var startDay = new Date(date1);
                start = startDay;
                end = new Date(date2);
                // To calculate the time difference of two dates
                var Difference_In_Time = end - start;
                // To calculate the no. of days between two dates

                days = Math.floor(Difference_In_Time / (1000 * 3600 * 24));

                $('#date_start').val(moment(start).format('DD MMMM YYYY'));
                $('#date_end').val(moment(end).format('DD MMMM YYYY'));
                start = moment(start).format("YYYY/MM/DD");
                end = moment(end).format("YYYY/MM/DD");

                $(".se-pre-con").fadeIn("fast");

                get_data(start, end);
                set_all_data();

                $(".se-pre-con").fadeOut("fast");


            }
        });

        //set datepicker value
        picker.setDateRange(start_date, end_date);

        $(".se-pre-con").fadeIn("fast");

        get_data(start_date, end_date);
        set_all_data();

        $(".se-pre-con").fadeOut("fast");
    });
    var RoomPie = am4core.create("room_chart", am4charts.PieChart3D);

    function initialize_datatable() {
        // Initialize DataTable
        $('.table').DataTable({
            dom: 'lBfrtip',
            "ordering": false,
            buttons: [
                'excelHtml5',
            ],
            "aLengthMenu": [
                [5, 10, -1],
                [5, 10, 50]
            ],
            "bStateSave": true
        });
    }

    function savePDF() {
        $(".se-pre-con").fadeIn("fast");
        var imgToExport = document.getElementById('imgToExport');
        var canvas = document.createElement('canvas');
        canvas.width = imgToExport.width;
        canvas.height = imgToExport.height;
        canvas.getContext('2d').drawImage(imgToExport, 0, 0);
        var logoUrl = canvas.toDataURL('image/png');

        var StartDate = $('#date_start').val();
        var EndDate = $('#date_end').val();
        if (StartDate == EndDate) {
            var period = "Until " + StartDate;
        } else {
            var period = StartDate + " - " + EndDate;
        }

        var master = [];
        var head = [];
        var table = [];
        var table_body = [];
        var twidth = [];
        var thead = [];
        var tbody = [];
        allotment_table.forEach(year => {
            year['data'].forEach(month => {
                head = [];
                table = [];
                twidth = [];
                table_body = [];
                thead = [];
                tbody = [];
                var insert_head = true;

                head.push({
                    text: month.month + " " + year.year,
                    bold: true,
                    fontSize: 17,
                    color: '#333333',
                    margin: [0, 7, 0, 17]
                });

                var first_child1 = true;
                // var insert_head = true;
                var opening_allotment = 0;
                var remaining_alltoment = 0;
                month['data'].forEach(room => {
                    var first_child2 = true;
                    var temp_body = [];
                    room['data'].forEach(function (allotment, index) {
                        if (first_child1) {
                            twidth.push("20%");
                            thead.push({
                                text: 'Room Type',
                                bold: true,
                                fontSize: 8,
                                fillColor: '#F2F2F2',
                                alignment: 'center',
                                margin: [0, 6, 0, 6]
                            });
                            first_child1 = false;
                        }
                        if (insert_head) {
                            twidth.push("2.5%");
                            thead.push({
                                text: index,
                                bold: true,
                                fontSize: 8,
                                fillColor: '#F2F2F2',
                                alignment: 'center',
                                margin: [0, 5, 0, 5]
                            });
                        }

                        if (first_child2) {
                            temp_body.push({
                                text: room['name'],
                                fontSize: 8,
                                alignment: 'center',
                                margin: [0, 6, 0, 6]
                            });
                            first_child2 = false;
                        }
                        temp_body.push({
                            text: allotment['remaining'],
                            fontSize: 7,
                            alignment: 'center',
                            margin: [0, 5, 0, 5]
                        });

                        opening_allotment += parseInt(allotment['opening']);
                        remaining_alltoment += parseInt(allotment['remaining']);
                    });
                    if (insert_head) {

                        table_body.push(thead);
                        insert_head = false;
                    }

                    table_body.push(temp_body);
                });
                head.push({
                    text: "Total opened allotment : " + opening_allotment,
                    fontSize: 10,
                    color: '#333333',
                    margin: [0, 0, 0, 17]
                }, {
                    text: "Total available allotment : " + remaining_alltoment,
                    fontSize: 10,
                    color: '#333333',
                    margin: [0, -15, 0, 17]
                }, {
                    table: {
                        headerRows: 1,
                        widths: twidth,
                        body: table_body
                    }
                });
                master.push(head);
            });
        });

        Promise.all([
            RoomPie.exporting.pdfmake,
            // RoomPie.exporting.getImage("png"),
            // ProductPie.exporting.getImage("png")
        ]).then(function (res) {
            var pdfMake = res[0];


            // pdfmake is ready
            // Create document template
            var doc = {
                pageSize: "A4",
                pageOrientation: "landscape",
                pageMargins: [30, 95, 30, 30],
                header: {
                    margin: [30, 30, 30, 30],
                    columns: [{
                            // usually you would use a dataUri instead of the name for client-side printing
                            // sampleImage.jpg however works inside playground so you can play with it
                            image: logoUrl,
                            // text: "Logo",
                            width: 150
                        },
                        {
                            stack: [
                                // second column consists of paragraphs
                                {
                                    text: 'HORISON AVAILABLE ALLOTMENT REPORT',
                                    fontSize: 17,
                                    bold: true,
                                    color: '#333333',
                                    margin: [10, 5, 0, 6]
                                },
                                {
                                    text: "Report Period: " + period + "",
                                    fontSize: 10,
                                    color: '#333333',
                                    margin: [10, 0, 0, 0]
                                },
                            ],
                        },
                    ]
                },
                footer: {
                    margin: [10, 10, 10, 10],
                    columns: [{
                        // usually you would use a dataUri instead of the name for client-side printing
                        // sampleImage.jpg however works inside playground so you can play with it
                        // image: logoUrl,
                        text: 'Generated in ' + moment(new Date()).format('LLLL'),
                        fontSize: 8,
                        bold: true,
                        color: '#333333',
                        alignment: 'right',
                        margin: [0, 0, 0, 0]
                    }, ],
                    // optional space between columns
                    columnGap: 20
                },
                content: []
            };

            doc.content.push(master);

            // pdfMake.createPdf(doc).open();
            pdfMake.createPdf(doc).download("report-" + period + ".pdf");
            $(".se-pre-con").fadeOut("fast");


        });
    }

    function saveExcel() {
        var array_data = [];
        var yearIndex = 0;
        allotment_table.forEach(year =>{
            var monthIndex = 0;
            var temp = {
                'year': year.year,
                'data': []
            };
            array_data.push(temp);

            year['data'].forEach(month =>{
                var roomIndex = 0;

                var temp = {
                    'month': month.month,
                    'opening_allotment':0,
                    'remaining_allotment':0,
                    'data':[]
                };

                array_data[yearIndex]['data'].push(temp);
                month['data'].forEach(room =>{
                    var first_child2 = true;
                    var temp = {
                    'name': room.name,
                    'data':[]
                    };
                    array_data[yearIndex]['data'][monthIndex]['data'].push(temp);

                    room['data'].forEach(function (allotment, index) {
                        index--;

                        array_data[yearIndex]['data'][monthIndex]['data'][roomIndex]['data'][index] = allotment['remaining'] ;
                        array_data[yearIndex]['data'][monthIndex]['opening_allotment'] += parseInt(allotment['opening']);
                        array_data[yearIndex]['data'][monthIndex]['remaining_allotment'] += parseInt(allotment['remaining']);
                    });
                    roomIndex++;
                });
                monthIndex++;
            });
            yearIndex++;
        });

        $('#allotment_data').val(JSON.stringify(array_data));
        $('#export_excel').submit();

    }

</script>


@endsection
