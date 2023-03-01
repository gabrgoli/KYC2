<nav class="bg-white" id="header">
    <img src="{{url('/images/IAMX_OYI_Blue.png')}}" class="mx-auto d-block mt-4 mb-5" alt="IAMX Logo" width="72px" />
    <a href="#" class="mx-auto d-block header">
        @if(!empty($dbProduct->name)){{$dbProduct->name}}@endif 
        @if(!empty($dbProduct->name))-@endif 
        @if(!empty($view_name)){{$view_name}}@endif
    </a>
    <a href="/" class="mx-auto d-block header">Own your identity</a>
</nav>
