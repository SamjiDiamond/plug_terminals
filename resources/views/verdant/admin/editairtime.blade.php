@extends('layouts.verdant_admin')

@section('contents')
    <div class="row">
        <div class="col-sm-5 col-lg-5">
            <div class="materialCard profileSettings">
                <div class="profilePhoto">
                        <img width="100" src="{{asset($airtime->providerLogoUrl)}}" alt="">
                    <h6>{{$airtime->provider}}</h6>
                    <div class="materialButtonIcon">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-lg-7">
            <div class="materialCard">
                <div class="materialCardForm px-4 py-4">
                    <form method="post" action="{{route('admin.updateairtime')}}">
                        @csrf
                        <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>
                            <h4>Product Details</h4>
                            <div class="mt-4 mb-4">
                                <input type="hidden" name="id" value="{{$airtime->id}}" placeholder="Selling Price" id="" required>
                                <h5 class="mb-3">Minimum Amount</h5>
                                <input type="text" class="subject" name="min" value="{{$airtime->minAmount}}" placeholder="Selling Price" id="" required>
                            </div>
                            <div class="mt-4 mb-4">
                                <h5 class="mb-3">Maximum Amount</h5>
                                <input type="text" class="subject" name="max" value="{{$airtime->maxAmount}}" placeholder="Maximum Amount" id="">
                            </div>
                            <div class="mt-4 mb-4">
                                <h5 class="mb-3">Agency Commission(%)</h5>
                                <input type="text" class="subject" name="ccent" value="{{$airtime->c_cent}}" placeholder="Agency Commission" id="">
                            </div>
                            <input type="submit" class="btn-primary">
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
