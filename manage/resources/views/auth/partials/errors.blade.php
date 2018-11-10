@if (isset($errors) && $errors->any())
<p class="text-center font-semibold text-danger my-3">
    @if (isset($errors) && $errors->has('email'))
        {{ isset($errors) ? $errors->first('email') : '' }}
    @else
        {{ isset($errors) ? $errors->first('password') : '' }}
    @endif
    </p>
@endif
