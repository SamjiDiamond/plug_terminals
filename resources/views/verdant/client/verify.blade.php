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


                <div class="materialCard mt-1">
                    <div class="materialCardForm">
                        <form action="{{route('requesttransfer')}}" method="post">
                            @csrf
                            <h4>Account Details</h4>
                            <div class="flex-between">
                                <input type="text" name="name" value="{{$accountName}}"  class="subject" readonly>
                                <input type="number" name="number"value="{{$request->number}}"  class="subject" placeholder="Account Number" id="" readonly>
                            </div>
                            <input type="hidden" name="code" value="{{$request->id}}"/>
                            <input type="hidden" name="bank" value="{{$request->bank}}"/>
                            <input type="hidden" name="sessionID" value="{{$sessionID}}"/>
                            <input type="hidden" name="transactionId" value="{{$transactionId}}"/>
                            <input type="hidden" name="bankVerificationNumber" value="{{$bankVerificationNumber}}"/>
                            <input type="hidden" name="refid" value="{{rand(11111111,99999999).rand()}}"/>
                            <div class="flex-between">
                                <input type="number" maxlength="4" name="amount" value="{{$request->amount}}"  class="subject" placeholder="Enter Amount" id="" readonly>
                                <input type="text" name="bankName" class="subject" value="{{$request->code}}"   readonly>
                            </div>
                            <h4>Narration</h4>
                            <input type="text" name="narration" class="subject" value="{{$request->narration}}" readonly>

                            <input type="submit" class="btn-primary">

                        </form>
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
