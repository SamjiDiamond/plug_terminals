@extends('layouts.verdant_client')

@section('contents')
    <div class="container-fluid dashboardSummary">
        <div class="row">
            <div class="col-12">
                <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>


                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 alert-dismissible alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 font-medium text-sm alert-danger alert-dismissible alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 font-medium text-sm alert-success alert-dismissible alert">
                        {{ session('success') }}
                    </div>
                @endif

                <script>
                    function myNewFunction(sel) {
                        // alert(sel.options[sel.selectedIndex].id);
                        document.getElementById("po").value = (sel.options[sel.selectedIndex].id);
                        document.getElementById("pk").value = (sel.options[sel.selectedIndex].text);
                    }
                </script>
                <div class="materialCard mt-1">
                    <div class="materialCardForm">
                        <form action="{{route('verify')}}" method="POST">
                            @csrf
                            <h4>Choose Bank</h4>
                            <div class="flex-between">
                                <select name="bank" class="subject" onChange="myNewFunction(this);"  id="" required>
                                    <option id="" value="" selected>Select Bank</option>
                                    @foreach($data as $plans)
                                        <option id="{{$plans['institution_code']}}" value="{{$plans['institution_code']}}">{{$plans['institution_name']}}</option>
                                    @endforeach
                                </select>
                                <input name="code" type="hidden" id="po" value="" class="form-control">
                                <input type="number" name="number" maxlength="11" class="subject" placeholder="Account Number" id="" required>
                            </div>
                            <div class="flex-between">
                                <input type="number" maxlength="4" name="amount" class="subject" placeholder="Enter Amount" id="" required>
                                <input type="text" name="narration" class="subject" placeholder="Description" id="" required>

                            </div>
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="materialCard materialTableContainer mt-5">
                    <div class="materialCardTitle">
                        <div class="materialCardInline flex-between">
                            <div>
                                <h4 id="lists">Transfer Transaction</h4>
                                <!--<h6 class="headingH6">Payouts Rate</h6>-->
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless dataTable">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Refid</th>
                                <th>Bank</th>
                                <th>Account Number</th>
                                <th>Narration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trans as $cli)
                                <tr>
                                    <td>{{$cli->created_at}}</td>
                                    <td>₦{{$cli->amount}}</td>
                                    <td>{{$cli->refid}}</td>
                                    <td>{{$cli->bankcode}}</td>
                                    <td>{{$cli->account_no}}</td>
                                    <td>{{$cli->narration}}</td>
                                    <td>
                                        @if($cli->status=='1')
                                            <span class="badge badge-success text-white">Successful</span>
                                        @elseif($cli->status=='0')
                                            <span class="badge badge-warning text-white">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                       <a href="{{route('tsq_transfer', $cli->refid)}}" class="btn btn-primary" >TSQ</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 text-right">
                        {{--                    {{$all->links()}}--}}
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection

@section('scripts')

    <script>
        FilePond.parse(document.body);
    </script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        });

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
