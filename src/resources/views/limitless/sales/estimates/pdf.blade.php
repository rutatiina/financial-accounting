@extends('accounting::layouts.layout_2.LTR.pdf')

@section('title', $txn->type->name.' #'.$txn->number)

@section('bodyClass', 'sidebar-xs')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">


    <!-- Content area -->
    <div class="content">

        <div class="panel panel-flat no-border no-shadow">

            @if (empty($txn))
                <div class="panel-body">
                    <div class="col-md-8">
                        <button data-href="/sales/estimate/" type="button" class="btn btn-danger"><i class="icon-plus22"></i> New Estimate</button>
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
											<li>Due date: <span class="text-semibold">{{$txn->due_date}}</span></li>
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

                                {{--
								<div class="col-md-6 col-lg-3 content-group">
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
								</div>
                                --}}

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
