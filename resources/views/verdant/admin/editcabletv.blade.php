@extends('layouts.verdant_admin')

@section('contents')
    <div class="row">
        <div class="col-sm-5 col-lg-5">
            <div class="materialCard profileSettings">
                <div class="profilePhoto">
                    @if($tv->type=='dstv')
                        <img width="100" src="{{asset('verdant_assets/dstv.png')}}" alt="">
                    @elseif($tv->type=='gotv')
                        <img width="100" src="{{asset('verdant_assets/gotv.jpg')}}" alt="">
                    @elseif($tv->type=='startimes')
                        <img width="100" src="/verdant_assets/a.jpg" alt="">
                    @elseif($tv->type=='showmax')
                        <img width="100" src="/verdant_assets/9.png" alt="">
                    @endif
                    <h6>{{$tv->name}}</h6>
                    <div class="materialButtonIcon">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-lg-7">
            <div class="materialCard">
                <form method="post" action="{{route('admin.updatetv')}}">
                    @csrf
                    <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>
                    <div class="materialCardForm px-4 py-4">
                        <h4>Product Details</h4>
                        <div class="mt-4 mb-4">
                            <input type="hidden" name="id" value="{{$tv->id}}" placeholder="Selling Price" id="" required>
                            <h5 class="mb-3">Provider Price</h5>
                            <input type="text" class="subject" name="amount" value="{{$tv->amount}}" placeholder="Provider Price" id="" disabled>
                        </div>
                        <div class="mt-4 mb-4">
                            <h5 class="mb-3">Your Price</h5>
                            <input type="text" class="subject" name="price" value="{{$tv->price}}" placeholder="Your Price" id="">
                        </div>
                        <div class="mt-4 mb-4">
                            <h5 class="mb-3">Agency Commission(%)</h5>
                            <input type="text" class="subject" name="ccent" value="{{$tv->c_cent}}" placeholder="Agency Commission" id="">
                        </div>
                        <input type="submit" class="btn-primary">
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
