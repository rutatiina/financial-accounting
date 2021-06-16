/**
 * Created by t on 9/9/2017.
 */

(function($){
    $.fn.serializeObject = function(){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };


        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };
})(jQuery);

rg_txn = function () {

    var default_item_tax_details = {
        name: '',
        id: 0,
        total:0,
        inclusive:0,
        exclusive:0
    };
    var select2_items = [];
    var taxes = {};
    var items = {};
    var total = 0;
    var txn_number = '-NA-';
    var txn_exchange_rate = 1;

    var txn_edit = function() {
        /*
        //console.log($("#txn_form").data('edit'));
        if ( $("#txn_form").data('edit') === true) {
            return true;
        } else {
            return false;
        }
        */
        return $("#txn_form").data('edit');
    };

    var discount_value = function(discount_value, multiple) {

        item_discount = 0;

        if (!rg_empty(discount_value)) {

            if (discount_value.substr(-1, 1) == '%') {
                var P = discount_value.substr(0, discount_value.length-1);

                if ( isNaN(P) ) {
                    return 0;
                }

                item_discount = rg_number(multiple) * (rg_number(P) / 100);
            }
            else {
                item_discount = (isNaN(discount_value) ? 0 : rg_number(discount_value) );
            }

        }

        return rg_number(item_discount);
    };

    var taxValue = function(taxRateOrValue, taxableAmount, taxMethod ) {
        //console.log(tax_value);
        //console.log('type of tax: ' + inclusive);
        if (typeof taxRateOrValue === 'undefined') return 0;

        if (taxRateOrValue.length > 0) {

            if (taxRateOrValue.substr(-1, 1) == '%') {

                var tax = taxRateOrValue.substr(0, taxRateOrValue.length-1);

                if ( isNaN(tax) ) {
                    return 0;
                }

                if (taxMethod === 'inclusive') {
                    return (taxableAmount - (taxableAmount / (1 + (rg_number(tax) / 100)) ) );
                }

                return ( taxableAmount * (rg_number(tax)  / 100) );
            }
            else {
                return rg_number(taxRateOrValue);
            }

        }

        return 0;
    };

    var select2_item = function () {

        var rg_item_selector = $('.rg_item_selector');

        if (typeof rg_item_selector.data('url') === 'undefined') {
            console.log('Will not get items. data-url: ' + rg_item_selector.data('url'));
            return false;
        }

        if (rg_item_selector.length) {

            $.ajax({
                url: rg_item_selector.data('url'),
                method: 'POST',
                dataType: "json",
                success: function (response, status, xhr, $form) {

                    //console.log('success::get items');

                    select2_items = response; //update the variable

                    /*
                    $('#row_0 .rg_item_selector').select2({
                        data: response,
                        minimumInputLength: 0,
                        placeholder: "Choose item :: success",
                        tags: true
                    }).on('change', function() {
                        //console.log('we are rocking the party');
                    });
                    //*/

                },
                complete : function () {
                    //console.log('complete::get items');
                    new_item(false);

                    //Edit mode is only need immediately after load .. after that it should be disabled
                    $("#txn_form").data('edit', null);
                }
            });

            //new_item(false); //if ajax is removed

        } else {
            //do nothing
        }

        // Custom results color
        $('.select-results-color-danger').select2({
            containerCssClass: 'bg-danger-400'
        });
    };

    var new_item = function(manual) {

        manual = typeof manual === 'undefined' ? true : manual;

        //console.log('new_item called');
        //console.log('manual:: '+manual);
        //console.log('txn_edit:: '+txn_edit());

        //console.log(e);
        //console.log('Cloning template');
        //console.log('#items_field_rows tr length: ' + $('#items_field_rows tr').length);

        var table_rows = $('#items_field_rows tr');

        //console.log('table_rows.length:: '+table_rows.length);
        if (manual === false && table_rows.length > 1) {

            //This means the user is editing a txn so simply set the default values
            table_rows.each(function(index, row) {

                if (index === 0) return true;
                
                var _this_ = $(this);

                var item_selector = _this_.find(".rg_item_selector");

                item_selector.select2({
                    data: select2_items,
                    minimumInputLength: 0,
                    placeholder: "Choose item",
                    tags: true,
                    multiple: true,
                    maximumSelectionLength: 1,
                    selectOnClose: true
                });

                item_selector.on("select2:select", function (e) {
                    _this_.find(".item_row_description").focus();
                });

                _this_.find(".rg_tax_selector").select2({
                    allowClear: true,
                    multiple: true,
                    maximumSelectionLength: 1
                });

                item_selector.val(item_selector.data('value')).trigger('change');

                _this_.find('.item_row_description').keyup(); //Auto size the description fields
            });

            return true;
        }

        var rows = table_rows.length; //console.log(rows);
        var index = rows - 1;

        var rg_clone = $(".items_row_template").clone();

        //console.log(rg_clone);
        //console.log(select2_items);

        //remove the item_row_template class
        rg_clone.removeClass('items_row_template hidden');
        rg_clone.attr('id', 'row_'+index);

        rg_clone.find("[name^=items]").each(function() {
            var myName = $(this).attr("name");
            $(this).attr("name", myName.replace("_index_", index));
            $(this).attr("data-row", index);
        });
        rg_clone.appendTo("#items_field_rows");

        rg_clone.find(".rg_item_selector").attr("data-row", index);
        rg_clone.find(".rg_tax_selector").attr("data-row", index);
        rg_clone.find(".item_row_delete").attr("data-row", index);

        //console.log('drawing select2');
        //console.log(select2_items);
        rg_clone.find(".rg_item_selector").select2({
            data: select2_items,
            minimumInputLength: 0,
            placeholder: "Choose / Type",
            tags: true,
            multiple: true,
            maximumSelectionLength: 1,
            selectOnClose: true
        });

        rg_clone.on("select2:select", function (e) {
            //console.log('select2 event on:select2:select');
            rg_clone.find(".item_row_description").focus();
        });

        rg_clone.find(".rg_item_selector").focus();

        rg_clone.find(".rg_tax_selector").select2({
            allowClear: true,
            multiple: true,
            maximumSelectionLength: 1
        });

    };

    var due_date = function() {

        $("#txn_form").on("change", "[name=payment_terms], [name=date_time]", function(event) {

            var terms = $('#txn_form [name=payment_terms]').val();
            var due_date = $('#txn_form [name=due_date]');

            date_time = $('#txn_form [name=date_time]').val();
            DueDate = '';

            if (date_time === '') {
                return true;
            }

            try {

                var someDate = new Date(date_time.split('-'));

            } catch(e) {

                due_date.val(DueDate);
                return '';
            }

            if (terms == '') {
                due_date.val('');
                return '';
            }
            else if (terms == 'Net7') {
                someDate.setDate(someDate.getDate() + 7);
            }
            else if (terms == 'Net10') {
                someDate.setDate(someDate.getDate() + 10);
            }
            else if (terms == 'Net30') {
                someDate.setDate(someDate.getDate() + 30);
            }
            else if (terms == 'Net60') {
                someDate.setDate(someDate.getDate() + 60);
            }
            else if (terms == 'Net90') {
                someDate.setDate(someDate.getDate() + 90);
            }
            else if (terms == 'EOM') {
                someDate = new Date(someDate.getFullYear(), someDate.getMonth()+1, 0);
            }

            var d = ('0' + (someDate.getDate())).slice(-2);
            var m = ('0' + (someDate.getMonth() + 1)).slice(-2);
            var Y = someDate.getFullYear();

            DueDate = Y + '-'+ m + '-'+ d;

            //console.log(DueDate);

            due_date.val(DueDate);

            return DueDate;

        });
    };

    var item_total = function(row_id, update_description) {

        if (typeof row_id === 'undefined') {
            console.log('not calling this function. row_id: ' + row_id);
            return false;
        }

        //console.log(row_id);

        if (typeof items[row_id] === 'undefined') {
            items[row_id] = {
                taxable_amount : 0
            };
        }

        taxes = {}; //reset the tax details

        var tr = $('#row_' + row_id);

        rate     = rg_number(tr.find('.item_row_rate').val()); //console.log('item_total > 1st rate: ' + rate);
        quantity = tr.find('.item_row_quantity').val();
        multiple = rg_number(rate) * rg_number(quantity);
        discount = discount_value(tr.find('.item_row_discount').val(), multiple);

        taxableAmount = multiple - discount;

        row_total = taxableAmount;

        items[row_id] = {
            type: null,
            type_id: 0,
            name: '',
            description: '',
            rate: rate,
            quantity: quantity,
            total: multiple,
            multiple: multiple,
            discount: discount,
            taxable_amount: taxableAmount,
            tax: $.extend( {}, default_item_tax_details),
            row_total: row_total
        };

        //get the details of the selected item
        item = tr.find('.rg_item_selector').select2('data');

        //console.log(item);

        if (item === undefined || item.length === 0) {
            //do nothing
        } else {

            //console.log(item[0]);
            item = item[0];

            items[row_id].type = item.type;
            items[row_id].type_id = (isNaN(item.id) ? 0 : item.id);
            items[row_id].name = item.text;

            items[row_id].description = tr.find('.item_row_description').val();

            tr.find('.item_row_description').removeClass('hidden'); //Remove these line if you uncomment the above code wrapped in /**/
        }
        


        //console.log(items[row_id]);

        //console.log(tr.find('.rg_tax_selector').select2('data'));

        //Get the tax details
        selectedTaxes = tr.find('.rg_tax_selector').select2('data');
        //console.log(selectedTaxes);
        //console.log(selectedTaxes[0]);
        //console.log(selectedTaxes[0].element.dataset.method);

        taxSelected = (selectedTaxes === undefined ? undefined : selectedTaxes[0]);

        if (taxSelected === undefined) {
            taxRateOrValue = '';
            taxMethod = 'exclusive';
        } else {
            taxRateOrValue = taxSelected.id;
            taxMethod = taxSelected.element.dataset.method; //tr.find('.rg_tax_selector').find(":selected").data("method");
        }

        tax = taxValue(taxRateOrValue, taxableAmount, taxMethod);

        //console.log('Selected tax: '+ tax + '(taxable amount: ' + taxableAmount + ')');

        if (taxMethod === 'inclusive') {
            items[row_id].taxable_amount = rg_number(taxableAmount) - rg_number(tax);
        }

        if (tax > 0) {
            tax_selected = tr.find('.rg_tax_selector').select2('data')[0];
            items[row_id].tax.name = tax_selected.text;
            items[row_id].tax.id = tax_selected.element.dataset.id;
            items[row_id].tax.total = rg_number(tax);

            if (taxMethod === 'inclusive') {
                items[row_id].tax.inclusive = rg_number(tax);
            } else {
                items[row_id].tax.exclusive = rg_number(tax);
            }
        } else {
            //console.log('resetting tax details for - '+row_id);
            //console.log(default_item_tax_details);
            items[row_id].tax = $.extend( {}, default_item_tax_details); //reset the item tax details if no taxation applies
        }

        //console.log(items);
        //console.log(tax);
        //console.log(tr.find('.rg_tax_selector').select2('data'));
        //tax = tr.find('.item_row_tax').val();

        //console.log(rate);

        //Update the row total with tax values
        if (taxMethod === 'inclusive') {
            total = rg_number(rg_number(rate) * rg_number(quantity) - rg_number(discount));
        } else {
            total = rg_number(rg_number(rate) * rg_number(quantity) - rg_number(discount) + rg_number(tax));
        }

        //Display the effective row total
        tr.find('.item_row_total').val(rg_number_format(total, rg_decimal_places, '.', ','));
        //console.log('item_total > total: ' + total); //console.log('item_total > rate: ' + rate);

        items[row_id].row_total = rg_number(total);

        //Display the sub total
        var sub_total = 0;
        var txn_total = 0;
        var discount_total = 0;

        //Reset the taxes
        $.each(items, function(index, value) {
            if (value.tax.id > 0) {
                taxes[value.tax.id] = {
                    id: value.tax.id,
                    name: value.tax.name,
                    inclusive: 0,
                    exclusive: 0,
                    total: 0
                };
            }
        });

        //console.log(items);

        $.each(items, function(index, value) {

            //update the transaction sub total
            sub_total = sub_total + value.taxable_amount;

            //update the transaction total
            txn_total = rg_number(txn_total) + rg_number(value.total) + rg_number(value.tax.exclusive);
            discount_total = rg_number(discount_total) + rg_number(value.discount);

            if (value.tax.id > 0) {
                taxes[value.tax.id].total += rg_number(value.tax.total);
                taxes[value.tax.id].inclusive += rg_number(value.tax.inclusive);
                taxes[value.tax.id].exclusive += rg_number(value.tax.exclusive);
            }

        });

        $('#txn_subtotal').html(rg_number_format(sub_total, rg_decimal_places, '.', ','));
        $('#txn_total').html(rg_number_format(txn_total, rg_decimal_places, '.', ','));

        $('#txn_exchange_amount').html( rg_number_format((txn_total / txn_exchange_rate), rg_decimal_places, '.', ',') );

        total = txn_total;

        var colspan = ($('.items_row_template td').length === 5)? 2 : 3;

        //Show the summary of taxes foe expense
        $('._tax_amount_').val(rg_number_format(tax, rg_decimal_places, '.', ''));
        if ( tax > 0) {
            $('#expense_tax_summary').html('Tax is '+taxMethod);
        } else {
            $('#expense_tax_summary').html('');
        }
        
        
        //display the discount and taxes totals
        html = '';

        if (discount_total > 0) {
            html += '\
                <tr>\
                    <td class="p-15 no-border"></td>\
                    <td class="p-15 no-border-left no-border-top no-border-right text-bold" colspan="'+colspan+'">Discount</td>\
                    <td class="no-border-left no-border-top no-border-right text-right pr-10" colspan="2">(' + rg_number_format(discount_total, rg_decimal_places, '.', ',') + ')</td>\
                </tr>\
            ';
        }

        $.each(taxes, function(id, value) {
            html += '\
                <tr>\
                    <td class="p-15 no-border"></td>\
                    <td class="p-15 no-border-left no-border-top no-border-right text-bold" colspan="'+colspan+'">' + value.name + '</td>\
                    <td class="no-border-left no-border-top no-border-right text-right pr-10" colspan="2">' + rg_number_format(value.total, rg_decimal_places, '.', ',') + '</td>\
                </tr>\
            ';
        });

        $('#txn_totals').html(html);

        //console.log(items);

    };

    var item_row_update = function() {

        var jq_txn_form = $('#txn_form');

        jq_txn_form.on("select2:opening", ".rg_item_selector.select2-hidden-accessible", function(e) {

            //console.log('select2 event on:select2:selecting');

            //check if contact is set
            if ( $('[name=contact_id]').val() === '' ) {

                console.log('Contact is required');
                $('#fieldset_select_contact').removeClass('select_contact').addClass('select_contact_required');
                $('#contact_required_message').removeClass('hidden');

                e.preventDefault();

            }

        });

        jq_txn_form.on("change", ".rg_item_selector", function(e) {

            //console.log('select2 event on:change');

            //Set the defaults
            element = $(this);
            item = {
                quantity: 1,
                rate: 0,
                id: 0,
                discount: 0,
                total: 0
            };

            //console.log(element.select2('data'));
            selected = $.extend({}, element.select2('data')[0]);
            //console.log(selected);
            //console.log(selected.rate);

            if (typeof selected === 'undefined') {
                selected = {
                    rate: 0,
                    tax_id: 0
                };
            } else {
                if (!rg_empty(selected.description)) {
                    jq_txn_form.find('#row_' + element.data('row')+' .item_row_description').val(selected.description).removeClass('hidden');
                }
            }

            if ( txn_edit() ) {
                //console.log(item.rate);
                //do nothing>:: do not auto enter the rates via javascript because the transaction is being edited and thus the save rates should be shown
            } else {

                if (typeof selected.rate === 'undefined') {
                    // do nothing
                    //DO NOT auto enter the rate value in the .item_row_rate field
                } else {

                    //proceed and auto enter the rate value in the .item_row_rate field

                    //console.log(item.rate); //this is new
                    item.rate = rg_number((rg_number(selected.rate) / rg_number(txn_exchange_rate))); //todo look at the function of this line
                    //console.log('item_row_update > exchange_rate: ' + txn_exchange_rate);
                    //console.log(item.rate);

                    $('#row_' + element.data('row')).find('.item_row_rate').val(item.rate.toFixed(rg_decimal_places));
                }
            }

            //console.log('item.rate: '+item.rate);

            //item.total = rg_number(item.rate) * rg_number(item.quantity);

            //console.log('#row_' + element.data('row'));
            //console.log('item_row_update > txn_edit :' + txn_edit());

            item_total(element.data('row'));

        });

        jq_txn_form.on("keyup", ".item_row_rate, .item_row_discount, .item_row_quantity", function(event) { //.item_row_description,

            //console.log('we are here');

            element = $(this);

            //console.log('#row_' + element.data('row'));

            item_total(element.data('row'));

        });

        jq_txn_form.on("keyup", ".item_row_description", function(event) {

            //console.log('description edited');

            element = $(this);

            //console.log('#row_' + element.data('row'));

            item_total(element.data('row'));
            items[element.data('row')].description = element.val();

        });

        jq_txn_form.on("change", ".rg_tax_selector", function(event) {
            element = $(this);
            item_total(element.data('row'));
        });

    };

    var item_row_delete = function() {

        $('#txn_form').on("click", ".item_row_delete", function(e) {

            element = $(this);
            row_id = element.data('row');

            e.preventDefault();
            e.stopPropagation();

            //Nulfy the row totals
            $('#row_' + row_id).find('.item_row_rate').val(0);
            item_total(row_id);
            delete  items[row_id];

            //Destroy the select2 fields
            $('#row_'+row_id).find(".rg_item_selector, .rg_tax_selector").select2("destroy");

            //Now remove the row
            $('#row_'+row_id).remove();

            //console.log('Row #'+row_id+' deleted');

            return true;

        });
    };

    var reset_txn_form = function() {

        var form = $('#txn_form');

        form.trigger("reset"); //first reset the form fields

        form.find(".select").val('').trigger('change');
        form.find(".select-search").val('').trigger('change');
        form.find("[name=internal_ref]").val('');
        form.find(".item_row_description").val('').hide();

        //Remove all the details rows without the class .on-reset-remove
        $("[id^=row_]").not('.on-reset-remove').remove();

        $.each(items, function(row_id, value) {

            $element = $('#row_' + row_id);

            console.log('Form reset');

            //nullify the row totals
            $element.find('.item_row_rate').val(0);
            item_total(row_id);
            delete  items[row_id];

            //Destroy the select2 fields
            $element.not('.on-reset-remove').find(".rg_item_selector, .rg_tax_selector").select2("destroy");

            //Now remove the row
            $element.not('.on-reset-remove').remove();
        });

        items = []; //delete all items

        new_item(); //Add a new item field

        $('#rg-num-of-attahed-files').html('');
        $('#rg-attahed-file-names').html('');
        $('#dropzone_remove_all_files').html('');

        $('#txn_totals').html('');
        $('#txn_subtotal').html('0.00');
        $('#txn_total').html('0.00');

        $('div.btn-group').removeClass('open'); //hide the options of the btn group
        $('#txn_exchange_rate').hide(); //hide the exchange rate fields
        $('#contact_currency').addClass('hidden'); //hide the contact currency for the transaction

        if (txn_number !== '-NA-') {
            form.find("[name=number]").val(txn_number);
        }
    };

    var datatable_invoices = function () {

        $('#datatable-invoices').DataTable({
            ajax: '/invoices/datatable_json/',
            columnDefs: [
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 'checkbox'
                }
            ],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            //order: [[1, false]],
            ordering: false,
            info: false,
            bLengthChange: false,
            bFilter: false,
            iDisplayLength: 20,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": "number", "sClass": "pl-5" },
                { "mDataProp": "total", "sClass": "" }
            ],
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var column_two = '<h6 class="no-margin">' +
                    '<span>'+aData['contact_name']+'</span>' +
                    '<small class="display-block text-muted">' +
                    '<a href="/invoices/view/'+aData['id']+'">#'+aData['number']+'</a> | ' + aData['date'] +
                    '</small>' +
                    '</h6>';

                var column_three = '<h6 class="no-margin text-right">' +
                    '<small>'+aData['quote_currency']+'</small> ' + aData['total'] +
                    '<small class="display-block text-muted text-size-small">'+aData['status']+'</small>' +
                    '</h6>';

                $('td:eq(0)', nRow).html('');
                $('td:eq(1)', nRow).html(column_two);
                $('td:eq(2)', nRow).html(column_three);
            }
        });
    };

    var recurring = function() {

        //Show the custom repeat config fileds if needed
        $("#txn_form").on("change", "#recurring_measurement select", function(event) {
            var value = $(this).val();
            var frequency = $('#recurring_frequency');
            var measurement = $('#recurring_measurement');
            var custom_config = $('#recurring_custom_config');
            //console.log($(this).val());

            if (value === 'custom') {
                custom_config.removeClass('hidden');
            } else {
                custom_config.addClass('hidden');
            }

            if ( value === 'day' || value === 'week' || value === 'month' || value === 'year' ) {
                frequency.removeClass('hidden');
                measurement.removeClass('col-lg-12').addClass('col-lg-8 no-padding-left');
            } else {
                frequency.addClass('hidden');
                measurement.removeClass('col-lg-8 no-padding-left').addClass('col-lg-12');
            }
        });
    };

    var on_contact_change = function () {

        $('[name=contact_id]').change(function () {
            var t = $(this);
            var contact_id = $(this).val();

            //console.log('contact has been changed');

            //$('#contact_currency').addClass('hidden'); //using tenant base currency as default
            
            if(contact_id == '') {
                $('#fieldset_select_contact').removeClass('select_contact').addClass('select_contact_required');
                $('#contact_required_message').removeClass('hidden');
                return false;
            }

            $('#fieldset_select_contact').removeClass('select_contact_required').addClass('select_contact');
            $('#contact_required_message').addClass('hidden');

            //******************************
            $('#contact_currency').removeClass('hidden');
            //var currencies = t.find(':selected').data('currencies').split(',');
            //console.log(t.find(':selected').data('exchange_rates'));
            var currencies = jQuery.parseJSON(JSON.stringify(t.find(':selected').data('exchange_rates')));
            $("#base_currency").html('');
            $("#base_currency").select2("destroy");

            var select2Data = [];
            $.each(currencies, function(index, value) {
                select2Data.push({"id": index, "text": index, "exchange_rate":value});
            });


            $("#base_currency").select2({
                minimumResultsForSearch: Infinity,
                data: select2Data
            });

            $('#base_currency').val(Object.keys(currencies)[0]).trigger('change');
            //******************************

        });

        return false;

    };

    var on_base_currency_change = function () {

        $('#base_currency').change(function () {

            var selected = $.extend({}, $(this).select2('data')[0]); //console.log(selected);

            $('#txn_base_currency').html(selected.id);

            var quote_currency = $('[name=quote_currency]').val();

            if ( quote_currency != selected.id ) {
                
                var selected = $.extend({}, $(this).select2('data')[0]);
                //console.log('EX rate is: ' + selected.exchange_rate);

                txn_exchange_rate = rg_number(selected.exchange_rate);
                $('#txn_exchange_rate').show();
                $('[name=exchange_rate]').val(txn_exchange_rate);
                
                /*console.log('Call the exchange rate function');
                $("#base_currency").select2({
                    minimumResultsForSearch: Infinity,
                    data: response.select2_options
                });
                $('#base_currency').val(response.currency[0]).trigger('change');
                txn_exchange_rate = response.exchange_rate[response.currency[0]];                        
                console.log(txn_exchange_rate);

                item_total(0);
                */

                //https://openexchangerates.org/api/latest.json?app_id=52d8a2b2cea64d81ab6231628d68c7a3
            } else {
                $('#txn_exchange_rate').hide();
                $('[name=exchange_rate]').val(selected.exchange_rate);
                txn_exchange_rate = selected.exchange_rate;
                //console.log('EX rate is: ' + selected.exchange_rate);
            }

            //item_row_update();
            //item_total(0);
            $('#txn_form').find(".rg_item_selector").not("[name*='_index_']").change();
            //console.log('called change on rg_item_selector');
            
        });

        return false;

    };

    var on_exchange_rate_change = function () {

        $('[name=exchange_rate]').change(function () {
            txn_exchange_rate = rg_number($(this).val());
        });
    };

    var show_recurring = function() {

        var txn_recurring = $('#txn_recurring');

        if (txn_recurring.hasClass('hidden')) {

            txn_recurring.removeClass('hidden');
            //window.location.hash = "#txn_recurring";
            //console.log($("#txn_recurring").offset().top);
            //$("body").scrollTop($("#txn_recurring").offset().top);
            window.scrollTo(window.scrollX, txn_recurring.offset().top - 50);

            return false;

        } else {

            txn_recurring.addClass('hidden');
            return false;

        }
        
    };

    /*
    to be deleted
    var form_reset = function () {

        var form = $('#txn_form');
        
        $.each(items, function(row_id, value){
            //Nulfy the row totals
            $('#row_' + row_id).find('.item_row_rate').val(0);
            item_total(row_id);
            delete  items[row_id];

            //Destroy the select2 fields
            $('#row_'+row_id).find(".rg_item_selector, .rg_tax_selector").select2("destroy");

            //Now remove the row
            $('#row_'+row_id).remove();
        });

        form[0].reset();

        if (txn_number !== '-NA-') {
            form.find("[name=number]").val(txn_number);
        }

        //clear the customer/supplier field
        $("[name=contact_id]").val('').trigger('change')

    }
    */

    var attach_file = function (action) {

        Dropzone.options.rgDropzone = {

            // Prevents Dropzone from uploading dropped files immediately
            autoProcessQueue: false,
            
            addRemoveLinks: true,
            uploadMultiple: true,
            parallelUploads: 5,
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 5, 
            maxFilesize: 5, // MB
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',

            //new
            clickable : '#rg-txn-attache-files, #rg-dropzone',
            createImageThumbnails: false,
          
            init: function() {
                
                var submitButtons = document.querySelectorAll(".submit_txn_form");
                var rgDropzone = this; // closure
                var form = $('#txn_form');
                var rg_num_of_attahed_files = $('#rg-num-of-attahed-files');
                var rg_attahed_file_names = $('#rg-attahed-file-names');
                var dropzone_remove_all_files = $('#dropzone_remove_all_files');
                var onsuccess = null;
                
                
                for (var i = 0; i < submitButtons.length; i++) {
                    submitButtons[i].addEventListener("click", function(e) {

                        onsuccess = $(this).data('onsuccess'); //console.log(onsuccess);
                        resetForm = $(this).data('reset-form'); //console.log(resetForm);

                        e.preventDefault();
                        e.stopPropagation();

                        var processQueue = rgDropzone.processQueue(); // Tell Dropzone to process all queued files.

                        // To access all uploading files count
                        var getUploadingFiles = rgDropzone.getUploadingFiles().length;

                        //console.log(getUploadingFiles);
                        
                        if (getUploadingFiles === 0) {

                            console.log('Txn has no files to upload');

                            //Post form with ajax
                            //console.log('Posting with ajax');

                            PNotify.removeAll();
            
                            var notice = new PNotify({
                                //title: "Please wait",
                                text: 'Please wait as perform some magic...',
                                addclass: 'bg-primary',
                                type: 'info',
                                icon: 'icon-spinner4 spinner',
                                hide: false,
                                buttons: {
                                    closer: true,
                                    sticker: false
                                },
                                opacity: .9,
                                width: "350px"
                            });
                    
                            var options = {
                                buttons: {
                                    closer: true,
                                    sticker: true
                                },
                                width: "350px"
                            };

                            data = form.serializeObject();

                            data._token = form.find('[name=_token]').val(); //laravel
                            data._method = form.find('[name=_method]').val(); //laravel

                            if (form.data('use-native-fields') === true) {
                                //do nothing
                            } else {
                                data.items = $.extend({}, items); //Override the items values
                                data.taxes = $.extend({}, taxes);
                                data.total = total;
                                data.on_success = onsuccess;
                            }

                            $.ajax({
                                url: form.attr('action'),
                                method: form.attr('method'),
                                data: data,
                                dataType: "json",
                                success: function(response, status, xhr, $form) {

                                    if (response.status === true) {

                                        options.title = "Done!";
                                        options.text = response.message;
                                        options.addclass = "bg-success";
                                        options.type = "success";
                                        //options.hide = true;
                                        options.icon = 'icon-checkmark3';
                                        options.opacity = 1;
                                        options.width = PNotify.prototype.options.width;
                    
                                        notice.update(options);

                                        if (response.callback !== undefined) {
                                            window.location.href = response.callback;
                                        }

                                        //console.log(onsuccess);

                                        if (data._method === 'PUT' || data._method === 'PATCH') {
                                            history.go(-1);
                                        }
                    
                                        //if (onsuccess) window.location.href = onsuccess;

                                        if (data.on_submit === 'draft') {
                    
                                        } else if (data.on_submit === 'send') {
                    
                                        }

                                        if (response.number !== '-NA-') {
                                            form.find("[name=number]").val(response.number);
                                        }
                    
                                        //Reset the form fields
                                        txn_number = response.number;

                                        //if (resetForm === true) reset_txn_form();
                                        reset_txn_form(); //reset the form by default

                                    } else {
                    
                                        options.title = "Error(s)!";
                                        options.text = response.message;
                                        options.addclass = "bg-danger";
                                        options.type = "danger";
                                        options.icon = 'icon-alert';
                    
                                        notice.update(options);
                                    }

                                }
                            });
                        }

                    }) 
                };
                
                //console.log(dropzone_remove_all_files);

                dropzone_remove_all_files.click(function(e){
                    e.preventDefault();
                    e.stopPropagation();

                    //console.log('removeAllFiles');
                    rgDropzone.removeAllFiles();
                    rg_num_of_attahed_files.html('');
                    rg_attahed_file_names.html('');
                    dropzone_remove_all_files.hide();
                });

                // You might want to show the submit button only when 
                // files are dropped here:
                rgDropzone.on("addedfile", function(file) {

                    setTimeout(function () {

                        // Show submit button here and/or inform user to click it.

                        // To access all files count
                            //myDropzone.files.length
                        // To access only accepted files count
                            //myDropzone.getAcceptedFiles().length
                        // To access all rejected files count
                            //myDropzone.getRejectedFiles().length
                        // To access all queued files count
                            //myDropzone.getQueuedFiles().length
                        // To access all uploading files count
                            //myDropzone.getUploadingFiles().length
                        
                        //console.log(rgDropzone.getQueuedFiles());
                        //console.log(file);
                        //console.log('xxxxxxxx');

                        get_accepted_files = rgDropzone.getAcceptedFiles().length;
                        rg_num_of_attahed_files.html(get_accepted_files + ' file(s) attached.');
                        rg_attahed_file_names.append('<br>' + file.name);
                        dropzone_remove_all_files.show();

                    }, 10);
                });

                rgDropzone.on('sending', function(file, xhr, formData) {

                    PNotify.removeAll();
        
                    var notice = new PNotify({
                        //title: "Please wait",
                        text: 'Please wait as perform some magic xxx...',
                        addclass: 'bg-primary',
                        type: 'info',
                        icon: 'icon-spinner4 spinner',
                        hide: false,
                        buttons: {
                            closer: true,
                            sticker: false
                        },
                        opacity: .9,
                        width: "350px"
                    });
                
                    $.each(form.serializeObject(), function(index, value) {
                        //console.log(index); //console.log(value);
                        if (index != 'items') {
                            formData.append(index, JSON.stringify(value));
                            //formData.append(index, value );
                        }
                    });                    

                    if (form.data('use-native-fields') === true) {
                        //do nothing
                    } else {
                        formData.append('items', JSON.stringify(items));
                        formData.append('taxes', JSON.stringify(taxes));
                        formData.append('total', JSON.stringify(total));
                        formData.append('on_success', onsuccess);
                    }

                });

                rgDropzone.on("processing", function(file) {
                    rgDropzone.options.url = form.attr('action');
                });

                rgDropzone.on("success", function(file, response) {

                    console.log('Txn has files to upload');

                    //console.log(response);

                    rgDropzone.removeFile(file);
                    
                    response = JSON.parse(response);

                    PNotify.removeAll();
        
                    var notice = new PNotify({
                        //title: "Please wait",
                        text: 'Please wait as perform some magic xxx...',
                        addclass: 'bg-primary',
                        type: 'info',
                        icon: 'icon-spinner4 spinner',
                        hide: false,
                        buttons: {
                            closer: true,
                            sticker: false
                        },
                        opacity: .9,
                        width: "350px"
                    });

                    var options = {
                        buttons: {
                            closer: true,
                            sticker: true
                        },
                        width: "350px"
                    };

                    if (response.status === true) {

                        options.title = "Done!";
                        options.text = response.message;
                        options.addclass = "bg-success";
                        options.type = "success";
                        //options.hide = true;
                        options.icon = 'icon-checkmark3';
                        options.opacity = 1;
                        options.width = PNotify.prototype.options.width;
    
                        notice.update(options);
    
                        if (action.on_submit === 'view') {
                            //window.location.href = '/invoices/view/' + response.txn.id;
                        } else if (action.on_submit === 'draft') {
    
                        } else if (action.on_submit === 'send') {
    
                        }
    
                        //Reset the form fields
                        txn_number = response.number;
                        if (resetForm === true) reset_txn_form();

    
                    } else {
    
                        options.title = "Error(s)!";
                        options.text = response.message;
                        options.addclass = "bg-danger";
                        options.type = "danger";
                        options.icon = 'icon-alert';
    
                        notice.update(options);
                    }
                });

          
            }
          }
          
    };

    return {
        // public functions
        init: function() {

            txn_edit();
            select2_item();
            due_date();
            item_row_update();
            item_row_delete();
            recurring();
            on_contact_change();
            on_base_currency_change();
            attach_file('draft');
            on_exchange_rate_change();

            try {
                datatable_invoices();
            } catch (e) {
                console.log(e);
            }

        },
        new_item: function() {
            new_item();
        },
        /*on_submit: function (a) {
            on_submit(a);
        },*/
        show_recurring: function () {
            show_recurring();
        },
        form_reset: function () {
            //form_reset();
            reset_txn_form();
        },
        reset_txn_form: function () {
            reset_txn_form();
        }
    };
}();

jQuery(document).ready(function () {

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });


    rg_txn.init();
    //rg_txn.new_item(); //this function is called after the select2 values are ajax loaded

});
