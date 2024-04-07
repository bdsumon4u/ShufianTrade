@extends('layouts.yellow.master')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{asset('strokya/css/sagartex.css')}}">
@endpush

@section('content')

@include('partials.slides')

<div class="wrapper container">
	<ul class="page_home">
		<li class="body_content row">
			<ul class="right pr-4 col-md-3 d-none d-md-flex">
				<div class="category inner_bg border_radius_5_full">
					<div class="ltitle fpink txt_shadow_white bottom_grey_border">Product Categories</div>
					<ul class="top_white_border">
                        @foreach (\App\Category::all() as $category)
						<li>
                            <a class='main_menu' href='{{route('categories.products',$category)}}' title='{{$category->name}}'>{{$category->name}}</a>
                        </li>
                        @endforeach
                    </ul>
				</div>
			</ul>
			<ul class="left col-md-9">
				<li class="product inner_bg border_radius_5_full">
					<div class="ltitle fpink txt_shadow_white bottom_grey_border">
                        @if(request('search'))
                        Found {{ $products->total() }} result(s) for "{{ request('search', 'NULL') }}"
                        @elseif($category = request()->route()->parameter('category'))
                        Showing from "{{ $category->name }}" category.
                        @elseif($brand = request()->route()->parameter('brand'))
                        Showing from "{{ $brand->name }}" brand.
                        @else
                        Latest Products
                        @endif
                    </div>
					<ul class="row">
                        @foreach($products as $product)
                        <li class="content top_white_border col-md-6">
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

<div class="container">
    <div class="px-3 py-3 bg-light my-2">
        <h5 class="text-center my-2">Our Brands</h5>
        <marquee behavior="alternate" direction="" onmouseover="this.stop();" onmouseout="this.start();">
            @foreach (\App\Brand::all() as $brand)
                @if($src = optional($brand->image)->src)
                    <a href="{{route('brands.products', $brand)}}">
                        <img src="{{asset($src)}}" alt="{{$brand->name}}" height="100" width="100" class="mr-3">
                    </a>
                @endif
            @endforeach
        </marquee>
    </div>
</div>

@endsection
