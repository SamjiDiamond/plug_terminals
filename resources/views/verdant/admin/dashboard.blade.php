@extends('layouts.verdant_admin')

@section('contents')
    <div class="container-fluid dashboardSummary">
        <div class="row">
            <div class="col-sm-12">
                <div class="titleWithDateDiv">
                    <div>
                        <h3>Super Admin</h3>
                        <h5>Overview</h5>
                    </div>
{{--                    <div>--}}
{{--                        <h5 class="mb-1 text-right">--}}
{{--                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z"/><path d="M20 9.83984H4C3.45 9.83984 3 10.2898 3 10.8398V16.9998C3 19.9998 4.5 21.9998 8 21.9998H16C19.5 21.9998 21 19.9998 21 16.9998V10.8398C21 10.2898 20.55 9.83984 20 9.83984ZM9.21 18.2098C9.16 18.2498 9.11 18.2998 9.06 18.3298C9 18.3698 8.94 18.3998 8.88 18.4198C8.82 18.4498 8.76 18.4698 8.7 18.4798C8.63 18.4898 8.57 18.4998 8.5 18.4998C8.37 18.4998 8.24 18.4698 8.12 18.4198C7.99 18.3698 7.89 18.2998 7.79 18.2098C7.61 18.0198 7.5 17.7598 7.5 17.4998C7.5 17.2398 7.61 16.9798 7.79 16.7898C7.89 16.6998 7.99 16.6298 8.12 16.5798C8.3 16.4998 8.5 16.4798 8.7 16.5198C8.76 16.5298 8.82 16.5498 8.88 16.5798C8.94 16.5998 9 16.6298 9.06 16.6698C9.11 16.7098 9.16 16.7498 9.21 16.7898C9.39 16.9798 9.5 17.2398 9.5 17.4998C9.5 17.7598 9.39 18.0198 9.21 18.2098ZM9.21 14.7098C9.02 14.8898 8.76 14.9998 8.5 14.9998C8.24 14.9998 7.98 14.8898 7.79 14.7098C7.61 14.5198 7.5 14.2598 7.5 13.9998C7.5 13.7398 7.61 13.4798 7.79 13.2898C8.07 13.0098 8.51 12.9198 8.88 13.0798C9.01 13.1298 9.12 13.1998 9.21 13.2898C9.39 13.4798 9.5 13.7398 9.5 13.9998C9.5 14.2598 9.39 14.5198 9.21 14.7098ZM12.71 18.2098C12.52 18.3898 12.26 18.4998 12 18.4998C11.74 18.4998 11.48 18.3898 11.29 18.2098C11.11 18.0198 11 17.7598 11 17.4998C11 17.2398 11.11 16.9798 11.29 16.7898C11.66 16.4198 12.34 16.4198 12.71 16.7898C12.89 16.9798 13 17.2398 13 17.4998C13 17.7598 12.89 18.0198 12.71 18.2098ZM12.71 14.7098C12.66 14.7498 12.61 14.7898 12.56 14.8298C12.5 14.8698 12.44 14.8998 12.38 14.9198C12.32 14.9498 12.26 14.9698 12.2 14.9798C12.13 14.9898 12.07 14.9998 12 14.9998C11.74 14.9998 11.48 14.8898 11.29 14.7098C11.11 14.5198 11 14.2598 11 13.9998C11 13.7398 11.11 13.4798 11.29 13.2898C11.38 13.1998 11.49 13.1298 11.62 13.0798C11.99 12.9198 12.43 13.0098 12.71 13.2898C12.89 13.4798 13 13.7398 13 13.9998C13 14.2598 12.89 14.5198 12.71 14.7098ZM16.21 18.2098C16.02 18.3898 15.76 18.4998 15.5 18.4998C15.24 18.4998 14.98 18.3898 14.79 18.2098C14.61 18.0198 14.5 17.7598 14.5 17.4998C14.5 17.2398 14.61 16.9798 14.79 16.7898C15.16 16.4198 15.84 16.4198 16.21 16.7898C16.39 16.9798 16.5 17.2398 16.5 17.4998C16.5 17.7598 16.39 18.0198 16.21 18.2098ZM16.21 14.7098C16.16 14.7498 16.11 14.7898 16.06 14.8298C16 14.8698 15.94 14.8998 15.88 14.9198C15.82 14.9498 15.76 14.9698 15.7 14.9798C15.63 14.9898 15.56 14.9998 15.5 14.9998C15.24 14.9998 14.98 14.8898 14.79 14.7098C14.61 14.5198 14.5 14.2598 14.5 13.9998C14.5 13.7398 14.61 13.4798 14.79 13.2898C14.89 13.1998 14.99 13.1298 15.12 13.0798C15.3 12.9998 15.5 12.9798 15.7 13.0198C15.76 13.0298 15.82 13.0498 15.88 13.0798C15.94 13.0998 16 13.1298 16.06 13.1698C16.11 13.2098 16.16 13.2498 16.21 13.2898C16.39 13.4798 16.5 13.7398 16.5 13.9998C16.5 14.2598 16.39 14.5198 16.21 14.7098Z"/></svg>--}}
{{--                            Filter Date--}}
{{--                        </h5>--}}
{{--                        <div class="reportRangePicker">--}}
{{--                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z"/><path d="M20 9.83984H4C3.45 9.83984 3 10.2898 3 10.8398V16.9998C3 19.9998 4.5 21.9998 8 21.9998H16C19.5 21.9998 21 19.9998 21 16.9998V10.8398C21 10.2898 20.55 9.83984 20 9.83984ZM9.21 18.2098C9.16 18.2498 9.11 18.2998 9.06 18.3298C9 18.3698 8.94 18.3998 8.88 18.4198C8.82 18.4498 8.76 18.4698 8.7 18.4798C8.63 18.4898 8.57 18.4998 8.5 18.4998C8.37 18.4998 8.24 18.4698 8.12 18.4198C7.99 18.3698 7.89 18.2998 7.79 18.2098C7.61 18.0198 7.5 17.7598 7.5 17.4998C7.5 17.2398 7.61 16.9798 7.79 16.7898C7.89 16.6998 7.99 16.6298 8.12 16.5798C8.3 16.4998 8.5 16.4798 8.7 16.5198C8.76 16.5298 8.82 16.5498 8.88 16.5798C8.94 16.5998 9 16.6298 9.06 16.6698C9.11 16.7098 9.16 16.7498 9.21 16.7898C9.39 16.9798 9.5 17.2398 9.5 17.4998C9.5 17.7598 9.39 18.0198 9.21 18.2098ZM9.21 14.7098C9.02 14.8898 8.76 14.9998 8.5 14.9998C8.24 14.9998 7.98 14.8898 7.79 14.7098C7.61 14.5198 7.5 14.2598 7.5 13.9998C7.5 13.7398 7.61 13.4798 7.79 13.2898C8.07 13.0098 8.51 12.9198 8.88 13.0798C9.01 13.1298 9.12 13.1998 9.21 13.2898C9.39 13.4798 9.5 13.7398 9.5 13.9998C9.5 14.2598 9.39 14.5198 9.21 14.7098ZM12.71 18.2098C12.52 18.3898 12.26 18.4998 12 18.4998C11.74 18.4998 11.48 18.3898 11.29 18.2098C11.11 18.0198 11 17.7598 11 17.4998C11 17.2398 11.11 16.9798 11.29 16.7898C11.66 16.4198 12.34 16.4198 12.71 16.7898C12.89 16.9798 13 17.2398 13 17.4998C13 17.7598 12.89 18.0198 12.71 18.2098ZM12.71 14.7098C12.66 14.7498 12.61 14.7898 12.56 14.8298C12.5 14.8698 12.44 14.8998 12.38 14.9198C12.32 14.9498 12.26 14.9698 12.2 14.9798C12.13 14.9898 12.07 14.9998 12 14.9998C11.74 14.9998 11.48 14.8898 11.29 14.7098C11.11 14.5198 11 14.2598 11 13.9998C11 13.7398 11.11 13.4798 11.29 13.2898C11.38 13.1998 11.49 13.1298 11.62 13.0798C11.99 12.9198 12.43 13.0098 12.71 13.2898C12.89 13.4798 13 13.7398 13 13.9998C13 14.2598 12.89 14.5198 12.71 14.7098ZM16.21 18.2098C16.02 18.3898 15.76 18.4998 15.5 18.4998C15.24 18.4998 14.98 18.3898 14.79 18.2098C14.61 18.0198 14.5 17.7598 14.5 17.4998C14.5 17.2398 14.61 16.9798 14.79 16.7898C15.16 16.4198 15.84 16.4198 16.21 16.7898C16.39 16.9798 16.5 17.2398 16.5 17.4998C16.5 17.7598 16.39 18.0198 16.21 18.2098ZM16.21 14.7098C16.16 14.7498 16.11 14.7898 16.06 14.8298C16 14.8698 15.94 14.8998 15.88 14.9198C15.82 14.9498 15.76 14.9698 15.7 14.9798C15.63 14.9898 15.56 14.9998 15.5 14.9998C15.24 14.9998 14.98 14.8898 14.79 14.7098C14.61 14.5198 14.5 14.2598 14.5 13.9998C14.5 13.7398 14.61 13.4798 14.79 13.2898C14.89 13.1998 14.99 13.1298 15.12 13.0798C15.3 12.9998 15.5 12.9798 15.7 13.0198C15.76 13.0298 15.82 13.0498 15.88 13.0798C15.94 13.0998 16 13.1298 16.06 13.1698C16.11 13.2098 16.16 13.2498 16.21 13.2898C16.39 13.4798 16.5 13.7398 16.5 13.9998C16.5 14.2598 16.39 14.5198 16.21 14.7098Z"/></svg>--}}
{{--                            <span></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Total Transaction</h6>
                    <div class="dashboardSummaryCount">
                        <h3 class="mb-3">&#8358; {{number_format($trx_total??0)}}</h3>
{{--                        <span class="orange-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.6806 13.9783L15.4706 10.7683L13.5106 8.79828C12.6806 7.96828 11.3306 7.96828 10.5006 8.79828L5.32056 13.9783C4.64056 14.6583 5.13056 15.8183 6.08056 15.8183H11.6906H17.9206C18.8806 15.8183 19.3606 14.6583 18.6806 13.9783Z"/></svg>--}}
{{--                                    250,000--}}
{{--                                </span>--}}
{{--                        <small><span class="orange-color">+12%</span>vs May</small>--}}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Successful Transaction</h6>
                    <div class="dashboardSummaryCount">
                        <h3 class="mb-3">&#8358; {{number_format($trx_success??0)}}</h3>
{{--                        <span class="green-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.6806 13.9783L15.4706 10.7683L13.5106 8.79828C12.6806 7.96828 11.3306 7.96828 10.5006 8.79828L5.32056 13.9783C4.64056 14.6583 5.13056 15.8183 6.08056 15.8183H11.6906H17.9206C18.8806 15.8183 19.3606 14.6583 18.6806 13.9783Z"/></svg>--}}
{{--                                    200,000--}}
{{--                                </span>--}}
{{--                        <small><span class="green-color">+20%</span>vs May</small>--}}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Failed Transaction</h6>
                    <div class="dashboardSummaryCount">
                        <h3 class="mb-3">&#8358; {{number_format($trx_failed ??0)}}</h3>
{{--                        <span class="red-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9188 8.17969H11.6888H6.07877C5.11877 8.17969 4.63877 9.33969 5.31877 10.0197L10.4988 15.1997C11.3288 16.0297 12.6788 16.0297 13.5088 15.1997L15.4788 13.2297L18.6888 10.0197C19.3588 9.33969 18.8788 8.17969 17.9188 8.17969Z"/></svg>--}}
{{--                                    50,000--}}
{{--                                </span>--}}
{{--                        <small><span class="red-color">+8%</span>vs May</small>--}}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Pending Transaction</h6>
                    <div class="dashboardSummaryCount">
                        <h3 class="mb-3">&#8358; {{number_format($trx_pending ?? 0)}}</h3>
{{--                        <span class="yellow-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.6806 13.9783L15.4706 10.7683L13.5106 8.79828C12.6806 7.96828 11.3306 7.96828 10.5006 8.79828L5.32056 13.9783C4.64056 14.6583 5.13056 15.8183 6.08056 15.8183H11.6906H17.9206C18.8806 15.8183 19.3606 14.6583 18.6806 13.9783Z"/></svg>--}}
{{--                                    250,000--}}
{{--                                </span>--}}
{{--                        <small><span class="yellow-color">+12%</span>vs May</small>--}}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Refunded Transaction</h6>
                    <div class="dashboardSummaryCount">
                        <h3 class="mb-3">&#8358; {{number_format($trx_reversed??0)}}</h3>
{{--                        <span class="green-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.6806 13.9783L15.4706 10.7683L13.5106 8.79828C12.6806 7.96828 11.3306 7.96828 10.5006 8.79828L5.32056 13.9783C4.64056 14.6583 5.13056 15.8183 6.08056 15.8183H11.6906H17.9206C18.8806 15.8183 19.3606 14.6583 18.6806 13.9783Z"/></svg>--}}
{{--                                    250,000--}}
{{--                                </span>--}}
{{--                        <small><span class="green-color">+12%</span>vs May</small>--}}
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="row">--}}
{{--            <div class="col-sm-12">--}}
{{--                <div class="materialCard mb-5">--}}
{{--                    <div class="materialCardTitle">--}}
{{--                        <div class="materialCardInline">--}}
{{--                            <div>--}}
{{--                                <h4>Transactions</h4>--}}
{{--                                <!--<h6 class="headingH6">Payouts Rate</h6>-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="transactionBarChart"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col-sm-6">
                <div class="materialCard">
                    <div class="materialCardTitle">
                        <div class="materialCardInline">
                            <div>
                                <h4>Clients</h4>
                                <!--<h6 class="headingH6">Payouts Rate</h6>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 flex-center mb-4">
                            <div class="clientsChart" style="width: 360px;"></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="flex-between transactionSummary">
                                <div>
                                    <h6 class="grey-color orange-color">Total Clients</h6>
                                    <h3>{{number_format($client_total ?? 0)}}</h3>
                                </div>
                                <div>
                                    <h6 class="grey-color green-color">Active Clients</h6>
                                    <h3>{{number_format($client_active ?? 0)}}</h3>
                                </div>
                                <div>
                                    <h6 class="grey-color red-color">Inactive Clients</h6>
                                    <h3>{{number_format($client_inactive ?? 0)}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="materialCard">
                    <div class="materialCardTitle">
                        <div class="materialCardInline">
                            <div>
                                <h4>Top Performing Clients</h4>
                                <!--<h6 class="headingH6">Payouts Rate</h6>-->
                            </div>
                        </div>
                    </div>
{{--                    @foreach($clients as $cr)--}}
{{--                        <div class="materialListPanel">--}}
{{--                            <a href="{{route('admin.clients.details', $cr->id)}}">--}}
{{--                                <div class="materialListPanelBody">--}}
{{--                                    <div>--}}
{{--                                        <img src="/verdant_assets/img/varst-icon.png" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <h5>{{$cr->name}}</h5>--}}
{{--                                        <h6 class="grey-color">{{$cr->lga}}</h6>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <div><h6 class="green-theme">{{\Carbon\Carbon::parse($cr->created_at)->format('M d')}}</h6></div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Total Customers</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($customers_total ?? 0)}}</h2>
                        <span class="orange-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.16006 10.87C9.06006 10.86 8.94006 10.86 8.83006 10.87C6.45006 10.79 4.56006 8.84 4.56006 6.44C4.56006 3.99 6.54006 2 9.00006 2C11.4501 2 13.4401 3.99 13.4401 6.44C13.4301 8.84 11.5401 10.79 9.16006 10.87Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M16.41 4C18.35 4 19.91 5.57 19.91 7.5C19.91 9.39 18.41 10.93 16.54 11C16.46 10.99 16.37 10.99 16.28 11" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4.15997 14.56C1.73997 16.18 1.73997 18.82 4.15997 20.43C6.90997 22.27 11.42 22.27 14.17 20.43C16.59 18.81 16.59 16.17 14.17 14.56C11.43 12.73 6.91997 12.73 4.15997 14.56Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18.3401 20C19.0601 19.85 19.7401 19.56 20.3001 19.13C21.8601 17.96 21.8601 16.03 20.3001 14.86C19.7501 14.44 19.0801 14.16 18.3701 14" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Active Customers</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($customers_active ?? 0)}}</h2>
                        <span class="green-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.16006 10.87C9.06006 10.86 8.94006 10.86 8.83006 10.87C6.45006 10.79 4.56006 8.84 4.56006 6.44C4.56006 3.99 6.54006 2 9.00006 2C11.4501 2 13.4401 3.99 13.4401 6.44C13.4301 8.84 11.5401 10.79 9.16006 10.87Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M16.41 4C18.35 4 19.91 5.57 19.91 7.5C19.91 9.39 18.41 10.93 16.54 11C16.46 10.99 16.37 10.99 16.28 11" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4.15997 14.56C1.73997 16.18 1.73997 18.82 4.15997 20.43C6.90997 22.27 11.42 22.27 14.17 20.43C16.59 18.81 16.59 16.17 14.17 14.56C11.43 12.73 6.91997 12.73 4.15997 14.56Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18.3401 20C19.0601 19.85 19.7401 19.56 20.3001 19.13C21.8601 17.96 21.8601 16.03 20.3001 14.86C19.7501 14.44 19.0801 14.16 18.3701 14" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Inactive Customers</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($customers_inactive ?? 0)}}</h2>
                        <span class="red-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.16006 10.87C9.06006 10.86 8.94006 10.86 8.83006 10.87C6.45006 10.79 4.56006 8.84 4.56006 6.44C4.56006 3.99 6.54006 2 9.00006 2C11.4501 2 13.4401 3.99 13.4401 6.44C13.4301 8.84 11.5401 10.79 9.16006 10.87Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M16.41 4C18.35 4 19.91 5.57 19.91 7.5C19.91 9.39 18.41 10.93 16.54 11C16.46 10.99 16.37 10.99 16.28 11" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4.15997 14.56C1.73997 16.18 1.73997 18.82 4.15997 20.43C6.90997 22.27 11.42 22.27 14.17 20.43C16.59 18.81 16.59 16.17 14.17 14.56C11.43 12.73 6.91997 12.73 4.15997 14.56Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18.3401 20C19.0601 19.85 19.7401 19.56 20.3001 19.13C21.8601 17.96 21.8601 16.03 20.3001 14.86C19.7501 14.44 19.0801 14.16 18.3701 14" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Total Terminals</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($terminal_total ?? 0)}}</h2>
                        <span class="orange-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5.56006H22" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14.22 2H19.78C21.56 2 22 2.44 22 4.2V8.31C22 10.07 21.56 10.51 19.78 10.51H14.22C12.44 10.51 12 10.07 12 8.31V4.2C12 2.44 12.44 2 14.22 2Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2 17.0601H12" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4.22 13.5H9.78C11.56 13.5 12 13.94 12 15.7V19.81C12 21.57 11.56 22.01 9.78 22.01H4.22C2.44 22.01 2 21.57 2 19.81V15.7C2 13.94 2.44 13.5 4.22 13.5Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M22 15C22 18.87 18.87 22 15 22L16.05 20.25" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2 9C2 5.13 5.13 2 9 2L7.95001 3.75" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Mapped Terminals</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($terminal_mapped ?? 0)}}</h2>
                        <span class="green-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5.56006H22" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14.22 2H19.78C21.56 2 22 2.44 22 4.2V8.31C22 10.07 21.56 10.51 19.78 10.51H14.22C12.44 10.51 12 10.07 12 8.31V4.2C12 2.44 12.44 2 14.22 2Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2 17.0601H12" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4.22 13.5H9.78C11.56 13.5 12 13.94 12 15.7V19.81C12 21.57 11.56 22.01 9.78 22.01H4.22C2.44 22.01 2 21.57 2 19.81V15.7C2 13.94 2.44 13.5 4.22 13.5Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M22 15C22 18.87 18.87 22 15 22L16.05 20.25" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2 9C2 5.13 5.13 2 9 2L7.95001 3.75" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Unmapped Terminals</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($terminal_unmapped ?? 0)}}</h2>
                        <span class="red-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5.56006H22" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14.22 2H19.78C21.56 2 22 2.44 22 4.2V8.31C22 10.07 21.56 10.51 19.78 10.51H14.22C12.44 10.51 12 10.07 12 8.31V4.2C12 2.44 12.44 2 14.22 2Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2 17.0601H12" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4.22 13.5H9.78C11.56 13.5 12 13.94 12 15.7V19.81C12 21.57 11.56 22.01 9.78 22.01H4.22C2.44 22.01 2 21.57 2 19.81V15.7C2 13.94 2.44 13.5 4.22 13.5Z" stroke-linecap="round" stroke-linejoin="round"></path><path d="M22 15C22 18.87 18.87 22 15 22L16.05 20.25" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2 9C2 5.13 5.13 2 9 2L7.95001 3.75" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
        $('.dataTable').DataTable();
        });

        $(".jsonExport").on("click", function () {
        $(".dataTable").tableHTMLExport({ type: "json", filename: "file.json",});
        });
        $(".csvExport").on("click", function () {
        $(".dataTable").tableHTMLExport({ type: "csv", filename: "file.csv" });
        });
        $(".pdfExport").on("click", function () {
        $(".dataTable").tableHTMLExport({ type: "pdf", filename: "file.pdf" });
        });

        // Transactions Bar Chart
        let transactionChartSeries = [{
        name: 'Successful',
        data: [600000000, 750000000, 550000000, 600000000, 900000000, 750000000, 600000000, 900000000, 806000000, 550000000, 400000000, 950000000]
        }, {
        name: 'Failed',
        data: [300000000, 350000000, 550000000, 800000000, 200000000, 430000000, 550000000, 600000000, 906000000, 150000000, 350000000, 550000000]
        }, {
        name: 'Pending',
        data: [500000000, 750000000, 250000000, 100000000, 700000000, 130000000, 650000000, 350000000, 656000000, 120000000, 170000000, 320000000]
        }];

        let transactionChartMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        let transactionChartSelector = 'transactionBarChart';
        barChartFunc(transactionChartSeries, transactionChartMonths, transactionChartSelector);


        // Clients Pie Chart
        let clientsPieChartSeries = [{{$client_active ?? 0}}, {{$client_inactive ?? 0}}];
        let clientsPieChartLabels = ['Active', 'Inactive'];
        let clientsPieChartSelector = 'clientsChart';
        pieChartFunc(clientsPieChartSeries, clientsPieChartLabels, clientsPieChartSelector);
    </script>

@endsection
