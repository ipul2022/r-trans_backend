<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">R-TRANS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">R</a>
        </div>
        <ul class="sidebar-menu">

            <li>
                <a href="{{ url('home') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>

            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-alt"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('user.index') }}">User List</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-list-alt"></i><span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('order.index') }}">New Order List</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('receipt.index') }}">Receipt Order</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('listOrder.index') }}">List Order</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('listPickup.index') }}">List Receipt</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown">
                    {{-- <i class="fas fa-list-alt"></i> --}}
                    <i class="fa-solid fa-person-biking"></i>
                    <span>Driver</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('driver.index') }}">Driver List</a>
                    </li>

                </ul>
            </li>

    </aside>
</div>
