<?php

namespace App\Http\Controllers\FrontEnd;

use App\City;
use App\Order;
use App\OrderAddress;
use App\OrderConfirmation;
use App\OrderProduct;
use App\Province;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Service\MailerService;
use App\Service\OrderService;
use App\User;
use App\Util\Constant;
use Validator;
use Illuminate\Http\Request;

use App\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use Response;
use RajaOngkir;

use PDF;

class OrderController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cart()
    {
        $province = RajaOngkir::Provinsi()->all();
        return view('frontend.orders.cart',['province'=>$province]);
    }

    public function checkout()
    {
        $totalCart = Session::get('totalCart');
        $shipping = Session::get('shipping');

        if(empty($totalCart) || empty($shipping)){
            return redirect('cart');
        }

        $city = City::where('provinceId',$shipping['province'])->get();
        return view('frontend.orders.checkout',[
            'totalCart' => $totalCart,
            'shipping' => $shipping,
            'province' => Provinsi::all(),
            'city' => $city,
        ]);
    }

    public function confirm($code){
        $order = Order::where('code',$code)->first();
        return view('frontend.orders.confirm',['order'=>$order]);
    }

    public function addCart(Request $product){
        if(empty($product->product) || empty($product->size)){
            $result['status'] = false;
            $result['message'] = 'Produk tidak boleh kosong!';
            return Response::json($result);
        }

        if($product->qty == 0){
            $result['status'] = false;
            $result['message'] = 'Pembelian produk minimal 1!';
            return Response::json($result);
        }

        $carts = Session::get('carts');
        $totalCart = Session::get('totalCart');

        $prd = Product::find($product->product);

        $varian = json_decode($product->size);

        $data = [];
        $data['product'] = $prd->id;
        $data['name'] = ucwords($prd->name);
        $data['price'] = $varian->price;
        $data['image'] = url('storage').'/'.$prd->image;
        $data['qty'] = $product->qty;
        $data['stock'] = $prd->stock;

        $totalCart += $varian->price * $product->qty;

        array_push($carts,$data);
        //set current cart session
        Session::put('carts',$carts);
        Session::put('totalCart',$totalCart);
        
        //set updated data

        $data['qty'] = number_format($data['qty']);
        $data['price'] = number_format($data['price']);
        $data['totalNow'] = number_format($totalCart);
        $data['totalCount'] = count($carts);
        $data['detail'] = route('productDetail',['id'=>$prd->id]);

        $result['status'] = true;
        $result['message'] = 'Produk berhasil ditambahkan ke keranjang :)';
        $result['data'] = $data;
        
        return Response::json($result);
    }

    public function removeCart(Request $product){
        if(empty($product->product)){
            $result['status'] = false;
            $result['message'] = 'Produk tidak boleh kosong!';
            return Response::json($result);
        }

        $carts = Session::get('carts');
        $totalCart = Session::get('totalCart');

        foreach ($carts as $key => $cart) {
            if($cart['product'] == $product->product){
                $totalCart -= ($cart['price'] * $cart['qty']);

                $result['product'] = $cart['product'];
                unset($carts[$key]);
            }
        }

        //set current cart session
        Session::put('carts',array_values($carts));
        Session::put('totalCart',$totalCart);

        $result['status'] = true;
        $result['message'] = 'Produk berhasil dihapus dari keranjang!';
        $result['totalNow'] = number_format($totalCart);
        $result['totalCount'] = count($carts);
        return Response::json($result);
    }

    public function updateCart(Request $request){
        $carts = Session::get('carts');
        Session::put('totalCart',0);
        $totalCart = 0;

        foreach ($carts as $key => $cart) {
            $carts[$key]['qty'] = $request['changed'][$key];
            $totalCart += ($cart['price'] * $carts[$key]['qty']);
        }

        //set current cart session
        Session::put('carts',$carts);
        Session::put('totalCart',$totalCart);

        $result['status'] = true;
        $result['total'] = $totalCart;
        $result['totalnow'] = Session::get('totalCart');
        $result['message'] = 'Berhasil update keranjang!';

        return Response::json($result);
    }

    public function emptyCart(){
        $this->reset();
        return redirect('/')->with('success','Keranjang Berhasil Dikosongkan!');
    }

    public function getCity($id){
        return Response::json(RajaOngkir::Kota()->byProvinsi($id)->get());
    }

    public function getSubdistrict($id){
        return Response::json(RajaOngkir::Kecamatan()->byCity($id)->get());
    }

    public function getKabupaten($id){
        return Response::json(Kabupaten::where('id_provinsi',$id)->get());
    }

    public function getKecamatan($id){
        return Response::json(Kecamatan::where('id_kabupaten',$id)->get());
    }

    public function getCost($id,$courier){
        $weight = 0;
        $carts = Session::get('carts');
        foreach ($carts as $cart){
            $weight += $cart['weight']*$cart['qty'];
        }

        $cost = RajaOngkir::Cost([
            'origin' => 152,
            'originType'=>'city',
            'destination' => $id,
            'destinationType'=>'city',
            'weight' => $weight*1000,
            'courier' => $courier,
        ])->get();

        return Response::json($cost[0]);
    }

    public function getWaybill(Request $request){
        if(empty($request->waybill)){
            return array('status'=>false,'message'=>'Nomor resi tidak boleh kosong!');
        }

        $result = RajaOngkir::Waybill([
            'waybill' => $request->waybill,
            'courier' => $request->courier,
        ])->get();

        $result['status'] = true;
        $result['data'] = $result;

        return Response::json($result);
    }

    public function saveCart(Request $request)
    {
        $shipping['method'] = $request['methodShipping'];
        $shipping['province'] = $request['province'];
        $shipping['city'] = $request['city'];
        $shipping['courier'] = $request['courier'];
        $shipping['total'] = $request['shipping'];

        Session::put('shipping',$shipping);

        return redirect('checkout');
    }

    public function saveCheckout()
    {
        DB::beginTransaction();
        //if(!Auth::user()->id){
            $request = Input::all();

            //return $request;

            //set for user
            $request['role'] = Constant::USER_ROLE_USER;
            $request['registerType'] = Constant::REGISTRATION_MANUAL;

            $expired = new \Carbon\Carbon(date('y-m-d H:i:s'));
            $request['expired_at'] = $expired->addDays(7);

            //set for order
            $request['code'] = uniqid();
            $request['orderType'] = Constant::ORDER_GUEST;
            $request['uniquePrice'] = mt_rand(100,500);
            $request['status'] = Constant::ORDER_UNPAID;

            $totalCart = Session::get('totalCart');
            $request['amount'] = $totalCart;

            $shipping = Session::get('shipping');
            $request['shippingType'] = strtoupper($shipping['courier']);
            $request['shippingFee'] = $shipping['total'];
            $request['shippingMethod'] = $shipping['method'];

            $request['totalPrice'] = $request['uniquePrice'] + $request['amount'] + $request['shippingFee'];

            if(empty(Auth::user()->id)){
                //create user
                $user = new User();
                $user->fill((array)$request);
                $user->save();
            }else{
                $user = Auth::user();
                $user->fill((array)$request);
                $user->save();
            }

            //create order
            $order = new Order((array)$request);
            $order->userId = $user->id;
            $order->save();

            //create order address
            $orderAddress = new OrderAddress((array)$request);
            $orderAddress->orderId = $order->id;
            $orderAddress->save();

            //create order item
            $carts = Session::get('carts');
            foreach ($carts as $cart){
                $cart['orderId'] = $order->id;
                $cart['productId'] = $cart['product'];
                $cart['total'] = $cart['qty'] * $cart['price'];
                $orderProduct = new OrderProduct((array)$cart);
                $orderProduct->save();
            }

            $sendMail = MailerService::orderSuccess(['order'=>Order::with(['user','orderProduct.product','orderAddress.city.province'])->find($order->id)],$user->email);
            if($sendMail['status']){
                DB::commit();
                $this->reset();
                return redirect('confirm/'.$order->code)->with('success','Pesanan telah kami terima, mohon check email anda dan segera lakukan konfirmasi pembayaran');
            }else{
                DB::rollback();
                return redirect()->back()->with('error','Gagal Send Email, pesanan dibatalkan');
            }
    }

    public function saveConfirm(Request $request){
        $validate_array = array();
        $validate_array['orderId'] = 'required';
        $validate_array['name'] = 'required';
        $validate_array['amount'] = 'required|numeric';
        $validate_array['accountNumber'] = 'required';
        $validate_array['bankName'] = 'required';
        $validate_array['file'] = 'required|max:2048|mimes:pdf,doc,docx,png,jpg,jpeg';

        $validator = Validator::make($request->all(),$validate_array);

        if($validator->fails()){
            $response['status'] = false;
            $response['message'] = 'Periksa Data Kembali!';
            $response['error'] = $validator->errors();

            return Response::json($response);
        }

        //get File
        $file = $request->file('file');
        $request = Input::all();
        $request['confirmationDate'] = date('Y-m-d H:i:s',strtotime($request['year'].'-'.$request['month'].'-'.$request['day']));
        //Set File
        $request['image'] = str_replace('public/','',$file->store('orders','public'));
        $orderConfirmation = new OrderConfirmation();
        $orderConfirmation->fill((array)$request)->save();
        $response['status'] = true;
        $response['message'] = 'Pesanan Berhasil Dikonfirmasi! Kami akan segera melakukan verifikasi';

        OrderService::updateStatus($request['orderId'],Constant::ORDER_PROCESS);
        return Response::json($response);
    }

    private function reset(){
        Session::put('carts',[]);
        Session::put('totalCart',0);
        Session::put('shipping',[]);
    }

    public function download($id){
        $order = Order::with(['orderProduct.product','orderAddress','orderConfirmation'])
                ->find($id);
        //return view('frontend.pdf.order',['order'=>$order]);

        $pdf = PDF::loadView('frontend.pdf.order', ['order'=>$order]);
        return $pdf->download('order_'.$order->code.'.pdf');
    }
}



