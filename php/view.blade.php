@extends('layouts.admin')
<style>
#mostra {
 display:none;
}
</style>
<?php
    $permissions = session()->get('permissions');
?>

@section('content')
<div class="row">
<form class="col s12" action="{{route('ViewMap/Filter')}}">
  <div class="input-field col s6">
    <input type="text" id="autocomplete_user_id" class="autocomplete" {{ $filters['user_id'] ? 'autofocus' : '' }}>
    <input type="hidden" name="user_id" id="user_id" value="{{ $filters['user_id'] }}">
    <label for="autocomplete_user_id">Técnico</label>
  </div>
  <div class="input-field col s4">
    <input type="date" name="date" />
    <label for="name">Data</label>
  </div>
  <button type="submit" class="waves-effect waves-light btn #fb8c00 orange darken-1"><i class="material-icons">search</i></button>
</form>
</div>
<div id="right-panel">
<div id="mostra">
<select id="start" hidden>
  @if(isset($mapStart) && trim($mapStart->service_order->location, '[]') != null && trim($mapStart->service_order->location, '[]') != '0,0')
<option value="{{trim($mapStart->service_order->location, '[]')}}">{{trim($mapStart->service_order->location, '[]')}}</option>
  @endif
</select>
<select multiple id="waypoints">
  @if(isset($maps))
@foreach($maps as $map)
  @if(trim($map->service_order['location'], '[]') != null && trim($map->service_order['location'], '[]') != '0,0'
  && trim($map->service_order['location'], '[]') != trim($mapStart->service_order->location, '[]')
  && trim($map->service_order['location'], '[]') != trim($map_end->service_order['location'], '[]'))
<option value="{{trim($map->service_order['location'], '[]')}}" selected>{{trim($map->service_order['location'], '[]')}}</option>
  @endif
@endforeach
  @endif
</select>
<select id="end" style="display: none;">
  @if(isset($map_end) && trim($map_end->service_order['location'], '[]') != null && trim($map_end->service_order['location'], '[]') != '0,0')
<option value="{{trim($map_end->service_order['location'], '[]')}}">{{trim($map_end->service_order['location'], '[]')}}</option>
 @endif
</select>
</div>
</div>
</div>

<!-- Form two -->
<div id="right-panel">
  <div id="mostra">
  <div>
  <select id="startTwo">
    @if(isset($address_start) && $address_start != null)
    <option value="{{$address_start->street}}, {{$address_start->number}}, {{$address_start->city}}, {{$address_start->district}}, {{$address_start->zipcode}}">{{$address_start->street}}, {{$address_start->number}}, {{$address_start->city}}, {{$address_start->district}}, {{$address_start->zipcode}}</option>
    @endif
  </select>
  <select multiple id="waypointsTwo">
    @if(isset($addresses))
      @foreach($addresses as $address)
    <option value="{{$address->street}}, {{$address->number}}, {{$address->city}}, {{$address->district}}, {{$address->zipcode}}" selected>{{$address->street}}, {{$address->number}}, {{$address->city}}, {{$address->district}}, {{$address->zipcode}}</option>
      @endforeach
    @endif
  </select>
  <select id="endTwo">
    @if(isset($address_end) && $address_end != null)
    <option value="{{$address_end->street}}, {{$address_end->number}}, {{$address_end->city}}, {{$address_end->district}}, {{$address_end->zipcode}}">{{$address_end->street}}, {{$address_end->number}}, {{$address_end->city}}, {{$address_end->district}}, {{$address_end->zipcode}}</option>
    @endif
  </select>
</div>
</div>
<div class="row" align="center">
  @if(isset($mapStart))
  <h6 class="col s12">{{$mapStart->user->name}} | {{date('d/m/Y', strtotime($mapStart->start_time))}}</h6>

  <button class="waves-effect waves-light btn #00838f cyan darken-3" type="submit" id="submit">Realizados</button>
    @elseif(!isset($mapStart))
      <span></span>
  @else
    <h5 class="col s6">Não existem OS realizados nesta data para este técnico</h5>
  @endif
  @if(isset($address_start))
  <button class="waves-effect waves-light btn #fb8c00 orange darken-1"  type="submit" id="submitTwo">Agendamentos</button>
  @elseif(!isset($address_start))
  @else
    <h5 class="col s6">Não existem agendamentos nesta data para este técnico</h5>
  @endif
</div>
</div>
<div id="map"></div>
<script>
    window.users = {!! json_encode($users) !!}

    document.addEventListener("DOMContentLoaded", function(event) {
        var users = window.users.reduce(function (map, obj) {
            map[obj.name] = null;
            return map;
        }, {});
        var user_id = $('#user_id').val();
        if (user_id) {
            $('input.autocomplete#autocomplete_user_id').val(window.users.find(user => user.id == user_id).name)
        }
        $('input.autocomplete#autocomplete_user_id').autocomplete({
            data: users,
            limit: 20,
            onAutocomplete: function (data) {
                $('#user_id').val(window.users.find(user => user.name == data).id);
            }
        });
        $('[type=reset]').click(() => {
            setTimeout(() => {
                $('#all').val(true);
            }, 100);
        });
    });
</script>
@endsection
