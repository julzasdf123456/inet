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

        <li class="nav-header">Others</li>
        <li class="nav-item">
            <a href="{{ route('customers.double-entry-monitor') }}"
            class="nav-link {{ Request::is('customers.double-entry-monitor*') ? 'active' : '' }}">
                <i class="fas fa-link nav-icon"></i>
                <p>Double Entry Monitor</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('customers.trash') }}"
            class="nav-link {{ Request::is('customers.trash*') ? 'active' : '' }}">
                <i class="fas fa-trash nav-icon"></i>
                <p>Trash</p>
            </a>
        </li>
    </ul>
</li>

{{-- PAYMENT --}}
<li class="nav-item">
    <a href="{{ route('paymentTransactions.payments') }}"
       class="nav-link {{ Request::is('paymentTransactions.payments*') ? 'active' : '' }}">
       <i class="fas fa-dollar-sign nav-icon"></i>
        <p>Bills Payment</p>
    </a>
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

{{-- INVENTORY --}}
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="fas fa-warehouse nav-icon"></i>
        <p>
            Inventory
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('stocks.index') }}"
               class="nav-link {{ Request::is('stocks*') ? 'active' : '' }}">
                <i class="fas fa-stream nav-icon"></i>
                <p>Stock Items</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('stockHistories.index') }}"
               class="nav-link {{ Request::is('stockHistories*') ? 'active' : '' }}">
                <i class="fas fa-history nav-icon"></i>
                <p>Stock Histories</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('stockHistories.withdrawal') }}"
               class="nav-link {{ Request::is('stockHistories.withdrawal') ? 'active' : '' }}">
                <i class="fas fa-minus-circle nav-icon"></i>
                <p>Stock Withdrawal</p>
            </a>
        </li>
    </ul>
</li>

{{-- TICKETS --}}
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="fas fa-archive nav-icon"></i>
        <p>
            Tickets
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('tickets.index') }}"
               class="nav-link {{ Request::is('tickets*') ? 'active' : '' }}">
               <i class="fas fa-circle nav-icon"></i>
                <p>Tickets</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('ticketTypes.index') }}"
               class="nav-link {{ Request::is('ticketTypes*') ? 'active' : '' }}">
               <i class="fas fa-circle nav-icon"></i>
                <p>Ticket Types</p>
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
            <a href="#"
               class="nav-link">
               <i class="fas fa-map nav-icon"></i>
                <p>Fleet Monitoring</p>
            </a>
        </li>

        <li class="nav-header">                
            Others
        </li>
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
