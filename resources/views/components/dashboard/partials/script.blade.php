<!-- JAVASCRIPT -->
<script src="{{ Path::dashboardPath('libs/jquery/jquery.min.js') }}"></script>
<script src="{{ Path::dashboardPath('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ Path::dashboardPath('libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ Path::dashboardPath('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ Path::dashboardPath('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ Path::dashboardPath('libs/feather-icons/feather.min.js') }}"></script>

<!-- pace js -->
<script src="{{ Path::dashboardPath('libs/pace-js/pace.min.js') }}"></script>


<!-- apexcharts -->
<script src="{{ Path::dashboardPath('libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Plugins js-->
<script src="{{ Path::dashboardPath('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
</script>
<script
    src="{{ Path::dashboardPath('libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
</script>

<!-- dashboard init -->
<script src="{{ Path::dashboardPath('js/pages/dashboard.init.js') }}"></script>


<!-- Required datatable js -->
<script src="{{ Path::dashboardPath('libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{ Path::dashboardPath('libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Buttons examples -->
<script src="{{ Path::dashboardPath('libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/jszip/jszip.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ Path::dashboardPath('js/pages/datatables.init.js')}}"></script>
<!-- choices js -->
<script src="{{ Path::dashboardPath('libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>

<!-- datepicker js -->
<script src="{{ Path::dashboardPath('libs/flatpickr/flatpickr.min.js')}}"></script>

<!-- init js -->
<script src="{{ Path::dashboardPath('js/pages/form-advanced.init.js')}}"></script>


<script src="{{ Path::dashboardPath('js/app.js') }}"></script>

z

<!-- color picker js -->
<script src="{{ Path::dashboardPath('libs/@simonwep/pickr/pickr.min.js')}}"></script>
<script src="{{ Path::dashboardPath('libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>



<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!--sweetalert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<x-dashboard.partials.toastr-notifications />

<x-dashboard.partials.confirm-delete-button/>

<script>
    $(document).ready(function() {
        // Initialize Select2 for all multi-select dropdowns
        $('.select2-multiple').select2({
            placeholder: "Select values", // Placeholder text
            allowClear: true, // Allow clearing selections
        });
    });
   
</script>

<script>
    $('.permissions').select2({
        placeholder: 'Select permissions'
    });

    $("#checkbox").click(function(){
        if($("#checkbox").is(':checked') ){
            $(".select2 > option").prop("selected",true);
            $(".select2").trigger("change");
        }else{
            $('.select2 option:selected').prop("selected", false);
            $(".select2").trigger("change");
        }select2
    });

</script>


<script>
    // Group "Check All" functionality
    document.addEventListener('DOMContentLoaded', function() {
        
        document.querySelectorAll('.check-all').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const group = this.getAttribute('data-group');
                const checkboxes = document.querySelectorAll(`.permission-checkbox-${group}`);
                
                checkboxes.forEach(function(item) {
                    item.checked = checkbox.checked;
                });
            });
        });
        
      
    });
    // Global "Check All" functionality
    $("#checkAll").change(function() {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>


<script>
    

    @php
    use Illuminate\Support\Facades\Request;
    $segment = Request::segment(3);
    @endphp

    var segment = @json(Request::segment(3));

    var url = @json(url("dashboard/$segment"));
    $(document).ready(function() {

        <x-dashboard.partials.delete-btn />
        <x-dashboard.partials.change-status/>
    });

</script>
