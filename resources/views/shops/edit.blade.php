@extends('layouts.main')

@section('title', '店舗情報修正')

@section('content')
    <h1>店舗情報修正</h1>

    <form action="{{ route('shops.update', $shop) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">店舗名：</label>
            <input type="text" name="name" id="name" value="{{ old('name', $shop->name) }}">
        </div>
        <div>
            <label for="description">詳細：</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $shop->description) }}</textarea>
        </div>
        <div>
            <label for="address">住所：</label>
            <input type="text" name="address" id="address" value="{{ old('address', $shop->address) }}">
        </div>
        <input type="hidden" name="latitude" id="latitude" value="{{ $shop->latitude }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ $shop->longitude }}">
        <div id="map" style="height: 50vh;"></div>
        <div>
            <input type="submit" value="更新">
            <button type="button" onclick="location.href='{{ route('shops.show', $shop) }}'">詳細に戻る</button>
        </div>
    </form>
@endsection

@section('script')
    @include('partial.map')
    <script>
        @if (!empty($shop))
            const lat = document.getElementById('latitude');
            const lng = document.getElementById('longitude');
            const marker = L.marker([{{ $shop->latitude }}, {{ $shop->longitude }}], {draggable: true})
            .addTo(map)
            .bindPopup("{{ $shop->name }}", {closeButton: false});
            marker.on('dragend', function(e){
                lat.value = e.target._latlng.lat;
                lng.value = e.target._latlng.lng;
            });
        @endif
    </script>
@endsection