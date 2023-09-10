<tr x-data="{ modalIsOpen : false }">
    <td> {{ $warehouseitem->name }} </td>
    <td> {{ $warehouseitem->incomeqty }} {{$warehouseitem->base->name ??""}} </td>    
    <td> {{ $warehouseitem->exportqty }} {{$warehouseitem->base->name ??""}}</td>    
    <td> {{ $warehouseitem->qtynow }} {{$warehouseitem->base->name ??""}}</td>  
    <td>
        {{ $warehouseitem->price ??""}}
    </td>
    @if( Auth::user()->user_type  == "stockmanagment" ||  Auth::user()->user_type  == "superadmin" )
    @if(config('easy_panel.crud.warehouseitem.delete') or config('easy_panel.crud.warehouseitem.update'))
        <td>

        
            @if(config('easy_panel.crud.warehouseitem.update'))
                <a href="@route(getRouteName().'.warehouseitem.update', ['warehouseitem' => $warehouseitem->id])" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(config('easy_panel.crud.warehouseitem.delete'))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('WarehouseItem') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('WarehouseItem') ]) }}</p>
                        <div class="mt-5 d-flex justify-content-between">
                            <a wire:click.prevent="delete" class="text-white btn btn-success shadow">{{ __('Yes, Delete it.') }}</a>
                            <a @click.prevent="modalIsOpen = false" class="text-white btn btn-danger shadow">{{ __('No, Cancel it.') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </td>
        @endif
    @endif
</tr>
