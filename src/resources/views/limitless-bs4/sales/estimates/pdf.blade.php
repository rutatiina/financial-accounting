@extends('l-limitless-bs4.layout_2-ltr-default.pdf')

@section('title', $txn->type->name.' #'.$txn->number)

@section('bodyClass', 'sidebar-xs')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper p-0">

        <!-- Content area -->
        <div class="content border-0 p-0">

            <!-- Content area -->
            <div class="content p-0">

                <!-- txn template -->
                <div class="card max-width-960 m-auto border-0 rounded-0 shadow-0">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <img src="/timthumb.php?src=storage/{{$tenant->logo}}&h=27&q=100" class="" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-4">
                                    <ul class="list list-unstyled mb-0">
                                        <li>
                                            <h5 class="rg-font-weight-600">{{$tenant->name}}</h5>
                                        </li>
                                        <li>{{$tenant->street_line_1}}</li>
                                        <li>{{$tenant->street_line_2}}</li>
                                        <li>{{$tenant->city}}</li>
                                        <li>{{$tenant->state_province}}</li>
                                        <li>{{$tenant->phone}}</li>
                                        <li>{{$tenant->website}}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-4">
                                    <div class="text-sm-right">
                                        <h4 class="text-primary mb-2 mt-md-2">{{$txn->type->name}} #{{$txn->number}}</h4>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Date: <span class="font-weight-semibold">{{$txn->date}}</span></li>
                                            <li>Due date: <span class="font-weight-semibold">{{$txn->due_date}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="clear: both;"></div>

                        <div class="row">
                            <div class=" col-6 mb-4 mb-md-2">
                                <span class="text-muted">{{$txn->type->name}} To:</span>
                                <ul class="list list-unstyled mb-0">
                                    <li><h5 class="my-2">{{$txn->contact->contact_salutation}} {{$txn->contact->first_name}} {{$txn->contact->other_name}}</h5></li>
                                    <li>
                                        <span class="font-weight-semibold">{{$txn->contact->shipping_address_street1}} {{$txn->contact->shipping_address_street2}}</span>
                                    </li>
                                    <li>{{$txn->contact->shipping_address_city}}</li>
                                    <li>{{$txn->contact->shipping_address_state}}</li>
                                    <li>{{$txn->contact->shipping_address_country}}</li>
                                    <li>{{$txn->contact->contact_work_phone}}</li>
                                    <li><a href="#">{{$txn->contact->contact_email}}</a></li>
                                </ul>
                            </div>

                            <div class="col-6 mb-2 ml-auto">
                                <span class="text-muted">Summary:</span>
                                <div class="wmin-400">
                                    <ul class="float-left list list-unstyled mb-0">
                                        <li><h5 class="my-2">Total Due:</h5></li>
                                        <li>Reference:</li>
                                    </ul>

                                    <ul class=" float-right list list-unstyled text-right mb-0 ml-auto">
                                        <li><h5 class="font-weight-semibold my-2">{{number_format($txn->total, 2)}}</h5></li>
                                        <li>{{$txn->reference}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                            <tr class="bg-light">
                                <th class="font-weight-bold">Description</th>
                                <th class="font-weight-bold text-right">Rate</th>
                                <th class="font-weight-bold text-right">Quantity</th>
                                <th class="font-weight-bold text-right">Total <small> {{$txn->base_currency}}</small></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($txn->items as $item)
                                @if(!in_array($item->type, ['txn', 'txn_type', 'tax']))
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">{{$item->name}}</h6>
                                            <span class="text-muted">{{$item->description}}</span>
                                        </td>
                                        <td class="text-right">{{number_format($item->rate, 2)}}</td>
                                        <td class="text-right">{{number_format($item->quantity)}}</td>
                                        <td class="text-right">
                                            <span class="font-weight-semibold">{{number_format($item->total, 2)}}</span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body pr-0">
                        <div class="d-md-flex flex-md-wrap">
                            <div class="pt-2 mb-3 text-muted">
                                <h6>Authorized Stamp / Signature</h6>
                            </div>

                            <div class="col-6 mb-3 wmin-md-400 ml-auto">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Subtotal:</th>
                                            <td class="text-right">{{number_format($txn->taxable_amount, 2)}}</td>
                                        </tr>

                                        @foreach($txn->items as $item)
                                            @if(in_array($item->type, ['txn_type', 'tax']))
                                                <tr>
                                                    <th>{{$item->description}}</th>
                                                    <td class="text-right">{{number_format($item->total, $tenant->decimal_places)}}</td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        <tr>
                                            <th>Total:</th>
                                            <td class="text-right">
                                                <span>{{$txn->base_currency}}</span>
                                                <span class="h5 font-weight-semibold">{{number_format($txn->total, 2)}}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div style="clear: both;"></div>

                        <hr>
                        <h6>Amount in words:</h6>
                        <p class="text-muted">{{$txn->total_in_words}}</p>

                    </div>

                    <div class="card-footer">
                        <span class="text-muted">Thank you for working with us. Always contact us for any feedback.</span>
                    </div>
                </div>
                <!-- /invoice template -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /content area -->


        <!-- Footer -->

        <!-- /footer -->

    </div>
    <!-- /main content -->
@endsection
