<script src="{{ asset('dist') }}/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('dist') }}assets/js/hs.chartjs.js"></script>
<script>
    (function() {
        // INITIALIZATION OF CHARTJS
        // =======================================================
        document.querySelectorAll('.js-chart').forEach(item => {
            HSCore.components.HSChartJS.init(item)
        })
    })();
</script>
