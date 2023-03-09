@extends('layouts.verdant_client')

@section('contents')
    <div class="container-fluid dashboardSummary">

        @include('verdant.admin.partials.client_vas_nav', ['active' => "a"])

        <div class="row">
        <div class="col-sm-12">
            <div class="materialCard materialTableContainer mt-5">
                <div class="materialCardTitle">
                    <div class="materialCardInline flex-between">
                        <div>
                            <h4 id="lists">Airtime Table</h4>
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
                            <th>Provider</th>
                            <th>Min Amount</th>
                            <th>Max Amount</th>
                            <th>Commission</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all as $cli)
                            <tr>
                                <td>{{$cli->parentData->provider}}</td>
                                <td>{{$cli->parentData->minAmount}}</td>
                                <td>{{$cli->parentData->maxAmount}}</td>
                                <td>{{$cli->c_cent}}</td>
                                <td>
                                    @if($cli->status=='1')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($cli->status=='0')
                                        <span class="badge badge-warning">In-Active</span>
                                    @endif
                                </td>
                                <td><a href="{{route('editAirtime',$cli->id)}}">
                                        <svg class="mainBodyRightContainerTrigger" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.25 9.14969C18.94 5.51969 15.56 3.42969 12 3.42969C10.22 3.42969 8.49 3.94969 6.91 4.91969C5.33 5.89969 3.91 7.32969 2.75 9.14969C1.75 10.7197 1.75 13.2697 2.75 14.8397C5.06 18.4797 8.44 20.5597 12 20.5597C13.78 20.5597 15.51 20.0397 17.09 19.0697C18.67 18.0897 20.09 16.6597 21.25 14.8397C22.25 13.2797 22.25 10.7197 21.25 9.14969ZM12 16.0397C9.76 16.0397 7.96 14.2297 7.96 11.9997C7.96 9.76969 9.76 7.95969 12 7.95969C14.24 7.95969 16.04 9.76969 16.04 11.9997C16.04 14.2297 14.24 16.0397 12 16.0397Z"></path><path d="M11.9984 9.14062C10.4284 9.14062 9.14844 10.4206 9.14844 12.0006C9.14844 13.5706 10.4284 14.8506 11.9984 14.8506C13.5684 14.8506 14.8584 13.5706 14.8584 12.0006C14.8584 10.4306 13.5684 9.14062 11.9984 9.14062Z"></path></svg>
                                    </a>

                                    <label class="toggleSwitch nolabel">
                                        <input type="checkbox" name="status" value="0" id="myCheckBox"
                                               {{$cli->status =="1"?'checked':''}} onclick="window.location='{{route('airtimeModify', $cli->id)}}'"/>
                                        <span>
                                                <span>off</span>
                                                <span>on</span>
                                             </span>

                                        <a></a>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-right">
                    {{$all->links()}}
                </div>
            </div>
        </div>


    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#myBtn").click(function(){
                $("#myModal").modal();
            });
        });
    </script>
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

@endsection
