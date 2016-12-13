<?php
$model = new Model();
//$arr_news_hl2 = $model->qry_all_news_by_hl(2);
//$arr_news_hl1 = $model->qry_all_news_by_hl(1);
//$arr_news_hl3 = $model->qry_all_news_by_hl3();
$arr_all_news_new = $this->arr_all_news_new;
//$arr_all_news_hot = $this->arr_all_news_hot;// view nhieu
$arr_all_news_type_feature=$model->qry_all_news_feature();// tieu diem
// tieu noi bat
?>



<div id ="content" class="boxShadow">          
    <div id="featured" class="boxShadow">
        <ul class="images">
            <?php foreach($arr_all_news_type_feature as $arr_single_news_type_feature):?>
            <li><img src="<?php echo SITE_ROOT ?>public/img/news/<?php echo $arr_single_news_type_feature['C_IMG']?>" alt="" />
            </li>
            <?php endforeach; ?>
        </ul>
        <ul class="text">
            <?php foreach($arr_all_news_type_feature as $arr_single_news_type_feature):?>
            <li>
                <a href="<?php echo SITE_ROOT?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_type_feature['PK_NEWS']?>">
                    <h2><?php echo $arr_single_news_type_feature['C_TITLE']?></h2>
                </a>
                <p><?php echo $arr_single_news_type_feature['C_SHORT_CONTENT']?></p>
                <a href="<?php echo SITE_ROOT?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_type_feature['PK_NEWS']?>" class="readmore"><?php echo __('read_continue'); ?></a>
            </li>
            <?php endforeach;?>

        </ul>
    </div><!-- end #featured -->
    
    
    <script type="text/javascript" src="<?php echo SITE_ROOT ?>templates/frontend/js/jquery.scrollerota.min.js"></script>
    <script type="text/javascript">
        $("#featured").scrollerota();
    </script>


    <div id="newNews" class="boxShadow">
        <h2><?php echo __('new_news'); ?></h2>
        <ul>
            
            <?php foreach ($arr_all_news_new as $arr_single_news_new): ?>
                <li>
                    <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_new['PK_NEWS'] ?>" 
                       title="<?php echo $arr_single_news_new['C_TITLE'] ?>">
                        <?php echo $arr_single_news_new['C_TITLE'] ?>
                    </a>        
                </li>
            <?php endforeach; ?>
        </ul>
    </div><!-- end #newnews -->

    <?php foreach ($arr_all_cate as $arr_single_cate): ?>
        <?php if ($arr_single_cate['C_PARENT'] == 0): ?>
            <?php $parent_id = $arr_single_cate['PK_CATE']; ?>
            <div id="floatLeft">
                <div class="mainContent boxShadow">
                    <div class="menu">
                        <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_all_news_cate/?id=<?php echo $arr_single_cate['PK_CATE'] ?>" 
                           title="<?php 
                           if(isset($_SESSION['lang'])&&$_SESSION['lang']=='en'){
                               if($arr_single_cate['C_NAME_EN']==''){
                                   echo $arr_single_cate['C_NAME'];
                               }else{
                                   echo $arr_single_cate['C_NAME_EN'];
                               }
                           }  else {
                               echo $arr_single_cate['C_NAME'];
                           }
                           ?>">
                            <h2><?php if( isset($_SESSION['lang']) && $_SESSION['lang']=='en'){
                                               if( $arr_single_cate['C_NAME_EN']==''){
                                                   echo $arr_single_cate['C_NAME'] ;
                                               }else{
                                                   echo $arr_single_cate['C_NAME_EN'] ;
                                               }
                                           }else{
                                            echo $arr_single_cate['C_NAME'] ;
                                           }
                                            ?>
                            </h2>
                        </a>
                        <ul>
                            <?php foreach ($arr_all_cate as $arr_single_cate2): ?>
                                <?php if ($arr_single_cate2['C_PARENT'] == $parent_id): ?>
                                    <li><a href="<?php echo SITE_ROOT?>frontend/news/dsp_all_news_cate/?id=<?php echo $arr_single_cate2['PK_CATE'] ?>" 
                                           title="
                                           <?php if( isset($_SESSION['lang']) && $_SESSION['lang']=='en'){
                                                                if( $arr_single_cate2['C_NAME_EN']==''){
                                                                    echo $arr_single_cate2['C_NAME'] ;
                                                                }else{
                                                                    echo $arr_single_cate2['C_NAME_EN'] ;
                                                                }
                                                            }else{
                                                             echo $arr_single_cate2['C_NAME'] ;
                                                            }?>
                                           ">
                                             <?php if( isset($_SESSION['lang']) && $_SESSION['lang']=='en'){
                                                                if( $arr_single_cate2['C_NAME_EN']==''){
                                                                    echo $arr_single_cate2['C_NAME'] ;
                                                                }else{
                                                                    echo $arr_single_cate2['C_NAME_EN'] ;
                                                                }
                                                            }else{
                                                             echo $arr_single_cate2['C_NAME'] ;
                                                            }?>
                                        </a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php
                    $arr_single_news_type_hight_light=$model->qry_single_news_hight_light_in_cate($parent_id);
                    $arr_single_news_type_hight_light=!empty($arr_single_news_type_hight_light) 
                        ? $model->qry_single_news_hight_light_in_cate($parent_id) : $model->qry_single_news_hight_light_in_cate_auto($parent_id)?>
                    <?php if(!empty($arr_single_news_type_hight_light)):?>
                    <div class="shortLeft">
                        <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_all_news_cate/?id=<?php echo $arr_single_news_type_hight_light['PK_CATE'] ?>">
                            <img src="<?php echo SITE_ROOT ?>public/img/news/<?php echo $arr_single_news_type_hight_light['C_IMG']?>" alt="" /></a>
                        <div class="shortLeftContent">
                            <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_type_hight_light['PK_NEWS']?>">
                                <h3>
                                <?php echo $arr_single_news_type_hight_light['C_TITLE'];?>
                                </h3></a>
                            <p><?php echo $arr_single_news_type_hight_light['C_SHORT_CONTENT'];?></p>                
                        </div>
                        <p class="more">&raquo;<a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_type_hight_light['PK_NEWS']?>"><?php echo __('continue') ?></a></p> 
                    </div>
                    <?php endif;?>
                    <ul class="listOther">
                        <?php $arr_all_news_in_cate=$model->qry_all_news_in_cate($parent_id)?>
                        <?php foreach ($arr_all_news_in_cate as $arr_single_news_in_cate): ?>
                        <li>&raquo; <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_in_cate['PK_NEWS']?>" 
                                       title="<?php echo $arr_single_news_in_cate['C_TITLE']?>">
                                <?php echo $arr_single_news_in_cate['C_TITLE']?></a></li>
                        <?php endforeach; ?>
                    </ul>

                </div><!-- end #mainContent -->
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div><!-- end #content -->
<div class="clear"></div>