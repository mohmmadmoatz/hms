<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0">
                <h3 class="card-title">الحسابات</h3>

                <div class="px-2 mt-4">

                    <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                        <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')"
                                class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">المرضى الداخلين</li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" @if(config('easy_panel.lazy_mode'))
                            wire:model.lazy="search" @else wire:model="search" @endif
                            placeholder="{{ __('Search') }}" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <a wire:target="search" wire:loading.remove><i class="fa fa-search"></i></a>
                                <a wire:loading wire:target="search"><i class="fas fa-spinner fa-spin"></i></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 card table-responsive" wire:poll.7000ms>
        <table class="table table-hover">
            <tr>
                <th>رقم المريض</th>
                <th>الأسم</th>

                <th>التوجيه</th>
                <th>المبلغ</th>
                <th></th>
            </tr>
            @php
            $setting = App\Models\Setting::first();
            @endphp
            @foreach($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>

                 @if($item->status == 1)
                <td>{{$item->stage->name ?? ""}}</td>
                <td>@convert($setting->clinic_price + $setting->doctor_price) د.ع</td>
                @endif

                @if($item->status == 3)
                <td>{{$item->stage->name ?? ""}}</td>
                <td>@convert($setting->xray + $setting->xray_doctor_price) د.ع</td>
                @endif

                @if($item->status == 4)
                <td>{{$item->stage->name ?? ""}}</td>
                <td>@convert($setting->sonar + $setting->doctor_sonar_price) د.ع</td>
                @endif

                @if($item->status == 5)
                <td>{{$item->operation->name ?? ""}}</td>
                <td>{{$item->operation->price + $setting->pat_profile}} د.ع</td>
                @endif
                        <td>

                        @if($item->status ==1)

                        <button class="btn btn-danger" wire:click="saveSands({{$item->id}},{{$setting->clinic_price}},{{$setting->doctor_price}},'اجور العيادة الاستشارية',{{$setting->doctor->id}})">
                            قبض : @convert($setting->clinic_price + $setting->doctor_price) د.ع 
                            من المريض 
                            <hr>

                            صرف : @convert($setting->doctor_price) د.ع 
                            الى {{$setting->doctor->name ?? ""}}

                        </button>

                        @elseif($item->status ==3)
                        <button class="btn btn-danger" wire:click="saveSands({{$item->id}},{{$setting->xray}},{{$setting->xray_doctor_price}},'اجور الأشعة',{{$setting->xdoctor->id}})">
                            قبض : @convert($setting->xray + $setting->xray_doctor_price) د.ع 
                            من المريض 
                            <hr>

                            صرف : @convert($setting->xray_doctor_price) د.ع 
                            الى {{$setting->xdoctor->name ?? ""}}

                        </button>
                        @elseif($item->status ==4)
                        <button class="btn btn-danger" wire:click="saveSands({{$item->id}},{{$setting->sonar}},{{$setting->doctor_sonar_price}},'اجور السونار',{{$setting->sdoctor->id}})">
                            قبض : @convert($setting->sonar + $setting->doctor_sonar_price) د.ع 
                            من المريض 
                            <hr>

                            صرف : @convert($setting->doctor_sonar_price) د.ع 
                            الى {{$setting->sdoctor->name ?? ""}}

                        </button>
                        @elseif($item->status == 5)
                        @php
                            $doctor_amount = ($item->operation->price) * ($item->hms_nsba / 100);
                            $hms_amount = ($item->operation->price) - $doctor_amount;
                            $helperdoctor = $setting->helper_doctor;
                            $m5dr_doctor = $setting->m5dr_doctor;
                            $helper_m5dr_doctor = $setting->helper_m5dr_doctor;
                            @endphp
                            @if($item->operation->name =="ولادة طبيعية")
                            <button class="btn btn-danger" wire:click ="saveOpSandWalada({{$item->operation->price + $setting->pat_profile}},{{$item->id}})">
                            قبض : @convert($item->operation->price + $setting->pat_profile) د.ع 
                            من المريض 
                            @else

                        <button class="btn btn-danger" wire:click ="saveOpSand({{$item->operation->price + $setting->pat_profile}},{{$doctor_amount}},{{$helperdoctor}},{{$m5dr_doctor}},{{$helper_m5dr_doctor}},{{$item->id}})">
                            قبض : @convert($item->operation->price + $setting->pat_profile) د.ع 
                            من المريض 
                           @endif

                           

                            <!-- صرف : @convert($doctor_amount) د.ع 
                            الى {{$item->doctor->name ?? ""}}
                            <hr>
                            صرف : @convert($helperdoctor) د.ع 
                            الى مساعد الجراح

                            <hr>
                            صرف : @convert($m5dr_doctor) د.ع 
                            الى المخدر

                            <hr>
                            صرف : @convert($helper_m5dr_doctor) د.ع 
                            الى مساعد المخدر -->

                        </button>

                        @endif

                      
                      
                     
                        

                      
                        
                        </td>


            </tr>
            @endforeach
        </table>
    </div>