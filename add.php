<?php
    session_start();
?>
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
                <h2>追加</h2>
            </div>
        </header>
        <div class="main-wrapper">
            <?php
            if(isset($_POST['gazou_name']))
            {
                $gazou_name=$_POST['gazou_name'];
                if(isset($_SESSION['add_back']))
                {
                    if(isset($_SESSION['add_back_existing']))
                    {
                        if($_SESSION['add_back_existing']==0)
                        {
                            $result_gazou_name=glob('./gazou/'.$gazou_name);
                            if(isset($result_gazou_name)&&$_SESSION['add_back']==1)
                            {
                                unlink('./gazou/'.$gazou_name);

                                $_SESSION['add_back']=0;
                            }
                            else
                            {
                                $_SESSION['add_back']=0;
                            }
                        }
                    }
                }
                if(isset($_SESSION['add_back_existing']))
                {
                    $_SESSION['add_back_existing']=0;
                }
            }
            
            ?>
            <a class="title-button" onclick="sound_push();href_sound('setting.php')">戻る</a>
            <div class="add-content">
                <p class="mondai">問題追加</p><br />
                <br />
                <form class="form-style" accept="image/*" method="post" action="add_check.php" enctype="multipart/form-data">
                    画像を選択してください。<br />
                    ※２MBより小さいサイズの画像を選択してください。<br />
                    <input type="file" accept="image/*" name="gazou" style="width:425px"><br />
                    <br />
                    言葉を入力してください。<br />
                    <input type="text" name="kotoba" style="width:220px"><br />
                    <br />
                    <br />
                    <input type="submit" value="OK" class="button">
                </form>
            </div>
                
            <?php
                /*echo ini_get('upload_max_filesize');
                echo'<br />';
                echo ini_get('post_max_size');
                echo'<br />';
                echo ini_get('memory_limit');*/
            ?>
        </div>
        <footer>日本工業大学　先進工学部　情報メディア工学科　シュガーマンズ</footer>
        <audio id="push" preload="auto">
            <source src="sounds/push.mp3" type="audio/mp3">
            <source src="sounds/push.wav" type="audio/wav">
        </audio>
        <script src="script.js"></script>

    </body>
</html>
