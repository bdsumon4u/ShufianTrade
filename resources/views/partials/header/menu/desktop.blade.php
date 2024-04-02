<div class="nav-panel__nav-links nav-links">
    <ul class="nav-links__list">
        <li class="nav-links__item">
            <a href="{{ url('/') }}">
                <span>Home</span>
            </a>
        </li>
        <li class="nav-links__item nav-links__item--has-submenu">
            <a class="nav-links__item-link" href="shop-grid-3-columns-sidebar.html">
                <span>Categories
                    <svg style="fill: currentColor; transform: rotate(90deg); margin-left: 5px;" width="6px" height="9px">
                        <use
                            xlink:href="{{ asset('strokya/images/sprite.svg#arrow-rounded-right-6x9') }}">
                        </use>
                    </svg>
                </span>
            </a>
            <div class="nav-links__submenu nav-links__submenu--type--menu" style="background: black; width: 255px;">
                <ul class="departments__links">
                    @foreach($categories as $category)
                        <li class="departments__item @if($category->childrens->isNotEmpty()) departments__item--menu @endif">
                            <a href="{{ route('categories.products', $category->category) }}">{{ $category->category->name }}
                                @if ($category->childrens->isNotEmpty())
                                    <svg class="departments__link-arrow" width="6px" height="9px">
                                        <use
                                            xlink:href="{{ asset('strokya/images/sprite.svg#arrow-rounded-right-6x9') }}">
                                        </use>
                                    </svg>
                                @endif
                            </a>
                            @if($category->childrens->isNotEmpty())
                                <div class="departments__menu">
                                    <!-- .menu -->
                                    <ul class="menu menu--layout--classic">
                                        @foreach ($category->childrens as $category)
                                            <li>
                                                <a href="{{ route('categories.products', $category->category) }}">{{ $category->category->name }}
                                                    @if ($category->childrens->isNotEmpty())
                                                        <svg class="menu__arrow" width="6px" height="9px">
                                                            <use
                                                                xlink:href="{{ asset('strokya/images/sprite.svg#arrow-rounded-right-6x9') }}">
                                                            </use>
                                                        </svg>
                                                    @endif
                                                </a>
                                                @if($category->childrens->isNotEmpty())
                                                    <div class="menu__submenu">
                                                        <!-- .menu -->
                                                        <ul class="menu menu--layout--classic">
                                                            @foreach($category->childrens as $category)
                                                                <li><a href="{{ route('categories.products', $category->category) }}">{{ $category->category->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        <!-- .menu / end -->
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul><!-- .menu / end -->
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
        @foreach($menuItems as $item)
        <li class="nav-links__item">
            <a href="{{ url($item->href) }}">
                <span>{{ $item->name }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>