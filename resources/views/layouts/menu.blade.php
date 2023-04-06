

<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link">
        <i class="fas fa-user-alt nav-icon"></i>
        <p>
            Customers
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('customers.index') }}"
               class="nav-link {{ Request::is('customers.index*') ? 'active' : '' }}">
               <i class="fas fa-list nav-icon"></i>
                <p>All Customers</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('customers.create') }}"
            class="nav-link {{ Request::is('customers.create*') ? 'active' : '' }}">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add New Customer</p>
            </a>
        </li>

        <li class="nav-header">                
            Reports
        </li>
        
        <li class="nav-item">
            <a href="{{ route('billings.all-unpaid-bills') }}"
            class="nav-link {{ Request::is('billings.all-unpaid-bills*') ? 'active' : '' }}">
                <i class="fas fa-info-circle nav-icon"></i>
                <p>All Unpaid Bills</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="fas fa-shield-alt nav-icon"></i>
        <p>
            Administrative
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('users.index') }}"
               class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
               <i class="fas fa-user nav-icon"></i>
                <p>Registered Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('towns.index') }}"
               class="nav-link {{ Request::is('towns*') ? 'active' : '' }}">
               <i class="fas fa-map-marker-alt nav-icon"></i>
                <p>Towns</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('barangays.index') }}"
               class="nav-link {{ Request::is('barangays*') ? 'active' : '' }}">
               <i class="fas fa-map-marker-alt nav-icon"></i>
                <p>Barangays</p>
            </a>
        </li>
    </ul>
</li>