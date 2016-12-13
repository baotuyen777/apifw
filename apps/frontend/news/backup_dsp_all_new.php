<!--<div>
            <div class="content_left">
                 hl2 
<?php if (!empty($arr_news_hl2)) { ?>
                        <div style=" border: 1px solid #ffffcc;">
                            <div style="padding: ">
                                <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_news_hl2['PK_NEWS'] ?>">
                                <img src="<?php echo SITE_ROOT ?>/public/img/news/<?php echo $arr_news_hl2['C_IMG']; ?>" height="100"/>
                                </a>
                            </div>
                            <div style="background-color: #999999;font-weight: bold;color:white">
                                <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_news_hl2['PK_NEWS'] ?>">
    <?php echo $arr_news_hl2['C_TITLE']; ?></a>
                                <br>
                            </div>
                        </div>
<?php } ?>
                end hl2 
                <div>
                    <div class="left_title">TIN HOT TRONG NGÀY</div>
                    <div class="left_content">
                        <ul >
<?php foreach ($arr_all_news_hot as $arr_single_news_hot) { ?>
                                    <li><a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_hot['PK_NEWS'] ?>"><?php echo $arr_single_news_hot['C_TITLE'] ?></a></li>
<?php } ?>
                        </ul>

                    </div>
                </div>
                <div>
                    <div class="left_title">TIN MỚI TRONG NGÀY</div>
                    <div class="left_content">
                        <ul >
<?php foreach ($arr_all_news_new as $arr_single_news_new) { ?>
                                    <li><a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_new['PK_NEWS'] ?>"><?php echo $arr_single_news_new['C_TITLE'] ?></a></li>
<?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
             begin Cot giua 
            <div class="content_right">
<?php if (!empty($arr_news_hl1)) { ?>
                        <div style=" border: 1px solid orange;">
                            <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_news_hl1['PK_NEWS'] ?>">
                                <img src="<?php echo SITE_ROOT ?>/public/img/news/<?php echo $arr_news_hl1['C_IMG'] ?>" width="100%"/>
                            </a>
                            <div class="title_right_hl">
                                <p  style="font-weight:bold;font-size: 20px; color: #bb3914;padding: 5px;"><a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_news_hl1['PK_NEWS'] ?>">
    <?php echo $arr_news_hl1['C_TITLE'] ?></a>
                                </p>
                                <p>
    <?php echo $arr_news_hl1['C_SHORT_CONTENT'] ?>
                                </p>
                            </div>
                        </div>
<?php } ?>
                <div class="hl3" >
<?php foreach ($arr_news_hl3 as $arr_single_news_hl3) { ?>
                            <div style="float: left; width: 45%; height: 170px; margin: 10px; font-weight: bold; color: #878787; border: 0px solid red;">
                                <div style="overflow: hidden; height: 110px;">
                                <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_hl3['PK_NEWS'] ?>">
                                    <img src="<?php echo SITE_ROOT ?>/public/img/news/<?php echo $arr_single_news_hl3['C_IMG'] ?>" width="90%" height="20px" />
                                </a>
                                </div>
                                <p><a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_hl3['PK_NEWS'] ?>">
    <?php echo $arr_single_news_hl3['C_TITLE'] ?>
                                    </a>
                                </p>
                            </div>
<?php } ?>
                    <div class="clr"></div>
                </div>
            </div>
            end Cot giua 
</div> -->
