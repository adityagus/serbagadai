@extends('frontend.layouts.email')

@section('content')
    <tr>
        <td  class="main-header" style="color: #484848; font-size: 14px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
            Pengiriman Pesanan <b>{{strtoupper($order->code)}}</b>
        </td>
    </tr>
    <tr><td height="10"></td></tr>
    <tr>
        <td>
            Pesanan dalam proses pengiriman, berikut detail pengiriman:
            <table style="margin-top:10px;width: 100%">
                <tr style="background-color:#eee;">
                    <th style="text-align: left">Jenis Pengiriman</th>
                    <td>{{$order->shippingType.' - '.$order->shippingMethod}}</td>
                </tr>
            </table>
            <table style="margin-top:10px;width: 100%">
                <tr>
                    <td>
                        <b>Alamat tujuan pengiriman</b>
                        <br>
                        {{ucwords($order->user->name)}}
                        <br>
                        {{$order->orderAddress->address}}
                        <br>
                        {{$order->orderAddress->kecamatan->nama}}
                        <br>
                        {{$order->orderAddress->kabupaten->nama.' - '.$order->orderAddress->provinsi->nama.' ( '.$order->orderAddress->postcode.' )'}}
                        <br>
                        {{$order->user->phone}}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
