@if(\Session::has('success'))
<p class="alert {{ \Session::get('alert-class', 'alert-info') }}">{{ \Session::get('success') }}</p>
@endif
