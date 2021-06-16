/**
 * Created by t on 9/9/2017.
 */
rg_recurring_expenses = function() {

    var datatable_sidebar = function() {

        var _table = $('.rg_datatable_sidebar');
        var txnId = _table.data('txn-id');

        var dtable = _table.DataTable({
            pagingType: "simple",
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            columnDefs: [
                {
                    'targets': [0,1],
                    "orderable": false 
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [0, false]
            ],
            ordering: false,
            info: false,
            bLengthChange: false,
            //bFilter: false, //to allow search
            iDisplayLength: 20,
            aoColumns: [
                { "mDataProp": "number", "sClass": "pointer " },
                { "mDataProp": "total", "sClass": "pointer " }
            ],
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

                if (aData.id == txnId) $(nRow).addClass('active');

                var column_two = '<h6 class="no-margin">' +
                    '<span>'+aData['contact_name']+'</span>' +
                    '<small class="display-block text-muted">' +
                    aData['number'] +
                    '</small>' +
                    '</h6>';

                var column_three = '<h6 class="no-margin text-right">' +
                    '<small>'+aData['quote_currency']+'</small> ' + rg_number_format(aData['total']) +
                    '<small class="display-block text-muted text-size-small">'+aData['date']+'</small>' +
                    '</h6>';

                $('td:eq(0)', nRow).html(column_two);
                $('td:eq(1)', nRow).html(column_three);

                $(nRow).click(function() {
                    document.location.href = aData['link_show'];
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

        if (_table.is(':visible')) {
            $('#navbar_top_search').keypress(function(e){
                if(e.which === 13) {
                    e.preventDefault();
                    dtable.search($(this).val()).draw() ;
                }
            });
        }

    };
    
    var datatable_txns = function() {

        var _table = $('.rg-datatable-txns-table');

        var dtable = _table.DataTable({
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
            iDisplayLength: 20,
            aLengthMenu: [
                [10, 20, 50, 100],
                [10, 20, 50, 100]
            ],
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
                                $('.page-header').hide();
                            } else {
                                $('.rg_datatable_onselect_btns').hide();
                                $('.page-header').show();
                            }
                        }
                    },
                },
                {
                    'targets': [0, 5, 6, 7],
                    "orderable": false
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [0, false]
            ],
            ordering: false,
            //info: false,
            //bLengthChange: false,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": null, "sClass": "pl-5 pr-5" },
                { "mDataProp": "date", "sClass": "pl-5 pointer" },
                { "mDataProp": null, "sClass": "pointer" },
                { "mDataProp": "reference", "sClass": "pointer" },
                { "mDataProp": 'contact_name', "sClass": "pointer" },
                { "mDataProp": null, "sClass": "pointer" },
                { "mDataProp": 'contact_name', "sClass": "pointer" },
                { "mDataProp": 'total', "sClass": "pointer text-right text-semibold" }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                $('td:eq(3)', nRow).html(aData.debit_account.name);
                $('td:eq(6)', nRow).html(aData.credit_account.name);
                $('td:eq(8)', nRow).html(rg_number_format(aData.total) + ' ' + aData.base_currency);

                var action = '\
                <ul class="icons-list">\
                    <li title="Copy"><a href="'+aData.link_copy+'"><i class="icon-files-empty2"></i></a></li>\
                </ul>\
                ';

                $('td:eq(1)', nRow).html(action);

                $('td:gt(1)', nRow).click(function() {
                    document.location.href = aData.link_show;
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

        $('body').on('click', '.rg_datatable_selected_delete, .rg_datatable_row_delete', function(ev) {

            ev.stopPropagation();
            ev.preventDefault();

            var ids = [];
            var url = (rg_empty($(this).data('url')) ? $(this).attr('href') : $(this).data('url'));

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId) {
                ids[index] = rowId;
            });

            //console.log(ids);

            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the record(s)!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                },
                function(isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: { ids: ids },
                            dataType: "json",
                            success: function(response, status, xhr, $form) {

                                //Update the cross dite tocken
                                //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

                                if (response.status === true) {
                                    swal({
                                        title: "Deleted!",
                                        text: response.message,
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 2000
                                    });

                                    //Redraw the the table
                                    dtable.ajax.reload();

                                    $('.rg_datatable_onselect_btns').slideUp(100);

                                } else {
                                    swal({
                                        title: "Failed!",
                                        text: response.message,
                                        confirmButtonColor: "#66BB6A",
                                        type: "danger",
                                        timer: 2000
                                    });
                                }

                            }
                        });

                    }
                });
        });

        $('body').on('click', '.rg_datatable_selected_export_to_excel', function(ev) {

            console.log('export to excel');

            ev.stopPropagation();
            ev.preventDefault();

            var ids = [];
            var url = (rg_empty($(this).data('url')) ? $(this).attr('href') : $(this).data('url'));

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            try {
                $.each(rows_selected, function(index, rowId) {
                    ids['ids['+index+']'] = rowId;
                });
            } catch(e) {
                //do nothing
            }

            //console.log(ids);

            rg_js_post(url, ids, 'post');

        });

        if (_table.is(':visible')) {
            $('#navbar_top_search').keypress(function(e){
                if(e.which === 13) {
                    e.preventDefault();
                    dtable.search($(this).val()).draw() ;
                }
            });
        }

        return dtable;

    };

    return {
        // public functions
        init: function() {
            try {
                datatable_sidebar();
            } catch (e) {
                console.log(e);
            }

            try {
                datatable_txns();
            } catch (e) {
                console.log(e);
            }

        }
    };
}();

jQuery(document).ready(function() {

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
        //dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        dom: '<"datatable-scroll-wrap"t><"datatable-footer"ip>',
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


    rg_recurring_expenses.init();

});