
			<div class="row margin-top-20">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Data Pengajuan PBG, SLF, SBKBG, RTB, atau Pendataan Bangunan Gedung</span>
							</div>
							<div class="actions">
								<!--a onClick="window.location.href = '<?php echo base_url();?>pengajuan';return false;" class="btn blue"><i class="fa fa-search"></i> Detail </a-->
								<a href="#" data-toggle="modal" data-target="#PPsit" class="btn red"><i class="fa fa-plus"></i> Tambah </a>
								<!--a class="btn btn-icon-only btn-default btn-sm fullscreen" href="javascript:;" data-original-title="" title="Layar Penuh"></a-->
							</div>
						</div>
						<div class="portlet-body">
							<div class="row list-separated">
								<div class="col-md-2">
									<div class="font-grey-mint font-sm">
										 Total Pengajuan
									</div>
									<div class="font-hg font-red-flamingo">
										<?php 
											if (isset($jum_imb->Pengajuan_IMB) != '0'){?>
												
													<?php echo set_value('id', (isset($jum_imb->Pengajuan_IMB) ? $jum_imb->Pengajuan_IMB : ''))?> 
													
											<?}else{?>
												
													-
												
											<?}
										?>
									</div>
								</div>
								<div class="col-md-2">
									<div class="font-grey-mint font-sm">
										 Dalam Proses
									</div>
									<div class="font-hg theme-font">
										<?php
											if (isset($jum_imb->Pengajuan_IMB) != '0'){
											$TotalIMBProses = (trim($jum_imb->Pengajuan_IMB)) - (trim($jum_imb->IMBTerbit)) - (trim($jum_imb->IMBDitolak));
											}else{
											$TotalIMBProses = (isset($jum_imb->Pengajuan_IMB)) - (isset($jum_imb->IMBTerbit)) - (isset($jum_imb->IMBDitolak));
											}
										?>
										<?php 
											if (isset($jum_imb->IMB_proses) != '0'){?>
												
													<?php echo $TotalIMBProses;?> 
												
											<?}else{?>
												
													-
												
											<?}
										?>
									</div>
								</div>
								<div class="col-md-2">
									<div class="font-grey-mint font-sm">
										 Terbit / Selesai
									</div>
									<div class="font-hg font-green">
										 <?php 
											if (isset($jum_imb->IMBTerbit) != null){?>
												
													<?php echo set_value('id', (isset($jum_imb->IMBTerbit) ? $jum_imb->IMBTerbit : ''))?>
												
											<?}else{?>
												
													-
												
											<?}
										?>
									</div>
								</div>
								<div class="col-md-2">
									<div class="font-grey-mint font-sm">
										 Ditolak
									</div>
									<div class="font-hg font-grey-mint">
										 <?php 
											if (isset($jum_imb->IMBDitolak) != null){?>
												
													<?php echo set_value('id', (isset($jum_imb->IMBDitolak) ? $jum_imb->IMBDitolak : ''))?>
												
											<?}else{?>
												
													-
												
											<?}
										?>
									</div>
								</div>
							</div>
	
							<div class="table-scrollable table-scrollable-borderless" style="min-height: 360px;">
							
								<table class="table table-striped table-bordered table-hover" >
								<thead>
									<tr class="">
									  <th>#</th>
									  <th>Nomor Registrasi</th>
									  <th>Jenis Pengajuan</th>
									  
									  <th>Status</th>
									  <th>Detail</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								</table>
							</div>
							
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
				
			</div> 
