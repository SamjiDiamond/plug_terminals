@extends('layouts.verdant_admin')

@section('contents')
    <div class="container-fluid dashboardSummary">

        @if (session('success'))
            <div class="mb-4 font-medium text-sm alert-success alert-dismissible alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-5 col-lg-5">
                <div class="materialCard profileSettings">
                    <div class="profilePhoto">
                        <img src="assets/img/user.png" alt="">
                        <h4 class="mt-4">{{\Illuminate\Support\Facades\Auth::user()->lastname}} {{\Illuminate\Support\Facades\Auth::user()->firstname}}</h4>
                        <h6>{{\Illuminate\Support\Facades\Auth::user()->email}}</h6>
                        <a href="{{route('logout')}}" class="materialButtonIcon">
                            <span>Sign Out</span>
                            <span class="buttonIcon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.59985 23.1001H3.29989C2.66337 23.1001 2.05293 22.8403 1.60284 22.3777C1.15276 21.9151 0.899902 21.2877 0.899902 20.6335V3.36681C0.899902 2.71261 1.15276 2.08521 1.60284 1.62262C2.05293 1.16003 2.66337 0.900146 3.29989 0.900146H9.59985" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.1001 17.9999L23.1001 12L17.1001 6" stroke-linecap="round" stroke-linejoin="round"/><path d="M23.0991 12H8.69922" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                        </a>
                    </div>
                </div>
                <div class="materialCard profileSettings">
                    <h4 class="mb-3">Secret Key</h4>
                    @if($business->secret_key == "")
                        <a href="{{route('generate-api-key')}}" class="btn btn-primary">Generate Key</a>
                    @else
                        <input id="inputApikey" type="text" class="form-control" value="{{$business->secret_key}}" readonly/>

                        <div class="flex-between mt-4">
                            <button type="button" onclick="navigator.clipboard.writeText('{{$business->secret_key}}');" class="form-control btn-success mr-2">Copy</button>
                            <a href="{{route('generate-api-key')}}" class="form-control btn-primary ml-2">re-Generate Key</a>
                        </div>
                    @endif

                </div>
            </div>
            <div class="col-sm-7 col-lg-7">
                <div class="materialCard">
                    <div class="materialCardForm">
                        <h4>Personal Information</h4>
                        <div class="flex-between">
                            <input type="text" class="subject" placeholder="First Name" id="" name="firstname" value="{{\Illuminate\Support\Facades\Auth::user()->firstname}}">
                            <input type="text" class="subject" placeholder="Last Name" id="" name="lastname" value="{{\Illuminate\Support\Facades\Auth::user()->lastname}}">
                        </div>
                        <div class="flex-between">
                            <input type="text" class="subject" placeholder="Address" id="">
                            <input type="number" class="subject" placeholder="Primary Contact Number" value="{{\Illuminate\Support\Facades\Auth::user()->phone}}" id="">
                        </div>
                        <input type="submit" class="btn-primary">
                    </div>
                </div>

                <div class="materialCard mt-5">
                    <div class="materialCardForm">
                        <h4>Business Information</h4>
                        <input type="text" class="subject" placeholder="Business Name" id="" value="{{$business->name}}" disabled>
{{--                        <input type="text" class="subject" placeholder="Primary Email" id="">--}}
{{--                        <div class="flex-between">--}}
{{--                            <input type="text" class="subject" placeholder="Secondary Email" id="">--}}
{{--                            <input type="text" class="subject" placeholder="Secondary Email 2" id="">--}}
{{--                        </div>--}}
{{--                        <div class="flex-between">--}}
{{--                            <input type="text" class="subject" placeholder="Registration No" id="">--}}
{{--                            <select>--}}
{{--                                <option value="" selected disabled>Category</option>--}}
{{--                                <option value="">MicroFinance Bank</option>--}}
{{--                                <option value="">Fintech</option>--}}
{{--                                <option value="">OFIs</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="flex-between">--}}
{{--                            <input type="text" class="subject" placeholder="City" id="" value="{{$business->address}}">--}}
{{--                            <input type="text" class="subject" placeholder="State" id="">--}}
{{--                            <input type="text" class="subject" placeholder="LGA" id="" value="{{$business->lga}}">--}}
{{--                        </div>--}}
{{--                        <div class="mt-4 mb-4">--}}
{{--                            <h5 class="mb-3">Upload CAC Document</h5>--}}
{{--                            <input type="file" class="filepond" name="filepond" accept="image/png, image/jpeg, image/gif"/>--}}
{{--                        </div>--}}
{{--                        <div class="mt-4 mb-4">--}}
{{--                            <h5 class="mb-3">Upload License</h5>--}}
{{--                            <input type="file" class="filepond" name="filepond" accept="image/png, image/jpeg, image/gif"/>--}}
{{--                        </div>--}}
{{--                        <input type="submit" class="btn-primary">--}}
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
