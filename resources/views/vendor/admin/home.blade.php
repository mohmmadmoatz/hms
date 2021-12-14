@component('admin::layouts.app')
@if(Auth::user()->user_type  == "superadmin")
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
@endif
@endcomponent
