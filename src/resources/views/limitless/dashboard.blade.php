@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Dashboard')

@section('content')

    <style>
        .progress-micro {
            height: 5px;
        }
    </style>
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #eee;">
            <div class="page-header-content">
                <div class="page-title">
                    <h1 class="no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Dashboard
                        <small>Quick account summary.</small>
                    </h1>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

            <div class="row mt-10"></div>

            <!-- Main charts -->
            <div class="row visible-md-block visible-lg-block">
                <div class="col-lg-12">

                    <!-- Basic column chart -->
                    <div class="panel panel-flat no-border-radius no-border no-shadow">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="highcharts_incomes_and_expenses" style="max-height: 350px;"></div>
                        </div>
                    </div>
                    <!-- /basic column chart -->

                </div>
            </div>
            <!-- /main charts -->

            <div class="row col-lg-8 col-lg-push-2">
                <div class="col-xs-12">
                    <div class="row">

                        <div class="col-sm-6 col-md-4 pr-md-0">
                            <div class="panel panel-body no-margin-bottom no-border-radius no-border-bottom no-shadow">
                                <div class="media no-margin-top content-group">
                                    <div class="media-body">
                                        <h6 class="no-margin text-semibold">Receviables Current</h6>
                                    </div>

                                    <div class="media-right media-middle">
                                        <i class="icon-cog3 text-indigo-400 opacity-75"></i>
                                    </div>
                                </div>

                                <div class="progress progress-micro mb-10">
                                    <div class="progress-bar bg-indigo-400" style="width: {{$receviable_current_percent}}%">
                                        <span class="sr-only">{{$receviable_current_percent}}% Complete</span>
                                    </div>
                                </div>
                                <span class="pull-right">{{$receviable_current_percent}}%</span>
                                Receviables Current

                            </div>
                            <div class="panel panel-body no-border-radius no-shadow">

                                <div class="media no-margin-top content-group">
                                    <div class="media-body">
                                        <h6 class="no-margin text-semibold">Receviables Overdue</h6>
                                    </div>

                                    <div class="media-right media-middle">
                                        <i class="icon-cog3 text-indigo-400 opacity-75"></i>
                                    </div>
                                </div>

                                <div class="progress progress-micro mb-10">
                                    <div class="progress-bar bg-indigo-400" style="width: {{$receviable_overdue_percent}}%">
                                        <span class="sr-only">{{$receviable_overdue_percent}}% Complete</span>
                                    </div>
                                </div>
                                <span class="pull-right">{{$receviable_overdue_percent}}%</span>
                                Receviables Overdue

                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 pl-md-0">
                            <div class="panel panel-body no-margin-bottom no-border-radius no-border-left no-border-bottom no-shadow">
                                <div class="media no-margin-top content-group">
                                    <div class="media-body">
                                        <h6 class="no-margin text-semibold">Payables current</h6>
                                    </div>

                                    <div class="media-right media-middle">
                                        <i class="icon-pulse2 text-danger-400 opacity-75"></i>
                                    </div>
                                </div>

                                <div class="progress progress-micro mb-10">
                                    <div class="progress-bar bg-danger-400" style="width: {{$payables_current_percent}}%">
                                        <span class="sr-only">{{$payables_current_percent}}% Complete</span>
                                    </div>
                                </div>
                                <span class="pull-right">{{$payables_current_percent}}%</span>
                                Payables current

                            </div>
                            <div class="panel panel-body no-border-radius no-border-left no-shadow">

                                <div class="media no-margin-top content-group">
                                    <div class="media-body">
                                        <h6 class="no-margin text-semibold">Payables Overdue</h6>
                                    </div>

                                    <div class="media-right media-middle">
                                        <i class="icon-pulse2 text-danger-400 opacity-75"></i>
                                    </div>
                                </div>

                                <div class="progress progress-micro mb-10">
                                    <div class="progress-bar bg-danger-400" style="width: {{$payables_overdue_percent}}%">
                                        <span class="sr-only">{{$payables_overdue_percent}}% Complete</span>
                                    </div>
                                </div>
                                <span class="pull-right">{{$payables_overdue_percent}}%</span>
                                Payables overdue


                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <!-- Segmented gauge -->
                            <div class="panel panel-body no-border-radius text-center no-shadow" style="min-height: 240px;">
                                <h6 class="text-semibold no-margin-bottom mt-5">Business Risk</h6>
                                <div class="text-size-small text-muted content-group-sm">{{round($business_risk * 10)}} average</div>

                                <div class="svg-center" id="segmented_gauge"></div>
                            </div>
                            <!-- /segmented gauge -->

                        </div>

                    </div>
                </div>
            </div>


            <!-- Main charts -->
            <div class="row col-lg-8 col-lg-push-2">
                <div class="col-xs-12">
                    <div class="row">

                        <div class="col-lg-8">

                            <!-- Basic column chart -->
                            <div class="panel panel-flat no-border-radius no-shadow" style="height:311px;">

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Receviables & Payables Aging</th>
                                            <th class="text-right">Receviables</th>
                                            <th class="text-right">Payables</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Current</td>
                                            <td class="text-right">{{number_format($invoice_aging['current']['outstanding'])}}</td>
                                            <td class="text-right">{{number_format($bill_aging['current']['outstanding'])}}</td>
                                        </tr>
                                        <tr>
                                            <td>Less than 30 days</td>
                                            <td class="text-right">{{number_format($invoice_aging['lessthan_30_days']['outstanding'])}}</td>
                                            <td class="text-right">{{number_format($bill_aging['lessthan_30_days']['outstanding'])}}</td>
                                        </tr>
                                        <tr>
                                            <td>31 - 60 days</td>
                                            <td class="text-right">{{number_format($invoice_aging['lessthan_60_days']['outstanding'])}}</td>
                                            <td class="text-right">{{number_format($bill_aging['lessthan_60_days']['outstanding'])}}</td>
                                        </tr>
                                        <tr>
                                            <td>61 - 90 days</td>
                                            <td class="text-right">{{number_format($invoice_aging['lessthan_90_days']['outstanding'])}}</td>
                                            <td class="text-right">{{number_format($bill_aging['lessthan_90_days']['outstanding'])}}</td>
                                        </tr>
                                        <tr>
                                            <td>Over 91 days</td>
                                            <td class="text-right">{{number_format($invoice_aging['over_90_days']['outstanding'])}}</td>
                                            <td class="text-right">{{number_format($bill_aging['over_90_days']['outstanding'])}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            <!-- /basic column chart -->

                        </div>

                        <div class="col-lg-4">
                            <div class="panel panel-body no-border-radius no-shadow">
                                <div class="media no-margin">
                                    <div class="media-body">
                                        <i class="icon-files-empty text-grey-400"></i> <span class="text-semibold pl-10">Total Invoices</span>
                                    </div>

                                    <div class="media-right media-middle">
                                        <span class="badge badge-primary">{{number_format($count_invoices)}}</span>
                                    </div>
                                </div>

                                <hr/>

                                <div class="media no-margin">
                                    <div class="media-body">
                                        <i class="icon-price-tag text-grey-400"></i> <span class="text-semibold pl-10">Total Bills</span>
                                    </div>

                                    <div class="media-right media-middle">
                                        <span class="badge badge-primary">{{number_format($count_bills)}}</span>
                                    </div>
                                </div>

                                <hr/>

                                <div class="media no-margin">
                                    <div class="media-body">
                                        <i class="icon-users text-grey-400"></i> <span class="text-semibold pl-10">Customers</span>
                                    </div>

                                    <div class="media-right media-middle">
                                        <span class="badge badge-primary">{{number_format($count_customers)}}</span>
                                    </div>
                                </div>

                                <hr/>

                                <div class="media no-margin">
                                    <div class="media-body">
                                        <i class="icon-truck text-grey-400"></i> <span class="text-semibold pl-10">Suppliers / Vendors</span>
                                    </div>

                                    <div class="media-right media-middle">
                                        <span class="badge badge-primary">{{number_format($count_suppliers)}}</span>
                                    </div>
                                </div>

                                <hr/>

                                <div class="media no-margin">
                                    <div class="media-body">
                                        <i class="icon-stack-text text-grey-400"></i> <span class="text-semibold pl-10">Items</span>
                                    </div>

                                    <div class="media-right media-middle">
                                        <span class="badge badge-primary">{{number_format($count_items)}}</span>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /main charts -->



            <!-- Footer -->
            <div class="footer text-muted">
                &copy; {{date('Y')}}. Maccounts - Financial, payroll and inventory accounting
            </div>
            <!-- /footer -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>

    <script src="/rutatiina_assets/highcharts-6.0.7/highcharts.js"></script>
    <script src="/rutatiina_assets/highcharts-6.0.7/modules/exporting.js"></script>

    <script type="text/javascript">


        $(function() {

            // Segmented gauge
            // ------------------------------
            segmentedGauge("#segmented_gauge", 200, 0, 10, 5);

            // Setup chart
            function segmentedGauge(element, size, min, max, sliceQty) {

                // Main variables
                var d3Container = d3.select(element),
                    width = size,
                    height = (size / 2) + 20,
                    radius = (size / 2),
                    ringInset = 15,
                    ringWidth = 20,

                    pointerWidth = 10,
                    pointerTailLength = 5,
                    pointerHeadLengthPercent = 0.75,

                    minValue = min,
                    maxValue = max,

                    minAngle = -90,
                    maxAngle = 90,

                    slices = sliceQty,
                    range = maxAngle - minAngle,
                    pointerHeadLength = Math.round(radius * pointerHeadLengthPercent);

                // Colors
                var colors = d3.scale.linear()
                    .domain([0, slices - 1])
                    .interpolate(d3.interpolateHsl)
                    .range(['#66BB6A', '#EF5350']);


                // Create chart
                // ------------------------------

                // Add SVG element
                var container = d3Container.append('svg');

                // Add SVG group
                var svg = container
                    .attr('width', width)
                    .attr('height', height);


                // Construct chart layout
                // ------------------------------

                // Donut
                var arc = d3.svg.arc()
                    .innerRadius(radius - ringWidth - ringInset)
                    .outerRadius(radius - ringInset)
                    .startAngle(function(d, i) {
                        var ratio = d * i;
                        return deg2rad(minAngle + (ratio * range));
                    })
                    .endAngle(function(d, i) {
                        var ratio = d * (i + 1);
                        return deg2rad(minAngle + (ratio * range));
                    });

                // Linear scale that maps domain values to a percent from 0..1
                var scale = d3.scale.linear()
                    .range([0, 1])
                    .domain([minValue, maxValue]);

                // Ticks
                var ticks = scale.ticks(slices);
                var tickData = d3.range(slices)
                    .map(function() {
                        return 1 / slices;
                    });

                // Calculate angles
                function deg2rad(deg) {
                    return deg * Math.PI / 180;
                }

                // Calculate rotation angle
                function newAngle(d) {
                    var ratio = scale(d);
                    var newAngle = minAngle + (ratio * range);
                    return newAngle;
                }


                // Append chart elements
                // ------------------------------

                //
                // Append arc
                //

                // Wrap paths in separate group
                var arcs = svg.append('g')
                    .attr('transform', "translate(" + radius + "," + radius + ")")
                    .style({
                        'stroke': '#fff',
                        'stroke-width': 2,
                        'shape-rendering': 'crispEdges'
                    });

                // Add paths
                arcs.selectAll('path')
                    .data(tickData)
                    .enter()
                    .append('path')
                    .attr('fill', function(d, i) {
                        return colors(i);
                    })
                    .attr('d', arc);


                //
                // Text labels
                //

                // Wrap text in separate group
                var arcLabels = svg.append('g')
                    .attr('transform', "translate(" + radius + "," + radius + ")");

                // Add text
                arcLabels.selectAll('text')
                    .data(ticks)
                    .enter()
                    .append('text')
                    .attr('transform', function(d) {
                        var ratio = scale(d);
                        var newAngle = minAngle + (ratio * range);
                        return 'rotate(' + newAngle + ') translate(0,' + (10 - radius) + ')';
                    })
                    .style({
                        'text-anchor': 'middle',
                        'font-size': 11,
                        'fill': '#999'
                    })
                    .text(function(d) { return d + ""; });


                //
                // Pointer
                //

                // Line data
                var lineData = [
                    [pointerWidth / 2, 0],
                    [0, -pointerHeadLength],
                    [-(pointerWidth / 2), 0],
                    [0, pointerTailLength],
                    [pointerWidth / 2, 0]
                ];

                // Create line
                var pointerLine = d3.svg.line()
                    .interpolate('monotone');

                // Wrap all lines in separate group
                var pointerGroup = svg
                    .append('g')
                    .data([lineData])
                    .attr('transform', "translate(" + radius + "," + radius + ")");

                // Paths
                pointer = pointerGroup
                    .append('path')
                    .attr('d', pointerLine)
                    .attr('transform', 'rotate(' + minAngle + ')');


                // Random update
                // ------------------------------

                // Update values
                function update() {
                    var ratio = {{$business_risk}} //scale(Math.random() * max);
                    var newAngle = minAngle + (ratio * range);
                    pointer.transition()
                        .duration(2500)
                        .ease('elastic')
                        .attr('transform', 'rotate(' + newAngle + ')');
                }
                update();

                /*/ Update values every 5 seconds
                setInterval(function() {
                    update();
                }, 5000);
                */
            }

        });

        Highcharts.chart('highcharts_incomes_and_expenses', {
            title: {
                text: 'Incomes and Expenses for the past year'
            },
            rangeSelector: {
                selected: 1
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: ['{!! implode("','", array_keys($revenues)) !!}']
            },
            yAxis: {
                title: null
            },
            series: [
                {
                    name: 'Incomes',
                    //type: 'bar',
                    data: [{{implode(',', array_values($revenues))}}],
                    type: 'spline',
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                textStyle: {
                                    fontWeight: 500
                                }
                            }
                        }
                    },
                    //step: 'center'
                },
                {
                    name: 'Expenses',
                    //type: 'bar',
                    data: [{{implode(',', array_values($expenses))}}],
                    type: 'spline',
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                textStyle: {
                                    fontWeight: 500
                                }
                            }
                        }
                    },
                    //step: 'center'
                }
            ]


        });

    </script>

@endsection


