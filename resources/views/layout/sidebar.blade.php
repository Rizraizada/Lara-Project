<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color" style="background-color: #004080;">
<div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="{{ route('home') }}">
            <img src="{{ URL::asset('/image/bdu_logo.jpg') }}"  class="img-fluid" alt="BDU logo" height="30" width="130">
             
               
            </a>
        </div>
    </div>

    @if (auth()->user()->role==3)    
    <div class="sidebar-menu-content">
        <ul class="nav nav-sidebar-menu sidebar-toggle-view">
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                                <a href="{{ route('item.entry') }}" class="nav-link"><i
                                        class="flaticon-open-book"></i><span>Vehicle List</span></a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ route('road.entry') }}" class="nav-link" ><i
                                        class="flaticon-chat"></i><span> Route Setup</span></a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ route('vehicledriver.entry') }}" class="nav-link" ><i
                                        class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Vehicle Dirver Setup</span></a>
                        </li>


                        <li class="nav-item">
                                <a href="{{ route('vehicleroutetime.entry') }}" class="nav-link" ><i
                                        class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Vehicle Route & Time Setup</span></a>
                        </li>

                        <li class="nav-item">
                                <a href="{{route('vehicleroutemap.entry')}}" class="nav-link"><i
                                        class="flaticon-chat"></i><span>Vehicle Route Register</span></a>
            </li>
            <li class="nav-item">
                                <a href="{{ route('fuelgas.entry') }}" class="nav-link"><i
                                        class="flaticon-open-book"></i><span>Fuel/Gas Regiter</span></a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ route('report.show') }}" class="nav-link"><i
                                        class="flaticon-open-book"></i><span>Report</span></a>
                        </li>
        </ul>

        <br><br><br><br><br><br><br>
    </div>
    @elseif(auth()->user()->role==1)
    <div class="sidebar-menu-content">
    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
         
         

                        <li class="nav-item">
                                <a href="{{route('vehicleroutemap.entry')}}" class="nav-link"><i
                                        class="flaticon-chat"></i><span>Vehicle Route Register</span></a>
                         </li>
           
        </ul>

       
    </div>
    @elseif(auth()->user()->role==2)
    <div class="sidebar-menu-content">
    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
         
         

                        <li class="nav-item">
                                <a href="{{ route('fuelgas.entry') }}" class="nav-link"><i
                                        class="flaticon-open-book"></i><span>Fuel/Gas Regiter</span></a>
                        </li>
           
        </ul>

        
    </div>
    @else
    @endif
</div>