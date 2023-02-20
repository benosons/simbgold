<!--  ----------------------------THIS IS FILE UPLOAD PART------------------------- -->
<base href="<?= base_url() ?>">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="./application/third_party/Fileupload/css/jquery.fileupload.css">
<link rel="stylesheet" href="./application/third_party/Fileupload/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript>
	<link rel="stylesheet" href="./application/third_party/Fileupload/css/jquery.fileupload-noscript.css"></noscript>
<noscript>
	<link rel="stylesheet" href="./application/third_party/Fileupload/css/jquery.fileupload-ui-noscript.css"></noscript>

<style type="text/css">
	th {
		text-align: center;
	}
</style>
<!-- BEGIN PAGE CONTENT-->

<div class="portlet box light">


	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">

					<blockquote>
						<p style="font-size:16px">
							File Upload widget with multiple file selection, drag&amp;drop support, progress bars and preview images for jQuery.
						</p>
					</blockquote>
					<br>
					<!-- The file upload form used as target for the file upload widget -->
					<fieldset id="referensi" action="referensi/do_upload" method="POST" enctype="multipart/form-data">
						<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
						<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
								<!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn btn-success fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Add files...</span>
									<input type="file" name="userfile" multiple>
								</span>
								<button type="submit" class="btn btn-primary start">
									<i class="glyphicon glyphicon-upload"></i>
									<span>Start upload</span>
								</button>
								<button type="reset" class="btn btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span>Cancel upload</span>
								</button>
								<button type="button" class="btn btn-danger delete">
									<i class="glyphicon glyphicon-trash"></i>
									<span>Delete</span>
								</button>
								<input type="checkbox" class="toggle">
								<span> Check all</span>
								<!-- The global file processing state -->
								<span class="fileupload-process"></span>
							</div>
							<!-- The global progress state -->
							<div class="col-lg-5 fileupload-progress fade">
								<!-- The global progress bar -->
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar progress-bar-success" style="width:0%;"></div>
								</div>
								<!-- The extended global progress state -->
								<div class="progress-extended">&nbsp;</div>
							</div>
						</div>
						<!-- The table listing the files available for upload/download -->
						<table role="presentation" class="table table-striped">
							<tbody class="files"></tbody>
						</table>
					</fieldset>
					<!-- The blueimp Gallery widget -->
					<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
						<div class="slides"></div>
						<h3 class="title"></h3>
						<a class="prev">‹</a>
						<a class="next">›</a>
						<a class="close">×</a>
						<a class="play-pause"></a>
						<ol class="indicator"></ol>
					</div>
					<!-- The template to display files available for upload -->

					<h1>List Logo Kabkot</h1>


					<?php if (isset($picturelist) && count($picturelist) > 0) { ?>
						<table id="example1" class="display nowrap" style="width:100%">
							<tbody class="files">
								<tr>
									<th>Preview</th>
									<th>Kabupaten / Kota</th>
									<th>Image Name</th>
									<th>Action</th>
								</tr>

								<?php foreach ($picturelist as $key => $picture) {
									if (isset($picture->id) && !empty($picture->image)) { ?>
										<tr>
											<td>
												<span class="preview">
													<img src="<?= isset($picture->image) ? base_url() . 'uploads/gallery/thumbs/' . $picture->image : '' ?>">
													<input type="hidden" name="img_name[]" value="<?= isset($picture->image) ? $picture->image : '' ?>">
												</span>
											</td>
											<td>
												<div class="form-group">
													<!-- <input class="form-control" type="text" placeholder="Enter Image Title" name="img_title[]"  value="<?= isset($picture->title) ? $picture->title : '' ?>"/> -->
													<p id='nilai'> <?= isset($picture->nama_kabkota) ? $picture->nama_kabkota : 'No-Data' ?></p>
												</div>
											</td>
											<td>
												<div class="form-group">
													<!-- <input class="form-control" type="text" placeholder="Enter Image Title" name="img_title[]"  value="<?= isset($picture->title) ? $picture->title : '' ?>"/> -->
													<p id='nilai'> <?= isset($picture->image) ? $picture->image : '' ?></p>
												</div>
											</td>
											<td>
												<input type="button" alt="Submit" class="btn btn-danger remove_uploded" value="Delete">
										</tr>

									<?php }
								} ?>
							</tbody>
						</table>
					<?php } ?>

					<br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Demo Notes</h3>
						</div>
						<div class="panel-body">
							<ul>
								<li>The maximum file size for uploads in this demo is <strong>999 KB</strong> (default file size is unlimited).</li>
								<li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
								<li>Uploaded files will be deleted automatically after <strong>5 minutes or less</strong> (demo files are stored in memory).</li>
								<li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">Browser support</a>).</li>
								<li>Please refer to the <a href="https://github.com/blueimp/jQuery-File-Upload">project website</a> and <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">documentation</a> for more information.</li>
								<li>Built with the <a href="http://getbootstrap.com/">Bootstrap</a> CSS framework and Icons from <a href="http://glyphicons.com/">Glyphicons</a>.</li>
							</ul>
						</div>
					</div>






					<script id="template-upload" type="text/x-tmpl">

						{% for (var i=0, file; file=o.files[i]; i++) { %}
			 <tr class="template-upload fade">
					 <td>
							 <span class="preview"></span>
					 </td>
					 <td>
							 <p>{%=file.name%}</p>
							 <strong class="error text-danger"></strong>
					 </td>
					 <td>
							 <p class="size">Processing...</p>
							 <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
					 </td>
					 <td>
							 {% if (!i && !o.options.autoUpload) { %}
									 <button class="btn btn-primary start" disabled>
											 <i class="glyphicon glyphicon-upload"></i>
											 <span>Start</span>
									 </button>
							 {% } %}
							 {% if (!i) { %}
									 <button class="btn btn-warning cancel">
											 <i class="glyphicon glyphicon-ban-circle"></i>
											 <span>Cancel</span>
									 </button>
							 {% } %}
					 </td>
			 </tr>
		{% } %}
		</script>
					<!-- The template to display files available for download -->
					<script id="template-download" type="text/x-tmpl">
						{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download fade">

					 <td>
							 <span class="preview">
									 {% if (file.thumbnailUrl) { %}
											 <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
											 <input type="hidden" name="img_name[]" value="{%=file.name%}" >
									 {% } %}
							 </span>
					 </td>
					 <td>
							 <div class="form-group">
									 {% if (file.url) { %}
											 <span>{%=file.name%}</span>
									 {% } %}
							 </div>
							 {% if (file.error) { %}
									 <div><span class="label label-danger">Error</span> {%=file.error%}</div>
							 {% } %}
					 </td>
					 <td>
							 <span class="size">{%=o.formatFileSize(file.size)%}</span>
					 </td>
					 <td>
							 {% if (file.deleteUrl) { %}
									 <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
											 <i class="glyphicon glyphicon-trash"></i>
											 <span>Delete</span>
									 </button>
									 <input type="checkbox" name="delete" value="1" class="toggle">
							 {% } else { %}
									 <button class="btn btn-warning cancel">
											 <i class="glyphicon glyphicon-ban-circle"></i>
											 <span>Cancel</span>
									 </button>
							 {% } %}
					 </td>
			</tr>
		{% } %}

		</script>
					<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
					<script src="./application/third_party/Fileupload/js/vendor/jquery.ui.widget.js"></script>
					<!-- The Templates plugin is included to render the upload/download listings -->
					<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
					<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
					<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
					<!-- The Canvas to Blob plugin is included for image resizing functionality -->
					<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>

					<!-- blueimp Gallery script -->
					<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
					<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
					<script src="./application/third_party/Fileupload/js/jquery.iframe-transport.js"></script>
					<!-- The basic File Upload plugin -->
					<script src="./application/third_party/Fileupload/js/jquery.fileupload.js"></script>
					<!-- The File Upload processing plugin -->
					<script src="./application/third_party/Fileupload/js/jquery.fileupload-process.js"></script>
					<!-- The File Upload image preview & resize plugin -->
					<script src="./application/third_party/Fileupload/js/jquery.fileupload-image.js"></script>
					<!-- The File Upload validation plugin -->
					<script src="./application/third_party/Fileupload/js/jquery.fileupload-validate.js"></script>
					<!-- The File Upload user interface plugin -->
					<script src="./application/third_party/Fileupload/js/jquery.fileupload-ui.js"></script>


					<script type="text/javascript">
						$(function() {
							'use strict';

							$('#referensi').fileupload({
								// Uncomment the following to send cross-domain cookies:
								//xhrFields: {withCredentials: true},
								url: "<?= base_url() . 'referensi/do_upload' ?>"
							});


							$('#referensi').addClass('fileupload-processing');
							$.ajax({
								// Uncomment the following to send cross-domain cookies:
								//xhrFields: {withCredentials: true},
								url: $('#referensi').fileupload('option', 'url'),
								dataType: 'json',
								context: $('#referensi')[0]
							}).always(function() {
								$(this).removeClass('fileupload-processing');
							}).done(function(result) {
								$(this).fileupload('option', 'done')
									.call(this, $.Event('done'), {
										result: result
									});
							});

						});


						var loadFeatured = function(event) {
							var output = document.getElementById('featured_img');
							output.src = URL.createObjectURL(event.target.files[0]);
						};


						// $(".remove_uploded").on("click", function (event) {
						//$(this).parent().parent().remove();
						// });

						$(".remove_uploded").on("click", function(event) {
							var _this = $(event.target);
							var tds = $(_this).closest("tr").find("td:lt(3)");
							var $link = $(tds[2]).text();

							var $tr = $(_this).closest("tr");

							var req = $.ajax({
								dataType: 'json',
								url: 'referensi/deleteImage/' + $.trim($link),
								type: 'DELETE'
							});

							req.success(function() {
								//alert($tr);
								$tr.find('td').fadeOut(1000, function() {
									$tr.remove();
								});
							});
						});
						$(document).ready(function() {
							var table = $('#example1').DataTable({
								scrollX: true,
								responsive: true
							});
						});
					</script>




					<input type="hidden" name="process" value="true">
					<input type="hidden" name="id" value="<?php echo (isset($record->id) ? $record->id : ''); ?>">
					<!-- <button type="hidden" class="btn btn-info">Submit</button> -->
					<input type="hidden" class="btn btn-info"></input>

				</form>
			</div>
		</div>
	</div>
</div>



<style>
	.featured {
		height: 200px;
		margin: 10px 5px 0 0;
	}
</style>