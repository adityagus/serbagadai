@extends('frontend.layouts.email')

@section('content')
    <tr>
        <td  class="main-header" style="color: #484848; font-size: 14px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
            Konfirmasi Pembayaran <b>{{strtoupper($order->code)}}</b>
        </td>
    </tr>
    <tr><td height="10"></td></tr>
    <tr>
        <td>
            Terima kasih telah melakukan konfirmasi pembayaran, berikut ini detail konfirmasi pesanan:
            <table style="margin-top:10px;width: 100%">
                <tr style="background-color:#eee;">
                    <th style="text-align: left">Tanggal Konfirmasi</th>
                    <td>{{date('l, d F Y',strtotime($order->orderConfirmation->first()->confirmationDate))}}</td>
                </tr>
                <tr style="background-color:#eee;">
                    <th style="text-align: left">Nama Rekening</th>
                    <td>{{$order->orderConfirmation->first()->name}}</td>
                </tr>
                <tr style="background-color:#eee;">
                    <th style="text-align: left">Nomor Rekening</th>
                    <td>{{$order->orderConfirmation->first()->accountNumber}}</td>
                </tr>
                <tr style="background-color:#eee;">
                    <th style="text-align: left">Nama Bank</th>
                    <td>{{$order->orderConfirmation->first()->bankName}}</td>
                </tr>
                <tr style="background-color:#eee;">
                    <th style="text-align: left">Jumlah Pembayaran</th>
                    <td>Rp. {{number_format($order->orderConfirmation->first()->amount)}}</td>
                </tr>
                <tr style="background-color:#eee;">
                    <th style="text-align: left">Bukti Bayar</th>
                    <td><a href="{{url('storage/'.$order->orderConfirmation->first()->image)}}" target="_blank">Lihat</a></td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
