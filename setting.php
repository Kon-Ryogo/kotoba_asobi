<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <title>ことばあそび</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <div class="header-contents item">
                <h1>ことばあそび</h1>
                <h2>設定</h2>
            </div>
        </header>
        
        <div class="main-wrapper">
            <a class="setting_botton back_botton" onclick="sound_push();href_sound('index.html')">戻る</a>
            <a class="setting_botton add_botton" onclick="sound_push();href_sound('add.php')">追加</a>

            <?php
            try
            {
                require_once('./common/common.php');
                $dbh=mondaidb();

                if(isset($_REQUEST['page'])&&is_numeric($_REQUEST['page']))
                {
                    $page=$_REQUEST['page'];
                }
                else
                {
                    $page=1;
                }

                $start=6*($page-1);
                $sql='SELECT code,kotoba,gazou FROM mondai WHERE 1 ORDER BY code LIMIT ?,6';
                $stmt=$dbh->prepare($sql);
                $stmt->bindParam(1,$start,PDO::PARAM_INT);
                $stmt->execute();

                $dbh=null;

                print'<form method="post" action="branch.php">';
                
                print'<input type="submit" name="disp" value="参照" class="setting_botton form_botton" onclick="sound_push();sound_chien()">';
                print'<input type="submit" name="edit" value="修正" class="setting_botton form_botton" onclick="sound_push();sound_chien()">';
                print'<input type="submit" name="delete" value="削除" class="setting_botton form_botton" onclick="sound_push();sound_chien()">';
                
                print'<div class="mondai_mainbox">';
                while(true)
                {
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

                    if($rec==false)
                    {
                        break;
                    }

                    $gazou_name=$rec['gazou'];
                    print'<div class="mondai_box">';
                    print'<label onclick="sound_push()"><img src="./gazou/'.$gazou_name.'" class="setting_gazou" >';
                    print'<div class="gazou_name">'.'<input type="radio" name="code" id="label" value="'.$rec['code'].'">'.$rec['kotoba'].'</label></div>';
                    print'</div>';
                }
                print'</div>';
                print'</form>';
            }

            catch(Exception $e)
            {
                print'ただいま障害により大変ご迷惑をおかけしております。';
                exit();
            }

            ?>
            
            <div class="center">
                <section>
                    <div class="home-content">
                        <!-- ページング -->
                        <div class="paging">
                            <?php if($page>=2):?>
                                <a onclick="sound_push();href_sound('setting.php?page=<?php print($page-1);?>')" class="title-button"><?php print($page-1);?>ページ目へ</a>
                            <?php endif;?>
                            |
                            <?php
                            require_once('./common/common.php');
                            $db=mondaidb();
                            $counts=$db->query('SELECT COUNT(*) as cnt FROM mondai');
                            $count=$counts->fetch();
                            $max_page=floor($count['cnt']/6)+1;
                            if($count['cnt']%6==0)
                            {
                                $max_page=$max_page-1;
                            }
                            $next_page=$count['cnt'];
                            //print$next_page;
                            if($page<$max_page):
                            ?>
                            <a onclick="sound_push();href_sound('setting.php?page=<?php print($page+1);?>')" class="title-button"><?php print($page+1);?>ページ目へ</a>
                            <?php endif;?>
                        </div>
                        <!-- /ページング -->
                        
                    </div><!-- /.home-content -->
                </section>
            </div><!-- /.center -->
        </div><!-- /.main-wrapper -->
        <footer>日本工業大学　先進工学部　情報メディア工学科　シュガーマンズ</footer>
        <audio id="push" preload="auto">
            <source src="sounds/push.mp3" type="audio/mp3">
            <source src="sounds/push.wav" type="audio/wav">
        </audio>
        <script src="script.js"></script>

    </body>
</html>
