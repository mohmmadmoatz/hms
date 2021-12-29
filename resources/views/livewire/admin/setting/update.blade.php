<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">الأسعار</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.setting.read')" class="text-decoration-none">الأسعار</a></li>
                <li class="breadcrumb-item active">{{ __('Update') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">

        <div class="card-body">

            <div class="row">

          
                <div class="col-md-4">
            <!-- Xray Input -->
        <div class='form-group'>
                <label for='inputxray' class=' control-label'>الأشعة</label>
                <input type='number' wire:model.lazy='xray' class="form-control @error('xray') is-invalid @enderror" id='inputxray'>
                @error('xray') <div class='invalid-feedback'>{{ $message }}</div> @enderror
         </div>
                </div>

                <div class="col-md-4">
                    <!-- Sonar Input -->
                    <div class='form-group'>
                        <label for='inputsonar' class=' control-label'>اجرة الطبيب من الأشعة</label>
                        <input type='number' wire:model.lazy='xray_doctor_price' class="form-control @error('xray_doctor_price') is-invalid @enderror" id='inputsonar'>
                        @error('doctor_sonar_price') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                    </div>
                </div>
        
                <div class="col-md-4" wire:ignore>
                    <div class='form-group'>
                        <label for='inputdoctor_id' class=' control-label'>طبيب الأشعة</label>
                        
                        <select class="form-control selectpicker" data-live-search="true" wire:model="xray_doctor_id">
                            <option value="">يرجى اختيار طبيب</option>
                            @foreach(App\Models\User::where('user_type','doctor')->get() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
        
                            @endforeach
                        </select>
                        
                    </div>
                </div>


            <div class="col-md-4">
            <!-- Sonar Input -->
            <div class='form-group'>
                <label for='inputsonar' class=' control-label'>السونار</label>
                <input type='number' wire:model.lazy='sonar' class="form-control @error('sonar') is-invalid @enderror" id='inputsonar'>
                @error('sonar') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="col-md-4">
            <!-- Sonar Input -->
            <div class='form-group'>
                <label for='inputsonar' class=' control-label'>اجرة الطبيب من السونار</label>
                <input type='number' wire:model.lazy='doctor_sonar_price' class="form-control @error('doctor_sonar_price') is-invalid @enderror" id='inputsonar'>
                @error('doctor_sonar_price') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="col-md-4" wire:ignore>
            <div class='form-group'>
                <label for='inputdoctor_id' class=' control-label'>طبيب السونار</label>
                
                <select class="form-control selectpicker" data-live-search="true" wire:model="doctor_sonar_id">
                    <option value="">يرجى اختيار طبيب</option>
                    @foreach(App\Models\User::where('user_type','doctor')->get() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>

                    @endforeach
                </select>
                
            </div>
        </div>
            
            <!-- Clinic_price Input -->
            <div class="col-md-4">
            <div class='form-group'>
                <label for='inputclinic_price' class=' control-label'>المستشفى من العيادة الأستشارية</label>
                <input type='number' wire:model.lazy='clinic_price' class="form-control @error('clinic_price') is-invalid @enderror" id='inputclinic_price'>
                @error('clinic_price') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            </div>

            <div class="col-md-4">
            <!-- Doctor_price Input -->
            <div class='form-group'>
                <label for='inputdoctor_price' class=' control-label'>الطبيب من العيادة الأستشارية</label>
                <input type='number' wire:model.lazy='doctor_price' class="form-control @error('doctor_price') is-invalid @enderror" id='inputdoctor_price'>
                @error('doctor_price') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            </div>
            
            <!-- Doctor_id Input -->
            <div class="col-md-4" wire:ignore>
                <div class='form-group'>
                    <label for='inputdoctor_id' class=' control-label'>طبيب العيادة الأستشارية</label>
                    
                    <select class="form-control selectpicker" data-live-search="true" wire:model="doctor_id">
                        <option value="">يرجى اختيار طبيب</option>
                        @foreach(App\Models\User::where('user_type','doctor')->get() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>

                        @endforeach
                    </select>
                    
                </div>
            </div>
         
            
        </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Update') }}</button>
            <a href="@route(getRouteName().'.setting.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
