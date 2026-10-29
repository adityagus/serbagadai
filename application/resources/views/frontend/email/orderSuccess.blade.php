@extends('frontend.layouts.email')

@section('content')
<tr>
    <td  class="main-header" style="color: #484848; font-size: 14px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
        Tagihan Pembayaran <b>{{strtoupper($order->code)}}</b>
    </td>
</tr>
<tr><td height="10"></td></tr>
<tr>
    <td  class="main-subheader" style="color: #484848; font-size: 12px; line-height:20px; font-family: Helvetica, Arial, sans-serif; text-align:justify;">
        Hai <b>{{ucwords($order->user->name)}}</b>,Terima kasih telah melakukan pemesanan di <b>{{$CONF->title}}</b>. Mohon segera lakukan pembayaran sebelum:
        <table class="nav" align="center" border="0" cellpadding="0" cellspacing="2" style="background-color:#eee; padding:20px; margin-top:20px;">
            <tbody>
                <tr>
                    <td> {{date('l, d F Y (H:i)',strtotime($order->expired_at))}}</td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: center">Lakukan Pembayaran Sebesar</p>
        <h1 style="text-align: center">Rp. <span style="background-color: #e1e1e1">{{number_format($order->totalPrice)}}</span></h1>
        <p style="text-align: center"><b>Tepat</b> hingga 3 <b>digit terakhir</b></p>
    </td>
</tr>
<tr><td height="20"></td></tr>
<tr>
    <td align="center">
        Pembayaran dapat dilakukan pada salah satu rekening a/n {{$CONF->title}} berikut:
        <table style="margin-top:10px;width: 100%">
            <tr style="background-color:#eee;">
                <th style="text-align: center">Bank</th>
                <th style="text-align: center">Rekening</th>
                <th style="text-align: center">A/N</th>
            </tr>
            @foreach(json_decode($CONF->bank) as $bank)
            <tr>
                <td style="text-align: center">{{ucwords($bank->bank)}}</td>
                <td style="text-align: center">{{ucwords($bank->number)}}</td>
                <td style="text-align: center">{{ucwords($bank->account)}}</td>
            </tr>
            @endforeach
        </table>
    </td>
</tr>
<tr><td height="20"></td></tr>
<tr>
    <td align="center">
        Setelah melakukan pembayaran silakan lakukan konfirmasi dibawah ini :
    </td>
</tr>
<tr><td height="30"></td></tr>
<tr>
    <td align="center">
        <a href="{{url('confirm/'.$order->code)}}" style="background-color: #7087A3;text-align: center; font-size: 12px; padding: 15px 30px; color: #fff; text-decoration: none"> Konfirmasi </a>
        <a href="{{url('order-download/'.$order->id)}}" style="background-color: #7087A3;text-align: center; font-size: 12px; padding: 15px 30px; color: #fff; text-decoration: none"> Download </a>
    </td>
</tr>
<tr><td height="30"></td></tr>
<tr>
    <td>
        Berikut penjelasan detail tagihan pembayaran:
        <table style="margin-top:10px;width: 100%">
            <tr style="background-color:#eee;">
                <th style="text-align: left">Tanggal Pemesanan</th>
                <td>{{date('l, d F Y (H:i)',strtotime($order->created_at))}}</td>
            </tr>
            <tr style="background-color:#eee;">
                <th style="text-align: left">Pengiriman</th>
                <td>{{$order->shippingType.' - '.$order->shippingMethod}}</td>
            </tr>
            <tr style="background-color:#eee;">
                <th style="text-align: left">Subtotal</th>
                <td>Rp. {{number_format($order->amount)}}</td>
            </tr>
            <tr style="background-color:#eee;">
                <th style="text-align: left">Shipping</th>
                <td>Rp. {{number_format($order->shippingFee)}}</td>
            </tr>
            <tr style="background-color:#eee;">
                <th style="text-align: left">Unique Code</th>
                <td>Rp. {{number_format($order->uniquePrice)}}</td>
            </tr>
            <tr style="background-color:#eee;">
                <th style="text-align: left">Total</th>
                <td>Rp. {{number_format($order->totalPrice)}}</td>
            </tr>
        </table>
    </td>
</tr>
<tr><td height="30"></td></tr>
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
@endsection
