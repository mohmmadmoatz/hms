<li class="list-divider"></li>
<li class="nav-small-cap"><span class="hide-menu">قائمة النظام</span></li>
<li class="sidebar-item @isActive(getRouteName().'.home', 'selected')">
    <a class="sidebar-link @isActive(getRouteName().'.home', 'active') " href="@route(getRouteName().'.home')" aria-expanded="false">
        <i data-feather="home" class="feather-icon"></i>
        <span class="hide-menu">{{ __('Home') }}</span>
    </a>
</li> 
@if(Auth::user()->user_type  == "superadmin")
<li class='sidebar-item'>

    

    <a class='sidebar-link has-arrow' href="javascript:void(0)" aria-expanded="false">
        <i data-feather="{{ get_icon('settings') }}" class="feather-icon"></i>
        <span class="hide-menu">تهيئة النظام</span>
    </a>

    <ul aria-expanded="false" class="collapse first-level base-level-line">
        <li class="sidebar-item @isActive(getRouteName().'.'.'room'.'.read')">
            <a href="@route(getRouteName().'.room.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'room'.'.read')">
                <span class="hide-menu"> الغرف </span>
            </a>
        </li>
        <li class="sidebar-item @isActive(getRouteName().'.'.'clinic'.'.read')">
            <a href="@route(getRouteName().'.clinic.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'clinic'.'.read')">
                <span class="hide-menu"> العيادات </span>
            </a>
        </li>

        <li class="sidebar-item @isActive(getRouteName().'.'.'operation'.'.read')">
            <a href="@route(getRouteName().'.operation.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'operation'.'.read')">
                <span class="hide-menu"> العمليات </span>
            </a>
        </li>

        <li class="sidebar-item @isActive(getRouteName().'.'.'setting'.'.read')">
            <a href="@route(getRouteName().'.setting.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'setting'.'.read')">
                <span class="hide-menu"> الأسعار </span>
            </a>
        </li>

        <li class="sidebar-item @isActive(getRouteName().'.'.'user'.'.read')">
            <a href="@route(getRouteName().'.user.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'user'.'.read')">
                <span class="hide-menu"> المستخدمين </span>
            </a>
        </li>
        
    </ul>





</li>
@endif

@if(Auth::user()->user_type  == "superadmin" || Auth::user()->user_type  == "accountant")
<li class="list-divider"></li>
<li class="nav-small-cap"><span class="hide-menu">المحاسبة</span></li>


<li class='sidebar-item'>
<li
    class='sidebar-item @isActive([getRouteName().".payments.converted", getRouteName().".payments.converted", getRouteName().".payments.converted"], "selected")'>
    <a class='sidebar-link @isActive([getRouteName().".payments.converted", getRouteName().".payments.converted", getRouteName().".payments.converted"], "active") '
        href="@route(getRouteName().'.payments.converted')" aria-expanded="false">
        <i data-feather="{{ get_icon("user") }}" class="feather-icon"></i>
        <span class="hide-menu">المرضى الداخلين</span>
    </a>
</li>
<li
    class='sidebar-item @isActive([getRouteName().".payments.patstatement", getRouteName().".payments.patstatement", getRouteName().".payments.patstatement"], "selected")'>
    <a class='sidebar-link @isActive([getRouteName().".payments.patstatement", getRouteName().".payments.patstatement", getRouteName().".payments.patstatement"], "active") '
        href="@route(getRouteName().'.payments.patstatement')" aria-expanded="false">
        <i data-feather="{{ get_icon("file") }}" class="feather-icon"></i>
        <span class="hide-menu">كشف حساب المرضى</span>
    </a>
</li>
<li
    class='sidebar-item @isActive([getRouteName().".payments.read", getRouteName().".payments.create", getRouteName().".payments.update"], "selected")'>
    <a class='sidebar-link @isActive([getRouteName().".payments.read", getRouteName().".payments.create", getRouteName().".payments.update"], "active") '
        href="@route(getRouteName().'.payments.read')" aria-expanded="false">
        <i data-feather="{{ get_icon("money") }}" class="feather-icon"></i>
        <span class="hide-menu">السندات المالية</span>
    </a>
</li>

<li
    class='sidebar-item @isActive([getRouteName().".statement.home"], "selected")'>
    <a class='sidebar-link @isActive([getRouteName().".statement.home"], "active") '
        href="@route(getRouteName().'.statement.home')" aria-expanded="false">
        <i data-feather="{{ get_icon("money") }}" class="feather-icon"></i>
        <span class="hide-menu">الكشوفات</span>
    </a>
</li>

<!-- <li
    class='sidebar-item @isActive([getRouteName().".attendance.logs"], "selected")'>
    <a class='sidebar-link @isActive([getRouteName().".attendance.logs"], "active") '
        href="@route(getRouteName().'.attendance.logs')" aria-expanded="false">
        <i data-feather="{{ get_icon("login") }}" class="feather-icon"></i>
        <span class="hide-menu">الحظور والأنصراف</span>
    </a>
</li> -->

</li>
@endif

<li class="list-divider"></li>
<li class="nav-small-cap"><span class="hide-menu">القائمة العامة</span></li>

