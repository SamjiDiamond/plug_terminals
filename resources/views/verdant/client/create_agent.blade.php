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
                        <form action="{{route('createSubAgent')}}" method="POST">
                            @csrf
                        <h4>Agent Information</h4>
                            <input name="firstName" type="text" class="subject" placeholder="First Name"  required>
                            <input name="lastName" type="text" class="subject" placeholder="Last Name" required>
                        <div class="flex-between">
                            <input name="email" type="email" class="subject" placeholder="Email Address" id="" required>
                            <input type="text" name="phone" maxlength="11" class="subject" placeholder="Phone Number" id="" required>
                        </div>
                        <div class="flex-between">
                            <input type="date" name="dob" class="subject" placeholder="Date of Birth" id="">
                            <select name="gender">
                                <option value="" selected disabled>Gender</option>
                                <option selected>Male</option>
                                <option>Female</option>
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
