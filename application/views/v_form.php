<div class="row justify-content-center" style="margin-top: 80px;margin-bottom: 80px;">
	<div class="col-8">
		<div x-data="init()" class="content">
			<div class="mb-4">
				<?php $index = 0; ?>
				<?php foreach ($steps as $keyStep => $step) : ?>
					<div x-show="curStep === <?= json_decode($index) ?>">
						<h2 class="mt-3 mb-5"><?= $step['name'] ?></h2>
						<section class="card">
							<div class="card-body">
								<form class="my-form" id="<?= $keyStep ?>" action="<?= $step['validation_link'] ?>">
									<?php foreach ($step['forms'] as $keyForm => $form) : ?>
										<template <?php if (isset($form['template_attr'])) foreach ($form['template_attr'] as $keyTempAtt => $tempAttr) : ?> <?= $keyTempAtt . '="' .	$tempAttr . '"' ?> <?php endforeach ?>>
											<div class="row">
												<?php foreach ($form['input'] as $key => $item) : ?>
													<?php
													$is_required = false;
													if (isset($item['attr'])) {
														foreach ($item['attr'] as $keyAttr => $attr) {
															if ($attr === 'required') {
																$is_required = true;
															}
														}
													}
													$txt_required = $is_required ? '<span class="text-danger">*</span>' : '';
													?>

													<div class="form-group <?= @$item['class_container'] ?>" <?php if (isset($item['attr_container'])) foreach ($item['attr_container'] as $keyContainerAttr => $containerAttr) : ?> <?= is_numeric($keyContainerAttr) ? $containerAttr : $keyContainerAttr . '="' .	$containerAttr . '"' ?> <?php endforeach ?>>
														<?php if ($item['type'] === 'select') : ?>
															<label class="d-block text-left" for="<?= $key ?>"><?= $item['label'] ?> <?= $txt_required ?></label>
															<select class="form-control" name="<?= $key ?>" id="<?= $key ?>" <?php if (isset($item['attr'])) foreach ($item['attr'] as $keyAttr => $attr) : ?> <?= is_numeric($keyAttr) ? $attr : $keyAttr . '="' .	$attr . '"' ?> <?php endforeach ?>>
																<?php foreach ($item['options'] as $opt) : ?>
																	<option value="<?= $opt['value'] ?>"><?= $opt['label'] ?></option>
																<?php endforeach ?>
															</select>
														<?php elseif ($item['type'] === 'heading') : ?>
															<h4><?= $item['text'] ?></h4>
														<?php else : ?>
															<label class="d-block text-left" for="<?= $key ?>"><?= $item['label'] ?> <?= $txt_required ?></label>
															<input title="<?= $item['label'] ?>" name="<?= $key ?>" type="<?= $item['type'] ?>" class="<?= $item['type'] === 'file' ? '' : 'form-control' ?>" id="<?= $key ?>" <?php if (isset($item['attr'])) foreach ($item['attr'] as $keyAttr => $attr) : ?> <?= is_numeric($keyAttr) ? $attr : $keyAttr . '="' .	$attr . '"' ?> <?php endforeach ?>>
															<div class="invalid-feedback"></div>
														<?php endif ?>
													</div>
												<?php endforeach ?>
											</div>
										</template>
									<?php endforeach ?>
								</form>
							</div>
						</section>
					</div>
					<?php $index++ ?>
				<?php endforeach ?>
			</div>

			<button x-show="curStep > 0" @click="back()" type="button" class="btn btn-secondary">Kembali</button>
			<button @click="next()" type="button" class="btn btn-primary" x-text="curStep === <?= json_decode(count($steps)) ?> - 1 ? 'Kirim' : 'Lanjut'"></button>
		</div>
	</div>
</div>
