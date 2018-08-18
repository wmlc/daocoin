@include('layouts.header')
@include('layouts.left')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="text-center" style="padding:200px 0;">
        <img style="margin-bottom:30px;" src="/assets/img/warn_fill.png"/>
        <p>{{$message}}</p>
    </div>

</div>

@include('layouts.footer')
