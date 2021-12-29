
@if(Auth::user()->user_type  == "superadmin" || Auth::user()->user_type  == "info")
<div>
<div class="card-group">
 <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">@convert(App\Models\Patient::count())</h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">المرضى</h6>
                                </div>
                                <div class="mr-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class ="fa fa-users fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">@convert(App\Models\User::count())</h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">المستخدمين</h6>
                                </div>
                                <div class="mr-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class ="fa fa-users fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">@convert(App\Models\WarehouseItem::count())</h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">مواد مخزن</h6>
                                </div>
                                <div class="mr-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class ="fa fa-box fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">@convert(App\Models\Payments::count())</h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">السندات المالية</h6>
                                </div>
                                <div class="mr-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class ="fa fa-dollar-sign fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

</div>


<div class="row">
<div class="col-md-12">
                            <div class="input-group">
                                <select class="form-control" wire:model.lazy="floorid">
                                    <option value="">اختيار الطابق</option>
                                    <option value="2">الطابق الثاني</option>
                                    <option value="3">الطابق الثالث</option>
                                </select>
                            </div>
                        </div>
                        
</div>

<div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td style='cursor: pointer' wire:click="sort('name')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'name') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'name') fa-sort-amount-up ml-2 @endif'></i> {{ __('Name') }} </td>
                        <td> {{ __('المريض') }} </td>
                        <td> {{ __('Floor') }} </td>
                        <td style='cursor: pointer' wire:click="sort('notes')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'notes') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'notes') fa-sort-amount-up ml-2 @endif'></i> {{ __('Notes') }} </td>
                        
                        @if(config('easy_panel.crud.room.delete') or config('easy_panel.crud.room.update'))
                        <td>{{ __('Action') }}</td>
                        @endif
                    </tr>

                    @foreach($rooms as $room)
                        @livewire('admin.room.single', ['room' => $room], key($room->id))
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="m-auto pt-3 pr-3">
                {{ $rooms->appends(request()->query())->links() }}
            </div>

@endif

</div>