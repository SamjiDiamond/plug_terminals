
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="profileDashboard">
            <div class="profileDashboardBanner">
                <div class="profileDashboardPhoto">
                    <img src="/verdant_assets/img/varst-icon.png" alt="">
                </div>
                <div class="profileDashboardContent">
                    <h3>{{$client->name}}</h3>
                    <h5>{{$client->phoneno}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div>

    @if (session('success'))
        <div class="mb-4 font-medium text-sm alert-success alert-dismissible alert">
            {{ session('success') }}
        </div>
    @endif

</div>

<div class="row mb-4">
    <div class="col-sm-12">
        <div class="materialNavigationList">
            <ul>
                <li class="{{$active == 'o' ? 'active' : '' }}"><a href="{{route('admin.clients.details', $client->id)}}">Overview</a></li>
                <li class="{{$active == 'tt' ? 'active' : '' }}"><a href="{{route('admin.clients.transactions', $client->id)}}">Transactions</a></li>
                <li class="{{$active == 'c' ? 'active' : '' }}"><a href="{{route('admin.clients.customers', $client->id)}}">Customers</a></li>
                <li class="{{$active == 't' ? 'active' : '' }}"><a href="{{route('admin.clients.terminal', $client->id)}}">Terminals</a></li>
                <li class="{{$active == 'i' ? 'active' : '' }}"><a href="{{route('admin.clients.income', $client->id)}}">Income</a></li>
                <li class="{{$active == 'k' ? 'active' : '' }}"><a href="{{route('admin.clients.kyc', $client->id)}}">KYC</a></li>
                {{--                        <li><a href="clients-single-settlements.html">Settlements</a></li>--}}
                {{--                        <li><a href="clients-single-support.html">Support</a></li>--}}
            </ul>
        </div>
    </div>
</div>
