@php
    $route = Route::current();
    $routeName = $route->getName();
@endphp
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ $routeName == 'home' ? 'active' : 'collapsed' }} " href="{{ route('home') }}">
                <i class="bi bi-grid"></i> <span>{{ __('Dashboard') }}</span>
            </a>
        </li>

        {{-- //////////////////////////////////// --}}
       
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>{{ __('Packages') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link {{ $routeName == 'products.create' ? 'active' : '' }} "
                        href="{{ route('products.create') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Add Package') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $routeName == 'products.index' ? 'active' : '' }} "
                        href="{{ route('products.index') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Package List') }}</span>
                    </a>
                </li>
                {{-- <li> <a href="forms-layouts.html"> <i class="bi bi-circle"></i><span>Form Layouts</span> </a></li>
                <li> <a href="forms-editors.html"> <i class="bi bi-circle"></i><span>Form Editors</span> </a></li>
                <li> <a href="forms-validation.html"> <i class="bi bi-circle"></i><span>Form Validation</span>
                    </a></li> --}}
            </ul>
        </li>
       
        @can('Staff access')
                   
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-staff" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>{{ __('Staff') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-staff" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link {{ $routeName == 'staff.create' ? 'active' : '' }} "
                        href="{{ route('staff.create') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Add Staff') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $routeName == 'staff.index' ? 'active' : '' }} "
                        href="{{ route('staff.index') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Staff List') }}</span>
                    </a>
                </li>
                
            </ul>
        </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#transaction" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>{{ __('Transaction') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="transaction" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @can('Staff access')
                <li>
                    <a class="nav-link {{ $routeName == 'transaction.view_deposit' ? 'active' : '' }} "
                        href="{{ route('transaction.view_deposit') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Deposit') }}</span>
                    </a>
                </li>
                @endcan
                <li>
                    <a class="nav-link {{ $routeName == 'transaction.view_history' ? 'active' : '' }} "
                        href="{{ route('transaction.view_history') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Transaction History') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $routeName == 'transaction.report' ? 'active' : '' }} "
                        href="{{ route('transaction.report') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Reports') }}</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Received_package_list" data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-journal-text"></i><span>{{ __('Received Packages') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Received_package_list" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link {{ $routeName == 'received_package.list' ? 'active' : '' }} "
                        href="{{ route('received_package.list') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Received Package List') }}</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ $routeName == 'delivered_package.list' ? 'active' : '' }} "
                        href="{{ route('delivered_package.list') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Delivered Package List') }}</span>
                    </a>
                </li>

            </ul>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Delivered_package_list" data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-journal-text"></i><span>{{ __('Delivered Packages') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Delivered_package_list" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link {{ $routeName == 'transaction.view_deposit' ? 'active' : '' }} "
                        href="{{ route('delivered_package.list') }}">
                        <i class="bi bi-grid"></i> <span>{{ __('Delivered Package List') }}</span>
                    </a>
                </li>

            </ul>
        </li> --}}
        {{-- <li class="nav-heading">Pages</li>
        <li class="nav-item"> <a class="nav-link collapsed" href="pages-blank.html"> <i class="bi bi-file-earmark"></i>
                <span>Blank</span> </a></li> --}}
    </ul>
</aside>