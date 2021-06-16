@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Groups :: Manage')

@section('bodyClass', 'sidebar-xs sidebar-opposite-visible')

@section('sidebar_secondary')
    @include('accounting::settings.sidebar_secondary')
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <div class="pull-left">
                        <h1 class="text-light">
                            Create User
                            <small>You can also create user contact</small>
                        </h1>
                    </div>

                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content no-padding">

            <div class="panel panel-flat no-border no-shadow">
                <div class="panel-body">

                    @include('limitless.basic_alerts')

                    <form id="counterparty_update_form" action="{{route('accounting.settings.users.store')}}" method="post" autocomplete="off"
                          class="form-horizontal" style="margin-bottom: 100px;">
                        @csrf
                        @method('POST')

                        <div class="col-md-8 mt-20">

                            <fieldset class="">


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">
                                        Email *
                                    </label>
                                    <div class="col-lg-8">
                                            <input type="text" name="email" value="{{old('email')}}" class="form-control input-roundless" placeholder="Email address *">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">
                                        Display name *
                                    </label>
                                    <table class="col-lg-8">
                                        <tr>
                                            <td width="100">
                                                <div class="col-lg-12">
                                                    <select name="salutation" class="select"
                                                            data-placeholder="Salutation ...">
                                                        <option></option>
                                                        <option value="none"{{ empty(old('salutation')) ? 'selected': ''}}>None</option>
                                                        <option value="Mr" {{ (old('salutation') == 'Mr') ? 'selected': ''}}>Mr</option>
                                                        <option value="Miss" {{ (old('salutation') == 'Miss') ? 'selected': ''}}>Miss</option>
                                                        <option value="Ms" {{ (old('salutation') == 'Ms') ? 'selected': ''}}>Ms</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-lg-12">
                                                        <input type="text" name="display_name" value="{{old('display_name')}}"
                                                               class="form-control input-roundless"
                                                               placeholder="Display name *">
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>


                                    </table>

                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">
                                        First name *
                                    </label>
                                    <div class="col-lg-8">
                                            <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control input-roundless" placeholder="First name *">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">
                                        Middle name
                                    </label>
                                    <div class="col-lg-8">
                                            <input type="text" name="middle_name" value="{{old('middle_name')}}" class="form-control input-roundless" placeholder="Middle name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">
                                        Surname *
                                    </label>
                                    <div class="col-lg-8">
                                            <input type="text" name="surname" value="{{old('surname')}}" class="form-control input-roundless" placeholder="Surname *">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">
                                        Password:
                                    </label>
                                    <div class="col-lg-8">
                                            <input type="password" name="password" value="" class="form-control input-roundless" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">
                                        Confirm Password:
                                    </label>
                                    <div class="col-lg-8">
                                            <input type="password" name="password_confirmation" value="" class="form-control input-roundless" placeholder="Confirm Password">
                                    </div>
                                </div>

                            </fieldset>

                            <fieldset>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">Create contact</label>
                                    <div class="col-sm-10" >

                                        <div class="checkbox checkbox-switchery">
											<label>
												<input type="checkbox" class="switchery" name="create_contact" value="yes" {{(old('create_contact') == 'yes') ? 'checked' : ''}}>
												Also create user as contact
											</label>
										</div>



                                    </div>
                                </div>

                            </fieldset>


                            <div class="tabbable">
                                <ul class="nav nav-tabs nav-tabs-solid bottom-divided"
                                    style="border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                                    <li class="active">
                                        <a href="#bottom-divided-tab2" data-toggle="tab" class="m-10 default-tab" style="padding: 5px 10px;">Address</a>
                                    </li>
                                    <li class="disabled">
                                        <a href="#bottom-divided-tab1" data-toggle="tab" class="m-10 disabled create-contact" style="padding: 5px 10px;">Contact details</a>
                                    </li>
                                    <li class="disabled">
                                        <a href="#bottom-divided-tab3" data-toggle="tab" class="m-10 disabled create-contact" style="padding: 5px 10px;">Contact persons</a>
                                    </li>
                                    <li class="disabled">
                                        <a href="#bottom-divided-tab4" data-toggle="tab" class="m-10 disabled create-contact" style="padding: 5px 10px;">Contact Remarks</a>
                                    </li>
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane " id="bottom-divided-tab1">

                                        <fieldset>

                                            <div class="form-group">
                                                <div>
                                                    <label class="control-label col-sm-2">Contact Type</label>
                                                    <div class="col-sm-10" style="margin-top: 7px;">

                                                        <span class="switchery-xs  no-border-right">
                                                            <input type="checkbox" name="types[0]" value="customer" {{(old('types.0') == 'customer') ? 'checked' : ''}}
                                                                   class="switchery" checked>
                                                        </span>
                                                        <span class="no-border-left no-padding-left">Customer</span>

                                                        <span class="pl-20 pr-20">|</span>

                                                        <span class="switchery-xs  no-border-right">
                                                            <input type="checkbox" name="types[1]" value="supplier" {{(old('types.1') == 'supplier') ? 'checked' : ''}}
                                                                   class="switchery" >
                                                        </span>
                                                        <span class="no-border-left no-padding-left">Supplier / Vendor</span>

                                                        <span class="pl-20 pr-20">|</span>

                                                        <span class="switchery-xs  no-border-right">
                                                            <input type="checkbox" name="types[2]" value="salesperson" {{(old('types.2') == 'salesperson') ? 'checked' : ''}}
                                                                   class="switchery" >
                                                        </span>
                                                        <span class="no-border-left no-padding-left">Salesperson / Agent</span>

                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>

                                        <fieldset class="">

                                            <div class="form-group">

                                                <label class="col-lg-2 control-label">
                                                    Country
                                                </label>
                                                <div class="col-lg-8">
                                                    <select name="country" data-placeholder="Select country"
                                                            class="select form-control">
                                                        {{--<option></option>--}}
                                                        @foreach ($countries as $country_code => $country_name)
                                                            @continue($country_code != 'UG')
                                                            <option value="{{$country_code}}" {{old('country') == $country_code ? 'selected' : ''}}>{{$country_code}}
                                                                - {{$country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label class="col-lg-2 control-label">
                                                    Default currency
                                                </label>
                                                <div class="col-lg-8">
                                                    <select name="currency" class="select input-roundless"
                                                            data-width="100%">
                                                        @foreach ($currencies as $currency_code => $currency_name)
                                                            @continue($currency_code != 'UGX')
                                                            <option value="{{$currency_code}}" {{ $currency_code == old('currency') ? 'selected' : ''}}>{{$currency_code}}
                                                                - {{$currency_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label class="col-lg-2 control-label">
                                                    Currencies
                                                </label>
                                                <div class="col-lg-8">
                                                    <select name="currencies[]" class="select input-roundless" multiple
                                                            data-width="100%">
                                                        <option></option>
                                                        @foreach ($currencies as $currency_code => $currency_name)
                                                            @continue($currency_code != 'UGX')
                                                            <option value="{{$currency_code}}" {{ $currency_code == old('currency') ? 'selected' : ''}}>{{$currency_code}}
                                                                - {{$currency_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">
                                                    Payment terms
                                                </label>
                                                <div class="col-lg-8">
                                                    <select name="payment_terms" class="select" data-placeholder="Payment terms ..." data-allow-clear="true">
                                                        <option value="Due on Receipt" {{ old('payment_terms') == 'Due on Receipt' ? 'selected' : ''}}>Due on Receipt</option>
                                                        <option value="" {{ empty(old('payment_terms') ) ? 'selected' : ''}}>Not applicable</option>
                                                        <option value="Net7" {{ old('payment_terms') == 'Net7' ? 'selected' : ''}}>Net 7</option>
                                                        <option value="Net10" {{ old('payment_terms') == 'Net10' ? 'selected' : ''}}>Net 10</option>
                                                        <option value="Net30" {{ old('payment_terms') == 'Net30' ? 'selected' : ''}}>Net 30</option>
                                                        <option value="Net60" {{ old('payment_terms') == 'Net60' ? 'selected' : ''}}>Net 60</option>
                                                        <option value="Net90" {{ old('payment_terms') == 'Net90' ? 'selected' : ''}}>Net 90</option>
                                                        <option value="EOM" {{ old('payment_terms') == 'EOM' ? 'selected' : ''}}>EOM</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label class="col-lg-2 control-label">
                                                    Facebook
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="facebook_link" value="{{old('facebook_link')}}"
                                                           class="form-control input-roundless"
                                                           placeholder="Facebook link">
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">
                                                    Twitter
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="twitter_link" value="{{old('twitter_link')}}"
                                                           class="form-control input-roundless"
                                                           placeholder="Twitter link">
                                                </div>
                                            </div>

                                        </fieldset>

                                    </div>

                                    <div class="tab-pane active" id="bottom-divided-tab2">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>BILLING ADDRESS</h6>
                                                <fieldset class="">

                                                    <div class="form-group">

                                                        <label class="col-lg-4 control-label">
                                                            Attention
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="billing_address_attention"
                                                                   value="{{old('billing_address_attention')}}" class="form-control input-roundless"
                                                                   placeholder="Attention">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">
                                                            Address
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="billing_address_street1"
                                                                   value="{{old('billing_address_street1')}}"
                                                                   class="form-control input-roundless mb-10"
                                                                   placeholder="Street 1">
                                                            <div class="clearfix"></div>
                                                            <input type="text" name="billing_address_street2"
                                                                   value="{{old('billing_address_street2')}}" class="form-control input-roundless"
                                                                   placeholder="Street 2">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-lg-4 control-label">
                                                            City
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="billing_address_city" value="{{old('billing_address_city')}}"
                                                                   class="form-control input-roundless"
                                                                   placeholder="City">
                                                        </div>

                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">
                                                            State
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="billing_address_state" value="{{old('billing_address_state')}}"
                                                                   class="form-control input-roundless"
                                                                   placeholder="State">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">
                                                            Zip code
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="billing_address_zip_code"
                                                                   value="{{old('billing_address_zip_code')}}" class="form-control input-roundless"
                                                                   placeholder="Name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">
                                                            Country
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <select name="billing_address_country"
                                                                    data-placeholder="Select country"
                                                                    class="select-search">
                                                                <option></option>
                                                                @foreach ($countries as $country_code => $country_name)
                                                                    @continue($country_code != 'UG')
                                                                    <option value="{{$country_code}}" {{old('billing_address_country') == $country_code ? 'selected' : ''}}>{{$country_code}}
                                                                        - {{$country_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group hidden">
                                                        <label class="col-lg-4 control-label">
                                                            Fax
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="billing_address_fax" value="{{old('billing_address_fax')}}"
                                                                   class="form-control input-roundless"
                                                                   placeholder="Name">
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </div>

                                            <div class="col-md-6">
                                                <h6>SHIPPING ADDRESS</h6>
                                                <fieldset class="">

                                                    <div class="form-group">

                                                        <label class="col-lg-4 control-label">
                                                            Attention
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="shipping_address_attention"
                                                                   value="{{old('shipping_address_attention')}}" class="form-control input-roundless"
                                                                   placeholder="Attention">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">
                                                            Address
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="shipping_address_street1"
                                                                   value="{{old('shipping_address_street1')}}"
                                                                   class="form-control input-roundless mb-10"
                                                                   placeholder="Street 1">
                                                            <div class="clearfix"></div>
                                                            <input type="text" name="shipping_address_street2"
                                                                   value="{{old('shipping_address_street2')}}" class="form-control input-roundless"
                                                                   placeholder="Street 2">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-lg-4 control-label">
                                                            City
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="shipping_address_city" value="{{old('shipping_address_city')}}"
                                                                   class="form-control input-roundless"
                                                                   placeholder="City">
                                                        </div>

                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">
                                                            State
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="shipping_address_state"
                                                                   value="{{old('shipping_address_state')}}" class="form-control input-roundless"
                                                                   placeholder="State">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">
                                                            Zip code
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="shipping_address_zip_code"
                                                                   value="{{old('shipping_address_zip_code')}}" class="form-control input-roundless"
                                                                   placeholder="Zip code">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">
                                                            Country
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <select name="shipping_address_country"
                                                                    data-placeholder="Select country"
                                                                    class="select-search">
                                                                <option></option>
                                                                @foreach ($countries as $country_code => $country_name)
                                                                    @continue($country_code != 'UG')
                                                                    <option value="{{$country_code}}" {{old('shipping_address_country') == $country_code ? 'selected' : ''}}>{{$country_code}}
                                                                        - {{$country_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group hidden">
                                                        <label class="col-lg-4 control-label">
                                                            Fax
                                                        </label>
                                                        <div class="col-lg-7">
                                                            <input type="text" name="shipping_address_fax" value=""{{old('shipping_address_fax')}}
                                                                   class="form-control input-roundless"
                                                                   placeholder="Fax">
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane " id="bottom-divided-tab3">

                                        <table id="primary_contact"
                                               class="table table-bordered no-border-left no-border-right no-border-bottom">
                                            <thead class="thead-default">
                                            <tr>
                                                <th class="pl-10">Salutation</th>
                                                <th class="pl-15">First Name</th>
                                                <th class="pl-15">Last Name</th>
                                                <th class="pl-15" width="30%">Email Address</th>
                                                <th class="pl-15">Work Phone</th>
                                                <th class="pl-15">Mobile</th>
                                            </tr>
                                            </thead>
                                            <tbody id="">
                                            <tr class="">
                                                <td class="no-padding">
                                                    <select class="select"
                                                            name="contact_salutation"
                                                            style="border: none;">
                                                        <option value="">None</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Ms">Ms</option>
                                                    </select>
                                                </td>
                                                <td class="no-padding">
                                                    <input type="text"
                                                           name="contact_first_name"
                                                           class="item_row_quantity form-control no-border"
                                                           value="" placeholder="First Name">
                                                </td>
                                                <td class="no-padding">
                                                    <input type="text"
                                                           name="contact_last_name"
                                                           class="item_row_rate form-control m-input no-border"
                                                           value="" placeholder="Last Name"></td>
                                                <td class="no-padding">
                                                    <input type="text"
                                                           name="contact_email"
                                                           class="item_row_rate form-control m-input no-border"
                                                           value="" placeholder="Email Address">
                                                </td>
                                                <td class="no-padding">
                                                    <input type="text"
                                                           name="contact_work_phone"
                                                           class="item_row_rate form-control m-input no-border"
                                                           value="" placeholder="Work Phone">
                                                </td>
                                                <td class="no-padding">
                                                    <input type="text"
                                                           name="contact_mobile"
                                                           class="item_row_rate form-control m-input no-border"
                                                           value="" placeholder="Mobile"></td>
                                            </tr>

                                            </tbody>
                                        </table>

                                        <hr>

                                        <table id="contact_persons"
                                               class="table table-bordered no-border-left no-border-right no-border-bottom">
                                            <thead class="thead-default">
                                            <tr>
                                                <th class="pl-10">Salutation</th>
                                                <th class="pl-15">First Name</th>
                                                <th class="pl-15">Last Name</th>
                                                <th class="pl-15" width="30%">Email Address</th>
                                                <th class="pl-15">Work Phone</th>
                                                <th class="pl-15">Mobile</th>
                                            </tr>
                                            </thead>
                                            <tbody id="contact_person_field_rows">
                                            <tr class="contact_person_row_template hidden">
                                                <td class="no-padding">
                                                    <select class="" name="contact_person[_index_][salutation]">
                                                        <option value="">None</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Ms">Ms</option>
                                                    </select>
                                                </td>
                                                <td class="no-padding"><input type="text"
                                                                              name="contact_person[_index_][first_name]"
                                                                              class="item_row_quantity form-control no-border"
                                                                              value="" placeholder="First Name">
                                                </td>
                                                <td class="no-padding"><input type="text"
                                                                              name="contact_person[_index_][last_name]"
                                                                              class="item_row_rate form-control m-input no-border"
                                                                              value="" placeholder="Last Name"></td>
                                                <td class="no-padding"><input type="text"
                                                                              name="contact_person[_index_][email]"
                                                                              class="item_row_rate form-control m-input no-border"
                                                                              value="" placeholder="Email Address">
                                                </td>
                                                <td class="no-padding"><input type="text"
                                                                              name="contact_person[_index_][work_phone]"
                                                                              class="item_row_rate form-control m-input no-border"
                                                                              value="" placeholder="Work Phone">
                                                </td>
                                                <td class="no-padding"><input type="text"
                                                                              name="contact_person[_index_][mobile]"
                                                                              class="item_row_rate form-control m-input no-border"
                                                                              value="" placeholder="Mobile"></td>
                                            </tr>

                                            </tbody>
                                        </table>

                                        <button type="button" onclick="rutatiina.new_contact_person(true);"
                                                class="btn btn-link btn-xs text-bold"><i
                                                    class="icon-plus22 position-left"></i>Add a row
                                        </button>


                                    </div>

                                    <div class="tab-pane " id="bottom-divided-tab4">

                                        <fieldset class="">

                                            <div class="form-group">

                                                <label class="col-lg-12 control-label">
                                                    <span class="text-semibold">Remarks</span> (
                                                    <small>For internal use</small>
                                                    )
                                                </label>
                                                <div class="col-lg-12">
                                                    <textarea name="remarks" class="form-control input-roundless"
                                                              placeholder="Remarks">{{old('remarks')}}</textarea>
                                                </div>

                                            </div>

                                        </fieldset>

                                    </div>

                                </div>
                            </div>

                            <hr class="">

                            <div class="text-left">
                                <button type="submit" class="btn btn-danger"><i class="icon-check"></i> Creat User
                                </button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>



        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

    <style>
        .label {
            text-transform: none !important;
            font-weight: 600;
        }
        .select2-selection--multiple .select2-selection__choice {
            background-color: transparent !important;
            color: inherit !important;
        }
    </style>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(function() {
            $(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
                if ($(this).hasClass("disabled")) {
                    e.preventDefault();
                    return false;
                }
            });
            $("[name=create_contact]").on("change", function(e) {
                var _c = $(".create-contact");
                if ($(this).is(":checked")) {
                    _c.removeClass('disabled');
                    _c.parent('li').removeClass('disabled');
                } else {
                    _c.addClass('disabled');
                    _c.parent('li').addClass('disabled');
                    $(".default-tab").trigger('click');
                }
            });
        });
    </script>
@endsection
