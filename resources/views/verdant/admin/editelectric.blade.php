@extends('layouts.verdant_admin')

@section('contents')
    <div class="row">
        <div class="col-sm-5 col-lg-5">
            <div class="materialCard profileSettings">
                <div class="profilePhoto">
                    <img width="100" src="{{asset($electric->providerLogoUrl)}}" alt="">
                    <h6>{{$electric->provider}}</h6>
                    <div class="materialButtonIcon">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-lg-7">
            <div class="materialCard">
                <form method="post" action="{{route('admin.updateelect')}}">
                    @csrf
                    <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>
                    <div class="materialCardForm px-4 py-4">
                        <h4>Product Details</h4>
                        <div class="mt-4 mb-4">
                            <input type="hidden" name="id" value="{{$electric->id}}" placeholder="Selling Price" id="" required>
                            <h5 class="mb-3">Minimum Amount</h5>
                            <input type="text" class="subject" name="min" value="{{$electric->minAmount}}" placeholder="Minimum Amount" id="" required>
                        </div>
                        <div class="mt-4 mb-4">
                            <h5 class="mb-3">Agency Commission(%)</h5>
                            <input type="text" class="subject" name="ccent" value="{{$electric->c_cent}}" placeholder="Agency Commission" id="">
                        </div>
                        <input type="submit" class="btn-primary">
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
