<footer class="main-footer d-flex p-2 px-3 bg-white border-top">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/profile')}}">Loggedin as <strong>{!!ucfirst(Auth::user()->first_name)!!}</strong></a>
        </li>
    </ul>
    <span class="copyright ml-auto my-auto mr-2">Copyright © 2020
        <a href="https://fb.com/computersworm" target="_blank" rel="nofollow">Abdulrehman Sheikh - Sr. Software Solutions Architect.</a>
    </span>
</footer>