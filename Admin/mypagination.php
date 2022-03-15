<?php
if(!isset($_COOKIE['currentpage'])){
  $_COOKIE['currentpage'] = 1;
}



function paginateAKIN($paged, $num_page, $chpage) {
  for ($page = 1; $page <= $num_page ; $page++) {
      if ($paged == $page) {
        if ($paged == $num_page and $paged == '1') {
          $pagz = $paged;
          echo' <li><button title="Page '.$pagz.'" class="page_num btn btn-primary" data-value ='.$pagz.'>'.$pagz.'</button></li>';
        }
        elseif($paged < $num_page -1) {
          if ($paged != 1) {
            $pagz = $page - ($page-1);
              echo' <li><button title="Page '.$pagz.'" class="page_num btn btn-primary" data-value ='.$pagz.'>'.$pagz.'</button></li> ...';
          }
          if ($_COOKIE['currentpage'] >= $paged) {
            if ($paged == 1 or $paged == 2) {
              $pre = $page + 1;
              $pre2 =$pre + 1;
                echo' <li><button title="Page '.$page.'" class="page_num btn btn-primary" data-value ='.$page.'>'.$page.'</button></li>
                      <li><button title="Page '.$pre.'" class="page_num btn btn-primary" data-value ='.$pre.'>'.$pre.'</button></li>
                      <li><button title="Page '.$pre2.'" class="page_num btn btn-primary" data-value ='.$pre2.'>'.$pre2.'</button></li>
                      ...
                      <li><button title="Page '.$num_page.'" class="page_num btn btn-primary" data-value ='.$num_page.'>'.$num_page.'</button></li>
                ';
            }else {
              $pre = $page - 1;
              $pagg = $page +1;
                echo'
                      <li><button title="Page '.$pre.'" class="page_num btn btn-primary" data-value ='.$pre.'>'.$pre.'</button></li>
                      <li><button title="Page '.$page.'" class="page_num btn btn-primary" data-value ='.$page.'>'.$page.'</button></li>
                      <li><button title="Page '.$pagg.'" class="page_num btn btn-primary" data-value ='.$pagg.'>'.$pagg.'</button></li>
                      ...
                      <li><button title="Page '.$num_page.'" class="page_num btn btn-primary" data-value ='.$num_page.'>'.$num_page.'</button></li>
                ';
            }


          }else {
            $pre = $page + 1;
            $pre2 =$pre + 1;
              echo' <li><button title="Page '.$page.'" class="page_num btn btn-primary" data-value ='.$page.'>'.$page.'</button></li>
                    <li><button title="Page '.$pre.'" class="page_num btn btn-primary" data-value ='.$pre.'>'.$pre.'</button></li>
                    <li><button title="Page '.$pre2.'" class="page_num btn btn-primary" data-value ='.$pre2.'>'.$pre2.'</button></li>
                    ...
                    <li><button title="Page '.$num_page.'" class="page_num btn btn-primary" data-value ='.$num_page.'>'.$num_page.'</button></li>
              ';
          }




        }else {
          if ($paged == $num_page -1){
            $pag = 1;
            $pre2 = $page;
            $pre =$pre2 - 1;
              echo' <li><button title="Page '.$pag.'" class="page_num btn btn-primary" data-value ='.$pag.'>'.$pag.'</button></li>
                    ...
                    <li><button title="Page '.$pre.'" class="page_num btn btn-primary" data-value ='.$pre.'>'.$pre.'</button></li>
                    <li><button title="Page '.$pre2.'" class="page_num btn btn-primary" data-value ='.$pre2.'>'.$pre2.'</button></li>
                    <li><button title="Page '.$num_page.'" class="page_num btn btn-primary" data-value ='.$num_page.'>'.$num_page.'</button></li>
              ';

          }else {
            $pag = 1;
            $pre2 = $page - 1;
            $pre =$pre2 - 1;
              echo' <li><button title="Page '.$pag.'" class="page_num btn btn-primary" data-value ='.$pag.'>'.$pag.'</button></li>
                    ...
                    <li><button title="Page '.$pre.'" class="page_num btn btn-primary" data-value ='.$pre.'>'.$pre.'</button></li>
                    <li><button title="Page '.$pre2.'" class="page_num btn btn-primary" data-value ='.$pre2.'>'.$pre2.'</button></li>
                    <li><button title="Page '.$num_page.'" class="page_num btn btn-primary" data-value ='.$num_page.'>'.$num_page.'</button></li>
              ';
          }


          }
      }




  }

  setcookie("currentpage", $chpage, time() + 60 * 60);
}



 ?>
