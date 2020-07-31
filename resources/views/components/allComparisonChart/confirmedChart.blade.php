<div id="morris-line-chart-confirmed"></div>

@push('footer-scripts')
<script>
$(function() {
    Morris.Line({
        element: 'morris-line-chart-confirmed',
        data: [
                            { y: 'day 1', a: 2, b: 1 },
                            { y: 'day 2', a: 2, b: 1 },
                            { y: 'day 3', a: 2, b: 1 },
                            { y: 'day 4', a: 2, b: 1 },
                            { y: 'day 5', a: 4, b: 1 },
                            { y: 'day 6', a: 4, b: 1 },
                            { y: 'day 7', a: 6, b: 1 },
                            { y: 'day 8', a: 19, b: 1 },
                            { y: 'day 9', a: 27, b: 1 },
                            { y: 'day 10', a: 34, b: 1 },
                            { y: 'day 11', a: 34, b: 1 },
                            { y: 'day 12', a: 69, b: 1 },
                            { y: 'day 13', a: 96, b: 1 },
                            { y: 'day 14', a: 117, b: 1 },
                            { y: 'day 15', a: 134, b: 1 },
                            { y: 'day 16', a: 172, b: 1 },
                            { y: 'day 17', a: 227, b: 1 },
                            { y: 'day 18', a: 311, b: 2 },
                            { y: 'day 19', a: 369, b: 3 },
                            { y: 'day 20', a: 450, b: 7 },
                            { y: 'day 21', a: 514, b: 7 },
                            { y: 'day 22', a: 579, b: 7 },
                            { y: 'day 23', a: 686, b: 8 },
                            { y: 'day 24', a: 790, b: 8 },
                            { y: 'day 25', a: 893, b: 12 },
                            { y: 'day 26', a: 1046, b: 12 },
                            { y: 'day 27', a: 1155, b: 12 },
                            { y: 'day 28', a: 1285, b: 12 },
                    ],
        xkey: 'y',
        parseTime: false,
        ykeys: ['a', 'b'],
        xLabels: "string",
        labels: ['Indonesia', 'Saint Vincent and the Grenadines'],
        hideHover: 'auto',
        resize: true,
        lineColors: ['#ffdd33','#eda405'],
    });
});

</script>
@endpush