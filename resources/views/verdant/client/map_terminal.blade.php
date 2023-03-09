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
                        <form action="{{route('map_terminal_post')}}" method="POST">
                            @csrf
                        <h4>Terminal Information</h4>

                            <div class="flex-between">
                                <select name="terminal_id">
                                    <option value="" selected>Select Terminal</option>
                                    @foreach($terminals as $term)
                                        <option value="{{$term->id}}" selected>{{$term->serial_number}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h4>Agent Information</h4>

                        <div class="flex-between">
                            <select name="user_id">
                                <option value="" selected>Select Agent</option>
                                @foreach($business as $biz)
                                    <option value="{{$biz->id}}" selected>{{$biz->lastname}} {{$biz->firstname}}</option>
                                @endforeach
                            </select>
                        </div>
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
