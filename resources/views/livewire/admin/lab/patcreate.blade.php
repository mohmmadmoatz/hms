<div class="card" x-data="{status:@entangle('status').defer}">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Patient') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{
                        __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.lab.pat')"
                        class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Patient')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">



        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <!-- Name Input -->
                    <div class='form-group'>
                        <label for='inputname' class='control-label'> {{ __('Name') }}</label>
                        <input type='text' wire:model.lazy='name'
                            class="form-control @error('name') is-invalid @enderror" id='inputname'>
                        @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Gender Input -->
                    <div class='form-group'>
                        <label for='inputgender' class='control-label'> {{ __('Gender') }}</label>

                        <select wire:model="gender" class="form-control">
                            <option value=""></option>

                            <option>ذكر</option>
                            <option>انثى</option>

                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Phone Input -->
                    <div class='form-group'>
                        <label for='inputphone' class='control-label'> {{ __('Phone') }}</label>
                        <input type='text' wire:model.lazy='phone'
                            class="form-control @error('phone') is-invalid @enderror" id='inputphone'>
                        @error('phone') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">

                    <div class='form-group'>
                        <label for='inputphone' class='control-label'> {{ __('العمر') }}</label>
                        <input type='number' wire:model.lazy='age' 
                            class="form-control @error('phone') is-invalid @enderror" id='inputphone'>
                        @error('age') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <h4>الفحوصات المطلوبة</h4>
                </div>

                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم الفحص</th>
                            <th>السعر</th>
                            <th></th>
                        </tr>
                        <tr>
                        
                                <td wire:ignore>
                                    <select wire:change="selectitem" class="form-control selectpicker" wire:model.lazy="item" data-live-search="true" wire:change="selectitem">
                                        <option value="">يرجى اختيار الفحص</option>
                                         @foreach(App\Models\LabSetting::get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                         @endforeach
                                    </select>
                                </td>
                            <td>
                                <input type="text" class="form-control" wire:model.lazy="amount">
                            </td>
                            <td>
                                <button wire:click.prevent="addItem" class="btn btn-info"><i class="fa fa-plus"></i></button>
                            </td>
                        </tr>
                        @foreach($items as $data)
                        <tr>
                            <td>
                                {{$data['name']}}
                            </td>
                            <td>
                                {{$data['amount']}}
                            </td>
                            <td>
                                <button class="btn btn-danger" wire:click.prevent="deleteitem({{$loop->index}})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                      
                        @endforeach
                    </table>
                </div>

                <div class="col-md-12">
                    <label for="">الأجمالي</label>
                    <input type="text" class="form-control" readonly value="@convert($totalamount)">
                </div>
               
            </div>


        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.lab.pat')" class="btn btn-default float-left">{{ __('Cancel')
                }}</a>
        </div>
    </form>
</div>