@if(Auth::user()->user_type  == "info" || Auth::user()->user_type  == "accountant" ||  Auth::user()->user_type  == "superadmin" )
<li
    class='sidebar-item @isActive([getRouteName().".patient.read", getRouteName().".patient.create", getRouteName().".patient.update"], "selected")'>
    <a class='sidebar-link @isActive([getRouteName().".patient.read", getRouteName().".patient.create", getRouteName().".patient.update"], "active") '
        href="@route(getRouteName().'.patient.read')" aria-expanded="false">
        <i data-feather="{{ get_icon("users") }}" class="feather-icon"></i>
        <span class="hide-menu">المرضى</span>
    </a>
</li>
@endif


@if(Auth::user()->user_type  == "doctor" ||  Auth::user()->user_type  == "superadmin" )

<li class='sidebar-item'>

    

    <a class='sidebar-link has-arrow' href="javascript:void(0)" aria-expanded="false">
        <i  class="fa fa-stethoscope"></i>
        <span class="hide-menu"> العيادة الأستشارية</span>
    </a>

    <ul aria-expanded="false" class="collapse first-level base-level-line">
      
        <li class="sidebar-item @isActive(getRouteName().'.'.'checkup'.'.converted')">
            <a href="@route(getRouteName().'.checkup.converted')"
                class="sidebar-link @isActive(getRouteName().'.'.'checkup'.'.converted')">
                <span class="hide-menu"> المرضى الداخلين </span>
            </a>
        </li>

        <li class="sidebar-item @isActive(getRouteName().'.'.'checkup'.'.read')">
            <a href="@route(getRouteName().'.checkup.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'checkup'.'.read')">
                <span class="hide-menu"> الملفات السابقة </span>
            </a>
        </li>

       
        
    </ul>





</li>
@endif

@if(Auth::user()->user_type  == "sonar" ||  Auth::user()->user_type  == "superadmin" )
<li class='sidebar-item'>

    

    <a class='sidebar-link has-arrow' href="javascript:void(0)" aria-expanded="false">
        <i  class="fa fa-stethoscope"></i>
        <span class="hide-menu">قسم السونار</span>
    </a>

    <ul aria-expanded="false" class="collapse first-level base-level-line">
        <li class="sidebar-item @isActive(getRouteName().'.'.'sonar'.'.converted')">
            <a href="@route(getRouteName().'.sonar.converted')"
                class="sidebar-link @isActive(getRouteName().'.'.'sonar'.'.converted')">
                <span class="hide-menu"> المرضى الداخلين </span>
            </a>
        </li>
        <li class="sidebar-item @isActive(getRouteName().'.'.'sonar'.'.read')">
            <a href="@route(getRouteName().'.sonar.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'sonar'.'.read')">
                <span class="hide-menu"> الملفات السابقة </span>
            </a>
        </li>

       
        
    </ul>





</li>

@endif

@if(Auth::user()->user_type  == "rays" ||  Auth::user()->user_type  == "superadmin" )
<li class='sidebar-item'>

    

    <a class='sidebar-link has-arrow' href="javascript:void(0)" aria-expanded="false">
        <i  class="fa fa-x-ray"></i>
        <span class="hide-menu">قسم الأشعة</span>
    </a>

    <ul aria-expanded="false" class="collapse first-level base-level-line">
        <li class="sidebar-item @isActive(getRouteName().'.'.'rays'.'.converted')">
            <a href="@route(getRouteName().'.rays.converted')"
                class="sidebar-link @isActive(getRouteName().'.'.'rays'.'.converted')">
                <span class="hide-menu"> المرضى الداخلين </span>
            </a>
        </li>
        <li class="sidebar-item @isActive(getRouteName().'.'.'rays'.'.read')">
            <a href="@route(getRouteName().'.rays.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'rays'.'.read')">
                <span class="hide-menu"> الملفات السابقة </span>
            </a>
        </li>

       
        
    </ul>





</li>
@endif

@if(Auth::user()->user_type  == "accountant" ||  Auth::user()->user_type  == "stockmanagment" ||  Auth::user()->user_type  == "superadmin" )
<li class='sidebar-item'>

    

    <a class='sidebar-link has-arrow' href="javascript:void(0)" aria-expanded="false">
        <i  class="fa fa-box"></i>
        <span class="hide-menu">المخزن</span>
    </a>

    <ul aria-expanded="false" class="collapse first-level base-level-line">
        <li class="sidebar-item @isActive(getRouteName().'.'.'warehouse'.'.read')">
            <a href="@route(getRouteName().'.warehouse.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'warehouse'.'.read')">
                <span class="hide-menu"> القوائم </span>
            </a>
        </li>
        <li class="sidebar-item @isActive(getRouteName().'.'.'warehouseitem'.'.read')">
            <a href="@route(getRouteName().'.warehouseitem.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'warehouseitem'.'.read')">
                <span class="hide-menu"> المواد </span>
            </a>
        </li>
        <li class="sidebar-item @isActive(getRouteName().'.'.'warehouseexport'.'.read')">
            <a href="@route(getRouteName().'.warehouseexport.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'warehouseexport'.'.read')">
                <span class="hide-menu"> الطلبات </span>
            </a>
        </li>

       
        
    </ul>





</li>

@endif