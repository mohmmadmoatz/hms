<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">طلب جديد</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')"
                        class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.warehouseexport.read')"
                        class="text-decoration-none">طلبات المخزن</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <!-- Name Input -->
                    <div class='form-group'>
                        <label for='inputname' class='col-sm-2 control-label'> {{ __('القسم') }}</label>
                        <input type='text' wire:model.lazy='name'
                            class="form-control @error('name') is-invalid @enderror" id='inputname'>
                        @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                    </div>
                </div>
           

                <div class="col-md-6">
                     <!-- Date Input -->
            <div class='form-group'>
                <label for='inputdate' class='col-sm-2 control-label'> {{ __('Date') }}</label>
                <input type='date' wire:model.lazy='date' class="form-control @error('date') is-invalid @enderror"
                    id='inputdate'>
                @error('date') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
                </div>
           
                <div class="col-md-12">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>اسم المادة</th>
                                <th>السعر</th>
                                <th>العدد</th>
                                <th>العدد الحالي</th>
                                <th>الأجمالي</th>
                                <th></th>
                            </tr>
        
                        </thead>
                        <tbody>
                            <tr>
                                <td wire:ignore>
                                    <select class="form-control selectpicker" wire:model.lazy="item" data-live-search="true" wire:change="selectitem">
                                        <option value="">يرجى اختيار المادة</option>
                                         @foreach(App\Models\WarehouseItem::get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                         @endforeach
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" wire:model="amount"></td>
                                <td><input type="number" class="form-control" wire:model="qty"></td>
                                <td>{{$qtynow}}</td>
                                <td><input readonly type="number" class="form-control" wire:model="total"></td>
                                <td>
                                    <a href="#addPlus" wire:click="addItem()" class="btn btn-info"><i class="fa fa-plus"></i></a>
                                </td>
                            </tr>
                            @foreach($items as $item)
                            <tr>
        
                            
                            <td>{{$item['productname']}}</td>
                            <td>@convert($item['amount'])</td>
                            <td>{{$item['qty']}}</td>
                            <td></td>
                            <td>@convert($item['total'])</td>
                            <td>
                                <a href="#delete" class="btn btn-danger" wire:click="deleteItem({{$loop->index}})"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="col-md-6">
                    <!-- Total Input -->
            <div class='form-group'>
                <label for='inputtotal' class='col-sm-2 control-label'> {{ __('الأجمالي') }}</label>
                <input readonly type='text' wire:model.lazy='totalmenu'
                    class="form-control @error('total') is-invalid @enderror" id='inputtotal'>
                @error('total') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
                </div>


        </div>
        </div>




        

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.warehouseexport.read')"
                class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>