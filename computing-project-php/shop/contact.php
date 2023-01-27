<?php 
	include 'inc/header.php';

 ?>

 <div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<h3>Live Support</h3>
  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
  				<p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
  			</div>
  				<img src="web/images/contact.png" alt="" />
  			<div class="clear"></div>
  		</div>
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Contact Us</h2>
					    <form>
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" value=""></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" value=""></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" value=""></span>
						    </div>
						    <div>
						    	<span><label>SUBJECT</label></span>
						    	<span><textarea> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT"></span>
						  </div>
					    </form>
				  </div>
  				</div>
				<div class="col span_1_of_3">
				<?php
				$cglist = $cg->show_config();
				if ($cglist) {
					$i = 0;
					while ($result = $cglist->fetch_assoc()) {
				?>
      			<div class="company_address">
				     	<h2>Company Information :</h2>
						   		<p>Address: <?=$result['address']?></p>
				   		<p>Phone: <?=$result['fax_num']?></p>
				   		<p>Fax: <?=$result['fax_num']?></p>
				 	 	<p>Email: <span><a href="mailto:<?=$result['social_mail']?>"><?=$result['social_mail']?></a></span></p>
				   		<p>Follow on: 
							<?php 
							if($result['social_pinterest']){
								?><a href="https://www.pinterest.com/<?=$result['social_pinterest']?>" target="_blank">Pinterest</a>, <?php
							}
							if($result['social_facebook']){
								?><a href="https://www.facebook.com/<?=$result['social_facebook']?>" target="_blank">Facebook</a>, <?php
							} 
							if($result['social_twitter']){
								?> <a href="https://www.twitter.com/<?=$result['social_twitter']?>" target="_blank">Twitter</a> <?php
							} 
							?>
						</p>
				   </div>
				   <?php
					}
				}
				?>
				 </div>
			  </div>    	
    </div>
 </div>
 <?php 
	include 'inc/footer.php';

 ?>