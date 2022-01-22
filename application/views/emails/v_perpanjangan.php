<div style="padding:0;margin:0;width:100%!important;background-color:#ffffff" bgcolor="#FFFFFF">
	<table width="100%" cellpadding="30" border="0" cellspacing="0">
		<tbody>
			<tr>
				<td align="center" bgcolor="#eeeeee">
					<table width="660" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF" style="border-radius:6px">
						<tbody>
							<tr>
								<td style="border-radius:5px">

									<table width="600" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="center" id="m_-2546716786083846732content-5" style="padding:40px 0">
													<img src="<?= base_url('assets/images/logo.png') ?>" alt="Sigenajo" border="0" style="width:150px">
												</td>
											</tr>
										</tbody>
									</table>
									<table width="600" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="center" style="padding-bottom:60px;font-size:14px;font-family:Helvetica,Arial,Verdana sans-serif" id="m_-2546716786083846732content-5">
													<div>
														<table align="center" style="margin-top:30px;margin-bottom:30px;color:#1a1a1a">
															<tbody>
																<tr>
																	<td align="center">
																		<p style="font-size:28px;line-height:48px;margin-top:0px;margin-bottom:20px"><b><?= $title ?></b></p>
																	</td>
																</tr>


																<tr>
																	<td>
																		<?php foreach ($data as $key => $val) : ?>
																			<div style="margin-bottom: 1rem;">
																				<label for=""><?= M_Perpanjangan::get_label($key) ?></label>
																				<input style="display: block;width: 100%;height: calc(1.5em + 0.75rem + 2px);padding: 0.375rem 0.75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;" type="text" value="<?= $val ?>" readonly>
																			</div>
																		<?php endforeach ?>
																		<br>
																	</td>
																</tr>
																<tr>
																	<td>
																		<?php foreach ($files as $key => $val) : ?>
																			<div style="margin-bottom: 1rem;">
																				<a target="_blank" href="<?= base_url(MyFiles::$perpanjangan . '/' . $val) ?>"><?= M_Perpanjangan::get_label($key) ?></a>
																			</div>
																		<?php endforeach ?>
																		<br>
																	</td>
																</tr>
																<?php if ($is_admin) : ?>
																	<tr>
																		<td align="center">
																			<p><?= $text ?></p>
																		</td>
																	</tr>

																	<tr>
																		<td align="center">
																			<a href="<?= $link ?>" rel="noopener noreferrer" style="font-family:Verdana,Sans-Serif;background-color:#492682;border-radius:3px;color:#ffffff;display:inline-block;font-size:14px;line-height:50px;text-align:center;text-decoration:none;width:300px;margin-top:20px;margin-bottom:20px" target="_blank"><strong>Download Berkas</strong></a>
																		</td>
																	</tr>
																<?php endif ?>
															</tbody>
														</table>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<hr style="border:1px solid #ededed">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>