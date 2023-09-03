<div class="card shadow-none">
   <div class="card-body">
       <div class="row">
           {{-- QUICK SUMMARY --}}
           <div class="col-lg-4">
               <p class="text-muted" style="margin: 0px !important; padding: 0px !important;">This month's Sales</p>
               <p class="text-primary" id="this-month-collection" style="font-size: 3em; font-weight: bold;">P 0.0</p>
               <p class="text-muted">versus Expenses: <span class="text-danger" id="this-month-expenses" style="font-weight: bold;">P 0.0</span></p>
           </div>

           <div class="col-lg-12">
               <div class="card shadow-none" style="height: 35vh">
                   <div class="card-body">
                       <canvas id="collection-summary-chart" height="300" style="height: 300px;"></canvas>
                   </div>
               </div>                       
           </div>
       </div>
   </div>
</div>

@push('page_scripts')
   <script>
      $(document).ready(function() {
         graphCollectionSummary()
      })

      function graphCollectionSummary() {
            var collectionSummaryChartCanvas = document.getElementById('collection-summary-chart').getContext('2d')
            // $('#application-chart-canvas').get(0).getContext('2d');
            // var areas = ['Cadiz', 'EB Magalona', 'Manapla', 'Victorias', 'San Carlos', 'Sagay', 'Escalante', 'Calatrava', 'Toboso']

            $.ajax({
                url : "{{ route('paymentTransactions.dashboard-graph-data') }}",
                type : 'GET',
                success : function(res) {
                    if (!jQuery.isEmptyObject(res)) {
                        var expenses = []
                        var sales = []
                        var labels = []

                        var expenseTotal = 0
                        var salesTotal = 0

                        $.each(res, function(index, element) {
                           sales.push(parseFloat(res[index]['SalesAmount']))
                           expenses.push(jQuery.isEmptyObject(res[index]['Expenses']) ? 0 : (res[index]['Expenses']))
                           labels.push(moment(res[index]['Month'] + '-01').format("MMM yyyy"))

                           salesTotal += jQuery.isEmptyObject(res[index]['SalesAmount']) ? 0 : parseFloat(res[index]['SalesAmount'])
                           expenseTotal += jQuery.isEmptyObject(res[index]['Expenses']) ? 0 : (res[index]['Expenses'])
                        })

                        $('#this-month-collection').text("₱ " + Number(parseFloat(salesTotal).toFixed(2)).toLocaleString())
                        $('#this-month-expenses').text("₱ " + Number(parseFloat(expenseTotal).toFixed(2)).toLocaleString())

                        var collectionSummaryChartData = {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Sales',
                                    backgroundColor: '#bdddff',
                                    borderColor: '#007bff',
                                    pointRadius: true,
                                    pointColor: '#002e5e',
                                    pointStrokeColor: 'rgba(60,141,188,1)',
                                    pointHighlightFill: '#fff',
                                    pointHighlightStroke: 'rgba(60,141,188,1)',
                                    data: sales
                                },
                                {
                                    label: 'Expenses',
                                    backgroundColor: '#ffc0b5',
                                    borderColor: '#f72500',
                                    pointRadius: true,
                                    pointColor: '#660f00',
                                    pointStrokeColor: '#660f00',
                                    pointHighlightFill: '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data: expenses
                                },
                            ]
                        }

                        var collectionSummaryChartOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                            legend: {
                                display: true
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display: false
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display: false
                                    }
                                }]
                            }
                        }

                        var collectionSummaryChart = new Chart(collectionSummaryChartCanvas, { 
                            type: 'line',
                            data: collectionSummaryChartData,
                            options: collectionSummaryChartOptions
                        })
                    }
                },
                error : function(err) {
                    console.log(err)
                } 
            })
        }
   </script>
@endpush