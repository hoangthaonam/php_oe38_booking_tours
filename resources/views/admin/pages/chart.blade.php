@extends('admin.layouts.master')
@section('title')
{{trans('language.list_tour')}}
@endsection

@section('content')
<figure class="highcharts-figure">
    <h1>{{trans('language.chart_by_month')}}</h1>
    <input type="hidden" id="payments_month" value="{{json_encode($payments_month)}}">
    <div id="chartByMonth"></div>
    <p class="highcharts-description">{{trans('language.chart_month_des')}}</p>
</figure>
<figure class="highcharts-figure">
    <h1>{{trans('language.chart_by_year')}}</h1>
    <input type="hidden" id="payments_year" value="{{json_encode($payments_year)}}">
    <div id="chartByYear"></div>
    <p class="highcharts-description">{{trans('language.chart_year_des')}}</p>
</figure>

@endsection
