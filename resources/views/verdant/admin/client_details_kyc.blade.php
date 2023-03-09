@extends('layouts.verdant_admin')

@section('contents')
    <div class="container-fluid dashboardSummary">
        <div class="row">
            <div class="col-sm-12">
                <div class="titleWithDateDiv">
                    <div>
                        <a href="{{route('admin.clients.details', $client->id)}}">
                            <a href="javascript:history.back()">
                                <h5 class="mb-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 4.5L7.5 12L15 19.5" stroke="#51526C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    Back
                                </h5>
                            </a>
                        </a>
                    </div>
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

        @include('verdant.admin.partials.client_nav', ['active' => "k"])

        <div class="materialCard mt-5">
            <div class="materialCardForm">
                <h4>Business Information <span class="badge badge-info">(@if($client->status == 1) Active @else Inactive @endif&nbsp;)</span></h4>
                <input type="text" class="subject" placeholder="Business Name" id="" value="{{$client->name}}" disabled>
                <input type="text" class="subject" placeholder="Primary Phone Number" value="{{$client->phoneno}}" id="" disabled>
                <input type="text" class="subject" placeholder="Business Type" value="{{$client->type}}" id="" disabled>
                <input type="text" class="subject" placeholder="Business Address" value="{{$client->address}}" id="" disabled>

                @if($client->status == 0)
                    <a href="{{route('admin.clients.kyc_update', $client->id)}}" class="btn btn-success text-white">Enable Business</a>
                @else
                    <a href="{{route('admin.clients.kyc_update', $client->id)}}" class="btn btn-danger text-white">Disable Business</a>
                @endif
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

        <div class="row">
            <div class="col-sm-12">
                <div class="materialCard">
                    <div class="twoItemsPerRow">
                        @if($kyc != null)
                            <div>
                                <img width="150" height="150" alt="Card Image" src="{{asset($kyc->utility)}}" class="card-img-top">
                                <h2>Utility Bill</h2>
                                <a class="btn btn-sm  btn-success" href="{{asset($kyc->utility)}}" download>Download</a>
                            </div>
                        @else
                            <h2>Utility Bill not found</h2>
                        @endif

                        @if($kyc != null)
                            <div>
                                <img width="150" height="150" alt="Guarantor's ID Image" src="{{asset($kyc->passport)}}" class="card-img-top">
                                <h5>Passport</h5>
                                <a class="btn btn-sm  btn-success" href="{{asset($kyc->passport)}}" download>Download</a>
                            </div>
                        @else
                            <h2>Passport not found</h2>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="materialCard">
                    <div class="twoItemsPerRow">
                        @if($kyc != null)
                            <div>
                            <img width="150" height="150" alt="IDCard Image" src="{{asset($kyc->idcard)}}" class="card-img-top">
                            <h5>ID Card</h5>
                            <a class="btn btn-sm  btn-success" href="{{asset($kyc->idcard)}}" download>Download</a>
                        </div>
                        @else
                            <h2>ID Card not found</h2>
                        @endif

                        @if($kyc != null)
                            <div>
                                <img width="150" height="150" alt="Guarantor's ID Image" src="{{asset($kyc->guarantorform)}}" class="card-img-top">
                                <h5>Guarantor's ID</h5>
                                <a class="btn btn-sm  btn-success" href="{{asset($kyc->guarantorform)}}" download>Download</a>
                            </div>
                        @else
                            <h2>Guarantor's ID not found</h2>
                        @endif

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
@endsection
