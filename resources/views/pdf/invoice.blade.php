@extends('pdf.template')

@section('content')
    <table>
        <tr>
            <td  class="main-header" style="color: #484848; font-size: 14px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                Informasi pesanan <b>{{strtoupper(@$order->code)}}</b>, berikut penjelasan detail pesanan:
            </td>
        </tr>
        <tr>
            <td>
                <b>Detil Pesanan</b>
                <table style="margin-top:10px;width: 100%">
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Tanggal Pemesanan</th>
                        <td>{{date('l, d F Y (H:i)',strtotime(@$order->created_at))}}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Pemesan</th>
                        <td>{{ ucwords(@$order->member->name . ' ('.@$order->member->phone.')') }}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Biaya Desain</th>
                        <td>Rp {{number_format(@$order->design_fee)}}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Biaya Finishing</th>
                        <td>Rp {{number_format(@$order->finishing_fee)}}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Total Harga</th>
                        <td>Rp {{number_format(@$order->grand_total)}}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Jumlah Bayar</th>
                        <td>Rp {{number_format(@$order->down_payment)}}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">{{ @$order->down_payment - @$order->grand_total >= 0 ? 'Kembali': 'Sisa Bayar' }}</th>
                        <td>Rp {{number_format((@$order->down_payment - @$order->grand_total >= 0 ? @$order->down_payment - @$order->grand_total : @$order->grand_total - @$order->down_payment))}}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Status</th>
                        <td>{{ \App\Util\Constant::ORDER_STATUS_LIST[$order->status] }}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Status Pembayaran</th>
                        <td>{{ \App\Util\Constant::STATUS_PAYMENT_LIST[$order->payment_status] }}</td>
                    </tr>
                    <tr style="background-color:#eee;">
                        <th style="text-align: left">Metode Pembayaran</th>
                        <td>{{ \App\Util\Constant::PAYMENT_METHOD_LIST[$order->payment_method] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td class="break"></td></tr>
        <tr>
            <td>
                <b>Daftar Produk</b>
                <table style="margin-top:10px;width: 100%;text-align: center;" border="1px #000 solid">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                    @foreach($order->items as $key => $product)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ucwords($product->product->name . (!empty($product->remark) ? ' ('.$product->remark.')' : '' ) )}}</td>
                            <td>Rp {{number_format($product->price)}}</td>
                            <td>{{ number_format($product->qty) }}</td>
                            <td>{{ number_format($product->total_price) }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr><td class="break"></td></tr>
        <tr>
            <td> Di input oleh : <b>{{ @$order->creator->name }}</b>, cashier : <b>{{ @$order->cashier->name }}</b></td>
        </tr>
    </table>
@endsection
