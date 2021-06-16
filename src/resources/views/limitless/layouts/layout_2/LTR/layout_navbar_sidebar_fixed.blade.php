<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>

	<base href="{{ url('template/limitless/layout_2/LTR/default') }}/">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Global stylesheets -->
	{{--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

	<link href="assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<link href="rutatiina/styles.css" rel="stylesheet" type="text/css">



	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<script>
        var rg_decimal_places = 2;
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
        var APP_URL = "{{url('/')}}";
        var TENANT_ID = "{{optional($tenant)->id}}";
	</script>

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/select.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/uploaders/dropzone.min.js"></script>

    <script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/bootbox.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>

	{{--<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>--}}
    {{--<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.min.js"></script>--}}
    {{--<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.min.js"></script>--}}
    <script type="text/javascript" src="assets/js/plugins/ui/headroom/headroom.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/headroom/headroom_jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>


	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/dataTables.checkboxes.min.js"></script>

	<script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/legacy.js"></script>


	<script type="text/javascript" src="assets/js/core/app.js"></script>

	<script type="text/javascript" src="assets/js/pages/layout_fixed_custom.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="assets/js/pages/picker_date.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_bootstrap_select.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_input_groups.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_multiselect.js"></script>
	<script type="text/javascript" src="assets/js/pages/datatables_extension_select.js"></script>
	<script type="text/javascript" src="assets/js/pages/form_inputs.js"></script>

    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/rutatiina/functions.js') }}"></script>
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/rutatiina/scripts.js') }}"></script>
	<!-- /theme JS files -->

	@yield('head')

</head>

<body class="navbar-top @yield('bodyClass')">

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		@csrf
	</form>

	<!-- Main navbar -->
	<div class="navbar navbar-default navbar-fixed-top header-highlight">
		<div class="navbar-header {{--bg-grey-800--}}" style="box-shadow: none; {{--background: transparent; border-right:1px solid #ddd;--}}">

			{{--<a class="navbar-brand" href=""><img src="/rutatiina_assets/assets/img/logo_white.png" class="no-margin" alt="" style="height: auto;"></a>--}}
            <a class="navbar-brand" href="">
                <img src="/timthumb.php?src=/logo-white.png&w=35&h=35&zc=2" class="no-margin" alt="" style="height: 35px;">
            </a>

            {{--<a id="rg_sidebar_control" class="sidebar-control sidebar-main-toggle hidden-xs pull-right m-15 text-white"><i class="icon-chevron-left"></i></a>--}}

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

		</div>


		<div class="navbar-collapse collapse" id="navbar-mobile">
			<!--<ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>-->

			<ul class="nav navbar-nav hidden-xs">
				<div class="mega-menu btn-group " style="margin-top: 7px;"><!-- btn-group-animated-->
					<button type="button" class="btn btn-primary btn-link btn-icon btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu3"></i></button>
					<div class="dropdown-menu dropdown-content no-border-radius no-margin" style="width: 820px;">
						<div class="dropdown-content-body">
							<div class="row">
                                {{--
								<div class="col-md-3">
									<span class="menu-heading underlined"><i class="icon-grid6"></i> General</span>
									<ul class="menu-list">
										<li><a href="/contacts/new"><i class="icon-plus22"></i>Customer</a></li>
										<li><a href="/contacts/new"><i class="icon-plus22"></i>Vendor</a></li>
										<li><a href="#" data-toggle="modal" data-target="#rg_modal_item"><i class="icon-plus22"></i>Item</a></li>
										<!--<li><a href="#"><i class="icon-plus22"></i>User</a></li>
										<li><a href="#"><i class="icon-plus22"></i>Item Adjustments</a></li>
										<li><a href="#"><i class="icon-plus22"></i>Journal Entry</a></li>
										<li><a href="#"><i class="icon-plus22"></i>Log time</a></li>-->
									</ul>
								</div>
                            	--}}

								{{--
								<div class="col-md-3">
									<span class="menu-heading underlined"><i class="icon-grid6"></i> Apps</span>
									<ul class="menu-list">
                                        @if (in_array($this->router->fetch_module(), array('human_resource')))
										<li><a href="/accounting/" class="text-semibold"><i class="icon-book3"></i> <span class="text-semibold">Accounting</span></a></li>
                                        @endif
                                        @if (!in_array($this->router->fetch_module(), array('human_resource')))
										<li><a href="/human_resource/" class="text-semibold" title="Human Resource"><i class="icon-people"></i> <span>Human Resource</span></a></li>
                                        @endif
										<li><a href="#" class="text-semibold" title="Customer relationship management"><i class="icon-collaboration"></i> <span class="">CRM</span></a></li>
									</ul>
								</div>
								--}}

								<div class="col-md-3">
									<span class="menu-heading underlined"><i class="icon-cart-add"></i> Sales</span>
									<ul class="menu-list">
										<li><a href="/sales/estimate/"><i class="icon-plus22"></i>Estimates</a></li>
										<li><a href="/sales/invoice/"><i class="icon-plus22"></i>Invoices</a></li>
										<li><a href="/sales/recurring_invoice/"><i class="icon-plus22"></i>Recurring Invoice</a></li>
										<li><a href="/sales/retainer_invoice/"><i class="icon-plus22"></i>Retainer Invoice</a></li>
										<li><a href="/sales/sales_order/"><i class="icon-plus22"></i>Sales Order</a></li>
										<li><a href="/sales/receipt/"><i class="icon-plus22"></i>Customer payment</a></li>
									</ul>
								</div>
								<div class="col-md-3">
									<span class="menu-heading underlined"><i class="icon-price-tag"></i> Bills</span>
									<ul class="menu-list">
										<li><a href="/purchases/expense/"><i class="icon-plus22"></i>Expenses</a></li>
										<li><a href="/purchases/recurring_expense/"><i class="icon-plus22"></i>Recurring Expense</a></li>
										<li><a href="/purchases/bill/"><i class="icon-plus22"></i>Bills</a></li>
										<li><a href="/purchases/recurring_bill/"><i class="icon-plus22"></i>Recurring Bills</a></li>
										<li><a href="/purchases/purchase_order/"><i class="icon-plus22"></i>Purchase orders</a></li>
										<li><a href="/purchases/payment/"><i class="icon-plus22"></i>Vendor Payment</a></li>
										<li><a href="/purchases/debit_note/"><i class="icon-plus22"></i>Vendor Credits</a></li>
									</ul>
								</div>
								<div class="col-md-3">
									<span class="menu-heading underlined"><i class="icon-library2"></i> Banking</span>
									<ul class="menu-list">
										<li><a href="#">Bank Transfer</a></li>
										<li><a href="#">Card Payment</a></li>
										<li><a href="#">Owner Drawings</a></li>
										<li><a href="#">Other Incomes</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</ul>

			<form class="navbar-form navbar-left" autocomplete="off">
				<div class="form-group " style="width: 100%;">
					<input id="navbar_top_search" type="search" autocomplete="off" class="form-control input-rounded" placeholder="Search field" style="width: 100%;">
					<div class="form-control-feedback">
						<i class="icon-search4 text-muted text-size-base"></i>
					</div>
				</div>
			</form>

            {{--
			<ul class="nav navbar-nav navbar-right ml-5">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
						<i class="icon-grid"></i>
						<span class="visible-xs-inline-block position-right">Apps</span>
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right no-border-radius">
						@if (in_array($this->router->fetch_module(), array('human_resource')))
							<li><a href="/accounting/"><i class="icon-book3"></i> <span class="text-semibold">Accounting</span></a></li>
						@endif
						@if (!in_array($this->router->fetch_module(), array('human_resource')))
							<li><a href="/human_resource/"><i class="icon-people"></i> <span class="text-semibold">Human Resource</span></a></li>
						@endif
					</ul>
				</li>
			</ul>
			--}}

			<ul class="nav navbar-nav navbar-right">

                {{--
				<li><a href="#">Text xxxxx</a></li>

				<li>
					<a href="#">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right">Icon xxxxx</span>
					</a>
				</li>
				--}}

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
						<i class="icon-gear"></i>
						<span class="visible-xs-inline-block position-right">Settings</span>
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right no-border-radius">
						<li><a href="{{route('profile.index')}}"><i class="icon-user"></i>{{auth()->user()->first_name.' '.auth()->user()->other_name}}</a></li>
						<li><a href="{{route('organisations.index')}}"><i class="icon-office"></i> Organisations</a></li>
                        {{--<li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>--}}
						<li><a href="{{url()->current()}}"><i class="icon-price-tags"></i> Packages</a></li>
						<li class="divider"></li>
						<li><a href="https://documenter.getpostman.com/view/5104905/SVSPn6qW" target="_blank"><i class="icon-newspaper"></i> Api Documentation</a></li>
						<li class="divider"></li>
						<li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>

			</ul>

			<div class="navbar-right">
				<p class="navbar-text"><i class="icon-users2 position-left"></i> {{auth()->user()->name}} </p>
			</div>

			@if(auth()->user()->tenant)
			<div class="navbar-right pl-20 pr-20">
				<a href="{{route('organisations.index')}}" class="navbar-text text-semibold">{{optional(auth()->user()->tenant)->name}}</a>
			</div>
			@endif

		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
				{{--
				<div class="navbar-header no-margin-left" style="position:fixed; top: 0px; left: 0px; right: 0px; width: 260px; z-index: 999; background: transparent">
					<a class="navbar-brand" href=""><img src="/themes/accounting/rutatiina_assets/logo.png" alt="" class="no-margin" style="height: auto;"></a>

					<ul class="nav navbar-nav pull-right visible-xs-block">
						<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
						<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
					</ul>
				</div>
				--}}


				<div class="sidebar sidebar-main sidebar-fixed {{--bg-grey-700--}} hidden-print" style="background:#2a3140;">
					<div class="sidebar-content">

						<!-- User menu -->
						{{--
						<div class="sidebar-user">
							<div class="category-content">
								<div class="media">
									<img src="/themes/accounting/assets/images/logo_light.png" height="16" alt="">
								</div>
							</div>
						</div>
						--}}
						<!-- /user menu -->

						<!-- Main navigation -->
						<div class="sidebar-category sidebar-category-visible">
							<div class="category-content no-padding">
								<ul class="navigation navigation-main navigation-accordion">

									<!-- Main -->
									<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>

									<li class="{{(Request::is('accounting'))  ? 'active' : '' }}"><a href="{{route('accounting.index')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

									<li class="mt-20 {{(Request::is('contacts*'))  ? 'active' : '' }}">
										<a href="#"><i class="icon-users2"></i> <span>Contacts</span></a>
										<ul>
											<li>
												<a href="{{route('contacts.index')}}">
													Contacts
													<span class="label bg-danger" data-href="{{route('contacts.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>

										</ul>
									</li>


									<li class="{{(Request::is('*items*'))  ? 'active' : '' }}">
										<a href="#"><i class="icon-price-tags"></i> <span>Items</span></a>
										<ul>
											<li>
												<a href="{{route('items.index')}}">
													Items
													<span class="label bg-danger" data-href="{{route('items.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<!--<li><a href="#">Price lists</a></li>
											<li><a href="#">Item Adjustments</a></li>-->
										</ul>
									</li>

									<li class="{{(Request::is('banking*'))  ? 'active' : '' }}"><a href=""><i class="icon-library2"></i> <span>Banking</span></a></li>

									{{--
									<li class="{{($this->router->fetch_class() == 'banking') ? 'active' : ''}}">
										<a href="#"><i class="icon-library2"></i> <span>Banking</span></a>
										<ul>
											<li>
												<a href="/banking/accounts">
													Accounts
													<span class="label bg-blue-400" data-href="/banking/account">Add</span>
												</a>
											</li>
											<li><a href="/banking/reconcile">Reconcile</a></li>
										</ul>
									</li>
									--}}

									<li class="mt-20 {{(Request::is('*sales/*'))  ? 'active' : '' }}">
										<a href="#"><i class="icon-cart"></i> <span>Sales</span></a>
										<ul>
											<li class="{{(Request::is('*sales/estimates*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.sales.estimates.index')}}">
													Estimates
													<span class="label bg-danger" data-href="{{route('accounting.sales.estimates.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*sales/retainer-invoices*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.sales.retainer-invoices.index')}}">
													Retainer Invoices
													<span class="label bg-danger" data-href="{{route('accounting.sales.retainer-invoices.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*sales/sales-orders*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.sales.sales-orders.index')}}">
													Sales Orders
													<span class="label bg-danger" data-href="{{route('accounting.sales.sales-orders.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*sales/invoices*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.sales.invoices.index')}}" class="display-inline-block">
													Invoices
													<span class="label bg-danger" data-href="{{route('accounting.sales.invoices.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*sales/receipts*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.sales.receipts.index')}}">
													Receipts
													<span class="label bg-danger" data-href="{{route('accounting.sales.receipts.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*sales/recurring-invoices*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.sales.recurring-invoices.index')}}">
													Recurring Invoices
													<span class="label bg-danger" data-href="{{route('accounting.sales.recurring-invoices.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*sales/credit-notes*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.sales.credit-notes.index')}}">
													Credit Notes
													<span class="label bg-danger" data-href="{{route('accounting.sales.credit-notes.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>

                                            {{--
											<li>
                                                <a href="/sales/credit_notes">
                                                    Foreign Exchange gain
                                                    <span class="label bg-danger" data-href="/sales/credit_note/">Add</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/sales/credit_notes">
                                                    Foreign Exchange loss
                                                    <span class="label bg-danger" data-href="/sales/credit_note/">Add</span>
                                                </a>
                                            </li>
                                            --}}

										</ul>
									</li>

									<li class="{{(Request::is('*purchases/*'))  ? 'active' : '' }}">
										<a href="#"><i class="icon-price-tag"></i> <span>Purchases</span></a>
										<ul>
											<li class="{{(Request::is('*purchases/expenses*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.purchases.expenses.index')}}">
													Expenses
													<span class="label bg-danger" data-href="{{route('accounting.purchases.expenses.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*purchases/recurring-expenses*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.purchases.recurring-expenses.index')}}">
													Recurring Expenses
													<span class="label bg-danger" data-href="{{route('accounting.purchases.recurring-expenses.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*purchases/purchase-orders*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.purchases.purchase-orders.index')}}">
													Purchase Orders
													<span class="label bg-danger" data-href="{{route('accounting.purchases.purchase-orders.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*purchases/bills*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.purchases.bills.index')}}">
													Bills
													<span class="label bg-danger" data-href="{{route('accounting.purchases.bills.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*purchases/payments*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.purchases.payments.index')}}">
													Payments
													<span class="label bg-danger" data-href="{{route('accounting.purchases.payments.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*purchases/recurring-bills*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.purchases.recurring-bills.index')}}">
													Recurring Bills
													<span class="label bg-danger" data-href="{{route('accounting.purchases.recurring-bills.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*purchases/debit-notes*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.purchases.debit-notes.index')}}">
													Debit Notes
													<span class="label bg-danger" data-href="{{route('accounting.purchases.debit-notes.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
										</ul>
									</li>

									<li class="{{(Request::is('*inventory/*'))  ? 'active' : '' }}">
										<a href="#"><i class="icon-grid6"></i> <span>Inventory</span></a>
										<ul>
											<li class="{{(Request::is('*inventory/goods-received-notes*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.inventory.goods-received-notes.index')}}">
													Goods received
													<span class="label bg-danger" data-href="{{route('accounting.inventory.goods-received-notes.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*inventory/delivery-notes*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.inventory.delivery-notes.index')}}">
													Delivery notes
													<span class="label bg-danger" data-href="{{route('accounting.inventory.delivery-notes.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*inventory/goods-issued-notes*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.inventory.goods-issued-notes.index')}}">
													Goods issued
													<span class="label bg-danger" data-href="{{route('accounting.inventory.goods-issued-notes.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('*inventory/goods-returned-notes*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.inventory.goods-returned-notes.index')}}">
													Goods returned
													<span class="label bg-danger" data-href="{{route('accounting.inventory.goods-returned-notes.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
										</ul>
									</li>

									<li class="mt-20 {{(Request::is('*drafts','*journals*','*chat-of-accounts*'))  ? 'active' : '' }}">
										<a href="#"><i class="icon-archive"></i> <span>Accounting</span></a>
										<ul>
											<li class="{{(Request::is('accounting/drafts*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.drafts.index')}}">Drafts</a>
											</li>
											<li class="{{(Request::is('accounting/journals*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.journals.index')}}">
													Journal entries
													<span class="label bg-danger" data-href="{{route('accounting.journals.create')}}"><i class="fa fa-plus"></i> Add</span>
												</a>
											</li>
											<li class="{{(Request::is('financial-accounts/accounts*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.accounts.index')}}">Chart of Accounts</a>
											</li>
											<li class="{{(Request::is('accounting/transactions/imports*'))  ? 'active' : '' }}">
												<a href="{{route('accounting.transactions.imports.index')}}">Import transactions</a>
											</li>
											<!--<li><a href="#">Currency Adjustments</a></li>-->
											<!--<li><a href="#">Transaction Locking</a></li>-->
										</ul>
									</li>

									<li class="{{--( in_array($this->router->fetch_class(), array('reports') ) ) ? 'active' : ''--}}"><a href="{{route('accounting.reports.index')}}"><i class="icon-chart"></i> <span>Reports</span></a></li>

									<li class="{{(Request::is('*settings'))  ? 'active' : '' }}"><a href="{{route('organisations.index')}}"><i class="icon-cog4"></i> <span>Settings</span></a></li>

									{{--
									<li class="{{(Request::is('*settings'))  ? 'active' : '' }}">
										<a href="#"><i class="icon-cog4"></i> <span>Settings</span></a>
										<ul>
											<li class="{{(Request::is('permissions', 'permissions*')) ? 'active' : '' }}">
                                                <a href="{{ route('permissions.index') }}">Permissions</a>
                                            </li>
											<li class="{{(Request::is('roles', 'roles*')) ? 'active' : '' }}">
                                                <a href="{{ route('roles.index') }}">Roles</a>
                                            </li>
											<li class="{{(Request::is('groups', 'groups*')) ? 'active' : '' }}">
                                                <a href="{{ route('groups.index') }}">Groups</a>
                                            </li>

										</ul>
									</li>
									--}}

									{{--
									<!-- SYSTEM ADMINISTRATOR -->
									@if (auth()->user()->hasRole('super_admin'))
										<li class="navigation-header"><span>SYSTEM ADMINISTRATOR</span> <i class="icon-menu" title="Main pages"></i></li>
										<li class=""><a href="/administrator"><i class="icon-chart"></i> <span>Administrator</span></a></li>
									@endif

									--}}

									{{--<li class="mt-20"><a href="/logout"><i class="icon-switch2"></i> <span>Log out</span></a></li>--}}
									<!-- /main -->

								</ul>
							</div>
						</div>
						<!-- /main navigation -->

					</div>
				</div>
			<!-- /main sidebar -->

			<!-- Secondary sidebar -->
			@yield('sidebar_secondary')
			<!-- /secondary sidebar -->


			<!-- Main content -->
			@yield('content')
			<!-- /main content -->

			<!-- Opposite sidebar -->
			@yield('sidebar_opposite')
			<!-- /opposite sidebar -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	{{--<div action="/import" class="dropzone" id="rg-dropzone" style="display:none;"></div><!-- used for items and contactas packages -->--}}

	<style>
		@media (min-width: 480px) {
			.navbar-form.navbar-left {
				width: 35%;
			}
		}

        @media (min-width: 769px) {
            .sidebar-xs .header-highlight .navbar-header .navbar-brand {
                background: url(/timthumb.php?src=/logo-white.png&w=35&h=35&zc=2) no-repeat center center;
            }
        }
    </style>
    @yield('javascript')

</body>
</html>
