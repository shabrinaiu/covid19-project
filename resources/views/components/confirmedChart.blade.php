<div class="row" id="chart1">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h3>Confirmed data history</h3>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-footer">
                <div>
                    {{-- <canvas id="confirmedChart" style="height:20%; width:80%"></canvas> --}}
                    <div id="morris-line-chart-confirmed"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
<script>
    
@isset($historyData)
    function dateFormat(d){
        let dat = d;
        let res = str.split("-");
        let newDat = (res[1] + ' ' + res[0] + ' ' + res[2]);

        let monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let t = new Date(newDat);
        return t.getDate()+' '+monthNames[t.getMonth()]+' '+t.getFullYear();
    }
    $(function() {
        Morris.Line({
            element: 'morris-line-chart-confirmed',
            data: [
                @foreach($historyData as $i => $datum)
                    { y: '{{$datum['date']}}', a: {{$datum['confirmed']}} },
                @endforeach
            ],
            xkey: 'y',
            parseTime: false,
            ykeys: ['a'],
            xLabels: "string",
            labels: ['confirmed'],
            hideHover: 'auto',
            resize: true,
            lineColors: ['#ffdd33'],
        });
    });

    var historyData = {!! json_encode($historyData) !!}
    var data = {!! json_encode($data) !!}
    
    console.log(historyData);
@endisset
</script>
@endpush