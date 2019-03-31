<?php
//dummy parts

//echo $page_id;
?>

<nav aria-label="Page navigation example">
  <ul class="pagination">

<?php 
for($i=1; $i<=$numof_pages; $i++): 
  if($i==$page_id) $active_page = "active";
  else $active_page = "";
  
?>

<?php 
if(abs($i-$page_id)<2 || $i==1 || $i==$numof_pages): 
  $actv = $i;

?>
    <li class="page-item <?php  
    echo $active_page; ?>">
    
    <a class="page-link" href="<?php echo basename($_SERVER['SCRIPT_NAME']); ?>?show_post_page=<?php 
    echo $actv; ?> ">
      <?php echo $actv; ?>
    </a>

    </li>
<?php endif; ?>
<?php endfor; ?>

  </ul>
</nav>