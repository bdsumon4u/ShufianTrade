
<div class="wrapper container">
	<ul class="page_home">
		<li class="body_content">
			<ul class="left outer_border border_radius_5_full">
				<li class="product inner_bg border_radius_5_full" style="width: auto;">
					<div class="ltitle fpink txt_shadow_white bottom_grey_border">
                        {{$title}}
                    </div>
					<ul class="row">
                        @foreach($products as $product)
                        <li class="content top_white_border col-md-4">
							<ul>
								<li class="itm">
									<a href="{{route('products.show',$product)}}" title="{{$product->name}}">
										<img src="{{ $product->base_image->src }}" alt="{{$product->name}}" />
									</a>
								</li>
								<li class="info">
									<ul>
										<li>
											<a class="stitle" href="{{route('products.show',$product)}}" title="{{$product->name}}">
                                                {{$product->name}}
                                            </a>
										</li>
										<li class="stitle">Price:
                                            @if($product->selling_price == $product->price)
                                                {!!  theMoney($product->price)  !!}
                                            @else
                                                <span class="product-card__new-price">{!! theMoney($product->selling_price) !!}</span>
                                                &nbsp;
                                                <span class="product-card__old-price">{!! $product->price !!}</span>
                                            @endif
                                        </li>
										<li>Availability:
                                            @if(! $product->should_track)
                                                <span class="text-success">In Stock</span>
                                            @else
                                                <span class="text-{{ $product->stock_count ? 'success' : 'danger' }}">{{ $product->stock_count }} In Stock</span>
                                            @endif
                                        </li>
										<li><a class="bblue" href="{{route('products.show',$product)}}" title="{{$product->name}}">Show Deatils</a></li>
									</ul>
								</li>
							</ul>
						</li>
                        @endforeach
                        <li class="clear_less_height">&nbsp;</li>
					</ul>
				</li>
			</ul>
		</li>
		
		<li class="clear_less_height">&nbsp;</li>
	</ul>
</div>