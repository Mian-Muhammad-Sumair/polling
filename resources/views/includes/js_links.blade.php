
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<?php $content = file_get_contents(public_path("/js/app.js")); ?>
<script src="{{ asset('js/app.js?version=' . md5($content)) }}"></script>
<script src="{{ asset('assets/js/lib/css3-animate-it.js') }}"></script>
<script src="{{ asset('assets/js/lib/owl.carousel.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
