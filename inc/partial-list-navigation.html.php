<div class="pagination">
	<?php 
		$i=0;
		while($i<$pages){
			
			++$i;
			if($i == $current_page){
			?>
				<span><?php echo $i; ?></span>
			<?php
			}else{
				?>
				<a href="./?pg=<?php echo $i;?>"><?php echo $i; ?></a>
				

				<?php
			}	
		}
	?>
</div>