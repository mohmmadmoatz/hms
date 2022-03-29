<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0">
                <h3 class="card-title">ملاحظات الممرضة والعلاج</h3>

                <div class="px-2 mt-4">

                    <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                        <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">ملاحظات الممرضة والعلاج</li>
                    </ul>

                    <div class="row justify-content-between mt-4 mb-4">
                        @if(config('easy_panel.crud.followup.create'))
                        <div class="col-md-4 right-0">
                            <a href="@route(getRouteName().'.followup.create')" class="btn btn-success">اضافة ملاحظة</a>
                        </div>
                        @endif
                        @if(config('easy_panel.crud.followup.search'))
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
                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-6" wire:ignore>
             
                            <select wire:model.lazy="patient_id" class="form-control selectpicker"
                                data-live-search="true">
                                <option value="">فلترة حسب المريض</option>
                                @foreach(App\Models\Patient::latest()->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td style='cursor: pointer' wire:click="sort('bp')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'bp') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'bp') fa-sort-amount-up ml-2 @endif'></i> {{ __('Bp') }} </td>
                        <td style='cursor: pointer' wire:click="sort('pr')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'pr') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'pr') fa-sort-amount-up ml-2 @endif'></i> {{ __('Pr') }} </td>
                        <td style='cursor: pointer' wire:click="sort('drain')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'drain') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'drain') fa-sort-amount-up ml-2 @endif'></i> {{ __('Drain') }} </td>
                        <td style='cursor: pointer' wire:click="sort('itake')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'itake') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'itake') fa-sort-amount-up ml-2 @endif'></i> {{ __('Itake') }} </td>
                        <td style='cursor: pointer' wire:click="sort('spo2')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'spo2') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'spo2') fa-sort-amount-up ml-2 @endif'></i> {{ __('Spo2') }} </td>
                        <td style='cursor: pointer' wire:click="sort('Temp')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'Temp') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'Temp') fa-sort-amount-up ml-2 @endif'></i> {{ __('Temp') }} </td>
                        <td style='cursor: pointer' wire:click="sort('treatment')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'treatment') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'treatment') fa-sort-amount-up ml-2 @endif'></i> {{ __('Treatment') }} </td>
                        <td style='cursor: pointer' wire:click="sort('date')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'date') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'date') fa-sort-amount-up ml-2 @endif'></i> {{ __('Date') }} </td>
                        <td> {{ __('User Name') }} </td>
                        <td> {{ __('المريض') }} </td>
                        
                        @if(config('easy_panel.crud.followup.delete') or config('easy_panel.crud.followup.update'))
                        <td>{{ __('Action') }}</td>
                        @endif
                    </tr>

                    @foreach($followups as $followup)
                        @livewire('admin.followup.single', ['followup' => $followup], key($followup->id))
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="m-auto pt-3 pr-3">
                {{ $followups->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</div>
