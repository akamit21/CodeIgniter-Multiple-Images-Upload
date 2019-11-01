<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Gallery</span></h2>
		<ol class="breadcrumb">
			<li class="active">
				<strong class="text-capitalize">Add</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4"></div>
</div>

<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'add-form',
		'enctype' => 'multipart/form-data',
		'class' => ''
	);
	echo form_open('gallery/add', $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Plant <small>(Basic Information)</small></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-8 b-r">
								<div class="form-group <?php if(form_error('gallery-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Gallery Name', 'gallery-name');

									echo form_textarea(array(
										'name' => 'gallery-name',
										'class' => 'form-control',
										'placeholder' => 'Gallery Name',
										'rows' => '9',
										'value' => set_value('gallery-name')
									));

									echo form_error('gallery-name'); ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group <?php if(form_error('thumbnail')) echo 'has-error'; ?>">
									<?php
									echo form_label('Thumbnail <small class="text-danger">*</small>', 'thumbnail');

									echo form_input(array(
										'type' => 'file',
										'name' => 'thumbnail',
										'class' => 'dropify',
										'required' => 'true'
									));

									echo form_error('thumbnail'); ?>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="text-right">
							<button class="btn btn-primary" type="submit">Save </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
