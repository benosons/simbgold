<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="fa fa-gift"></i>Data Perbaikan</div>
			</div>
		</div>
		<div class="portlet light bordered margin-top-20">
			<?php include "HeaderData.php"; ?>
		</div>
		<div class="tabbable tabbable-custom tabbable-noborder">
			<ul class="nav nav-tabs">
				<center>
					<li class="active"><a href="#tab1" data-toggle="tab" class="step"><h4><span class="desc"><i class="fa fa-check"></i>Perbaikan Dokumen Teknis</span></h4></a></li>
				</center>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<?php include "DataPerbaikanDokumen.php"; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="PDFViewer" class="modal fade" aria-hidden="true" data-width="75%" >
	<div class="modal-body">
		<div>
			<embed id="pdfdataid" src="" frameborder="1" width="100%" height="750px">
		</div>
	</div>
</div>
<script>
	$(document).on("click",".open-PDFViewer", function(){
		var datapdf = $(this).data("id");
		$(".modal-body #pdfdataid").attr("src", datapdf);
		
	});
</script>