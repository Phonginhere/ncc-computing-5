 <div class="clear">
 </div>
 </div>
 <div class="clear">
 </div>
 <?php
    $cglist = $cg->show_config();
    if ($cglist) {
        $i = 0;
        while ($result = $cglist->fetch_assoc()) {
    ?>
         <div id="site_info">
             <p>
             <?= $result['copyright_text'] ?>
             </p>
         </div>
 <?php
        }
    }
    ?>
 </body>

 </html>