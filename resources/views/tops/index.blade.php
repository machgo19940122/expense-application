
@extends('common/header_side') 
@section('index')

<div class="main">
    {!! $calendar !!}
    <div class="total-data"> {{ $monthTotal[0]->sum_expense }} 件  合計 {{ number_format($monthAmount[0]->sum_expense) }} 円</div>
</div>

@endsection