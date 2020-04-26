@extends("layouts.index")
@section("content")
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian">
			            <!--category-productsr-->
						@foreach($categories as $category)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="/products/category/{{$category->id}}">{{$category->name}}</a></h4>
								</div>
							</div>
						@endforeach
						</div><!--/category-products-->
					</div>
				</div>
            
                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{asset('storage')}}/product_image/{{$product->image}}" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="{{asset('images/product-details/new.jpg')}}" class="newarrival" alt="" />
                                <h2>{{$product->name}}</h2>
                                <p>{{$product->description}}</p>
                                <span>
                                    <span>{{number_format($product->price)}} ฿</span>
                                    <label>Quantity:</label>
                                    <input type="text" value="1" />
                                    <a href="/products/addToCart/{{$product->id}}" class="btn btn-default add-to-cart">
                                    <i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </span>
                                <p><b>Category</b>
                                   <a href="/products/category/{{$product->category->id}}"> {{$product->category->name}} </a>
                                </p>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->
                </div>
			</div>
		</div>
	</section>
@endsection