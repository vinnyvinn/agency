<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                @can('manage-leads')
                    <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/leads') }}" aria-expanded="false">
                            <i class="mdi mdi-gauge"></i><span class="hide-menu">Leads</span></a>
                    </li>
                @endcan
                @can('manage-customers')
                    <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/customers') }}" aria-expanded="false">
                            <i class="mdi mdi-gauge"></i><span class="hide-menu">Customers</span></a>
                    </li>
                @endcan
                @can('manage-tariffs')
                    <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/tariffs') }}" aria-expanded="false">
                            <i class="mdi mdi-gauge"></i><span class="hide-menu">Tariffs</span></a>
                    </li>
                @endcan
                @can('admin')
                    <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/other-services') }}" aria-expanded="false">
                            <i class="mdi mdi-gauge"></i><span class="hide-menu">Extra Services</span></a>
                    </li>
                @endcan
                @can('manage-pdas')
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-account"></i><span class="hide-menu">PDAs</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/all-pdas') }}">All PDAs</a></li>
                            <li><a href="{{ url('/my-pdas') }}">My PDAs</a></li>
                            {{--<li><a href="">Transport</a></li>--}}
                            {{--<li><a href="">Logistics</a></li>--}}
                        </ul>
                    </li>
                @endcan
                @can('manage-fdas')
                    <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/dms') }}" aria-expanded="false">
                            <i class="mdi mdi-gauge"></i><span class="hide-menu">Jobs</span></a>
                    </li>
                @endcan
                {{--@can('manage-fdas')--}}
                    {{--<li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/dms') }}" aria-expanded="false">--}}
                            {{--<i class="mdi mdi-gauge"></i><span class="hide-menu">Vessels</span></a>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--<li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/reports') }}" aria-expanded="false">--}}
                        {{--<i class="mdi mdi-gauge"></i><span class="hide-menu">Reports</span></a>--}}
                {{--</li>--}}

                @can('manager')
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-account"></i><span class="hide-menu">Agency Manager</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/agency') }}">Dashboard</a></li>
                            {{--<li><a href="">Transport</a></li>--}}
                            {{--<li><a href="">Logistics</a></li>--}}
                        </ul>
                    </li>
                    @endcan
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-package-down"></i><span>Reports</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/reports/create') }}">Jobs</a></li>
                        <li><a href="{{ url('/pdas-report') }}">Pdas</a></li>
                        <li><a href="{{ url('/pos-report') }}">Pos</a></li>
                        <li><a href="{{ url('/leads-report') }}">Leads</a></li>

                    </ul>
                </li>
                {{--<li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/report-error') }}" aria-expanded="false">--}}
                        {{--<i class="mdi mdi-gauge"></i><span class="hide-menu">Report Error</span></a>--}}
                {{--</li>--}}
            </ul>
        </nav>
    </div>
</aside>
