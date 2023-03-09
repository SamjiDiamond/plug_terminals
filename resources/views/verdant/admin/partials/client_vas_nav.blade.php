
<div class="row mb-4">
    <div class="col-sm-12">
        <div class="materialNavigationList">
            <ul>
                <li class="{{$active == 'a' ? 'active' : '' }}"><a href="{{route('airtime')}}">Airtime</a></li>
                <li class="{{$active == 'd' ? 'active' : '' }}"><a href="{{route('internetdata')}}">Data</a></li>
                <li class="{{$active == 'c' ? 'active' : '' }}"><a href="{{route('tv')}}">Cable TV</a></li>
                <li class="{{$active == 'e' ? 'active' : '' }}"><a href="{{route('electricity')}}">Electricity</a></li>
{{--                <li><a href="{{route('admin.clients.income', 1)}}">Income</a></li>--}}
                {{--                        <li><a href="clients-single-settlements.html">Settlements</a></li>--}}
                {{--                        <li><a href="clients-single-support.html">Support</a></li>--}}
            </ul>
        </div>
    </div>
</div>
