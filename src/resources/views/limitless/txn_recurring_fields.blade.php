<div id="txn_recurring" class="{{(\Request::is('*recurring*'))? '' : 'hidden' }}">
    <div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #eee; margin-top: -1px;"></div>
    <fieldset>

        <div class="form-group">

            <div class="max-width-1040">
                <label class="col-lg-2 control-label">
                    Repeat every
                </label>
                <div class="col-lg-4">
                    <div class="row">
                        <div id="recurring_frequency" class="col-lg-4 hidden">
                            <input type="text" name="recurring[frequency]" value="0" class="form-control input-roundless text-right" placeholder="1">
                        </div>
                        <div id="recurring_measurement" class="col-lg-12">
                            <select name="recurring[measurement]" class="select-search" data-placeholder="Repeat every ..."  data-allow-clear="false">
                                <option value="monthly">Monthly</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <!--<option value="fortnight">Fortnight</option>-->
                                <option value="2months">2 Months</option>
                                <option value="3months">3 Months</option>
                                <option value="6months">6 Months</option>
                                <option value="month">Month(s)</option>
                                <option value="day">Day(s)</option>
                                <option value="week">Week(s)</option>
                                <option value="year">Year(s)</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                    </div>



                </div>

                <div class="col-lg-3">
                    <div class="input-group">
                        <span class="input-group-addon no-border-radius">Starting</span>
                        <input type="text" name="recurring[start_date]" value="" class="form-control input-roundless daterange-single" placeholder="">

                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="input-group">
                                            <span class="input-group-addon switchery-xs  no-border-right no-border-radius">
                                                <input type="checkbox" name="billing_tax_inclusive" value="1" class="switchery" checked>
                                            </span>
                        <span class="input-group-addon no-border-left no-border-right no-padding-left">Ending</span>
                        <input type="text" name="recurring[end_date]" value="{{date('Y-m-d', strtotime('+1 year'))}}" class="form-control input-roundless daterange-single" placeholder="">

                    </div>
                </div>

            </div>

        </div>

        <div id="recurring_custom_config" class="form-group hidden">

            <div class="max-width-1040">
                <label class="col-lg-2 control-label">
                    Repeat every
                </label>

                <div class="col-lg-4">
                    <div class="input-group">
                        <div class="multi-select-full">
                            <select name="recurring[month][]" class="multiselect-number" tabindex="7" multiple="multiple" data-placeholder="...">
                                <option value="" selected>Every</option>
                                {{--
                                @foreach($crontab_options['month'] as $value => $month)
                                    <option value="{{$value}}">{{$month}}</option>
                                @endforeach
                                --}}
                            </select>
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default input-roundless" type="button">Month(s)</button>
                        </span>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="input-group">
                        <div class="multi-select-full">
                            <select name="recurring[day_of_month][]" class="multiselect" multiple="multiple" data-placeholder="...">
                                <option value="" selected>Every</option>
                                @for($i=1;$i<=31;$i++) { ?>
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default input-roundless" type="button">Day(s) of month</button>
                        </span>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="input-group">
                        <div class="multi-select-full">
                            <select name="recurring[day_of_week][]" class="multiselect" multiple="multiple" data-placeholder="...">
                                <option value="" selected>Every</option>
                                {{--
                                @foreach($crontab_options['day_of_week'] as $value => $day)
                                    <option value="{{$value}}">{{$day}}</option>
                                @endforeach
                                --}}
                            </select>
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default input-roundless" type="button">Day(s) of week</button>
                        </span>
                    </div>
                </div>


            </div>

        </div>

    </fieldset>
    <div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #eee;"></div>
</div>