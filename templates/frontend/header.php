<!-- Copyright 2013: design & programming by Hong Van -->
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo __('title') ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="Hong Van" />
        <meta name="dcterms.rightsHolder" content="tinviet.juplo.com" />
        <meta name="dcterms.dateCopyrighted" content="2013" />
        <meta name="designer" content="Hong Van" />
        <meta name="description" content="Tin tức Online, đưa tin chính xác, cập nhật từng giây, nội dung phong phú, đa dạng, tin tức thế giới, quốc phòng, chính trị - xã hội, giáo dục ,đời sống, giới trẻ" />
        <meta name="keywords" content="tin tức, online, đăng tin, chính xác, cập nhật, nội dung, phong phú, đa dạng, quốc phòng, thế giới, giáo dục, giới trẻ, chính trị, xã hội" />
        <link rel="canonical" href="http://www.tinviet.juplo.com/" />
        <link rel="Shortcut Icon" href="images/fav.png" type="image/x-icon" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT ?>templates/frontend/css/style_1.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT ?>templates/frontend/css/jquery-ui.css" />
        <script type="text/javascript" src="<?php echo SITE_ROOT ?>templates/frontend/js/functions.js"></script> 
        <script type="text/javascript" src="<?php echo SITE_ROOT ?>templates/frontend/js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?php echo SITE_ROOT ?>templates/frontend/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo SITE_ROOT ?>templates/frontend/js/poll.js"></script>
        <script type="text/javascript" src="<?php echo SITE_ROOT ?>templates/frontend/js/newsScroller.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $( ".datepicker" ).datepicker({
                    showOn: "button",
                    buttonImage: "images/calendar.gif",
                    dateFormat:"yy-mm-dd",
                    buttonImageOnly: true
                });
                $('#wrapper').append('<div id="toTop">Back to Top</div>');
                $(window).scroll(function() {
                    if($(window).scrollTop() != 0) {
                        $('#toTop').fadeIn();
                    } else {
                        $('#toTop').fadeOut();
                    }
                });
                $('#toTop').click(function() {
                    $('html, body').animate({scrollTop:0},500);
                });
                $('a.tab').click(function(){
                    $('.active').removeClass('active');
                    $(this).addClass('active');
                    $('.ctn').hide();
                    var content_show = $(this).attr('title');
                    $('.' + content_show).fadeIn(500);
                });
                $('.parentNav li').hover(function(){
                    $(this).find('ul:first').css({visibility: 'visible', display: 'none'}).slideDown(700);
                }, function(){
                    $(this).find('ul:first').css({visibility: 'hidden'});
                });
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $(".feed").jCarouselLite({
                    vertical: true,
                    visible: 5,
                    auto:3000,
                    speed:1000
                });
            });
        </script>
        <style type="text/css">
            /*        * { margin: 0; padding: 0;}*/
            #wrapper_feed {
                width: 250px;
                margin: 10px;
            }

            #feedHeader {
                background: #a4a4a4;
                padding: 5px;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 18px;
            }
        </style>
    </head>
    <body onload="showTime()">
        <div id="fb-root"></div>
        <script>/*(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));*/</script>
        <div id="wrapper">
            <div id="header">
                <div id="toplink">
                    <p id="dateTime"></p>
                    <p class="sysNav"> 
                    <ul  class="parentNav">
                    </ul>
                    </p>
                    &nbsp;
                </div><!-- end #toplink -->
                <div id="banner">
                    <div  style="float: left">
                    <a href="index.php"><img src="<?php echo SITE_ROOT ?>templates/frontend/img/logo2.png" 
                                             width="200" title="News Live" alt="News Live logo" /></a>
                        </div>
                     
                    <div style="float: right;"> 
                      <?php $model_obj = new Model();
                       $arr_single_adv=$model_obj->qry_single_adv(1);
                       ?>
                        <a href="<?php if(isset($arr_single_adv['C_LINK'])) echo $arr_single_adv['C_LINK'] ?>" title="<?php if(isset($arr_single_adv['C_TITLE'])) echo $arr_single_adv['C_TITLE'] ?>">
                        <img src="<?php echo SITE_ROOT ?>public/img/adv/<?php echo $arr_single_adv['C_IMG'] ?>"
                             alt="anh quang cao" width="700" /></a>
                    </div>
                    <div class="clear"></div>
                </div><!-- end #banner -->
                <div id="mainNav">
                    <ul class="parentNav">
                        <li><a href="<?php echo SITE_ROOT ?>frontend/news" title="Trang chủ"><?php echo __('home') ?></a></li>
                        <?php
                        $model = new Model();
                        $arr_all_cate = $model->qry_all_category();
                        foreach ($arr_all_cate as $arr_single_cate):
                            if ($arr_single_cate['C_PARENT'] == 0):
                                ?>
                                <li><a href="<?php echo SITE_ROOT ?>frontend/news/dsp_all_news_cate/?id=<?php echo $arr_single_cate['PK_CATE'] ?>" 
                                       title="<?php 
                                        if (isset($_SESSION['lang'])&&$_SESSION['lang']=='en'){
                                            if ($arr_single_cate['C_NAME_EN']==''){
                                                echo $arr_single_cate['C_NAME'];
                                            }else{
                                                echo $arr_single_cate['C_NAME_EN'];
                                            }
                                        }  else {
                                            echo $arr_single_cate['C_NAME'];
                                        }
                                       ?>">
                                           <?php
                                           if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
                                               if ($arr_single_cate['C_NAME_EN'] == '') {
                                                   echo $arr_single_cate['C_NAME'];
                                               } else {
                                                   echo $arr_single_cate['C_NAME_EN'];
                                               }
                                           } else {
                                               echo $arr_single_cate['C_NAME'];
                                           }
                                           ?>
                                    </a>
                                    <?php
                                    $parent_id = $arr_single_cate['PK_CATE'];
                                    ?>
                                    <ul class="childNav">
                                        <?php
                                        foreach ($arr_all_cate as $arr_single_cate2):
                                            if ($arr_single_cate2['C_PARENT'] == $parent_id):
                                                ?>
                                                <li><a href="<?php echo SITE_ROOT ?>frontend/news/dsp_all_news_cate/?id=<?php echo $arr_single_cate2['PK_CATE'] ?>" 
                                                       title="<?php
                                                        if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
                                                            if ($arr_single_cate2['C_NAME_EN'] == '') {
                                                                echo $arr_single_cate2['C_NAME'];
                                                            } else {
                                                                echo $arr_single_cate2['C_NAME_EN'];
                                                            }
                                                        } else {
                                                            echo $arr_single_cate2['C_NAME'];
                                                        }
                                                        ?>">
                                                        <?php
                                                        if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
                                                            if ($arr_single_cate2['C_NAME_EN'] == '') {
                                                                echo $arr_single_cate2['C_NAME'];
                                                            } else {
                                                                echo $arr_single_cate2['C_NAME_EN'];
                                                            }
                                                        } else {
                                                            echo $arr_single_cate2['C_NAME'];
                                                        }
                                                        ?>
                                                    </a>
                                                </li>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </ul>
                                </li>

                                <?php
                            endif;
                        endforeach;
                        ?>
                        <li>
                            <?php
                            $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : "vi";
                            if ($lang == 'vi') {
                                ?>
                                <a>Tiếng việt</a>
                                <?php
                            } elseif ($lang = 'en') {
                                ?>
                                <a>English</a>
                                <?php
                            } else {
                                echo ' <a>Tiếng việt</a>';
                            }
                            ?>
                            <ul class="childNav">
                                <li><a href="<?php echo SITE_ROOT ?>frontend/news/set_lang/?lang=en">Engligh</a></li>
                                <li><a href="<?php echo SITE_ROOT ?>frontend/news/set_lang/?lang=vi">Tiếng Việt</a></li>
                            </ul>
                        </li>
                    </ul>

                </div><!-- end mainNav -->
            </div><!-- end #header -->




            <div id="sidebar" class="boxShadow">
                <div id="topRightAdv" class="boxShadow">
                    <form action="<?php echo SITE_ROOT ?>frontend/news/dsp_list_all_news">
                        <input type="text" name="search" />
                        <input type="submit" value="<?php echo __('search') ?>" />
                    </form>
                </div><!-- end #topRightAdv -->
                <div id="topRight1">

                </div>
                <div id="topRight2">

                </div>
                <div id="topRight3">

                </div>
                <div class="item">
                    <!--<h2>Like me on Facebook</h2>-->
                    <div class="fb-like-box" data-href="http://www.facebook.com/tinvietnews" data-width="280" data-height="320" data-show-faces="true" data-stream="false" data-border-color="#ffffff" data-header="false"></div>
                    <h2><?php echo __('image_news') ?></h2>
                    <div class="imgNews1">
                        <?php $arr_news_image_hl = $model->qry_all_news_image(1) ?>
                        <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_news_image_hl['PK_NEWS'] ?>">
                            <h3><?php echo $arr_news_image_hl['C_TITLE'] ?></h3></a>
                        <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_news_image_hl['PK_NEWS'] ?>">
                            <img src="<?php echo SITE_ROOT ?>public/img/news/<?php echo $arr_news_image_hl['C_IMG'] ?>" /></a>
                    </div>
                    <ul class="itemx">
                        <?php foreach ($model->qry_all_news_image() as $arr_single_news_image): ?>
                            <li><a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_image['PK_NEWS'] ?>">
                                    <?php echo $arr_single_news_image['C_TITLE'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="item">
                    <h2><?php echo __('most_view') ?></h2>
                    <div class="itemx mostViews ctn">
                        <?php
                        $arr_all_news_hot = $model->qry_all_news_hot();
                        foreach ($arr_all_news_hot as $arr_single_news_hot):
                            ?>
                            <p> 
                                <img src="<?php echo SITE_ROOT ?>public/img/news/<?php echo $arr_single_news_hot['C_IMG'] ?>" alt="" />
                                <a href="<?php echo SITE_ROOT ?>frontend/news/dsp_content_news/?id=<?php echo $arr_single_news_hot['PK_NEWS'] ?>">
                                    <?php echo $arr_single_news_hot['C_TITLE'] ?></a>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="">
                    <?php //rss
                    $feed = new SimplePie();//thư viện có sẵn giúp xử lý rss
                    $feed->set_feed_url('http://vnexpress.net/rss/du-lich.rss');
                    if($lang=='en'){
                        $feed->set_feed_url('http://vietnamnews.feedsportal.com/c/35237/f/655031/index.rss');
                    }
                    //set up cache
                    $feed->enable_cache(false);
                    $feed->set_cache_duration(3600);
                    $feed->set_cache_location(SITE_ROOT . 'libs/simplePie/cache/');
                    //start the process
                    $feed->init();
                    $feed->handle_content_type();
                    ?>
                    <div id="wrapper_feed">
                        <div id="feedHeader">
                            <p><?php echo $feed->get_title(); ?></p>
                            <!--<p><?php echo $feed->get_description(); ?></p>-->
                        </div><!--end #header-->
                        <div class="feed">
                            <ul>
                                <?php foreach ($feed->get_items(0, 5) as $item): ?>
                                    <?php $feed = $item->get_feed(); ?>
                                    <li class="entry">
                                        <h1><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h1>
                                        <p><?php echo $item->get_content(); ?></p>
                                        <?php echo $item->get_date(); ?>
                                        <p>Source:
                                            <img src="<?php echo $feed->get_favicon(); ?>" alt="<?php echo $feed->get_title(); ?>" border="0" width="16" height="16" /> <?php echo $feed->get_title(); ?>
                                        </p>
                                        <p>Copyright: <?php echo $feed->get_copyright(); ?>

                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div><!--End #wrapper-->
                </div>

                <!--widget -->
                <iframe frameborder="0" height="350" marginheight="0" marginwidth="0" scrolling="no" 
                        src="http://www.thienduongweb.com/tool/weather/?size=270&amp;fsize=12&amp;bg=images/bg.png&amp;repeat=repeat-x&amp;r=1&amp;w=1&amp;g=1&amp;col=1&amp;d=0" width="260"></iframe>
                        
                <!-- end widget -->
                
                <!--adv2-->
                <div class="item">
                    <?php $arr_single_adv2=$model_obj->qry_single_adv(2);?>
                    <a href="<?php echo $arr_single_adv2['C_LINK'] ?>" title="<?php echo $arr_single_adv2['C_TITLE'] ?>">
                        <img src="<?php echo SITE_ROOT ?>public/img/adv/<?php echo $arr_single_adv2['C_IMG'] ?>"
                             alt="anh quang cao" width="280"/></a>
                </div>
                <!--end adv2-->

<!--                <div id="poll" class="item hidden">
                    <h2>Thăm Dò Ý Kiến</h2>
                    <h3></h3>

                    <div>
                        <button id="submitPoll">Biểu quyết</button>
                        <button onclick="openWindow('sites/poll/result.php?id=','')">Kết quả</button>
                    </div>
                </div>-->
                <div id="advSidebar">

                </div>
                <div id="advSidebar">

                </div>
                <div id="advSidebar">

                </div>
            </div><!-- end #sidebar --> 