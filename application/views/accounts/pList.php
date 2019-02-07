
						<?php 

					
							
							$pre_date=date('Y-m-d',strtotime($start.' - 1 days'));	
							$pre_pur_sale_amount=$this->report_model->getPreTransactionForPl($pre_date,$lastDate,$mainCol,$type1,$col,$col_head,$type2,$col2,$col_head2);
							
							
							
							
							
						
							
							$pList=$this->report_model->getProductClosingList($start,$lastDate,$mainCol,$type1,$col,$col_head,$type2,$col2,$col_head2);
							$gross_total=0;
							foreach($pList as $product){
								
									$am=$product["tamount"];
								
									if($mainCol == "qun")
									{
										$price=$this->report_model->getLastPrice('product',$start,$lastDate,$product['ITEM']);
										$am=$product["tamount"] * $price;
										
										
									}
										$gross_total=$gross_total + $am;
								
								?>
								
									<tr>
									
									
										<td style="text-align:left;"><?php echo $product["ITEM"] ?></td>
										<td style="border-right:1px solid;border-left:1px solid"><?php echo $am  ?></td>
									
									</tr>
								
								<?php
							}
						
						
						/*	$tp=0;
							$ts=0;
							if($class == "gpurchase")
								$tp=$gross_total;
							else
								$ts=$gross_total;
								
							*/

						?>
						
						
						<input readonly style="display:none;" class="form-control <?php echo $class ?>" value="<?php echo (float)$gross_total ?>"/>
						<input readonly style="display:none;" class="form-control <?php echo $class."1" ?>" value="<?php echo (float)$pre_pur_sale_amount ?>"/>