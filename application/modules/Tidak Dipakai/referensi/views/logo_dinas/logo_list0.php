 <base href="<?=base_url()?>">
 <style type="text/css">
	th{text-align: center;}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<blockquote>
			<p style="font-size:16px">
				 File Upload widget with multiple file selection, drag&amp;drop support, progress bars and preview images for jQuery.
			</p>
		</blockquote>
		<br>
		<!-- The file upload form used as target for the file upload widget -->
		<fieldset id="fileupload" action="ablums/do_upload" method="POST" enctype="multipart/form-data">
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
		  <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
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


		    <?php if(isset($picturelist) && count($picturelist)>0) { ?>
		    <table class="table table-striped"><tbody class="files">
		    <tr>
		    <th>Preview</th>
		    <th>Kabupaten / Kota</th>
		    <th>Image Name</th>
		    <th>Action</th>
		    </tr>

		    <?php    foreach ($picturelist as $key => $picture) {
		            if (isset($picture->id) && !empty($picture->image)){ ?>
		            <tr>
		            <td>
		                <span class="preview">
		                        <img src="<?=isset($picture->image)?base_url().'uploads/gallery/thumbs/'.$picture->image:'' ?>">
		                        <input type="hidden" name="img_name[]" value="<?=isset($picture->image)?$picture->image:''?>" >
		                </span>
		            </td>
		            <td>
		                <div class="form-group">
		                        <!-- <input class="form-control" type="text" placeholder="Enter Image Title" name="img_title[]"  value="<?=isset($picture->title)?$picture->title:''?>"/> -->
		                        <p id='nilai'> <?=isset($picture->nama_kabkota)?$picture->nama_kabkota:'No-Data'?></p>
		                </div>
		            </td>
		            <td>
		                <div class="form-group">
		                        <!-- <input class="form-control" type="text" placeholder="Enter Image Title" name="img_title[]"  value="<?=isset($picture->title)?$picture->title:''?>"/> -->
		                        <p id='nilai'> <?=isset($picture->image)?$picture->image:''?></p>
		                </div>
		            </td>
		            <td>
		              <input type="button" alt="Submit" class="btn btn-danger remove_uploded" value="Delete">
		                    <!-- <button class="btn btn-danger remove_uploded" >
		                        <i class="glyphicon glyphicon-trash"></i>
		                        <span>Delete</span>
		                    </button> -->
		            </td>
		            </tr>

		    <?php } } ?>
		                </tbody></table>
		    <?php } ?>




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
