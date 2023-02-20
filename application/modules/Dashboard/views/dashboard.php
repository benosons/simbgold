<style>
  .comingsoon {
    text-align: center;
    font-size: 48pt;
  }
</style>
<?php
$role_id    = $this->session->userdata('loc_role_id');
if ($role_id != '7') {
  ?>
  <!-- BEGIN DASHBOARD STATS -->
  <div class="portlet-body">
    <div class="row">
      <!-- Content -->
      <div class="col-md-12">
        <div class="profile-content">
          <div class="row">
            <div class="col-md-12">
              <div class="portlet light">
                <!--// Content -->
                <div class="tab-content">
			<div class="row margin-top-10">
				<div class="tab-pane active" id="tab_1">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="portlet blue-hoki box">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-cogs"></i>Summary Data Pengajuan IMB
									</div>
								</div>
								<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($profile_user->id) ? $profile_user->id : ''))?>" name="id" placeholder="id" autocomplete="off">
								<div class="portlet-body">
									<div class="row static-info">
										<div class="col-md-5 name">
											Jumlah Pengajuan IMB
										</div>
										<?php 
											if (isset($JumPerIMBKab->Pengajuan_IMB) != '0'){?>
												<div class="col-md-7 value">
													<?php echo set_value('id', (isset($JumPerIMBKab->Pengajuan_IMB) ? $JumPerIMBKab->Pengajuan_IMB : ''))?> Permohonan
												</div>
											<?}else{?>
												<div class="col-md-7 value">
													Belum Ada IMB Yang Dimohonkan
												</div>
											<?}
										?>
									</div>
									<div class="row static-info">
										<div class="col-md-5 name">
											Pengajuan IMB dalam Proses
										</div>
										<?php
											if (isset($JumPerIMBKab->Pengajuan_IMB) != '0'){
											$TotalIMBProses = (trim($JumPerIMBKab->Pengajuan_IMB)) - (trim($JumPerIMBKab->IMBTerbit)) - (trim($JumPerIMBKab->IMBDitolak));
											}else{
											$TotalIMBProses = (isset($JumPerIMBKab->Pengajuan_IMB)) - (isset($JumPerIMBKab->IMBTerbit)) - (isset($JumPerIMBKab->IMBDitolak));
											}
										?>
										<?php 
											if (isset($JumPerIMBKab->IMB_proses) != '0'){?>
												<div class="col-md-7 value">
													<?php echo $TotalIMBProses;?> Permohonan
												</div>
											<?}else{?>
												<div class="col-md-7 value">
													Belum Ada IMB Yang Terbit
												</div>
											<?}
										?>
									</div>
									<div class="row static-info">
										<div class="col-md-5 name">
											Pengajuan IMB yang Terbit
										</div>
										<?php 
											if (isset($JumPerIMBKab->IMBTerbit) != null){?>
												<div class="col-md-7 value">
													<?php echo set_value('id', (isset($JumPerIMBKab->IMBTerbit) ? $JumPerIMBKab->IMBTerbit : ''))?> Permohonan
												</div>
											<?}else{?>
												<div class="col-md-7 value">
													Belum Ada IMB Yang Terbit
												</div>
											<?}
										?>
									</div>
									
									
									<div class="row static-info">
										<div class="col-md-5 name">
											Pengajuan IMB Ditolak
										</div>
										<?php 
											if (isset($JumPerIMBKab->IMBDitolak) != null){?>
												<div class="col-md-7 value">
													<?php echo set_value('id', (isset($JumPerIMBKab->IMBDitolak) ? $JumPerIMBKab->IMBDitolak : ''))?> Permohonan
												</div>
											<?}else{?>
												<div class="col-md-7 value">
													Belum Ada IMB Yang Ditolak
												</div>
											<?}
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="portlet blue-hoki box">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-cogs"></i> Summary Data Pengajuan SLF
									</div>
								</div>
								<div class="portlet-body">
									<div class="row static-info">
										<div class="col-md-5 name">
											Jumlah Pengajuan SLF
										</div>
										<?php 
											if (isset($JumPerSLFKab->PengajuanSLF) != '0'){?>
												<div class="col-md-7 value">
													<?php echo set_value('id', (isset($JumPerSLFKab->PengajuanSLF) ? $JumPerSLFKab->PengajuanSLF : ''))?> Permohonan
												</div>
											<?}else{?>
												<div class="col-md-7 value">
													Belum Ada SLF Yang Ditolak
												</div>
											<?}
										?>
									</div>
									<div class="row static-info">
										<div class="col-md-5 name">
											Pengajuan SLF Dalam Proses	
										</div>
										<?php
										if (isset($JumPerSLFKab->PengajuanSLF) != '0'){
											$TotalSLFProses =  (trim($JumPerSLFKab->PengajuanSLF)) - (trim($JumPerSLFKab->SLFTerbit)) - (trim($JumPerSLFKab->SLFDitolak));
										}else{
											$TotalSLFProses =  (isset($JumPerSLFKab->PengajuanSLF)) - (isset($JumPerSLFKab->SLFTerbit)) - (isset($JumPerSLFKab->SLFDitolak));
										}
										?>
										<?php 
											if (isset($JumPerSLFKab->SLFProses) != null){?>
												<div class="col-md-7 value">
													<?php echo $TotalSLFProses;?> Permohonan
												</div>
											<?}else{?>
												<div class="col-md-7 value">
													Belum Ada SLF Yang Ditolak
												</div>
											<?}
										?>
									</div>
									<div class="row static-info">
										<div class="col-md-5 name">
											Pengajuan SLF Yang Terbit
										</div>
										<?php 
											if (isset($JumPerSLFKab->SLFTerbit) != '0'){?>
												<div class="col-md-7 value">
													<?php echo set_value('id', (isset($JumPerSLFKab->SLFTerbit) ? $JumPerSLFKab->SLFTerbit : ''))?> Permohonan
												</div>
											<?}else{?>
												<div class="col-md-7 value">
													Belum Ada SLF Yang Ditolak
												</div>
											<?}
										?>
									</div>
									
									<div class="row static-info">
										<div class="col-md-5 name">
											Pengajuan SLF Ditolak
										</div>
										<?php 
											if (isset($JumPerSLFKab->SLFDitolak) != '0'){?>
												<div class="col-md-7 value">
													<?php echo set_value('id', (isset($JumPerSLFKab->SLFDitolak) ? $JumPerSLFKab->SLFDitolak : ''))?> Permohonan
												</div>
											<?}else{?>
												<div class="col-md-7 value">
													Belum Ada SLF Yang Ditolak
												</div>
											<?}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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
<?php
}
?>