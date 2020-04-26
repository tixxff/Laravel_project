@extends("layouts.index")
@section("content")
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        <!-- cartItems เข้าถึง array items -->
						@foreach($cartItems->items as $item) 
                            <tr>
                                <td class="cart_product">
                                    <a href="/products/details/{{$item['data']['id']}}"><img src="{{asset('storage')}}/product_image/{{$item['data']['image']}}" alt="" width="70px" height="70px"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$item['data']['name']}}</a></h4>
                                    <p>{{Str::limit($item['data']['description'],30)}}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{number_format($item['data']['price'])}} ฿</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href=""> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{number_format($item['totalSinglePrice'])}} ฿</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="total_area">
						<ul>
							<li>จำนวนสินค้า<span>{{$cartItems->totalQuantity}}</span></li>
							<li>ราคารวม<span>{{number_format($cartItems->totalPrice)}}฿</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection