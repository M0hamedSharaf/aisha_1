@if($errors->any())
@push('js')
    <script>
        setTimeout(() => {
            Swal.fire(
                'Error!',
                `There was an Error Check the form`,
                'error'
            )
        }, 500);
    </script>    
@endpush
@endif