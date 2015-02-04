<?php
if (count($images)>0) {
     /* Display paging info */
?>
<div id="pagination">
<?php
      echo $paginator->prev(); 
      echo $paginator->numbers(array('separator'=>' - ')); 
      echo $paginator->next();
?>
</div>

<table>
<?php
      foreach ($images as $image) {
?>
      <tr>
             <td>
<?php
           echo $html->image($image['Image']['filename']);
?>
            </td>
            <td>
                      <?php echo $image['Image']['title'];?>
            </td>
     </tr>
<?php
      }
?>
</table>
<?php
}
?> 