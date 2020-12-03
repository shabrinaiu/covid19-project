@extends('layouts.master')

@push('header-scripts')
<link href="{{URL::asset('theme/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('theme/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('theme/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endpush

@section('content')
<form action="{{route('public-response.store')}}" method="post" id="create-overview-form">
    @csrf
    <div class="row wrapper page-heading">
        <div class="col-md-12 vertical-align-middle">
            <h2>Data Respon Masyarakat</h2>
        </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Pilih Negara</h3>
        </div>
        <div class="col-md-4">
            <select class="select2_country form-control country @error('country') is-invalid @enderror"  name="country">
                @isset($data)
                @foreach ($data as $row)
                <option value="" disabled selected></option>
                <option value="{{$row['Country']}}">{{$row['Country']}}</option>
                @endforeach
                @endisset
            </select>
            @error('country')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>        
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Nama Peng-entry</h3>
        </div>
        <div class="col-md-4">
            <input type="text"  placeholder="" name="entried_by" class="form-control @error('entried_by') is-invalid @enderror">
            @error('entried_by')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Sumber Berita (URL)</h3>
        </div>
        <div class="col-md-7">
            <input type="text"  placeholder="" name="news_url" class="form-control @error('news_url') is-invalid @enderror">
            @error('news_url')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Tanggal Berita</h3>
        </div>
        <div class="col-md-7">
            <input type="date"  placeholder="" name="news_date" class="form-control @error('news_date') is-invalid @enderror">
            @error('news_date')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Penggalan Berita</h3>
        </div>
        <div class="col-md-7">
            <textarea  placeholder="" name="news_text" class="form-control @error('news_text') is-invalid @enderror"></textarea>
            @error('news_text')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Nilai Respon Masyarakat (-1 sampai 1)</h3>
        </div>
        <div class="col-md-4">
            <input type="number" min="-1" max="1"  placeholder="" name="response_value" class="form-control @error('response_value') is-invalid @enderror">
            @error('response_value')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-3 vertical-align-middle d-flex justify-content-end">
            <button type="button" class="btn btn-primary" id="submitButton"><strong>Submit</strong></button>
        </div>
    </div>

</form>
@endsection

@section('content')

</div>

@push('footer-scripts')
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="{{URL::asset('theme/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

{{-- MorrisJS --}}
<script src="{{URL::asset('theme/js/plugins/morris/raphael-2.1.0.min.js')}}"></script>
<script src="{{URL::asset('theme/js/plugins/morris/morris.js')}}"></script>

<script>
    $(document).ready(function() {

        $(".select2_country").select2({
            theme: 'bootstrap4',
            placeholder: "Select a target country",
            // allowClear: true
        });

        $(".select2_countries").select2({
            theme: 'bootstrap4',
            placeholder: "Select countries here",
        });

        $('.input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

        $('#submitButton').on('click', function (event) {
            $("#create-overview-form").submit();

            // event.stopImmediatePropagation();
            
            // let data = new FormData();
            // data.append("news_date", $("#news_date").val());
            // data.append("country", $('#country').val());
            // data.append("news_url", $('#news_url').val());
            // data.append("news_text", $('#news_text').val());
            // data.append("response_value", $('#response_value').val());
            // data.append("entried_by", $('#entried_by').val());
            
            // $.ajax({
            //     headers: {
            //         "X-CSRF-TOKEN": $(
            //             'meta[name="csrf-token"]'
            //         ).attr("content")
            //     },
            //     url: $(this).attr('action'),
            //     method: "POST",
            //     data: data,
            //     dataType: 'json',
            //     beforeSend:function(){
            //         let l = $( '.ladda-button-submit' ).ladda();
            //         l.ladda( 'start' );
            //         $('[class^="invalid-feedback-"]').html('');
            //         $("#create-overview-form").find('#submitButton').prop('disabled', true);
            //     },
            //     success:function(data){
            //         $('#create-overview-form').reset();
            //     },
            //     error:function(data){
            //         let errors = data.responseJSON.errors;
            //         if (errors) {
            //             $.each(errors, function (index, value) {
            //                 $('div.invalid-feedback-'+index).html(value);
            //             })
            //         }
            //     },
            //     complete:function(){
            //         let l = $( '.ladda-button-submit' ).ladda();
            //         l.ladda( 'stop' );
            //         $("#create-overview-form").find('#submitButton').prop('disabled', false);
            //     }
            // });
        });

    });
</script>
@endpush
@endsection