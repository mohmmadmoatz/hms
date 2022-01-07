<tr x-data="{ modalIsOpen : false ,modalIsOpendoctor:false,modalIsOpendoctor2:false,modalIsOpendoctor3:false,m5drisopen:false,modalIsOpendoctor4:false}">
    <td> {{ $operationhold->id }} </td>
    <td> {{ $operationhold->payment_number}} </td>
    <td> {{ $operationhold->Patient->name ??"" }} </td>
    <td> {{ $operationhold->doctor->name ?? "" }} </td>
    <td> @convert( $operationhold->operation_price) </td>
    <td> {{$operationhold->operation_name}} </td>
    <td> 
        @if(!$operationhold->doctor_paid)
       <button  @click.prevent="modalIsOpendoctor = true" class="btn btn-danger">@convert($operationhold->doctorexp)</button> 
       <div x-show="modalIsOpendoctor" class="cs-modal animate__animated animate__fadeIn">
        <div class="bg-white shadow rounded p-5" @click.away="modalIsOpendoctor = false" >
            <h5 class="pb-2 border-bottom">انشاء سند صرف</h5>
            <p>
                هل انت متأكد من انشاء السند؟
            </p>
            <div class="mt-5 d-flex justify-content-between">
                <a wire:click.prevent="savedoctor" class="text-white btn btn-success shadow">{{ __('موافق') }}</a>
                <a @click.prevent="modalIsOpendoctor = false" class="text-white btn btn-danger shadow">{{ __('الغاء') }}</a>
            </div>
        </div>
    </div>
       @else
   
       @convert($operationhold->doctorexp)
        @endif
    </td>
    
    <td> 
        @if(!$operationhold->helper_paid && $operationhold->helper!=0)
       <button  @click.prevent="modalIsOpendoctor2 = true" class="btn btn-danger">@convert($operationhold->helper)</button> 
       <div x-show="modalIsOpendoctor2" class="cs-modal animate__animated animate__fadeIn">
        <div class="bg-white shadow rounded p-5" @click.away="modalIsOpendoctor2 = false" >
            <h5 class="pb-2 border-bottom">انشاء سند صرف</h5>
            <p>
                هل انت متأكد من انشاء السند؟
            </p>
            <div class="mt-5 d-flex justify-content-between">
                <a wire:click.prevent="savehelper" class="text-white btn btn-success shadow">{{ __('موافق') }}</a>
                <a @click.prevent="modalIsOpendoctor2 = false" class="text-white btn btn-danger shadow">{{ __('الغاء') }}</a>
            </div>
        </div>
    </div>
       @else
   
       @convert($operationhold->helper)
        @endif
    </td>

    <td> 
        @if(!$operationhold->m5dr_paid && $operationhold->m5dr !=0)
       <button  @click.prevent="m5drisopen = true" class="btn btn-danger"> نوع العملية</button> 
       <div x-show="m5drisopen" class="cs-modal animate__animated animate__fadeIn">
        <div class="bg-white shadow rounded p-5" @click.away="m5drisopen = false" >
            <h5 class="pb-2 border-bottom">انشاء سند صرف</h5>
            <p>
               يرجى تحديد نوع العملية
            </p>
            <hr>
            <select wire:model="optype" class="form-control">
                <option value="">نوع العملية</option>
                <option value="{{App\Models\Setting::find(1)->m5dr_doctor}}">عملية فوق الكبرى</option>
                <option value="{{App\Models\Setting::find(1)->m5dr_large_doctor}}">عملية  الكبرى</option>
                <option value="{{App\Models\Setting::find(1)->m5dr_small_doctor}}">عملية وسطى او صغرى</option>
               
            </select>
            <div class="mt-5 d-flex justify-content-between">
                <a wire:click.prevent="savem5dr({{$optype}})" class="text-white btn btn-success shadow">{{ __('انشاء السند') }}</a>
                <a @click.prevent="m5drisopen = false" class="text-white btn btn-danger shadow">{{ __('الغاء') }}</a>
            </div>
        </div>
    </div>
       @else
   
       @convert($operationhold->m5dr)
        @endif
    </td>
    
    <td> 
        @if(!$operationhold->helperm5dr_paid && $operationhold->helperm5dr !=0)
       <button  @click.prevent="modalIsOpendoctor3 = true" class="btn btn-danger">@convert($operationhold->helperm5dr)</button> 
       <div x-show="modalIsOpendoctor3" class="cs-modal animate__animated animate__fadeIn">
        <div class="bg-white shadow rounded p-5" @click.away="modalIsOpendoctor3 = false" >
            <h5 class="pb-2 border-bottom">انشاء سند صرف</h5>
            <p>
                هل انت متأكد من انشاء السند؟
            </p>
            <div class="mt-5 d-flex justify-content-between">
                <a wire:click.prevent="savehelperm5dr" class="text-white btn btn-success shadow">{{ __('موافق') }}</a>
                <a @click.prevent="modalIsOpendoctor3 = false" class="text-white btn btn-danger shadow">{{ __('الغاء') }}</a>
            </div>
        </div>
    </div>
       @else
   
       @convert($operationhold->helperm5dr)
        @endif
    </td>

    <td> 
        @if(!$operationhold->qabla_paid && $operationhold->operation_name =="ولادة طبيعية")
       <button  @click.prevent="modalIsOpendoctor4 = true" class="btn btn-danger">@convert("25000")</button> 
       <div x-show="modalIsOpendoctor4" class="cs-modal animate__animated animate__fadeIn">
        <div class="bg-white shadow rounded p-5" @click.away="modalIsOpendoctor4 = false" >
            <h5 class="pb-2 border-bottom">انشاء سند صرف</h5>
            <p>
                هل انت متأكد من انشاء السند؟
            </p>
            <div class="mt-5 d-flex justify-content-between">
                <a wire:click.prevent="saveqabla" class="text-white btn btn-success shadow">{{ __('موافق') }}</a>
                <a @click.prevent="modalIsOpendoctor4 = false" class="text-white btn btn-danger shadow">{{ __('الغاء') }}</a>
            </div>
        </div>
    </div>
       @else
   
       @if($operationhold->operation_name =="ولادة طبيعية")
       @convert("25000")
       @else
       0
       @endif
     
        @endif
    </td>

    <td> {{ $operationhold->operation_type }} </td>    
    @if(config('easy_panel.crud.operationhold.delete') or config('easy_panel.crud.operationhold.update'))
        <td>

            @if(config('easy_panel.crud.operationhold.update'))
                <a href="@route(getRouteName().'.operationhold.update', ['operationhold' => $operationhold->id])" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(config('easy_panel.crud.operationhold.delete'))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('OperationHold') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('OperationHold') ]) }}</p>
                        <div class="mt-5 d-flex justify-content-between">
                            <a wire:click.prevent="delete" class="text-white btn btn-success shadow">{{ __('Yes, Delete it.') }}</a>
                            <a @click.prevent="modalIsOpen = false" class="text-white btn btn-danger shadow">{{ __('No, Cancel it.') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </td>
    @endif
</tr>
