@extends('layout')

@section('content')

    <h1>Selling a property?</h1>

    <div class="row">
        
        <div class="col-md-10 col-md-offset-1">
          
            <form method="post" action="/properties" enctype="multipart/form-data">

                @if (count($errors) > 0)
                    
                    @foreach ($errors->all() as $error)
                        
                        <p class="alert alert-danger">
                            {{ $error }}
                        </p>
                    @endforeach
                    
                @endif
        
                @include('properties.form')

                

            </form>  

        </div> <!-- EO .col -->

    </div> <!-- EO .row -->
    

@stop

@section('scripts.footer')

<script type="text/javascript">
    $(function() {

        $('form').on("submit", function(e) {

            $btn = $(this).find('input[type=submit]');

            $btn.val("Working...");

            $btn.attr("disabled", "disabled");

        })

    });
</script>

@stop