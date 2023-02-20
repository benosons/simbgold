//frontend
<div class="portlet box light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>Informasi Perizinan Bangunan Gedung
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <!-- Content -->

            <!--//End Content -->
        </div>
    </div>
</div>
//backend
<div class="portlet-body">
    <div class="row">
        <!-- Content -->
        <div class="col-md-12">
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light">
                            <!--// Content -->
                            <div class="portlet-title tabbable-line">

                            </div>
                            <div class="portlet-body">
                                <div class="row">

                                </div>
                            </div>
                            <!-- //End Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
//backend
<table id="example1" class="display nowrap" style="width:100%"></table>
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            scrollX: true,
            responsive: true
        });
    });

    $(document).ready(function() {
        var table = $('#example1').DataTable({
            // rowReorder: {
            // 	selector: 'td:nth-child(2)'
            // },
            scrollX: true,
            responsive: true
        });
    });
</script>