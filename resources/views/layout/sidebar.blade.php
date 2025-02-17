<div class="page-main">
    <div class="app-content main-content">
        <div class="side-app">
            <!--app header-->
            <div class="app-header header">
                <div class="container-fluid">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link {{ ((request()->segment(1) == 'contacts' || request()->segment(1) == '')) ? 'active' : '' }}" href="{{route('contacts')}}">Contacts</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <!--/app header-->
