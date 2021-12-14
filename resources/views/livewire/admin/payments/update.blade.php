<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('UpdateTitle', ['name' => __('Payments') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.payments.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Payments')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Update') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">

        <div class="card-body">

            <!-- Payment_type Input -->
            <div class='form-group'>
                <label for='inputpayment_type' class='col-sm-2 control-label'>نوع السند</label>
                <select wire:model.lazy='payment_type' class="form-control @error('payment_type') is-invalid @enderror" id='inputpayment_type'>
                <option value="1">صرف</option>
                <option value="2">قبض</option>
                </select>
                @error('payment_type') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class='form-group'>
                        <label for='inputamount' class='col-sm-2 control-label'>دينار</label>
                        <input type='number' wire:model.lazy='amount_iqd' class="form-control @error('amount_iqd') is-invalid @enderror" id='inputamount'>
                        @error('amount_iqd') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                        <!-- Amount Input -->
                <div class='form-group'>
                    <label for='inputamount' class='col-sm-2 control-label'>دولار</label>
                    <input type='number' wire:model.lazy='amount_usd' class="form-control @error('amount_usd') is-invalid @enderror" id='inputamount'>
                    @error('amount_usd') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                </div>
    
              
                  </div>
    
                
              </div>
            
            <!-- Description Input -->
            <div class='form-group'>
                <label for='inputdescription' class='col-sm-2 control-label'>وذالك عن</label>
                <textarea wire:model.lazy='description' class="form-control @error('description') is-invalid @enderror"></textarea>
                @error('description') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
           
            

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Update') }}</button>
            <a href="@route(getRouteName().'.payments.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
