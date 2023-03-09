@extends('layouts.verdant_client')

@section('contents')
            <div class="row">
                <div class="col-sm-5 col-lg-5">
                    <div class="materialCard profileSettings">
                        <div class="profilePhoto">
                            @if($net->parentData->type=='dstv')
                            <img width="100" src="{{asset('verdant_assets/dstv.png')}}" alt="">
                            @elseif($net->parentData->type=='gotv')
                                <img width="100" src="{{asset('verdant_assets/gotv.jpg')}}" alt="">
                            @elseif($net->parentData->type=='airtel-data')
                                <img width="100" src="verdant_assets/a.jpg" alt="">
                            @elseif($net->parentData->type=='etisalat-data')
                                <img width="100" src="verdant_assets/9.png" alt="">
                            @endif
                            <h6>{{$net->parentData->name}}</h6>
                            <div class="materialButtonIcon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 col-lg-7">
                    <div class="materialCard">
                        <form method="post" action="{{route('done1')}}">
                            @csrf
                            <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>
                            <div class="materialCardForm px-2 py-2">
                            <h4>Product Details</h4>
                            <div class="mt-4 mb-4">
                                <input type="hidden" name="id" value="{{$net->id}}" placeholder="Selling Price" id="" required>
                                <div class="mt-4 mb-4">
                                    <h5 class="mb-3">Provider Price</h5>
                                    <input type="text" class="subject" name="" value="{{$net->parentData->price}}" placeholder="Provider Price" id="" disabled>
                                </div>
                                <div class="mt-4 mb-4">
                                    <h5 class="mb-3">Provider Commission</h5>
                                    <input type="text" class="subject" name="" value="{{$net->parentData->c_cent}}" placeholder="Agency Commission" id="" disabled>
                                </div>
                                <h5 class="mb-3">Your Price</h5>
                                <input type="text" class="subject" name="sprice" value="{{$net->price}}" placeholder="Selling Price" id="" required></div>
                                <div class="mt-4 mb-4">
                                    <h5 class="mb-3">Agent Commission</h5>
                                    <input type="text" class="subject" name="ccent" value="{{$net->c_cent}}" placeholder="Customer Percentage" id="">
                             </div>
                            <input type="submit" class="btn-primary">
                        </div>
                        </form>
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


