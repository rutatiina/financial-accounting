<template>
    <!-- Secondary sidebar -->
    <div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md d-print-none" style="width: 350px">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-secondary-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            <span class="font-weight-semibold">Secondary sidebar</span>
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <perfect-scrollbar class="sidebar-content ">

            <div class="card text-center">
                <div class="card-body">
                    <h6 class="font-weight-semibold mb-0 mt-1">Invoicing summary</h6>
                    <div class="text-muted mb-3">{{rgNumber(invoicesSummary.count)}} invoices issued</div>
                    <div class="svg-center position-relative mb-1" id="progress_percentage_invoices"></div>
                </div>

                <div class="card-body border-top-0 pt-0">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="text-uppercase font-size-xs text-muted">Fully Paid</div>
                            <h5 class="font-weight-semibold line-height-1 mt-1 mb-0">{{rgNumber(invoicesSummary.fullyPaid)}}</h5>
                        </div>

                        <div class="col-4">
                            <div class="text-uppercase font-size-xs text-muted">Pending</div>
                            <h5 class="font-weight-semibold line-height-1 mt-1 mb-0">{{rgNumber(invoicesSummary.pending)}}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card text-center">
                <div class="card-body">
                    <h6 class="font-weight-semibold mb-0 mt-1">Billing summary</h6>
                    <div class="text-muted mb-3">{{rgNumber(billsSummary.count)}} bills received</div>
                    <div class="svg-center position-relative mb-1" id="progress_percentage_bills"></div>
                </div>

                <div class="card-body border-top-0 pt-0">
                    <div class="row justify-content-center">

                        <div class="col-4">
                            <div class="text-uppercase font-size-xs text-muted">Fully Paid</div>
                            <h5 class="font-weight-semibold line-height-1 mt-1 mb-0">{{rgNumber(billsSummary.fullyPaid)}}</h5>
                        </div>

                        <div class="col-4">
                            <div class="text-uppercase font-size-xs text-muted">Pending</div>
                            <h5 class="font-weight-semibold line-height-1 mt-1 mb-0">{{rgNumber(billsSummary.pending)}}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-body mt-3">
                <div class="row text-center">
                    <div class="col-4">
                        <p><i class="icon-users2 icon-2x d-inline-block text-info"></i></p>
                        <h5 class="font-weight-semibold mb-0">{{rgNumber(dataCounts.customers)}}</h5>
                        <span class="text-muted font-size-sm">Customers</span>
                    </div>

                    <div class="col-4">
                        <p><i class="icon-truck icon-2x d-inline-block text-warning"></i></p>
                        <h5 class="font-weight-semibold mb-0">{{rgNumber(dataCounts.suppliers)}}</h5>
                        <span class="text-muted font-size-sm">Suppliers</span>
                    </div>

                    <div class="col-4">
                        <p><i class="icon-price-tags icon-2x d-inline-block text-success"></i></p>
                        <h5 class="font-weight-semibold mb-0">{{rgNumber(dataCounts.items)}}</h5>
                        <span class="text-muted font-size-sm">Items</span>
                    </div>
                </div>
            </div>

            <div class="card card-body mt-3">
                <div class="row text-center">
                    <div class="col-4">
                        <p><i class="icon-cash3 icon-2x d-inline-block text-info"></i></p>
                        <h5 class="font-weight-semibold mb-0">{{rgNumber(dataCounts.invoices)}}</h5>
                        <span class="text-muted font-size-sm">Invoices</span>
                    </div>

                    <div class="col-4">
                        <p><i class="icon-coin-dollar icon-2x d-inline-block text-warning"></i></p>
                        <h5 class="font-weight-semibold mb-0">{{rgNumber(dataCounts.bills)}}</h5>
                        <span class="text-muted font-size-sm">Bills</span>
                    </div>

                    <div class="col-4">
                        <p><i class="icon-cart icon-2x d-inline-block text-success"></i></p>
                        <h5 class="font-weight-semibold mb-0">{{rgNumber(dataCounts.orders)}}</h5>
                        <span class="text-muted font-size-sm">Orders</span>
                    </div>
                </div>
            </div>

        </perfect-scrollbar>
        <!-- /sidebar content -->

    </div>
    <!-- /secondary sidebar -->
</template>

