@if (session('message'))
    <div class="alert alert-success">
       <button class="close" data-close="alert"></button>
       {{session('message')}}
   </div>
@endif