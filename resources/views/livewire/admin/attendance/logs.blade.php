<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0">
                <h3 class="card-title">الحظور والأنصراف</h3>

                <div class="px-2 mt-4">

                    <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                        <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">الحظور والأنصراف</li>
                    </ul>

                  
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td>اسم الموظف</td>
                        <td>طريقة التسجيل</td>
                        <td>نوع العملية</td>
                        <td>الوقت والتاريخ</td>
                        
                        
                        <td></td>
                    </tr>

                   
                    </tbody>
                </table>
            </div>

            <div class="m-auto pt-3 pr-3">
                {{ $data->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</div>
