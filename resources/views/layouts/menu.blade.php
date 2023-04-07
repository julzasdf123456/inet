{{-- CUSTOMERS --}}
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
            <a href="{{ route('paymentTransactions.monthly-sales') }}"
            class="nav-link {{ Request::is('paymentTransactions.monthly-sales*') ? 'active' : '' }}">
                <i class="fas fa-comments-dollar nav-icon"></i>
                <p>Monthly Sales</p>
            </a>
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

{{-- EXPENSES --}}
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="fas fa-file-invoice-dollar nav-icon"></i>
        <p>
            Accounting
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('expenses.my-expenses') }}"
               class="nav-link {{ Request::is('expenses.my-expenses*') ? 'active' : '' }}">
               <i class="fas fa-hand-holding-usd nav-icon"></i>
                <p>My Expenses</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('expenses.index') }}"
               class="nav-link {{ Request::is('expenses.index*') ? 'active' : '' }}">
               <i class="fas fa-list nav-icon"></i>
                <p>All Expenses</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('expenses.balance-sheet') }}"
               class="nav-link {{ Request::is('expenses.balance-sheet*') ? 'active' : '' }}">
               <i class="fas fa-file-invoice nav-icon"></i>
                <p>Balance Sheet</p>
            </a>
        </li>
    </ul>
</li>

{{-- ADMINISTRATIVE --}}
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


