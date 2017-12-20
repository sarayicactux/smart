<select class="form-control input-sm" id="city_id">
    @foreach($cities as $city)
        <option value="{{$city->id}}">{{$city->name}}</option>
    @endforeach
</select>