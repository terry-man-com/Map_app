@extends('layouts.main')

@section('title', '店舗情報登録')

@section('content')
    <h1>店舗情報登録</h1>

    <form action="{{ route('shops.store') }}" method="post">
        @csrf
        <div>
            <label for="name">店舗名：</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div>
            <label for="description">詳細：</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="address">住所：</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}">
        </div>
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <div id="map" style="height: 50vh;"></div>
        <div>
            <input type="submit" value="登録">
            <button type="button" onclick="location.href='{{ route('shops.index') }}'">一覧に戻る</button>
        </div>
    </form>
@endsection

@section('script')
    @include('partial.map')
    <script>
        const lat = document.getElementById('latitude');
        const lng = document.getElementById('longitude');
        let clicked;
        map.on('click', function(e){
            if(clicked != true){
                clicked = true;
                const marker = L.marker([e.latlng['lat'], e.latlng['lng']], {draggable: true}).addTo(map);
                lat.value = e.latlng['lat'];
                lng.value = e.latlng['lng'];
                marker.on('dragend', function(e){
                    lat.value = e.target._latlng.lat;
                    lng.value = e.target._latlng.lng;
                });
            }
        });
    </script>
@endsection