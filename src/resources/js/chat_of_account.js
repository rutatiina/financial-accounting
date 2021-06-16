/**
 * Created by t on 9/9/2017.
 */
chat_of_accounts = function () {

    var testFunction = function() {
        console.log('Success: Load rutatiina > metronic js');
    }

    var form_data_object = function(form) {
        var data = {};
        $.each(form.serializeArray(), function(_, kv) {
            data[kv.name] = kv.value;
        });
        return data;
    }

    var form_ajax_submit = function (form_id, form_reset) {

        form_reset = typeof form_reset !== 'undefined' ? form_reset : true;

        console.log('Ajax processing form '+form_id);

        var form = $(form_id);

        //Prepare the notification
        PNotify.removeAll();

        var notice = new PNotify({
            //title: "Please wait",
            text: 'Please wait as perform some magic ...',
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

        var data = form_data_object(form);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: data,
            dataType: "json",
            success: function(response, status, xhr, $form) {

                //Update the cross dite tocken
                //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

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

                    //Hide the modal
                    $('#rg_modal_account').modal('hide');

                } else {
                    options.title = "Error(s)!";
                    options.text = response.message;
                    options.addclass = "bg-danger";
                    options.type = "danger";
                    options.icon = 'icon-alert';

                    notice.update(options);
                }

                if (form_reset === true) {

                    form.trigger("reset");
                    form.find(".select-search, .select").val("").trigger('change');
                    //item_type_change('product');

                    if (form_id === '#item_form') {
                        console.log('#item_type_'+data.type);
                        form.find('#item_type_'+data.type).trigger('click');
                        //form.find('#item_rates').removeClass('service_rates cost_center_rates');
                    }
                }

            }
        });


    }

    var datatable = function() {

        var dtable = $('.rg_datatable').DataTable({
            serverSide: true,
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-default'
                    }
                },
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-copy3"></i>'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-file-excel"></i>'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-file-pdf"></i>'
                    }
                ]
            },
            pagingType: "simple",
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            /*columnDefs: [
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }
            ],*/
            columnDefs: [
                {
                    'targets': 0,
                    "orderable": false,
                    'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(nodes, selected, indeterminate) {
                            //nodes: [Array] List of cell nodes td containing checkboxes.
                            //selected: [Boolean]  Flag indicating whether checkbox has been checked.
                            //indeterminate: [Boolean] Flag indicating whether “Select all” checkbox has indeterminate state.
                            //console.log(nodes);
                            //console.log(selected);

                            var rows_selected = nodes.column(0).checkboxes.selected().length;
                            if (rows_selected > 0) {
                                $('.rg_datatable_onselect_btns').show();
                                //$('.page-header').hide();
                            } else {
                                $('.rg_datatable_onselect_btns').hide();
                                //$('.page-header').show();
                            }
                        }
                    },
                },
                {
                    "orderable": false,
                    'targets': [0,6,7,8]
                },
                {
                    "searchable": false,
                    'targets': [0,6,7,8]
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [0, false],
                [2, "asc" ]
            ],
            ordering: true,
            //info: true,
            //bLengthChange: true,
            //bFilter: true,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": "name", "sClass": "pointer " },
                { "mDataProp": "code", "sClass": "pointer " },
                { "mDataProp": "type", "sClass": "pointer " },
                { "mDataProp": 'sub_type', "sClass": "pointer " },
                { "mDataProp": 'description', "sClass": "pointer " },
                { "mDataProp": 'balance.debit', "sClass": "pointer text-right" },
                { "mDataProp": 'balance.credit', "sClass": "pointer text-right" },
                { "mDataProp": null }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(6)', nRow).html(rg_number_format(aData.balance.debit, 2));
                $('td:eq(7)', nRow).html(rg_number_format(aData.balance.credit, 2));

                if (rg_empty(aData['tenant_id'])) {
                    $('td:eq(0)', nRow).find("input[type=checkbox]").attr("disabled", true);
                    $('td:eq(8)', nRow).html('');
                } else {
                    var a = '\
                    <ul class="icons-list">\
                        <li><a href="'+APP_URL+'/financial-accounts/accounts/'+aData.id+'/edit" title="Edit item"><i class="icon-pencil7"></i></li>\
                        <li><a href="/financial-accounts/accounts/'+aData.id+'/delete" title="Delete item" class="rg_datatable_row_delete"><i class="icon-bin"></i></a></li>\
                    </ul>';
                    $('td:eq(8)', nRow).html(a);
                }



                $('td:gt(0)', nRow).click(function() {
                    document.location.href = aData['link_account_statement'];
                });

                $(nRow).hover(
                    function() {
                        $(this).addClass('text-primary');
                    },
                    function() {
                        $(this).removeClass('text-primary');
                    }
                );
            }
        });

        $('.navbar-fixed-top').on('click', '.rg_datatable_selected_delete, .rg_datatable_row_delete', function(ev) {

            ev.stopPropagation();
            ev.preventDefault();

            var ids = [];
            var url = (rg_empty($(this).data('url')) ? $(this).attr('href') : $(this).data('url'));

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            try {
                $.each(rows_selected, function(index, rowId) {
                    ids[index] = rowId;
                });
            } catch(e) {
                //do nothing
            }

            //console.log(ids);

            rutatiina.transaction_delete({
                datatable: dtable,
                url: url,
                data: { ids: ids },
            
                onSuccessCallback: function(dtable) {
                    dtable.ajax.reload();
                    $('.rg_datatable_onselect_btns').slideUp(100);
                },
                onFailureCallback: function() {
                    //console.log('this is the failure callback');
                },
            
                title: "Are you sure?",
                text: "You will not be able to recover this account(s)!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!"
            });
                
        });

        $('.search-accounts').on('click', function () {
            var _this = $(this);
            dtable.columns(3).search(_this.data('search')).draw();
        });

        $('#navbar_top_search').keypress(function(e){
            if(e.which === 13) {
                e.preventDefault();
                dtable.search($(this).val()).draw() ;
            }
        });

        return dtable;

    }

    return {
        // public functions
        init: function() {
            testFunction();

            try {
                datatable();
            } catch (e) {
                console.log(e);
            }
        },
        testFunction: function() {
            testFunction();
        },
        form_ajax_submit: function(form_id) {
            form_ajax_submit(form_id);
        }
    };

}();


jQuery(document).ready(function () {
    
    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '100px',
            targets: [5]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        //dom: '<"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    chat_of_accounts.init();

});


