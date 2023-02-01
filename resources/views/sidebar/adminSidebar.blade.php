
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu">
                    <a href="#" class="">
                        <i class="la la-user"></i>
                        <span> Employee</span> <span class="menu-arrow"></span>
                    </a>
                    <ul >
                        <li><a href="{{route('emp.index')}}">Employee List</a></li>
                        <li><a href="{{route('attendance.history')}}">Attendance List</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#" class="">
                        <i class="la la-user"></i>
                        <span> Customer</span> <span class="menu-arrow"></span>
                    </a>
                    <ul >
                        <li><a href="{{route('customer.index')}}">Customer List</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#" class="">
                        <i class="la la-list"></i>
                        <span> Tasks Management</span> <span class="menu-arrow"></span>
                    </a>
                    <ul >
                        <li><a href="{{route('task.index')}}">Task List</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#" class="">
                        <i class="la la-user"></i>
                        <span> Reports</span> <span class="menu-arrow"></span>
                    </a>
                    <ul >
                        <li><a href="{{route('report.attendance')}}">Attendance Report</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->