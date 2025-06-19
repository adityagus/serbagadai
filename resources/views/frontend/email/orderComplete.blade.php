@extends('frontend.layouts.email')

@section('content')
    <tr>
        <td  class="main-header" style="color: #484848; font-size: 14px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
            Pesanan Selesai <b>{{strtoupper($order->code)}}</b>
        </td>
    </tr>
    <tr><td height="10"></td></tr>
    <tr>
        <td>
            Terima kasih telah melakukan transaksi di <b>{{$CONF->title}}</b>. Kami berharap anda senang selama bertransaksi dengan kami,
            jika ada saran, pertanyaan silahkan klik di <a href="{{url('contact')}}">disini</a>.
        </td>
    </tr>
    <tr><td height="20"></td></tr>
    <tr>
        <td align="center">
             Mari belanja lagi:
        </td>
    </tr>
    <tr><td height="30"></td></tr>
    <tr>
        <td align="center">
            <a href="{{url('/')}}" style="background-color: #7087A3;text-align: center; font-size: 12px; padding: 15px 30px; color: #fff; text-decoration: none"> {{$CONF->title}} </a>
        </td>
    </tr>
@endsection
