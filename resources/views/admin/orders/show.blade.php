@extends ('bazar::layout.layout')

{{-- Title --}}
@section ('title', __('Order #:id', ['id' => $order->id]))

{{-- Content --}}
@section ('content')
    <x-bazar::form action="{{ URL::route('bazar.orders.update', $order) }}" :model="$order">
        <card :title="__('General')" class="mb-5">
            @include ('bazar::admin.orders.partials.details')
        </card>
        <card :title="__('Products')">
            @if ($order->products->isEmpty())
                <div class="alert alert-info  mb-0">
                    {{ __('There are no products yet.') }}
                </div>
            @else
                @include ('bazar::admin.orders.partials.items')
            @endif
        </card>

        <x-slot name="aside">
            <card :title="__('Settings')" class="mb-5">
                <form-select name="status" :label="__('Status')" :options="$page.statuses" v-model="form.fields.status"></form-select>
            </card>
        </x-slot>
    </x-bazar::form>
    <div class="row">
        <div class="col-12 col-lg-7 col-xl-8 mt-5">
            <order-transactions :order="$page.order"></order-transactions>
        </div>
    </div>
@endsection