<nav style="color: cornsilk" class="sidebar sidebar-offcanvas dynamic-active-class-disabled bg-dark" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile not-navigation-link">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{session()->get('user')->image}}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ session()->get('user')->fullname }}</p>
                        <div class="dropdown" data-display="static">
                            <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown"
                                href="#" data-toggle="dropdown" aria-expanded="false">
                                <small class="designation text-muted">Mô tả tài khoản</small>
                                <span class="status-indicator online"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                                <a class="dropdown-item p-0">
                                    <div class="d-flex border-bottom">
                                        <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                                        </div>
                                        <div
                                            class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                            <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                                        </div>
                                        <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                                        </div>
                                    </div>
                                </a>
                                <a href="/user/detail" class="dropdown-item mt-2"> Manage Accounts </a>
                                <a class="dropdown-item" href="/user/changepassword"> Change Password </a>

                                <a href="/logout" class="dropdown-item"> Sign Out </a>
                            </div>
                        </div>
                    </div>

                </div>
        </li>
        <li class="nav-item {{ active_class(['/']) }}">
            <a class="nav-link" href="{{ url('user/dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <!--    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
              <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
                <i class="menu-icon mdi mdi-dna"></i>
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ show_class(['basic-ui/*']) }}" id="basic-ui">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item {{ active_class(['basic-ui/buttons']) }}">
                    <a class="nav-link" href="{{ url('/basic-ui/buttons') }}">Buttons</a>
                  </li>
                  <li class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
                    <a class="nav-link" href="{{ url('/basic-ui/dropdowns') }}">Dropdowns</a>
                  </li>
                  <li class="nav-item {{ active_class(['basic-ui/typography']) }}">
                    <a class="nav-link" href="{{ url('/basic-ui/typography') }}">Typography</a>
                  </li>
                </ul>
              </div>
            </li>-->

        <!--    <li class="nav-item {{ active_class(['charts/chartjs']) }}">
              <a class="nav-link" href="{{ url('/charts/chartjs') }}">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">Charts</span>
              </a>
            </li>
            <li class="nav-item {{ active_class(['tables/basic-table']) }}">
              <a class="nav-link" href="{{ url('/tables/basic-table') }}">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Tables</span>
              </a>
            </li>
            <li class="nav-item {{ active_class(['icons/material']) }}">
              <a class="nav-link" href="{{ url('/icons/material') }}">
                <i class="menu-icon mdi mdi-emoticon"></i>
                <span class="menu-title">Icons</span>
              </a>
            </li>-->
        <li class="nav-item {{ active_class(['Catalog/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#catalog-pages">
                <i class="menu-icon mdi mdi-format-list-bulleted"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['user-pages/*']) }}" id="catalog-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['Catalog']) }}">
                        <a class="nav-link" href="{{ url('/catalog') }}">List Category</a>
                    </li>
                    <li class="nav-item {{ active_class(['Catalog/create']) }}">
                        <a class="nav-link" href="{{ url('/catalog/create') }}">Create new Category</a>
                    </li>


                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['product/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#product-pages">
                <i class="menu-icon mdi mdi-basket"></i>
                <span class="menu-title">Product</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['product/*']) }}" id="product-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['product']) }}">
                        <a class="nav-link" href="{{ url('/product') }}">List Product</a>
                    </li>
                    <li class="nav-item {{ active_class(['product/create']) }}">
                        <a class="nav-link" href="{{ url('/product/create') }}">Create new Product</a>
                    </li>


                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['customer/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#customer-pages">
                <i class="menu-icon mdi mdi-account-switch"></i>
                <span class="menu-title">Customer</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['user-pages/*']) }}" id="customer-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['customer']) }}">
                        <a class="nav-link" href="{{ url('/customer') }}">List Customer</a>
                    </li>
                    <li class="nav-item {{ active_class(['customer/create']) }}">
                        <a class="nav-link" href="{{ url('/customer/create') }}">Create new Customer</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['supplier/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#supplier-pages">
                <i class="menu-icon mdi mdi-truck"></i>
                <span class="menu-title">Supplier</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['supplier-pages/*']) }}" id="supplier-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['supplier']) }}">
                        <a class="nav-link" href="{{ url('/supplier') }}">List Supplier</a>
                    </li>
                    <li class="nav-item {{ active_class(['supplier/create']) }}">
                        <a class="nav-link" href="{{ url('/supplier/create') }}">Create new Supplier</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['import/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#import-pages">
                <i class="menu-icon mdi mdi-cart-plus"></i>
                <span class="menu-title">Import</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['import-pages/*']) }}" id="import-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['import']) }}">
                        <a class="nav-link" href="{{ url('/import') }}">List Import</a>
                    </li>
                    <li class="nav-item {{ active_class(['import/create']) }}">
                        <a class="nav-link" href="{{ url('/import/create') }}">Create new Import</a>
                    </li>
                    <li class="nav-item {{ active_class(['import/return']) }}">
                        <a class="nav-link" href="{{ url('/return/import') }}">Return Import</a>
                    </li>
                </ul>
            </div>
            
        </li>
        <li class="nav-item {{ active_class(['export/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#export-pages">
                <i class="menu-icon mdi mdi-cart-outline"></i>
                <span class="menu-title">Export</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['export-pages/*']) }}" id="export-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['export']) }}">
                        <a class="nav-link" href="{{ url('/export') }}">List Export</a>
                    </li>
                    <li class="nav-item {{ active_class(['export/create']) }}">
                        <a class="nav-link" href="{{ url('/export/create') }}">Create new Export</a>
                    </li>
                    <li class="nav-item {{ active_class(['export/return']) }}">
                        <a class="nav-link" href="{{ url('/return/export') }}">Return Export</a>
                    </li>
                    <li class="nav-item {{ active_class(['export/preorder']) }}">
                        <a class="nav-link" href="{{ url('/preorder/export') }}">Pre-Order</a>
                    </li>
                </ul>
            </div>
            
        </li>
        <li class="nav-item {{ active_class(['report/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#report-pages">
                <i class="menu-icon mdi mdi-message-draw"></i>
                <span class="menu-title">Report</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['report-pages/*']) }}" id="report-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['report/inventory']) }}">
                        <a class="nav-link" href="{{ url('report/inventory') }}">Inventory</a>
                    </li>
                    <li class="nav-item {{ active_class(['report/import']) }}">
                        <a class="nav-link" href="{{ url('/report/graph') }}">Graph</a>
                    </li>
                   
                    
                   
                </ul>
            </div>
            
        </li>
       

    </ul>
</nav>
