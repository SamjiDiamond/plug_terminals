@extends('layouts.verdant_client')

@section('contents')
    <div class="container-fluid dashboardSummary">
        <div class="row">
            <div class="col-sm-12">
                <div class="titleWithDateDiv">
                    <div><h4>Overview</h4></div>
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

        <div class="row mb-4">
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Total Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>&#8358; {{number_format($trx_total)}}</h2>
{{--                        <span class="orange-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.6806 13.9783L15.4706 10.7683L13.5106 8.79828C12.6806 7.96828 11.3306 7.96828 10.5006 8.79828L5.32056 13.9783C4.64056 14.6583 5.13056 15.8183 6.08056 15.8183H11.6906H17.9206C18.8806 15.8183 19.3606 14.6583 18.6806 13.9783Z"/></svg>--}}
{{--                                    2000--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Successful Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>&#8358; {{number_format($trx_success)}}</h2>
{{--                        <span class="green-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.6806 13.9783L15.4706 10.7683L13.5106 8.79828C12.6806 7.96828 11.3306 7.96828 10.5006 8.79828L5.32056 13.9783C4.64056 14.6583 5.13056 15.8183 6.08056 15.8183H11.6906H17.9206C18.8806 15.8183 19.3606 14.6583 18.6806 13.9783Z"/></svg>--}}
{{--                                    1700--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Failed Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>&#8358; {{number_format($trx_failed)}}</h2>
{{--                        <span class="red-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9188 8.17969H11.6888H6.07877C5.11877 8.17969 4.63877 9.33969 5.31877 10.0197L10.4988 15.1997C11.3288 16.0297 12.6788 16.0297 13.5088 15.1997L15.4788 13.2297L18.6888 10.0197C19.3588 9.33969 18.8788 8.17969 17.9188 8.17969Z"/></svg>--}}
{{--                                    300--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Pending Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>&#8358; {{number_format($trx_pending)}}</h2>
{{--                        <span class="yellow-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9188 8.17969H11.6888H6.07877C5.11877 8.17969 4.63877 9.33969 5.31877 10.0197L10.4988 15.1997C11.3288 16.0297 12.6788 16.0297 13.5088 15.1997L15.4788 13.2297L18.6888 10.0197C19.3588 9.33969 18.8788 8.17969 17.9188 8.17969Z"/></svg>--}}
{{--                                    34--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Refunded Transaction</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>&#8358; {{number_format($trx_reversed)}}</h2>
{{--                        <span class="green-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9188 8.17969H11.6888H6.07877C5.11877 8.17969 4.63877 9.33969 5.31877 10.0197L10.4988 15.1997C11.3288 16.0297 12.6788 16.0297 13.5088 15.1997L15.4788 13.2297L18.6888 10.0197C19.3588 9.33969 18.8788 8.17969 17.9188 8.17969Z"/></svg>--}}
{{--                                    10--}}
{{--                                </span>--}}
                    </div>
                </div>
            </div>



{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="materialCard">--}}
{{--                    <h6 class="grey-color">Failed Transaction</h6>--}}
{{--                    <div class="dashboardSummaryCount flex-between">--}}
{{--                        <h2>$5,000</h2>--}}
{{--                        <span class="red-theme">--}}
{{--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9188 8.17969H11.6888H6.07877C5.11877 8.17969 4.63877 9.33969 5.31877 10.0197L10.4988 15.1997C11.3288 16.0297 12.6788 16.0297 13.5088 15.1997L15.4788 13.2297L18.6888 10.0197C19.3588 9.33969 18.8788 8.17969 17.9188 8.17969Z"/></svg>--}}
{{--                                    5--}}
{{--                                </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>

{{--        <div class="row">--}}
{{--            <div class="col-sm-12 col-lg-8">--}}
{{--                <div class="materialCard mt-5">--}}
{{--                    <div class="materialCardTitle">--}}
{{--                        <div class="materialCardInline">--}}
{{--                            <div>--}}
{{--                                <h4>Transactions</h4>--}}
{{--                                <!--<h6 class="headingH6">Payouts Rate</h6>-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="transactionChart"></div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-12 col-lg-4">--}}
{{--                <div class="materialCard mt-5">--}}
{{--                    <div class="materialCardTitle">--}}
{{--                        <div class="materialCardInline">--}}
{{--                            <div>--}}
{{--                                <h4>New Customers</h4>--}}
{{--                                <!--<h6 class="headingH6">Payouts Rate</h6>-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @foreach($new_customers as $new_cs)--}}
{{--                        <div class="materialListPanel">--}}
{{--                        <div class="materialListPanelBody">--}}
{{--                            <div>--}}
{{--                                <img src="/verdant_assets/img/varst-icon.png" alt="">--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h5>{{$new_cs->name}}</h5>--}}
{{--                                <h6 class="grey-color">{{$new_cs->lga}}</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div><h6 class="green-theme">{{\Carbon\Carbon::parse($new_cs->created_at)->format('M d')}}</h6></div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col-sm-12">
                <div id="transactionsTable" class="materialCard materialTableContainer mt-5">
                    <div class="materialCardTitle">
                        <div class="materialCardInline flex-between">
                            <div>
                                <h4>Transactions Table</h4>
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
                        <table class="table table-borderless dataTable">
                            <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">User</th>
                                <th scope="col">Reference</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Fees</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($trxs as $trans)
                                <tr>
                                    <td class="opencloseModal" data-trigger-id="viewTransactions{{$trans->id}}">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.25 9.14969C18.94 5.51969 15.56 3.42969 12 3.42969C10.22 3.42969 8.49 3.94969 6.91 4.91969C5.33 5.89969 3.91 7.32969 2.75 9.14969C1.75 10.7197 1.75 13.2697 2.75 14.8397C5.06 18.4797 8.44 20.5597 12 20.5597C13.78 20.5597 15.51 20.0397 17.09 19.0697C18.67 18.0897 20.09 16.6597 21.25 14.8397C22.25 13.2797 22.25 10.7197 21.25 9.14969ZM12 16.0397C9.76 16.0397 7.96 14.2297 7.96 11.9997C7.96 9.76969 9.76 7.95969 12 7.95969C14.24 7.95969 16.04 9.76969 16.04 11.9997C16.04 14.2297 14.24 16.0397 12 16.0397Z"></path><path d="M11.9984 9.14062C10.4284 9.14062 9.14844 10.4206 9.14844 12.0006C9.14844 13.5706 10.4284 14.8506 11.9984 14.8506C13.5684 14.8506 14.8584 13.5706 14.8584 12.0006C14.8584 10.4306 13.5684 9.14062 11.9984 9.14062Z"></path></svg>
                                    </td>
                                    <td>{{$trans->user->firstname}}</td>
                                    <td>{{$trans->reference}}</td>
                                    <td>{{$trans->remark}}</td>
                                    <td>&#8358; {{number_format($trans->amount)}}</td>
                                    <td>&#8358; 0</td>
                                    <td>{{$trans->type}}</td>
                                    <td>
                                        @if($trans->status == 1)
                                            Success
                                        @elseif($trans->status == 0)
                                            Pending
                                        @elseif($trans->status == 2)
                                            Reversed
                                        @else
                                            Failed
                                        @endif
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($trans->created_at)->format('Y-m-d')}}</td>
                                </tr>

                                <!-- Modal Container -->
                                <div class="materialModalContainer viewTransactionDetailsDiv" data-trigger-content="viewTransactions{{$trans->id}}">
                                    <div class="materialModalDiv">
                                        <div class="materialModalHeader">
                                            <div>
                                                <h4>Transactions</h4>
                                            </div>
                                            <div class="closeModal">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 1.5L22.8627 22.5627" stroke-linecap="round" stroke-linejoin="round"/><path d="M22.8625 1.5L1.49986 22.5627" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </div>
                                        </div>

                                        <div class="transactionDetails flex-between mb-4">
                                            <div><small>Amount</small><h5>NGN {{number_format($trans->amount)}}</h5></div>
                                            <div><small>Transaction Date</small><h5>{{$trans->created_at}}</h5></div>
                                        </div>

                                        <div class="transactionDetails flex-between mb-4">
                                            <div><small>Amount Charged</small><h5>NGN 0</h5></div>
                                            <div><small>Reference</small><h5>{{$trans->reference}}</h5></div>
                                        </div>

                                        <div class="transactionDetails flex-between mb-4">
                                            <div><small>Status</small><h5>
                                                    @if($trans->status == 1)
                                                        Success
                                                    @elseif($trans->status == 0)
                                                        Pending
                                                    @elseif($trans->status == 2)
                                                        Reversed
                                                    @else
                                                        Failed
                                                    @endif
                                                </h5></div>
                                            <div><small>Type</small><h5>{{$trans->type}}</h5></div>
                                        </div>

                                        <div class="transactionDetails flex-between mb-4">
                                            <div><small>{{$trans->remark}}</small></div>
                                            {{--                                                <div><small>Card Expiry</small><h5>23/04</h5></div>--}}
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
{{--                    <div class="mt-4 text-right">--}}
{{--                        {{$new_customers->links()}}--}}
{{--                    </div>--}}
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
            $(".dataTable").tableHTMLExport({ type: "json", filename: "sample.json",});
        });
        $(".csvExport").on("click", function () {
            $(".dataTable").tableHTMLExport({ type: "csv", filename: "sample.csv" });
        });
        $(".pdfExport").on("click", function () {
            $(".dataTable").tableHTMLExport({ type: "pdf", filename: "sample.pdf" });
        });
    </script>
@endsection
