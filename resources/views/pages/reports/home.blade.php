@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h2>Description</h2>
                </div>
                <div class="card-body text-justify">
                    <div>
                        Coronavirus Disease 2019 atau COVID-19 adalah penyakit baru yang dapat menyebabkan terjadinya gangguan pernapasan dan radang paru. Sebagai virus model baru masyarakat awam kesulitan untuk mencari padanannya sehingga kemudian menganggapnya remeh. Penyebaran penyakit yang diakibatkan oleh virus COVID 19 telah ditetapkan sebagai pandemi oleh WHO per tanggal 12 Maret 2020.                         
                    </div>
                    <div>
                        Perkembangan data pandemi covid-19 di Indonesia, telah merenggut 181 nyawa pada 3 April 2020 (sumber :  <a href="http://covid19.bnpb.go.id">http://covid19.bnpb.go.id/)</a> dan merupakan ancaman besar bagi kesehatan masyarakat global khususnya Indonesia. Karena pandemi COVID-19 berlaku di seluruh dunia, maka kita bisa melihat perilaku masyarakat dan kebijakan pemerintah di seluruh dunia yang mempunyai kemiripan dengan Indonesia untuk dipakai dalam penentuan parameter dalam model yang tepat.
                    </div>
                    <div>
                        Pemerintah Indonesia sudah memberikan peringatan dan himbauan untuk melakukan social distance dengan memberlakukan bekerja dan belajar di rumah sebagai salah satu solusi untuk menghambat laju pertumbuhan kasus COVID-19 di Indonesia, namun masyarakat belum bisa melaksanakan himbauan tersebut dengan berbagai alasan. Keadaan ini bila dibiarkan akan membuat kasus penyebaran COVID-19 ini semakin tidak terkendali. 
                    </div>
                    <div>
                        Kami mengusulkan metode prediksi penyebaran pandemic COVID-19 di Indonesia melalui skema pendanaan penelitian lokal PENS. Metode yang diusulkan menggunakan model epidemic SEIR (S=Suspect, E=Expose, I=Infected, dan R=Recovered)   dengan parameter   fokus pada respon masyarakat dan pemerintah selama masa pandemic dan nilai  yang merepresentasikan kebijakan pemerintah untuk mengontrol laju pertumbuhan dari covid 19. Dengan model SEIR ini diharapkan dapat melakukan prediksi pandemi covid-19 yang akurat di Indonesia.
                        Web covid19prediction.info kami hasilkan sebagai luaran prototipenya.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header font-weight-bold">
                    <h3>Tim Peneliti</h3>
                </div>
                <div class="card-body text-justify">
                    <ul class="list-group list-group-flush"">
                        <li class="list-group-item">Nana Ramadijanti</li>
                        <li class="list-group-item">Muarifin</li>
                        <li class="list-group-item">Achmad Basuki</li>
                        <li class="list-group-item">Satriyo Aji</li>
                        <li class="list-group-item">Shabrina</li>
                        <li class="list-group-item">PENS 2020</li>
                      </ul>
                </div>
            </div>
        </div>
    </div>

    @push('footer-scripts')
    <script src="{{URL::asset('theme/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{URL::asset('theme/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{URL::asset('theme/js/inspinia.js')}}"></script>
    <script src="{{URL::asset('theme/js/plugins/pace/pace.min.js')}}"></script>
    @endpush

@endsection
