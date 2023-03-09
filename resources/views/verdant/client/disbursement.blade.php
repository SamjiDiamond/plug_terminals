@extends('layouts.verdant_client')

@section('contents')
    <div class="container-fluid dashboardSummary">
        <div class="row">
            <div class="col-sm-12">
                <div class="titleWithDateDiv">
                    <div><h4>Overview</h4></div>
                    <div>
                        <h5 class="mb-1 text-right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z"/><path d="M20 9.83984H4C3.45 9.83984 3 10.2898 3 10.8398V16.9998C3 19.9998 4.5 21.9998 8 21.9998H16C19.5 21.9998 21 19.9998 21 16.9998V10.8398C21 10.2898 20.55 9.83984 20 9.83984ZM9.21 18.2098C9.16 18.2498 9.11 18.2998 9.06 18.3298C9 18.3698 8.94 18.3998 8.88 18.4198C8.82 18.4498 8.76 18.4698 8.7 18.4798C8.63 18.4898 8.57 18.4998 8.5 18.4998C8.37 18.4998 8.24 18.4698 8.12 18.4198C7.99 18.3698 7.89 18.2998 7.79 18.2098C7.61 18.0198 7.5 17.7598 7.5 17.4998C7.5 17.2398 7.61 16.9798 7.79 16.7898C7.89 16.6998 7.99 16.6298 8.12 16.5798C8.3 16.4998 8.5 16.4798 8.7 16.5198C8.76 16.5298 8.82 16.5498 8.88 16.5798C8.94 16.5998 9 16.6298 9.06 16.6698C9.11 16.7098 9.16 16.7498 9.21 16.7898C9.39 16.9798 9.5 17.2398 9.5 17.4998C9.5 17.7598 9.39 18.0198 9.21 18.2098ZM9.21 14.7098C9.02 14.8898 8.76 14.9998 8.5 14.9998C8.24 14.9998 7.98 14.8898 7.79 14.7098C7.61 14.5198 7.5 14.2598 7.5 13.9998C7.5 13.7398 7.61 13.4798 7.79 13.2898C8.07 13.0098 8.51 12.9198 8.88 13.0798C9.01 13.1298 9.12 13.1998 9.21 13.2898C9.39 13.4798 9.5 13.7398 9.5 13.9998C9.5 14.2598 9.39 14.5198 9.21 14.7098ZM12.71 18.2098C12.52 18.3898 12.26 18.4998 12 18.4998C11.74 18.4998 11.48 18.3898 11.29 18.2098C11.11 18.0198 11 17.7598 11 17.4998C11 17.2398 11.11 16.9798 11.29 16.7898C11.66 16.4198 12.34 16.4198 12.71 16.7898C12.89 16.9798 13 17.2398 13 17.4998C13 17.7598 12.89 18.0198 12.71 18.2098ZM12.71 14.7098C12.66 14.7498 12.61 14.7898 12.56 14.8298C12.5 14.8698 12.44 14.8998 12.38 14.9198C12.32 14.9498 12.26 14.9698 12.2 14.9798C12.13 14.9898 12.07 14.9998 12 14.9998C11.74 14.9998 11.48 14.8898 11.29 14.7098C11.11 14.5198 11 14.2598 11 13.9998C11 13.7398 11.11 13.4798 11.29 13.2898C11.38 13.1998 11.49 13.1298 11.62 13.0798C11.99 12.9198 12.43 13.0098 12.71 13.2898C12.89 13.4798 13 13.7398 13 13.9998C13 14.2598 12.89 14.5198 12.71 14.7098ZM16.21 18.2098C16.02 18.3898 15.76 18.4998 15.5 18.4998C15.24 18.4998 14.98 18.3898 14.79 18.2098C14.61 18.0198 14.5 17.7598 14.5 17.4998C14.5 17.2398 14.61 16.9798 14.79 16.7898C15.16 16.4198 15.84 16.4198 16.21 16.7898C16.39 16.9798 16.5 17.2398 16.5 17.4998C16.5 17.7598 16.39 18.0198 16.21 18.2098ZM16.21 14.7098C16.16 14.7498 16.11 14.7898 16.06 14.8298C16 14.8698 15.94 14.8998 15.88 14.9198C15.82 14.9498 15.76 14.9698 15.7 14.9798C15.63 14.9898 15.56 14.9998 15.5 14.9998C15.24 14.9998 14.98 14.8898 14.79 14.7098C14.61 14.5198 14.5 14.2598 14.5 13.9998C14.5 13.7398 14.61 13.4798 14.79 13.2898C14.89 13.1998 14.99 13.1298 15.12 13.0798C15.3 12.9998 15.5 12.9798 15.7 13.0198C15.76 13.0298 15.82 13.0498 15.88 13.0798C15.94 13.0998 16 13.1298 16.06 13.1698C16.11 13.2098 16.16 13.2498 16.21 13.2898C16.39 13.4798 16.5 13.7398 16.5 13.9998C16.5 14.2598 16.39 14.5198 16.21 14.7098Z"/></svg>
                            Filter Date
                        </h5>
                        <div class="reportRangePicker">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z"/><path d="M20 9.83984H4C3.45 9.83984 3 10.2898 3 10.8398V16.9998C3 19.9998 4.5 21.9998 8 21.9998H16C19.5 21.9998 21 19.9998 21 16.9998V10.8398C21 10.2898 20.55 9.83984 20 9.83984ZM9.21 18.2098C9.16 18.2498 9.11 18.2998 9.06 18.3298C9 18.3698 8.94 18.3998 8.88 18.4198C8.82 18.4498 8.76 18.4698 8.7 18.4798C8.63 18.4898 8.57 18.4998 8.5 18.4998C8.37 18.4998 8.24 18.4698 8.12 18.4198C7.99 18.3698 7.89 18.2998 7.79 18.2098C7.61 18.0198 7.5 17.7598 7.5 17.4998C7.5 17.2398 7.61 16.9798 7.79 16.7898C7.89 16.6998 7.99 16.6298 8.12 16.5798C8.3 16.4998 8.5 16.4798 8.7 16.5198C8.76 16.5298 8.82 16.5498 8.88 16.5798C8.94 16.5998 9 16.6298 9.06 16.6698C9.11 16.7098 9.16 16.7498 9.21 16.7898C9.39 16.9798 9.5 17.2398 9.5 17.4998C9.5 17.7598 9.39 18.0198 9.21 18.2098ZM9.21 14.7098C9.02 14.8898 8.76 14.9998 8.5 14.9998C8.24 14.9998 7.98 14.8898 7.79 14.7098C7.61 14.5198 7.5 14.2598 7.5 13.9998C7.5 13.7398 7.61 13.4798 7.79 13.2898C8.07 13.0098 8.51 12.9198 8.88 13.0798C9.01 13.1298 9.12 13.1998 9.21 13.2898C9.39 13.4798 9.5 13.7398 9.5 13.9998C9.5 14.2598 9.39 14.5198 9.21 14.7098ZM12.71 18.2098C12.52 18.3898 12.26 18.4998 12 18.4998C11.74 18.4998 11.48 18.3898 11.29 18.2098C11.11 18.0198 11 17.7598 11 17.4998C11 17.2398 11.11 16.9798 11.29 16.7898C11.66 16.4198 12.34 16.4198 12.71 16.7898C12.89 16.9798 13 17.2398 13 17.4998C13 17.7598 12.89 18.0198 12.71 18.2098ZM12.71 14.7098C12.66 14.7498 12.61 14.7898 12.56 14.8298C12.5 14.8698 12.44 14.8998 12.38 14.9198C12.32 14.9498 12.26 14.9698 12.2 14.9798C12.13 14.9898 12.07 14.9998 12 14.9998C11.74 14.9998 11.48 14.8898 11.29 14.7098C11.11 14.5198 11 14.2598 11 13.9998C11 13.7398 11.11 13.4798 11.29 13.2898C11.38 13.1998 11.49 13.1298 11.62 13.0798C11.99 12.9198 12.43 13.0098 12.71 13.2898C12.89 13.4798 13 13.7398 13 13.9998C13 14.2598 12.89 14.5198 12.71 14.7098ZM16.21 18.2098C16.02 18.3898 15.76 18.4998 15.5 18.4998C15.24 18.4998 14.98 18.3898 14.79 18.2098C14.61 18.0198 14.5 17.7598 14.5 17.4998C14.5 17.2398 14.61 16.9798 14.79 16.7898C15.16 16.4198 15.84 16.4198 16.21 16.7898C16.39 16.9798 16.5 17.2398 16.5 17.4998C16.5 17.7598 16.39 18.0198 16.21 18.2098ZM16.21 14.7098C16.16 14.7498 16.11 14.7898 16.06 14.8298C16 14.8698 15.94 14.8998 15.88 14.9198C15.82 14.9498 15.76 14.9698 15.7 14.9798C15.63 14.9898 15.56 14.9998 15.5 14.9998C15.24 14.9998 14.98 14.8898 14.79 14.7098C14.61 14.5198 14.5 14.2598 14.5 13.9998C14.5 13.7398 14.61 13.4798 14.79 13.2898C14.89 13.1998 14.99 13.1298 15.12 13.0798C15.3 12.9998 15.5 12.9798 15.7 13.0198C15.76 13.0298 15.82 13.0498 15.88 13.0798C15.94 13.0998 16 13.1298 16.06 13.1698C16.11 13.2098 16.16 13.2498 16.21 13.2898C16.39 13.4798 16.5 13.7398 16.5 13.9998C16.5 14.2598 16.39 14.5198 16.21 14.7098Z"/></svg>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="materialCard">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="twoItemsPerRow">
                                <div>
                                    <h5 class="grey-color">{{explode("|",$account_details)[1] ?? ''}} ({{$account_name}})</h5>
                                    <h2>{{explode("|",$account_details)[0] ?? ''}}</h2>
                                </div>
                                <div>
                                    <h5 class="grey-color">Wallet Balance</h5>
                                    <h2>N{{number_format($balance)}}</h2>
                                </div>
                            </div>
                            <a href="{{route('transfer')}}" class="materialButtonIcon primary">
                                <span>Transfer Money</span>
                                <span class="buttonIcon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 12V17C22 20 20 22 17 22H7C4 22 2 20 2 17V12C2 9.28 3.64 7.38 6.19 7.06C6.45 7.02 6.72 7 7 7H17C17.26 7 17.51 7.00999 17.75 7.04999C20.33 7.34999 22 9.26 22 12Z" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.7514 7.05C17.5114 7.01 17.2614 7.00001 17.0014 7.00001H7.00141C6.72141 7.00001 6.45141 7.02001 6.19141 7.06001C6.33141 6.78001 6.53141 6.52001 6.77141 6.28001L10.0214 3.02C11.3914 1.66 13.6114 1.66 14.9814 3.02L16.7314 4.79002C17.3714 5.42002 17.7114 6.22 17.7514 7.05Z" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 12.5H19C17.9 12.5 17 13.4 17 14.5C17 15.6 17.9 16.5 19 16.5H22" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Total Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>N{{number_format($total)}}</h2>
{{--                        <span class="orange-theme">--}}
{{--                                    2,000--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Successful Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>N{{number_format($success)}}</h2>
{{--                        <span class="green-theme">--}}
{{--                                    1,700--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Failed Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>N{{number_format($failed)}}</h2>
{{--                        <span class="red-theme">--}}
{{--                                    300--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Pending Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>N{{number_format($pending)}}</h2>
{{--                        <span class="orange-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 14C2.79 14 1 15.79 1 18C1 20.21 2.79 22 5 22C7.21 22 9 20.21 9 18C9 15.79 7.21 14 5 14ZM6 17.68C6 18.29 5.67 18.87 5.15 19.18L4.39 19.64C4.27 19.72 4.13 19.75 4 19.75C3.75 19.75 3.5 19.62 3.36 19.39C3.15 19.04 3.26 18.57 3.62 18.36L4.38 17.9C4.45 17.86 4.5 17.77 4.5 17.69V16.76C4.5 16.34 4.84 16 5.25 16C5.66 16 6 16.34 6 16.75V17.68Z"/><path d="M17 4H7C4 4 2 5.5 2 9V12.56C2 12.93 2.38 13.16 2.71 13.01C3.69 12.56 4.82 12.39 6.01 12.6C8.64 13.07 10.57 15.51 10.5 18.18C10.49 18.6 10.43 19.01 10.32 19.41C10.24 19.72 10.49 20.01 10.81 20.01H17C20 20.01 22 18.51 22 15.01V9C22 5.5 20 4 17 4ZM12 14.5C10.62 14.5 9.5 13.38 9.5 12C9.5 10.62 10.62 9.5 12 9.5C13.38 9.5 14.5 10.62 14.5 12C14.5 13.38 13.38 14.5 12 14.5ZM19.25 14C19.25 14.41 18.91 14.75 18.5 14.75C18.09 14.75 17.75 14.41 17.75 14V10C17.75 9.59 18.09 9.25 18.5 9.25C18.91 9.25 19.25 9.59 19.25 10V14Z"/></svg>--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Total Service Fee</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>N{{number_format($fee)}}</h2>
                        <span class="orange-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM15.75 15.75H8.25C7.84 15.75 7.5 15.41 7.5 15C7.5 14.59 7.84 14.25 8.25 14.25H15.75C16.16 14.25 16.5 14.59 16.5 15C16.5 15.41 16.16 15.75 15.75 15.75ZM15.75 9.75H8.25C7.84 9.75 7.5 9.41 7.5 9C7.5 8.59 7.84 8.25 8.25 8.25H15.75C16.16 8.25 16.5 8.59 16.5 9C16.5 9.41 16.16 9.75 15.75 9.75Z"/></svg>
                                </span>
                    </div>
                </div>
            </div>
{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="materialCard">--}}
{{--                    <h6 class="grey-color">Total Commission</h6>--}}
{{--                    <div class="dashboardSummaryCount flex-between">--}}
{{--                        <h2>N10,023</h2>--}}
{{--                        <span class="red-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM9 8C9.55 8 10 8.45 10 9C10 9.55 9.56 10 9 10C8.45 10 8 9.55 8 9C8 8.45 8.45 8 9 8ZM9.53 15.53C9.38 15.68 9.19 15.75 9 15.75C8.81 15.75 8.62 15.68 8.47 15.53C8.18 15.24 8.18 14.76 8.47 14.47L14.47 8.47C14.76 8.18 15.24 8.18 15.53 8.47C15.82 8.76 15.82 9.24 15.53 9.53L9.53 15.53ZM15 16C14.44 16 13.99 15.55 13.99 15C13.99 14.45 14.44 14 14.99 14C15.54 14 15.99 14.45 15.99 15C15.99 15.55 15.55 16 15 16Z"/></svg>--}}
{{--                                </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

        <!-- <div class="row">
            <div class="col-sm-12">
                <div class="materialCard mt-5">
                    <div class="disbursementChart"></div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-sm-12">
                <div class="materialCard materialTableContainer mt-5">
                    <div class="materialCardTitle">
                        <div class="materialCardInline flex-between">
                            <div>
                                <h4>Transfer List</h4>
                                <!--<h6 class="headingH6">Payouts Rate</h6>-->
                            </div>
                            <div>
                                <div class="btn-group materialButtonDropdown">
                                    <button type="button" class="btn orange-theme btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        Download
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item csvExport" href="javascript:void(0)">Download CSV</a>
                                        <a class="dropdown-item pdfExport" href="javascript:void(0)">Download PDF</a>
                                        <a class="dropdown-item jsonExport" href="javascript:void(0)">Download JSON</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Reference</th>
                                <th scope="col">NUBAN</th>
                                <th scope="col">Bank Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Narration</th>
                                <th scope="col">Status</th>
                                <th scope="col">SessionID</th>
                                <th scope="col">Date Created</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($trans as $cli)
                                    <tr>
                                        <td>{{$cli->refid}}</td>
                                        <td>{{$cli->account_no}}</td>
                                        <td>{{$cli->bankcode}}</td>
                                        <td>₦{{$cli->amount}}</td>
                                        <td>{{$cli->narration}}</td>
                                        <td>
                                            @if($cli->status=='1')
                                                <span class="badge badge-success text-white">Successful</span>
                                            @elseif($cli->status=='0')
                                                <span class="badge badge-warning text-white">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{$cli->sessionid}}</td>
                                        <td>{{$cli->created_at}}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 text-right">
                            {{$trans->links()}}
                        </div>
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
    </script>
    <script>
        $(".jsonExport").on("click", function () {
            $(".dataTable").tableHTMLExport({ type: "json", filename: "file.json",});
        });
        $(".csvExport").on("click", function () {
            $(".dataTable").tableHTMLExport({ type: "csv", filename: "file.csv" });
        });
        $(".pdfExport").on("click", function () {
            $(".dataTable").tableHTMLExport({ type: "pdf", filename: "file.pdf" });
        });
    </script>
@endsection
