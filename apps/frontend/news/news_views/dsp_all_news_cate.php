<?php

$arr_all_news_cate = $this->arr_all_news_cate;
?>

<div  class="boxShadow" id="lMain"">
    <div class="hl3" >
        <?php foreach ($arr_all_news_cate as $arr_single_news_cate) { ?>
        <div class="lSecondItem">       
            <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_cate['PK_NEWS'] ?>">
                <img src="<?php echo SITE_ROOT ?>/public/img/news/<?php echo $arr_single_news_cate['C_IMG'] ?>" alt="" />
            </a>
            <div>
                <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_cate['PK_NEWS'] ?>">
                    <h3><?php echo $arr_single_news_cate['C_TITLE'] ?></h3>
                </a><span class="time">( <?php echo date_create($arr_single_news_cate['C_DATE'])->format('d-m-Y') ?>)</span>
                <p><?php echo $arr_single_news_cate['C_SHORT_CONTENT']?></p>
            </div>      
        
         </div><!-- end .lSecondItem -->

        
        <?php } ?>
        <p class="pager">
                <?php
                $sotrang = $this->sotrang;
                $prev = $this->prev;
                $next = $this->next;
                if ($prev != -1) {
                    echo "<a class='pager' href='?id={$this->cate_id}&p={$next}'>Previous</a>";
                } else {
                  //  echo "<a class='pager'>Previous</a>";
                }
                for ($page = 1; $page <= $sotrang; $page++) {

                    echo "<a class='pager' href='?id={$this->cate_id}&p={$page}' class='pager_tuyen'>$page</a>";
                }
                if ($next != -1) {
                    echo "<a class='pager' href='?id={$this->cate_id}&p={$next}'>Next</a>";
                } else {
                   // echo "<a class='pager' disabled >Next</a>";
                }
                ?>
            </div>
        </p>
</div> 