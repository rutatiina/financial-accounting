@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', $txn->type->name.' #'.$txn->number)

@section('bodyClass', 'sidebar-xs')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/invoice.js') }}"></script>
@endsection

@section('sidebar_secondary')
    <!-- Secondary sidebar -->
    <div class="sidebar sidebar-secondary sidebar-default sidebar-fixed" style="width: 390px;">
        <div class="sidebar-content" style="width: 389px;">

            <!-- Page header -->
            <div class="page-header" style="border-bottom: 1px solid #ddd;">
                <div class="page-header-content">
                    <div class="page-title clearfix">

                        <div id="quick-sort" class="btn-group pull-left">
                            <a href="#" class="btn btn-link dropdown-toggle text-semibold" data-toggle="dropdown" aria-expanded="true">
                                <span class="dropdown-title">All Invoices</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left dropdown-menu-xs no-border-radius">
                                <!--<li><a href="#" data-ajax="/datatable/transactions/entree/invoice/">Draft</a></li>-->
                                <li><a href="#" data-ajax="/datatable/transactions/entree/invoice/?status=client+viewed">Client viewed</a></li>
                                <li><a href="#" data-ajax="/datatable/transactions/entree/invoice/?status=partially+paid">Partially Paid</a></li>
                                <li><a href="#" data-ajax="/datatable/transactions/entree/invoice/?status=unpaid">Unpaid</a></li>
                                <li><a href="#" data-ajax="/datatable/transactions/entree/invoice/?status=overdue">Overdue</a></li>
                                <li><a href="#" data-ajax="/datatable/transactions/entree/invoice/?status=payment+initiated">Payment initiated</a></li>
                                <li><a href="#" data-ajax="/datatable/transactions/entree/invoice/?status=paid">Paid</a></li>
                                <!--<li><a href="#" data-ajax="/datatable/transactions/entree/invoice/?status=void">Void</a></li>-->
                                <li class="divider"></li>
                                <li><a href="#" data-ajax="/datatable/transactions/entree/invoice/">All Invoices</a></li>
                            </ul>
                        </div>

                        <button data-href="{{route('accounting.sales.invoices.create')}}" type="button" class="btn btn-danger pull-right"><i class="icon-plus22"></i> New</button>

                    </div>
                </div>

            </div>
            <!-- /page header -->

            <div class="panel-body bg-white rg_datatable_onselect_btns animate-class-change" style="width: 389px; border-bottom: 1px solid #ddd;">
                {{--<button id="dt_test" type="button" class="btn btn-default btn-icon rg_datatable_onselect_btn" data-url="/testing/testing/"><i class=" icon-cloud-download2"></i></button>--}}
                {{--<button id="dt_test" type="button" class="btn btn-default btn-icon rg_datatable_onselect_btn" data-url="/testing/testing/"><i class="icon-alert"></i></button>--}}
                <button type="button" class="btn btn-link text-danger text-semibold rg_datatable_selected_delete" data-url="/transaction/delete/"><i class="icon-bin position-left"></i> Delete</button>
            </div>


            <div class="panel panel-flat no-border ">

                <div class="table-responsive no-border datatable-invoices">
                    <table class="rg_datatable_sidebar table table-hover text-nowrap" data-ajax="{{route('accounting.sales.invoices.datatables')}}" data-txn-id="{{$txn->id}}">
                        <thead class="hidden">
                        <tr>
                            <th>INOVICES</th>
                            <th class="text-right"> </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /daily sales -->

        </div>
    </div>
    <!-- /secondary sidebar -->
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header hidden-print" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix text-right">

                <div class="btn-group pull-left mr-20">
                    <button type="button" class="btn btn-default btn-icon btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu7"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="{{url()->current()}}#"><i class="icon-envelop"></i> Send to contact</a></li>
                        <li><a href="{{url()->current()}}#"><i class="icon-comment"></i> View all comments</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('accounting.sales.invoices.destroy', $txn->id)}}"
                               class="text-danger rg-ajax-accounting-sales-invoice-destroy"
                               data-callback="{{route('accounting.sales.invoices.index')}}">
                                <i class="icon-trash"></i>
                                Delete transaction
                            </a>
                        </li>
                    </ul>
                </div>

                <h2 class="pull-left">{{$txn->type->name}} {{$txn->number}}</h2>


                <div class="pull-right">
                    <div class="btn-group">
                        {{--<button data-href="/sales/invoice/" type="button" class="btn btn-danger"><i class="icon-plus22"></i> New Estimate</button>--}}
                        <button data-href="{{route('accounting.sales.invoices.edit', $txn->id)}}" type="button" class="btn btn-default btn-icon"><i class="icon-pencil3"></i></button>
                        {{--<button data-href="/sales/pdf/{{$txn->id}}" type="button" class="btn btn-default btn-icon"><i class="icon-file-pdf"></i></button>--}}
                        <button onclick="window.print();" type="button" class="btn btn-default btn-icon"><i class="icon-printer2"></i></button>
                        {{--<button type="button" class="btn btn-default btn-icon"><i class="icon-alarm"></i></button>--}}
                        {{--<button data-href="/contacts/update/{{$txn->debit_contact_id}}" type="button" class="btn btn-default"><i class="icon-envelop"></i> Edit Contact</button>--}}
                    </div>

                    @if($txn->balance >0)
                        <a href="/sales/invoices/{{$txn->id}}/receipts/create" class="btn btn-warning btn-labeled btn-labeled-left">
                            <b><i class="icon-cash3"></i></b> Record Payment
                        </a>
                    @else
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-left">
                            <b><i class="icon-checkmark"></i></b> Fully paid
                        </button>
                    @endif

                    <a href="{{route('accounting.sales.invoices.index')}}" class="btn btn-icon btn-default"><i class="icon-cross"></i> Back</a>

                </div>

            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- transaction comments -->
    @include('accounting::transactions.comment_form_and_preview')

    <!-- Content area -->
    <div class="content">

        <div class="panel panel-flat no-border no-shadow">

            @if (empty($txn))
                <div class="panel-body">
                    <div class="col-md-8">
                        <button data-href="{{route('accounting.sales.invoices.create')}}" type="button" class="btn btn-danger"><i class="icon-plus22"></i> New Invoice</button>
                        <hr/>
                        <div class="alert alert-danger alert-styled-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">Oops!</span> Transaction not found <a href="#" class="alert-link">try submitting again</a>.
                        </div>
                    </div>
                </div>
            @else
            <div class="panel-body">

                <div class="max-width-820" style="margin: 0px auto;">

					<!-- document -->
					<div class="panel panel-white">
						<div class="panel-heading hidden-print">
							<h6 class="panel-title text-uppercase text-bold">{{$txn->type->name}} {{$txn->number}}</h6>
							<div class="heading-elements">
								<a href="{{route('accounting.sales.estimates.copy', $txn->id)}}" class="btn btn-default btn-xs heading-btn"><i class="icon-file-check position-left"></i> Copy</a>
								<button type="button" class="btn btn-default btn-xs heading-btn" onclick="window.print();"><i class="icon-printer position-left"></i> Print</button>
		                	</div>
						</div>

						<div class="panel-body no-padding-bottom">
                            @if (!empty($tenant->logo) && file_exists(public_path('storage/'.$tenant->logo)))
							<div class="row">
								<div class="col-sm-6 content-group">
                                    <img src="/timthumb.php?src={{asset('storage/'.$tenant->logo)}}&h=27&q=100" class="" alt="{{$tenant->name}}" >
								</div>
							</div>
                            @endif

							<div class="row">
								<div class="col-sm-6 content-group">
                                    <ul class="list-condensed list-unstyled">
                                        <li><h5 class="text-bold">{{$tenant->name}}</h5></li>
										@if ($tenant->street_line_1)
                                            <li>{{$tenant->street_line_1}}</li>
                                        @endif

                                        @if ($tenant->street_line_2)
                                            <li>{{$tenant->street_line_2}}</li>
                                        @endif

                                        @if ($tenant->city)
                                            <li>{{$tenant->city}}</li>
                                        @endif

                                        @if ($tenant->state_province)
                                            <li>{{$tenant->state_province}}</li>
                                        @endif

                                        @if ($tenant->phone)
                                            <li>{{$tenant->phone}}</li>
                                        @endif

                                        @if ($tenant->website)
                                            <li>{{$tenant->website}}</li>
                                        @endif
									</ul>
								</div>

								<div class="col-sm-6 content-group">
									<div class="invoice-details">
										<h5 class="text-uppercase text-semibold">{{$txn->type->name}} {{$txn->number}}</h5>
										<ul class="list-condensed list-unstyled">
											<li>Date: <span class="text-semibold">{{$txn->date}}</span></li>
                                            @if ($txn->due_date)
											<li>Due date: <span class="text-semibold">{{$txn->due_date}}</span></li>
                                            @endif
                                            @if ($txn->reference)
											<li>Ref: <span class="text-semibold">{{$txn->reference}}</span></li>
                                            @endif
										</ul>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6 col-lg-9 content-group">
									<span class="text-muted">Issued To:</span>
		 							<ul class="list-condensed list-unstyled">
										<li><h5>{{$txn->contact_name}}</h5></li>
										<li><span class="text-semibold">{{$txn->contact_address_array[0]}}</span></li>
										@foreach ($txn->contact_address_array as $key => $value)
                                            @continue($key === 0)
                                            <li>{{$value}}</li>
                                        @endforeach
									</ul>
								</div>

								<div class="col-md-6 col-lg-3 content-group">
                                    <div class="text-right no-margin text-bold">Balance Due:</div>
                                    <h1 class="text-right no-margin"><small>{{$txn->base_currency}}</small> {{number_format($txn->balance)}}</h1>
                                    {{--
									<span class="text-muted">Payment Details:</span>
									<ul class="list-condensed list-unstyled invoice-payment-details">
										<li><h5>Total Due: <span class="text-right text-semibold">$8,750</span></h5></li>
										<li>Bank name: <span class="text-semibold">Profit Bank Europe</span></li>
										<li>Country: <span>United Kingdom</span></li>
										<li>City: <span>London E1 8BF</span></li>
										<li>Address: <span>3 Goodman Street</span></li>
										<li>IBAN: <span class="text-semibold">KFH37784028476740</span></li>
										<li>SWIFT code: <span class="text-semibold">BPT4E</span></li>
									</ul>
									--}}
								</div>

							</div>
						</div>

                        <span>&nbsp;</span>{{--so that the top border on the bellow element is displayed when printing--}}
						<div class="border-default border-top">
						    <table class="table table-lg">
						        <thead>
						            <tr>
						                <th>Description</th>
						                <th class="col-sm-1 text-right">Rate</th>
						                <th class="col-sm-1 text-right">Quantity</th>
						                <th class="col-sm-1 text-right">Total</th>
						            </tr>
						        </thead>
						        <tbody>
                                    @foreach ($txn->items as $item)
                                        @if (!in_array($item->type, ['txn', 'txn_type', 'tax']))
                                            <tr>
                                                <td>
                                                    @if ($item->name)
                                                        <h6 class="no-margin">{{$item->name}}</h6>
                                                    @endif
                                                    @if ($item->description)
                                                        <span class="text-muted">{{$item->description}}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    {{number_format($item->rate, $tenant->decimal_places)}}
                                                </td>
                                                <td class="text-right">
                                                    @if(floor($item->quantity) == $item->quantity)
                                                        {{number_format($item->quantity)}}
                                                    @else
                                                        {{number_format($item->quantity, $tenant->decimal_places)}}
                                                    @endif
                                                </td>
                                                <td class="text-right"><span class="text-semibold">{{number_format($item->total, $tenant->decimal_places)}}</span></td>
                                            </tr>
                                        @endif
                                    @endforeach
						        </tbody>
						    </table>
						</div>

						<div class="panel-body border-default border-top">
							<div class="row invoice-payment">
								<div class="col-sm-7">
									<div class="content-group">
										<h6>Authorized Stamp / Signature</h6>
										<div class="mb-15 mt-15">
											{{--<img src="assets/images/signature.png" class="display-block" style="width: 150px;" alt="">--}}
                                            <p style="margin-top: 80px;">... ... ... ... ... ... ... ... ... ... ... ... ... ... ...</p>
										</div>

                                        {{--
										<ul class="list-condensed list-unstyled text-muted">
											<li>Eugene Kopyov</li>
											<li>2269 Elba Lane</li>
											<li>Paris, France</li>
											<li>888-555-2311</li>
										</ul>
                                        --}}
									</div>
								</div>

								<div class="col-sm-5">
									<div class="content-group">
										<h6>Total due</h6>
										<div class="table-responsive no-border">
											<table class="table">
												<tbody>
													<tr>
														<th>Subtotal:</th>
														<td class="text-right">{{number_format($txn->taxable_amount, $tenant->decimal_places)}}</td>
													</tr>
                                                    @foreach ($txn->items as $item)
                                                        @if (in_array($item->type, ['txn_type', 'tax']))
                                                            <tr>
                                                                <th>{{$item->description}}</th>
                                                                <td class="text-right">{{number_format($item->total, $tenant->decimal_places)}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
													<tr>
														<th>Total  ({{$txn->base_currency}}):</th>
														<td class="text-right text-primary">
                                                            <h5 class="text-semibold">
                                                                {{number_format($txn->total, $tenant->decimal_places)}}
                                                            </h5>
                                                        </td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="text-right hidden-print">
											<button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b> Send {{$txn->type->name}}</button>
										</div>
									</div>
								</div>
							</div>

                            <hr>
							<h6>Amount in words:</h6>
							<p class="text-muted">{{ucfirst($txn->total_in_words)}}</p>

                            <div class="row hidden hidden-print">
                                <div class="col-sm-12">
                                    <hr>
                                    <div class="content-group">
                                        <h6>Authorized Stamp / Signature</h6>
                                        <div class="mb-15 mt-15">
                                            {{--<img src="assets/images/signature.png" class="display-block" style="width: 150px;" alt="">--}}
                                            {{--<p style="margin-top: 80px;">... ... ... ... ... ... ... ... ... ... ... ... ... ... ...</p>--}}
                                        </div>

                                        {{--
                                        <ul class="list-condensed list-unstyled text-muted">
                                            <li>Eugene Kopyov</li>
                                            <li>2269 Elba Lane</li>
                                            <li>Paris, France</li>
                                            <li>888-555-2311</li>
                                        </ul>
                                        --}}
                                    </div>
                                </div>
                            </div>

						</div>
					</div>
					<!-- /document -->


                    @if(!$txn->items->contains('type', 'txn'))
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6 class="text-semibold no-margin-top">* No receipts made / found.</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif


                    @foreach ($txn->items as $item)
                        @if (in_array($item->type, ['txn']))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h6 class="text-semibold no-margin-top">{{$item->transaction->contact_name}}</h6>
                                                    <ul class="list list-unstyled">
                                                        <li>Date: <span class="text-semibold">{{$item->transaction->date}}</span></li>
                                                        <li>{{$item->transaction->type->name}} #: &nbsp;{{$item->transaction->number}}</li>
                                                        <li>Reference: <span class="text-semibold">{{$item->transaction->reference}}</span></li>
                                                    </ul>
                                                </div>

                                                <div class="col-sm-6 invoice-receipt-details no-margin-top">
                                                    <h6 class="text-semibold text-right no-margin-top">{{number_format($item->total, $tenant->decimal_places)}} {{$item->transaction->base_currency}}</h6>
                                                    <ul class="list list-unstyled text-right">
                                                        <li>Method: <span class="text-semibold"> {{$item->transaction->payment_mode}}</span></li>
                                                        <li>Account: <span class="text-semibold"> {{$item->transaction->debit_account->name}}</span></li>
                                                        <li class="dropdown">
                                                            Status: &nbsp;
                                                            <a href="#" class="label bg-success">Completed</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="row visible-print">
                                                <div class="col-sm-12">
                                                    <hr class="mt-15 mb-5 no-border">
                                                    <span class="status-mark border-danger position-left"></span>
                                                    <span class="text-semibold">{{$item->name}} {{$item->description}}</span>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-footer panel-footer-condensed hidden-print">
                                            <div class="heading-elements">
                                                <span class="heading-text">
                                                    <span class="status-mark border-danger position-left"></span>
                                                    <span class="text-semibold">{{$item->name}} {{$item->description}}</span>
                                                </span>

                                                <ul class="list-inline list-inline-condensed heading-text pull-right">
                                                    <li><a href="{{route('accounting.sales.receipts.show', $item->type_id)}}" class="text-default"><i class="icon-eye8"></i></a></li>
                                                    {{--
                                                    <li class="dropdown">
                                                        <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="icon-printer"></i> Print receipt</a></li>
                                                            <li><a href="#"><i class="icon-file-download"></i> Download receipt</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#"><i class="icon-cross2"></i> Remove receipt</a></li>
                                                        </ul>
                                                    </li>
                                                    --}}
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

            </div>
            @endif
        </div>


        <!-- Footer -->
        <div class="footer hidden-print text-muted">
            &copy; {{date('Y')}}. Maccounts - Financial, Payroll and Inventory accounting.
        </div>
        <!-- /footer -->

    </div>
    <!-- /content area -->

    </div>
    <!-- /main content -->
@endsection
