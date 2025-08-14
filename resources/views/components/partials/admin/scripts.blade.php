<!-- Core JS -->
<!-- build:js admin/assets/vendor/js/core.js -->
<script src="{{url('admin/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{url('admin/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{url('admin/assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{url('admin/assets/vendor/libs/node-waves/node-waves.js')}}"></script>
<script src="{{url('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{url('admin/assets/vendor/libs/hammer/hammer.js')}}"></script>
<script src="{{url('admin/assets/vendor/libs/i18n/i18n.js')}}"></script>
<script src="{{url('admin/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{url('admin/assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{url('admin/assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{url('admin/assets/vendor/libs/dropzone/dropzone.js')}}"></script>

<script src="{{url('admin/assets/vendor/libs/jquery-sticky/jquery-sticky.js')}}"></script>

<script src="{{url('admin/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{url('admin/assets/vendor/libs/swiper/swiper.js')}}"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Main JS -->
<script src="{{url('admin/assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{url('admin/assets/js/dashboards-analytics.js')}}"></script>
@livewireScripts

<script>
     $(document).ready(function() {
        $('.dataTable').DataTable();
    });
</script>
