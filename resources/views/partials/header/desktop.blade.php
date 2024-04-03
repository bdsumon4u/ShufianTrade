<header class="site__header d-lg-block d-none">
    <div class="site-header">
        <!-- .topbar -->
        @include('partials.topbar')
        <!-- .topbar / end -->
        <div class="site-header__nav-panel">
            <div class="nav-panel">
                <div class="nav-panel__container container">
                    <div class="nav-panel__row">
                        <div class="site-header__logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset($logo->desktop ?? '') }}" alt="Logo" style="max-width: 100%; max-height: 84px;">
                            </a>
                        </div>
                        <!-- .nav-links -->
                        @include('partials.header.menu.desktop')
                        <!-- .nav-links / end -->
                        <div class="nav-panel__indicators">
                            <div class="indicator indicator--trigger--click">
                                <a href="#" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg width="20" height="20">
                                            <circle cx="7" cy="17" r="2"></circle>
                                            <circle cx="15" cy="17" r="2"></circle>
                                            <path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6 V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4 C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z"></path>
                                        </svg>
                                        <span class="indicator__value cart-count"></span>
                                    </span>
                                </a>
                                <div class="indicator__dropdown">
                                    <!-- .dropcart -->
                                    <div class="dropcart">
                                        <div class="dropcart__products-list">
                                            
                                        </div>
                                        <div class="dropcart__totals">
                                            <table>
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td class="cart-subtotal">{!!  theMoney(0)  !!}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="dropcart__buttons">
                                            <a class="btn btn-primary" href="{{ route('checkout') }}">Checkout</a>
                                        </div>
                                    </div><!-- .dropcart / end -->
                                </div>
                            </div>
                            <div style="width: 5px;"></div>
                            <div class="indicator indicator--trigger--click">
                                <a href="#" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg aria-hidden="true" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16" style="width: 25px; top: 3px; position: relative;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M505 443L405 343c-4-4-10-7-17-7h-16a208 208 0 1 0-36 36v16c0 7 3 13 7 17l100 100c9 9 24 9 34 0l28-28c9-10 9-25 0-34zM208 336a128 128 0 1 1 0-256 128 128 0 0 1 0 256z"></path>
                                        </svg>
                                    </span>
                                </a>
                                <div class="indicator__dropdown" style="width: 1250px; padding: 0 250px;">
                                    <form action="/shop" method="get" style="background: white; padding: 1rem;" class="shadow d-flex">
                                        <input type="search" name="search" id="" class="form-control form-control-lg mr-1">
                                        <button class="btn btn-lg btn-dark ml-1">
                                            <svg aria-hidden="true" data-prefix="fas" data-icon="search" width="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor" d="M505 443L405 343c-4-4-10-7-17-7h-16a208 208 0 1 0-36 36v16c0 7 3 13 7 17l100 100c9 9 24 9 34 0l28-28c9-10 9-25 0-34zM208 336a128 128 0 1 1 0-256 128 128 0 0 1 0 256z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>