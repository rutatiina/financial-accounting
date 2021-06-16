/**
 * Created by t on 9/9/2017.
 */
txn_entree = function () {

    var config = function(state) {

        var table_rows = $('#txn_entree_field_rows tr');

        var rows = table_rows.length; //console.log(rows);
        var index = rows - 1;

        if (rows > 1 && state === false) { //alert('there');
            table_rows.not(".txn_entree_row_template").find("select").select2({});
            return true;
        }

        var rg_clone = $(".txn_entree_row_template").clone();

        //console.log(rg_clone);
        //console.log(select2_items);

        //remove the item_row_template class
        rg_clone.removeClass('txn_entree_row_template hidden');
        rg_clone.addClass('_remove_on_success_');
        rg_clone.attr('id', 'row_'+index);

        rg_clone.find("select").each(function() { //alert('here');
            var myName = $(this).attr("name");
            $(this).attr("name", myName.replace("_index_", index));
            $(this).attr("data-row", index);
        });

        rg_clone.appendTo("#txn_entree_field_rows");

        rg_clone.find("select").select2({});
    }

    var txn_entree_config = function(config) {
        //console.log('we get it');
        html = '<div style="margin:0px 50px;">';
        $.each(config, function(index, value) {
            html += '<div><span class="col-md-1">Debit:</span> ' + value.debit_name + '</div>';
            html += '<div><span class="col-md-1">Credit:</span> ' + value.credit_name + '</div>';
            if (config.length > 1) {
                html += '<hr>';
            }
        });
        html += '</div>';
        return html;
    }

    var datatable_txn_entree = function() {

        var table = $('.rg-datatable');

        var dtable = table.DataTable({
            pagingType: "simple",
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 10,
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
            columnDefs: [{
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
                                $('.rg_datatable_onselect_btns1').slideDown(100);
                            } else {
                                $('.rg_datatable_onselect_btns1').slideUp(100);
                            }
                        }
                    },
                },
                {
                    'targets': [0],
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
                { "mDataProp": "name", "sClass": "details" },
                { "mDataProp": "valuation", "sClass": "details" },
                { "mDataProp": "fields", "sClass": "details" },
                { "mDataProp": null, "sClass": "text-center" }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var action = '<ul class="icons-list">\
                    <li><a href="'+APP_URL+'/financial-accounts/settings/txn-entree/' + aData['id'] + '/edit"><i class="icon-pencil7"></i></a></li> \
                </ul>';
                
                if (aData.tenant_id != TENANT_ID) {
                    $('td:eq(0)', nRow).find('input').attr('disabled', 'disabled');
                    $('td:eq(4)', nRow).html('');
                } else {
                    $('td:eq(4)', nRow).html(action);
                }

                $(nRow).find('td.details').click(function() {
                    var p = $(this).parent()
                    if (p.hasClass('shown') && p.next().hasClass('row-details')) {
                        p.removeClass('shown');
                        p.next().remove();
                        return;
                    }
                    var tr = p.closest('tr');
                    var row = table.DataTable().row(tr);

                    p.parents('tbody').find('.shown').removeClass('shown');
                    p.parents('tbody').find('.row-details').remove();

                    row.child(txn_entree_config(aData['config'])).show();
                    tr.addClass('shown');
                    tr.next().addClass('row-details');
                });
                
            }
        });

        $('.rg_datatable_onselect_btns1').on('click', '.rg_datatable_selected_delete', function(ev) {

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
                },
                onFailureCallback: function() {
                    //console.log('this is the failure callback');
                },
            
                title: "Are you sure?",
                text: "You will not be able to recover this Invoice(s)!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!"
            });
                
        });

    }

    return {
        // public functions
        init: function() {
            datatable_txn_entree();
        },
        config: function(state) {
            config(state);
        }

    };
}();

jQuery(document).ready(function () {
    txn_entree.init();
    txn_entree.config(false);
});
