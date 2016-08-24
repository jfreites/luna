<ul class="nav nav-sidebar">
    <li @if(Request::segment(2) == 'dashboard')class="active"@endif><a href="{{ url('admin') }}">Dashboard <span class="sr-only">(current)</span></a></li>
    <li @if(Request::segment(2) == 'page')class="active"@endif><a href="{{ url('admin/page') }}">Pages</a></li>
    <li @if(Request::segment(2) == 'file-manager')class="active"@endif><a href="{{ url('admin/file-manager')  }}">Files</a></li>
    <li @if(Request::segment(2) == 'user')class="active"@endif><a href="{{ url('admin/user') }}">Users</a></li>
</ul>
<hr>
<p><small>Powered by <a href="http://luna.jonathanfreites.info" target="_blank">Luna</a></small></p>