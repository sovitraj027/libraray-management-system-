<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled nav nav-treeview" id="side-menu">
                <li class="menu-title">Home</li>

                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- <li class="menu-title">Menu Information</li> --}}


                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-map-marked"></i>
                        <span>Place Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Activity</a></li>
                        <li><a href="#">Place Information</a></li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="" class="waves-effect">
                        <i class="fas fa-search"></i>
                        <span>Search Books</span>
                    </a>
                </li> --}}
                <ul class="nav nav-treeview">
                    @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="waves-effect">
                            <i class="fas fa-user-friends"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->user_type_id == 1)
                    <li>
                        <a href="{{ route('categories.index') }}" class="waves-effect">
                            <i class="fa fa-list"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    
                    @endif
                    {{-- @if (auth()->user()->user_type_id == 1)
                    <li>
                        <a href="{{ route('authors.index') }}" class="waves-effect">
                            <i class="fa fa-user-astronaut"></i>
                            <span>Authors</span>
                        </a>
                    </li>
                    @endif --}}
                </ul>
               

           

                <li>
                    <a href="{{ route('books.index') }}" class="waves-effect">
                        <i class="fa fa-book"></i>
                        <span>Books</span>
                    </a>
                </li>
                
                @if(auth()->user()->user_type_id==1||auth()->user()->user_type_id==2)
                <li>
                    <a href="{{route('find')}}" class="waves-effect">
                        <i class="fas fa-user-circle"></i>
                        <span>User Reservations</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                    <li>
                        <a href="{{ route('return') }}" class="waves-effect">
                            <i class="fas fa-undo"></i>
                            <span>Return Books</span>
                        </a>
                    </li>
                @endif
                {{-- @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                    <li>
                        <a href="{{ route('bookIssue') }}" class="waves-effect">
                            <i class="fas fa-undo"></i>
                            <span>Issue book</span>
                        </a>
                    </li>
                    @endif --}}


                <li>
                    @if (auth()->user()->user_type_id == 3)
                        <a href="{{ route('mybook', auth()->user()->id) }}" class="waves-effect">
                            <i class="fas fa-book-open fa-lg"></i>
                            <span>My Books</span>
                        </a>

                </li>
                <li>
                    @if (auth()->user()->user_type_id == 3)
                        <a href="{{ route('recommendation') }}" class="waves-effect">
                            <i class="fas fa-book-open fa-lg"></i>
                            <span>Recommendation</span>
                        </a>
                    @endif
                </li>
                {{-- <li>
                    @if (auth()->user()->user_type_id == 3)
                    <a href="{{ route('profile') }}" class="waves-effect">
                        <i class="fas fa-book-open fa-lg"></i>
                        <span>My profile</span>
                    </a>
                    @endif
                </li> --}}

                <li>
                    @if (auth()->user()->user_type_id == 3)
                        <a href="{{ route('search_books') }}" class="waves-effect">
                            <i class="fas fa-search"></i>
                            <span>Search books</span>
                        </a>
                    @endif
                </li>
                <li>
                    <a href="{{ route('myreservation', auth()->user()->id) }}" class="waves-effect">
                        <i class="fal fa-book"></i>
                        <span>My Reservations</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