<script>
    export default {
        data() {
            return {
                invoicesSummary: {},
                billsSummary: {},
                dataCounts: {}
            }
        },
        watch: {
            '$route.query.page': function (page) {
                this.tableData.url = '/financial-accounts/sales/invoices' + '?page=' + page;
            }
        },
        methods: {
            async fetchInvoicesSummary() {

                try {

                    return await axios.get('/financial-accounts/dashboard/invoices-summary')
                        .then(response => {
                            this.invoicesSummary = response.data
                            this.progressPercentage('#progress_percentage_invoices', 46, 3, "#eee", "#2196F3", this.invoicesSummary.percentagePaid)
                        })

                } catch (e) {
                    //console.log(e);
                }
            },
            async fetchBillsSummary() {

                try {

                    return await axios.get('/financial-accounts/dashboard/bills-summary')
                        .then(response => {
                            this.billsSummary = response.data
                            this.progressPercentage('#progress_percentage_bills', 46, 3, "#eee", "#2196F3", this.billsSummary.percentagePaid)
                        })

                } catch (e) {
                    //console.log(e); //test
                }
            },
            async fetchDataCounts() {

                try {

                    return await axios.get('/financial-accounts/dashboard/data-count')
                        .then(response => {
                            this.dataCounts = response.data
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error); //test
                        })
                        .finally(function (response) {
                            // always executed this is supposed
                        })

                } catch (e) {
                    console.log(e); //test
                }
            },
            progressPercentage(element, radius, border, backgroundColor, foregroundColor, end) {
                if (typeof d3 == 'undefined') {
                    console.warn('Warning - d3.min.js is not loaded.');
                    return;
                }

                // Initialize chart only if element exsists in the DOM
                if(element) {


                    // Basic setup
                    // ------------------------------

                    // Main variables
                    var d3Container = d3.select(element),
                        startPercent = 0,
                        fontSize = 22,
                        endPercent = end,
                        twoPi = Math.PI * 2,
                        formatPercent = d3.format('.0%'),
                        boxSize = radius * 2;

                    // Values count
                    var count = Math.abs((endPercent - startPercent) / 0.01);

                    // Values step
                    var step = endPercent < startPercent ? -0.01 : 0.01;


                    // Create chart
                    // ------------------------------

                    // Add SVG element
                    var container = d3Container.append('svg');

                    // Add SVG group
                    var svg = container
                        .attr('width', boxSize)
                        .attr('height', boxSize)
                        .append('g')
                        .attr('transform', 'translate(' + radius + ',' + radius + ')');


                    // Construct chart layout
                    // ------------------------------

                    // Arc
                    var arc = d3.svg.arc()
                        .startAngle(0)
                        .innerRadius(radius)
                        .outerRadius(radius - border)
                        .cornerRadius(20);


                    //
                    // Append chart elements
                    //

                    // Paths
                    // ------------------------------

                    // Background path
                    svg.append('path')
                        .attr('class', 'd3-progress-background')
                        .attr('d', arc.endAngle(twoPi))
                        .style('fill', backgroundColor);

                    // Foreground path
                    var foreground = svg.append('path')
                        .attr('class', 'd3-progress-foreground')
                        .attr('filter', 'url(#blur)')
                        .style({
                            'fill': foregroundColor,
                            'stroke': foregroundColor
                        });

                    // Front path
                    var front = svg.append('path')
                        .attr('class', 'd3-progress-front')
                        .style({
                            'fill': foregroundColor,
                            'fill-opacity': 1
                        });


                    // Text
                    // ------------------------------

                    // Percentage text value
                    var numberText = svg
                        .append('text')
                        .attr('dx', 0)
                        .attr('dy', (fontSize / 2) - border)
                        .style({
                            'font-size': fontSize + 'px',
                            'line-height': 1,
                            'fill': foregroundColor,
                            'text-anchor': 'middle'
                        });


                    // Animation
                    // ------------------------------

                    // Animate path
                    function updateProgress(progress) {
                        foreground.attr('d', arc.endAngle(twoPi * progress));
                        front.attr('d', arc.endAngle(twoPi * progress));
                        numberText.text(formatPercent(progress));
                    }

                    // Animate text
                    var progress = startPercent;
                    (function loops() {
                        updateProgress(progress);
                        if (count > 0) {
                            count--;
                            progress += step;
                            setTimeout(loops, 10);
                        }
                    })();
                }
            }
        },
        mounted() {

            //console.log('AccountingSideBarLeftDashboard: mounted')

            let jsScript = document.createElement('script')
            jsScript.setAttribute('src', '../global_assets/js/plugins/visualization/d3/d3.min.js')
            document.head.appendChild(jsScript)

            this.fetchDataCounts()

            let currentObj = this

            let everythingLoaded = setInterval(function() {
                if (/loaded|complete/.test(document.readyState)) {

                    clearInterval(everythingLoaded);

                    // this is the function that gets called when everything is loaded
                    currentObj.fetchInvoicesSummary()
                    currentObj.fetchBillsSummary()
                }
            }, 10);

        },
        updated: function () {}
    }
</script>
