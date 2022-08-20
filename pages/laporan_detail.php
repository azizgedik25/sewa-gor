							<tr>
								<td colspan="8"> 
									<span class="pull-right"><h4>Total Pendapatan :
										<?php
										  $sum = mysqli_query($conn,"SELECT SUM(tot) as jumlah FROM booking WHERE status='sudah'");
										  $hasil = mysqli_fetch_array($sum);
										  echo "Rp. ".$hasil['jumlah'].",-";
										?></h4>
									</span>
								</td>
							</tr>