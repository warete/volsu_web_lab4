@extends('layouts.inner')

@section('title', 'Все заявки')

@section('content')
    <div class="col-12 row all-requests">
        <div class="col-12 col-md-8 order-2 order-md-1 mb-3">
            <div id="map"></div>
        </div>
        <div class="col-12 col-md-4 order-1 order-md-2 mb-3">
            <div id="cityShop">
                <div class="form-group row">
                    <label for="cities" class="col-3 col-md-12 col-lg-3">Город:</label>
                    <select name="cities" id="cities" class="form-control col-9 col-md-12 col-lg-9"></select>
                </div>
                <div class="row">
                    <ul id="shops" class="list-group w-100"></ul>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3 order-3 all-requests__list requests-list">

        </div>
    </div>
@endsection

@section('additional-scripts')
    <script>
        allRequestsMapInit('{{{ asset('template/app/data/map.json') }}}');
    </script>
@endsection
