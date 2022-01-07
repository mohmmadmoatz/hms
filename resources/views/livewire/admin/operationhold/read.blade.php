<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0">
                <h3 class="card-title">قائمة العمليات</h3>

                <div class="px-2 mt-4">

                    <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                        <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">العمليات</li>
                    </ul>

                    <div class="row justify-content-between mt-4 mb-4">
                        @if(config('easy_panel.crud.operationhold.create'))
                        <div class="col-md-4 right-0">
                            <a href="@route(getRouteName().'.operationhold.create')" class="btn btn-success">{{ __('CreateTitle', ['name' => __('OperationHold') ]) }}</a>
                        </div>
                        @endif
                        @if(config('easy_panel.crud.operationhold.search'))
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" @if(config('easy_panel.lazy_mode')) wire:model.lazy="search" @else wire:model="search" @endif placeholder="{{ __('Search') }}" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-default">
                                        <a wire:target="search" wire:loading.remove><i class="fa fa-search"></i></a>
                                        <a wire:loading wire:target="search"><i class="fas fa-spinner fa-spin" ></i></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
            </div>

            
    <style>
 .table.table-fit {
    width: max-content !important;
    table-layout: auto !important;
}
table.table-fit thead th, table.table-fit tfoot th {
    width: auto !important;
}
table.table-fit tbody td, table.table-fit tfoot td {
    width: auto !important;
}
                
        </style>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-fit">
                    <tbody>
                    <tr>
                        <td> رقم العملية</td>
                        <td>رقم الوصل</td>
                        <td style='cursor: pointer' wire:click="sort('patinet_id')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'patinet_id') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'patinet_id') fa-sort-amount-up ml-2 @endif'></i> {{ __('المريض') }} </td>
                        <td class="fit" style='cursor: pointer' wire:click="sort('doctor_id')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'doctor_id') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'doctor_id') fa-sort-amount-up ml-2 @endif'></i> {{ __('الطبيب') }} </td>
                        <td style='cursor: pointer' wire:click="sort('operation_price')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'operation_price') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'operation_price') fa-sort-amount-up ml-2 @endif'></i> {{ __('سعر العملية') }} </td>
                        <td style='cursor: pointer' wire:click="sort('operation_name')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'operation_name') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'operation_name') fa-sort-amount-up ml-2 @endif'></i> {{ __('اسم العملية') }} </td>
                        <td style='cursor: pointer' wire:click="sort('doctorexp')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'doctorexp') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'doctorexp') fa-sort-amount-up ml-2 @endif'></i> {{ __('اجور الجراح') }} </td>
                        <td style='cursor: pointer' wire:click="sort('helper')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'helper') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'helper') fa-sort-amount-up ml-2 @endif'></i> {{ __('اجور مساعد الجراح') }} </td>
                        <td style='cursor: pointer' wire:click="sort('m5dr')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'm5dr') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'm5dr') fa-sort-amount-up ml-2 @endif'></i> {{ __('اجور المخدر') }} </td>
                        <td style='cursor: pointer' wire:click="sort('helperm5dr')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'helperm5dr') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'helperm5dr') fa-sort-amount-up ml-2 @endif'></i> {{ __('اجور مساعد المخدر') }} </td>
                        <td style='cursor: pointer' wire:click="sort('operation_type')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'operation_type') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'operation_type') fa-sort-amount-up ml-2 @endif'></i> {{ __('اجور القابلة') }} </td>
                        
                        @if(config('easy_panel.crud.operationhold.delete') or config('easy_panel.crud.operationhold.update'))
                        <td>{{ __('Action') }}</td>
                        @endif
                    </tr>

                    @foreach($operationholds as $operationhold)
                        @livewire('admin.operationhold.single', ['operationhold' => $operationhold], key($operationhold->id))
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="m-auto pt-3 pr-3">
                {{ $operationholds->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</div>
