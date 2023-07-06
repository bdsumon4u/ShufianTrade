@extends('layouts.light.master')
@section('title', 'Reports')

@section('breadcrumb-title')
<h3>Reports</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Reports</li>
@endsection

@push('styles')
<style>
@media print {
    html, body {
        /* height:100vh; */
        margin: 0 !important;
        padding: 0 !important;
        /* overflow: hidden; */
    }
    .main-nav {
        display: none !important;
        width: 0 !important;
    }
    .page-body {
        font-size: 14px;
        margin-top: 0 !important;
        margin-left: 0 !important;
    }
    .page-break {
        page-break-after: always;
        border-top: 2px dashed #000;
    }

    .page-main-header, .page-header, .card-header, .footer-fix {
        display: none !important;
    }

    th, td {
        padding: 0.25rem !important;
    }

    a {
        text-decoration: none !important;
    }
}
</style>
@endpush

@section('content')
<div class="row mb-5">
    <div class="col-md-12 mx-auto">
        <div class="reports-table">
            <div id="section-to-print" class="card rounded-0 shadow-sm">
                <div class="card-header p-3">
                    <form id="search-form" action="">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="code" id="search" class="form-control form-control">
                            </div>
                            <div class="col-auto">
                                <button type="button" onclick="window.print()" class="btn btn-primary">Print</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="min-width: 50px;">S.I</th>
                                    <th style="min-width: 50px;">Order ID</th>
                                    <th>Customer</th>
                                    <th>Note</th>
                                    <th style="min-width: 80px;">Status</th>
                                    <th style="min-width: 80px;">Subtotal</th>
                                    <th style="min-width: 80px;">Shipping</th>
                                    <th style="min-width: 80px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer p-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="min-width: 50px;">Product Name</th>
                                    <th style="width: 80px;">Quantity</th>
                                    <th style="width: 120px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function cardPrint() {
            var printContents = document.getElementById('section-to-print').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            setTimeout(() => {
                window.print();
                document.body.innerHTML = originalContents;
            }, 1500);
        }

        var products = {};
        var uniqueness = [];
        var subtotal = shipping = total = quantity = amount = 0;
        $('#search-form').on('submit', function (ev) {
            ev.preventDefault();
            var code = $('#search').blur().val();

            $.get('{{url()->current()}}', {code:code}, function(order) {
                $('#search').focus().val('');
                if (! order || uniqueness.includes(order.id)) {
                    console.log('Order not found');
                    return;
                }
                uniqueness.push(order.id);

                subtotal += parseInt(order.data.subtotal);
                shipping += parseInt(order.data.shipping_cost);
                total += parseInt(order.data.subtotal)+parseInt(order.data.shipping_cost);

                var tr = `
                    <tr data-id="${order.id}">
                        <td>${1+$('.card-body table tbody tr').length}</td>
                        <td><a target="_blank" href="{{route('admin.orders.show', '')}}/${order.id}">${order.id}</a></td>
                        <td>${order.name}&nbsp;${order.phone}</td>
                        <td>${order.note ?? 'N/A'}</td>
                        <td>${order.status}</td>
                        <td>${order.data.subtotal}</td>
                        <td>${order.data.shipping_cost}</td>
                        <td>${parseInt(order.data.subtotal)+parseInt(order.data.shipping_cost)}</td>
                    </tr>
                `;
                $('.card-body table tbody').prepend(tr);

                $('.card-body table tbody tr:not(:last-child)').each(function (index, tr) {
                    $(tr).find('td:first-child').text(index + 1);
                });

                if (! $('.card-body table tbody tr:last-child').hasClass('summary')) {
                    $('.card-body table tbody').append('<tr class="summary"><th colspan="5" class="text-right">Total</th><th>'+subtotal+'</th><th>'+shipping+'</th><th>'+total+'</th></tr>');
                } else {
                    $('.card-body table tbody tr:last-child').find('th:nth-child(2)').text(subtotal);
                    $('.card-body table tbody tr:last-child').find('th:nth-child(3)').text(shipping);
                    $('.card-body table tbody tr:last-child').find('th:nth-child(4)').text(total);
                }

                // ## //
                if ($('.card-footer table tbody tr:last-child').hasClass('summary')) {
                    $('.card-footer table tbody tr:last-child').remove();
                }

                for (var product of order.products) {
                    var tr = $('.card-footer table tbody tr[data-id="'+product.id+'"]');

                    quantity += parseInt(product.quantity);
                    amount += parseInt(product.total);

                    if (tr.length) {
                        tr.find('td:nth-child(2)').text(parseInt(tr.find('td:nth-child(2)').text()) + parseInt(product.quantity));
                        tr.find('td:nth-child(3)').text(parseInt(tr.find('td:nth-child(3)').text()) + parseInt(product.total));
                    } else {
                        var tr = `
                            <tr data-id="${product.id}">
                                <td><a target="_blank" href="{{route('products.show', '')}}/${product.slug}">${product.name}</a></td>
                                <td>${product.quantity}</td>
                                <td>${product.total}</td>
                            </tr>
                        `;

                        $('.card-footer table tbody').append(tr);
                    }
                }

                if (! $('.card-footer table tbody tr:last-child').hasClass('summary')) {
                    $('.card-footer table tbody').append('<tr class="summary"><th class="text-right">Total</th><th>'+quantity+'</th><th>'+amount+'</th></tr>');
                }
            });

            return false;
        });
    </script>
@endpush