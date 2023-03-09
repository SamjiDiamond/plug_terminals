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
                        <form action="{{route('agent-trans')}}" method="POST">
                            @csrf
                            <h4>Choose Agent</h4>
                            <div class="flex-between">
                                <select name="id" class="subject" onChange="myNewFunction(this);"  id="" required>
                                    @foreach($agent as $plans)
                                        <option id="{{$plans['id']}}" value="{{$plans['id']}}">{{$plans['lastname']}} {{$plans['firstname']}} </option>
                                    @endforeach
                                </select>
                                <input name="reference" type="hidden"  value="{{rand(111111111111, 9999999999999)}}" class="form-control">
                            </div>
                            <input type="number" name="amount" maxlength="11" class="subject" placeholder="Enter Amount" id="" required>
                            <input type="text" name="narration" class="subject" placeholder="Description (Optional)" id="" required>
                            <input type="submit" class="btn-primary"/>
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
