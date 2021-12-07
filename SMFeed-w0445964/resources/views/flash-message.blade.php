{{-- Source Code: https://www.itsolutionstuff.com/post/laravel-6-flash-message-tutorialexample.html--}}
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


