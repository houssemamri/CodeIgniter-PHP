<?php include("blog_connection.php");?>		
<?php
$sql = "select * from posts";
$query = mysqli_query($blog_conn,$sql);
?>


		
		<div class="container">
			<div id="ca-container" class="ca-container">
				<div class="ca-wrapper">
	<?php
	while($row = mysqli_fetch_assoc($query)){ ?>			
					<div class="ca-item ca-item-1">
						<div class="ca-item-main">
							<div class="caa-icon">
							<img class="img-responsive" src="https://review-thunder.com/blog/<?php echo $row['Mainimage'];?>" alt="" />
							</div>
							<div class="text-blog">
							<h3><?php echo $row['Title'];?></h3>
							<h4>
							
								<span><?php echo mb_strimwidth($row['Content_English'], 0, 40, '...'); ?></span>
							</h4>
								<!--<a href="#" class="ca-more">more...</a>-->
							</div>
						</div>
						<div class="ca-content-wrapper">
							<div class="ca-content">
								<h6><?php echo $row['Title'];?></h6>
								<a href="#" class="ca-close">close</a>
								<div class="ca-content-text">
									<p><?php echo $row ['Content_English'];?></p>
								</div>
							<!--	<ul>
									<li><a href="#">Read more</a></li>
									<li><a href="#">Share this</a></li>
									<li><a href="#">Become a member</a></li>
									<li><a href="#">Donate</a></li>
								</ul>-->
							</div>
						</div>
					</div>
<?php	}
?>			
				</div>
			</div>
		</div>
		
		
		

		
		
		