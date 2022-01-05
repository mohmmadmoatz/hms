

<div>

@if(Auth::user()->user_type  == "superadmin" || Auth::user()->user_type  == "info" || Auth::user()->user_type  == "accountant")
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

@if(Auth::user()->user_type  == "accountant")
<div align="center">
    <img src="{{asset('formimages/hmslogo.png')}}" width="50%">

</div>
@endif

@if(Auth::user()->user_type  == "superadmin" || Auth::user()->user_type  == "info")
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

<div class="card-body ">
              

                    <div class="row">
                    @foreach($rooms as $room)
                    <div class="col-md-2  py-2" x-data="{'open':false}">
                        <button @click="open=!open" class="btn @if($room->user->name ?? '') btn-info @else btn-secondary @endif btn-block">
                            {{$room->name}}
                            <hr>
                            الطابق : {{$room->floor}}
                     
                            @if($room->user->name ??"")  
                            <hr x-show="open">  
      <a x-show="open" class="btn btn-info" href="@route(getRouteName().'.patient.update', ['patient' => $room->user->id])" target="_blank" rel="noopener noreferrer">{{$room->user->name}}</a>
      @endif

                        </button>
                    </div>
                    @endforeach
                    </div>
                   
                
            </div>
            
@endif
@endif



</div>