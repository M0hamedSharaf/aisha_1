</div>
</div>
<!--  END CONTENT PART  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('adminAssets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('adminAssets/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('adminAssets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminAssets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        App.init();
    });
</script>
<script src="{{ asset('adminAssets/assets/js/custom.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js">
</script>

@include('sweetalert::alert')

@stack('js')


</body>

</html>
