@if(count($errors) > 0)

    @foreach($errors->all() as $error) 

        <p class="alert alert-warning">
            {{ $error }}
        </p>

    @endforeach

@endif