@extends('layouts.verdant_admin')

@section('contents')
    <div class="container-fluid dashboardSummary">

        @include('error_success_message')


        <div class="row">
            <div class="col-sm-12">
                <div class="materialCard materialTableContainer mt-5">
                    <div class="materialCardTitle">
                        <div class="materialCardInline flex-between">
                            <div>
                                <h4>Services Table</h4>
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
                                <th scope="col">No</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Varst Service / Cap Fee</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $serv)
                                <tr>
                                    <td>{{$serv->id}}</td>
                                    <td>{{$serv->name}}</td>
                                    <td>{{$serv->description}}</td>
                                    <td>{{$serv->fee}} @if($serv->fee_type == 0) Flat @else % - NGN{{$serv->capped_fee}} @endif</td>
                                    <td><span class="opencloseModal" data-trigger-id="editServices{{$serv->id}}" style="cursor: pointer; font-weight: 600; color: #ee411f">Edit</span></td>

                                    <!-- Modal Container -->
                                    <div class="materialModalContainer viewTransactionDetailsDiv" data-trigger-content="editServices{{$serv->id}}">
                                        <div class="materialModalDiv">

                                            <form action="{{route('admin.updateFee')}}" method="POST">
                                                @csrf

                                                <div class="materialModalHeader" style="margin-bottom: 1rem;">
                                                    <div>
                                                        <h4>{{$serv->name}}</h4>
                                                        <h6>{{$serv->description}}</h6>
                                                    </div>
                                                    <div class="closeModal">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 1.5L22.8627 22.5627" stroke-linecap="round" stroke-linejoin="round"/><path d="M22.8625 1.5L1.49986 22.5627" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    </div>
                                                </div>

                                                <div class="materialCardForm">
                                                    <select name="type" id="type">
                                                        <option value="1" @if($serv->fee_type == 1) "selected" @else "" @endif>Percentage</option>
                                                        <option value="0" @if($serv->fee_type == 0) "selected" @else "" @endif>Flat</option>
                                                    </select>
                                                </div>
                                                <div class="materialCardForm">
                                                    <input type="hidden" class="firstName" name="id" value="{{$serv->id}}" placeholder="Varst Service Fee" id="fee">
                                                    <input type="text" class="firstName" name="fee" value="{{$serv->fee}}" placeholder="Varst Service Fee" id="fee">
                                                </div>
                                                <div class="materialCardForm" id="capfeeForm">
                                                    <input type="text" class="firstName" name="capfee" value="{{$serv->capped_fee}}" placeholder="Varst Cap Fee: Type 0 for Flat fee" id="capfee">
                                                </div>
                                                <div class="materialCardForm">
                                                    <input type="submit" class="btn-primary" style="margin-top: 0.25rem;">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
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
