@extends('layouts.verdant_admin')

@section('contents')
    <div class="container-fluid dashboardSummary">
        <div class="row">
            <div class="col-sm-12">
                <div class="titleWithDateDiv">
                    <div><h4>Clients</h4></div>
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
                            <div class="clientsChart" style="width: 360px; min-height: 257.867px;"></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="flex-between transactionSummary">
                                <div>
                                    <h6 class="grey-color orange-color">Total Clients</h6>
                                    <h3>{{number_format($client_total)}}</h3>
                                </div>
                                <div>
                                    <h6 class="grey-color green-color">Active Clients</h6>
                                    <h3>{{number_format($client_active)}}</h3>
                                </div>
                                <div>
                                    <h6 class="grey-color red-color">Inactive Clients</h6>
                                    <h3>{{number_format($client_inactive)}}</h3>
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

                    @foreach($client_recent as $cr)
                        <div class="materialListPanel">
                        <a href="{{route('admin.clients.details', $cr->id)}}">
                            <div class="materialListPanelBody">
                                <div>
                                    <img src="/verdant_assets/img/varst-icon.png" alt="">
                                </div>
                                <div>
                                    <h5>{{$cr->name}}</h5>
                                    <h6 class="grey-color">{{$cr->lga}}</h6>
                                </div>
                            </div>
                        </a>
                        <div><h6 class="green-theme">{{\Carbon\Carbon::parse($cr->created_at)->format('M d')}}</h6></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

{{--        <div class="row">--}}
{{--            <div class="col-sm-12 col-lg-8">--}}
{{--                <div class="materialCard">--}}
{{--                    <div class="materialCardTitle">--}}
{{--                        <div class="materialCardInline">--}}
{{--                            <div>--}}
{{--                                <h4>Clients Chart</h4>--}}
{{--                                <!--<h6 class="headingH6">Payouts Rate</h6>-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="clientsLineChart"></div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-12 col-lg-4">--}}
{{--                <div class="materialCard">--}}
{{--                    <div class="materialCardTitle">--}}
{{--                        <div class="materialCardInline">--}}
{{--                            <div>--}}
{{--                                <h4>New Clients</h4>--}}
{{--                                <!--<h6 class="headingH6">Payouts Rate</h6>-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @foreach($client_recent as $cr)--}}
{{--                        <div class="materialListPanel">--}}
{{--                        <a href="{{route('admin.clients.details', $cr->id)}}">--}}
{{--                            <div class="materialListPanelBody">--}}
{{--                                <div>--}}
{{--                                    <img src="/verdant_assets/img/varst-icon.png" alt="">--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <h5>{{$cr->name}}</h5>--}}
{{--                                    <h6 class="grey-color">{{$cr->lga}}</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <div><h6 class="green-theme">{{\Carbon\Carbon::parse($cr->created_at)->format('M d')}}</h6></div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col-sm-12">
                <div class="materialCard materialTableContainer mt-5">
                    <div class="materialCardTitle">
                        <div class="materialCardInline flex-between">
                            <div>
                                <h4 id="lists">Clients Table</h4>
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
                                <th scope="col">S/N</th>
                                <th>Name</th>
                                <th>Customers</th>
                                <th>Terminals</th>
                                <th>Transactions</th>
                                <th>Settlements</th>
                                <th>Income</th>
                                <th>Disbursement</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $cli)
                                    <tr>
                                    <td>{{$cli->id}}</td>
                                    <td><a href="{{route('admin.clients.details', $cli->id)}}">{{$cli->name}}</a></td>
                                    <td>{{$cli->Customers->count()}}</td>
                                    <td>{{$cli->Terminals->count()}}</td>
                                    <td>{{$cli->Transactions->count()}}</td>
                                    <td>&#8358; 0</td>
                                    <td>{{$cli->Income->sum('amount')}}</td>
                                    <td>{{$cli->Disbursement->sum('amount')}}</td>
                                    <td><a href="{{route('admin.clients.details', $cli->id)}}">
                                            <svg class="mainBodyRightContainerTrigger" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.25 9.14969C18.94 5.51969 15.56 3.42969 12 3.42969C10.22 3.42969 8.49 3.94969 6.91 4.91969C5.33 5.89969 3.91 7.32969 2.75 9.14969C1.75 10.7197 1.75 13.2697 2.75 14.8397C5.06 18.4797 8.44 20.5597 12 20.5597C13.78 20.5597 15.51 20.0397 17.09 19.0697C18.67 18.0897 20.09 16.6597 21.25 14.8397C22.25 13.2797 22.25 10.7197 21.25 9.14969ZM12 16.0397C9.76 16.0397 7.96 14.2297 7.96 11.9997C7.96 9.76969 9.76 7.95969 12 7.95969C14.24 7.95969 16.04 9.76969 16.04 11.9997C16.04 14.2297 14.24 16.0397 12 16.0397Z"></path><path d="M11.9984 9.14062C10.4284 9.14062 9.14844 10.4206 9.14844 12.0006C9.14844 13.5706 10.4284 14.8506 11.9984 14.8506C13.5684 14.8506 14.8584 13.5706 14.8584 12.0006C14.8584 10.4306 13.5684 9.14062 11.9984 9.14062Z"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 text-right">
                        {{$clients->links()}}
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
    </script>
    <script>
        // Clients Pie Chart
        let clientsPieChartSeries = [{{$client_active}}, {{$client_inactive}}];
        let clientsPieChartLabels = ['Active', 'Inactive'];
        let clientsPieChartSelector = 'clientsChart';
        pieChartFunc(clientsPieChartSeries, clientsPieChartLabels, clientsPieChartSelector);


        // Transactions Line Chart
        let clientsLineChartSeries = [
            {
                name: "Clients",
                data: [0, 0, 0, 0, 0, 0, 7,0,0,0,0,0]
            }
        ];
        let clientsLineChartMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        let clientsLineChartSelector = 'clientsLineChart';
        lineChartFunc(clientsLineChartSeries, clientsLineChartMonths, clientsLineChartSelector);
    </script>

@endsection
