@extends('layouts.verdant_admin')

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
                        <form action="{{route('admin.map_terminal_post')}}" method="POST">
                            @csrf
                        <h4>Terminal Information</h4>
                            <input name="terminal_id" type="text" class="subject" placeholder="Terminal ID"  required>
                        <div class="flex-between">
                            <input name="serial_number" type="text" class="subject" placeholder="Terminal Serial Number" id="" required>
                        </div>

                            <h4>Business Information</h4>

                        <div class="flex-between">
                            <select name="business_id">
                                <option value="" selected>Select Business</option>
                                @foreach($business as $biz)
                                    <option value="{{$biz->id}}" selected>{{$biz->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn-primary">
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>

                        <th scope="col">S/N</th>
                        <th>Terminal ID</th>
                        <th>Terminal Serial</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($terminals as $term)
                        <tr>
                            <td>{{$term->id}}</td>
                            <td>{{$term->terminal_id}}</td>
                            <td>{{$term->serial_number}}</td>
                            <td class="opencloseModal" data-trigger-id="viewTransactions{{$term->id}}">
                                <span class="btn btn-primary">Map Terminal</span>
                            </td>
                        </tr>


                        <!-- Modal Container -->
                        <div class="materialModalContainer viewTransactionDetailsDiv" data-trigger-content="viewTransactions{{$term->id}}">
                            <div class="materialModalDiv">
                                <div class="materialModalHeader">
                                    <div>
                                        <h4>Map Terminal</h4>
                                    </div>
                                    <div class="closeModal">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 1.5L22.8627 22.5627" stroke-linecap="round" stroke-linejoin="round"/><path d="M22.8625 1.5L1.49986 22.5627" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                </div>

                                <div class="transactionDetails flex-between mb-4">
                                    <div><small>Terminal ID</small><h5>{{$term->terminal_id}}</h5></div>
                                    <div><small>Terminal Serial</small><h5>{{$term->serial_number}}</h5></div>
                                </div>


                                <form action="{{route('admin.map_existing_terminal_post')}}" method="POST">
                                    @csrf
                                    <input name="id" type="hidden" class="subject" placeholder="Terminal ID" value="{{$term->id}}">
                                    <h4>Business</h4>

                                    <select class="form-control" name="business_id">
                                        <option value="" selected>Select Business</option>
                                        @foreach($business as $biz)
                                            <option value="{{$biz->id}}" selected>{{$biz->name}}</option>
                                        @endforeach
                                    </select>

                                    <input type="submit" class="btn-primary btn mt-4">
                                </form>

                            </div>
                        </div>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-right">
                {{$terminals->links()}}
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
