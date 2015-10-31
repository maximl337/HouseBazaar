@if (session()->has('flash_message'))

    <script type="text/javascript">

    swal({   
        title: "{{ session('flash_message.title') }}",   
        text: "{{ session('flash_message.message') }}",   
        type: "{{ session('flash_message.level') }}",   
        showConfirmButton: false,
        timer: 1700
    });

    </script>
@endif

@if (session()->has('flash_message_overlay'))

    <script type="text/javascript">

    swal({   
        title: "{{ session('flash_message_overlay.title') }}",   
        text: "{{ session('flash_message_overlay.message') }}",   
        type: "{{ session('flash_message_overlay.level') }}",   
        confirmButtonText: 'Okay'
    });

    </script>
@endif