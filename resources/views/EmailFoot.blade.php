<table cellpadding="0" cellspacing="0" border="0" width="90%" style="width: 90% !important; min-width: 90%; max-width: 90%; border-width: 1px; border-style: solid; border-color: #e8e8e8; border-bottom: none; border-left: none; border-right: none;">
										<tbody>
											<tr>
												<td align="left" valign="top">
													<div style="height: 28px; line-height: 28px; font-size: 26px;">&nbsp;</div>
												</td>
											</tr>
										</tbody>
									</table>
									<table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
										<tbody>
											<tr>
												<td align="left" valign="top">
													<font face="\'Source Sans Pro\', sans-serif" color="#7f7f7f" style="font-size: 17px; line-height: 23px;">
														<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #7f7f7f; font-size: 17px; line-height: 23px;">{{config('settingConfig.email_note')}}</span>
													</font>
													<div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
												</td>
											</tr>
										</tbody>
									</table>
									<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f5f8fa;">
										<tbody>
											<tr>
												<td align="center" valign="top">
													<div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
													<table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
														<tbody>
															<tr>
																<td align="center" valign="top">
																	<table cellpadding="0" cellspacing="0" border="0" width="78%" style="min-width: 300px;">
																		<tbody>
																			<tr>
																				<?php $flinks = AppClass::getPages(config('settingConfig.email_footer_links'));
																				foreach($flinks as $flink) {?>
																				
																				<td align="center" valign="top">
																					<a href="{{url($flink->alias)}}" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
																						<font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
																							<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">{{$flink->title}}</span>
																						</font>
																					</a>
																				</td>
																				<td align="center" valign="top" width="10%"></td>
																				<?php } ?>
																			</tr>
																		</tbody>
																	</table>
																	<div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
																	<font face="\'Source Sans Pro\', sans-serif" color="#868686" style="font-size: 15px; line-height: 20px;">
																		<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #868686; font-size: 15px; line-height: 20px;">                           {{config('sximo.cnf_appname')}}                           <br>                           {{config('settingConfig.email_footer_addr')}}</span>
																		</font>
																		<div style="height: 4px; line-height: 4px; font-size: 2px;">&nbsp;</div>
																		<div style="height: 3px; line-height: 3px; font-size: 1px;">&nbsp;</div>
																		<div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
									<td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
								</tr>
							</tbody>
						</table>
						<!--[if (gte mso 9)|(IE)]>            </td>          </tr>        </table>      <![endif]-->
					</td>
				</tr>
			</tbody>
		</table>