<?php if (!defined('THINK_PATH')) exit(); $config = D("Basic")->select(); $navs = D("Menu")->getBarMenus(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($config["title"]); ?></title>
    <meta name="keywords" content="<?php echo ($config["keywords"]); ?>"/>
    <meta name="description" content="<?php echo ($config["description"]); ?>"/>
    <link rel="stylesheet" href="/wish/Public/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/wish/Public/css/home/main.css" type="text/css" />
</head>
<body>
<header id="header">
    <div class="navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a href="/wish/index.php">
                    <img src="/wish/Public/images/logo.png" alt="">
                </a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li><a href="/wish/index.php" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>首页</a></li>
                <?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><li><a href="/wish/index.php?c=cat&id=<?php echo ($vo["menu_id"]); ?>" <?php if($vo['menu_id'] == $result['catId']): ?>class="curr"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9">
                <div class="news-list">
                    <?php if(is_array($result['listNews'])): $i = 0; $__LIST__ = $result['listNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
                            <dt><?php echo ($vo["title"]); ?></dt>
                            <dd class="news-img">
                                <a target="_blank" href="/wish/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><img width="200" height="120" src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>"></a>
                            </dd>
                            <dd class="news-intro">
                                <?php echo ($vo["description"]); ?>
                            </dd>
                            <dd class="news-info">
                                <?php echo ($vo["keywords"]); ?><span><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></span>阅读(<i news-id="<?php echo ($vo["news_id"]); ?>" class="news_count node-<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["count"]); ?></i>)
                            </dd>
                        </dl><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php echo ($result['pageres']); ?>
                </div>
            </div>
            <!--网站右侧信息-->
            <div class="col-sm-3 col-md-3">
    <div class="right-title">
        <h3>文章排行</h3>
        <span>TOP ARTICLES</span>
    </div>
    <div class="right-content">
        <ul>
            <?php if(is_array($result['rankNews'])): $k = 0; $__LIST__ = $result['rankNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?> curr">
                    <a target="_blank" href="/wish/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["small_title"]); ?></a>
                    <?php if($k == 1): ?><div class="intro">
                            <?php echo ($vo["description"]); ?>
                        </div><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <?php if(is_array($result['adNews'])): $i = 0; $__LIST__ = $result['adNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="right-hot">
            <a target="_blank" href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["thumb"]); ?>" alt=""></a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
        </div>
    </div>
</section>
</body>
</html>