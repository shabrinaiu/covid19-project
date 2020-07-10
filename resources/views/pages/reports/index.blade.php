@extends('layouts.master')

@section('content')
    <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h2 class="card-title text-success" id="recovered">Recovered</h2>
                      <h6 class="card-subtitle mb-2 text-muted"></h6>
                      <h4 class="card-text">Recovered</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h2 class="card-title text-warning" id="confirmed">Confirmed</h2>
                      <h6 class="card-subtitle mb-2 text-muted"></h6>
                      <h4 class="card-text">Confirmed</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h2 class="card-title text-danger" id="deaths">Deaths</h2>
                      <h6 class="card-subtitle mb-2 text-muted"></h6>
                      <p class="card-text">Deaths</p>
                    </div>
                </div>
            </div>
    </div>

    @push('footer-scripts')
    <script>
        $(document).ready(function () {
            semuaData();

            setInterval(function () {
                semuaData();
            }, 2000);
    
            function semuaData() {
            $.ajax({
                url: 'https://coronavirus-19-api.herokuapp.com/all',
                success: function (data) {
                    try {
                        var json = data;
                        var kasus = json.cases;
                        var meninggal = json.deaths;
                        var sembuh = json.recovered;

                        $('#confirmed').html(numeral(kasus).format('0,0'))
                        $('#deaths').html(numeral(meninggal).format('0,0'))
                        $('#recovered').html(numeral(sembuh).format('0,0'))
                    } catch {
                        alert('error!');
                    }
                }

            });
        }
    
        });
    
    </script>
    @endpush

@endsection