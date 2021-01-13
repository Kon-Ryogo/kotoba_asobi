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
                <h2>修正</h2>
            </div><!-- /.header-contents -->
        </header>

        <?php
            require_once('./common/common.php');

            $post=sanitize($_POST);
            $code=$post['code'];
        ?>
        <div class="main-wrapper">
            <form method="post" action="edit.php">
                <?php 
                    $_SESSION['edit_back']=1;
                    $gazou_name_str=strlen($_FILES['gazou']['name']);
                    if($gazou_name_str>0)
                    {
                        print'<input type="hidden" name="gazou_name" value="'.$_FILES['gazou']['name'].'">';
                    }
                ?>
                <input type="hidden" name="code" value="<?php print$code; ?>">
                <input class="title-button" type="submit" value="戻る" style="margin-top:-10px;" onclick="sound_push();sound_chien()">
            </form>
            <div class="add-content">
                <p class="mondai" style="margin-top:35px;">問題修正</p><br />
            </div>
            <div class="center">
                <section>
                    <div class="home-content">
                    <?php
                    $gazou_name_old=$post['gazou_name_old'];
                    $gazou=$_FILES['gazou'];
                    $kotoba=$post['kotoba'];

                    if($gazou['name']!='')
                    {
                        $result_gazou_name=glob('./gazou/'.$gazou['name']);
                        $flag=true;
                    }
                    
                    if($gazou['size']==0)
                    {
                        print'<img src="./gazou/'.$gazou_name_old.'" style="margin-top:-500px; height:200px;">';
                        print'<br/>';
                        $frag=1;
                    }
                    else if(count($result_gazou_name)!=0)
                    {
                        print'<div class="form-style">この画像は既に追加されています。</div><br /><br />';
                        print'<div class="form-style">別の画像を選択してください。</div><br /><br />';
                        $_SESSION['edit_back_existing']=1;
                        
                    }
                    else
                    {
                        if($gazou['size']>=2000000)
                        {
                            print'<img src="./gazou/'.$gazou_name_old.'" style="margin-top:-500px; height:200px;">';
                            print'<br/>';
                            print'<div class="form-style">２MBより小さいサイズの画像を選択してください。</div><br /><br />';
                            $frag=1;
                        }
                        else
                        {
                            move_uploaded_file($gazou['tmp_name'],'./gazou/'.$gazou['name']);
                            print'<img src="./gazou/'.$gazou['name'].'" style="margin-top:-500px; height:200px;">';
                            print'<br/>';
                        }
                    }
                    
                    if($kotoba=='')
                    {
                        print '<br /><div class="form-style" style="margin-top:20px">言葉が入力されていません。</div><br />';
                    }
                    else
                    {
                        print '<div class="container">';
                        $kotoba_check=preg_split("//u", $kotoba, -1, PREG_SPLIT_NO_EMPTY);
                        for($i=0;$i<count($kotoba_check);$i++)
                        {
                            print '<h1 class="item_a">'.$kotoba_check[$i].'</h1>';
                        }
                        print '</div>';
                        print '<br />';
                    }
                    
                    if(isset($result_gazou_name))
                    {
                        $flag=count($result_gazou_name);
                    }
                    else
                    {
                        $flag=false;
                    }

                    if($kotoba==''||$_SESSION['edit_back_existing']==1||$flag!=0)
                    {
                        print'<form></form>';
                    }
                    else
                    {
                        if(isset($gazou['name'])==false)
                        {
                            $gazou['name']=$gazou_name_old;
                        }
                        print'<div class="form-style" style="margin-top:0px">上記の問題を修正します。</div>';
                        print '<form method="post" action="edit_done.php">';
                        print '<input type="hidden" name="code" value="'.$code.'">';
                        print '<input type="hidden" name="gazou_name_old" value="'.$gazou_name_old.'">';
                        print '<input type="hidden" name="gazou_name" value="'.$gazou['name'].'">';
                        print '<input type="hidden" name="kotoba" value="'.$kotoba.'">';
                        print '<br />';
                        print '<input class="button" type="submit" value="ＯＫ" onclick="sound_push();sound_chien()">';
                        print '</form>';
                    }
                    
                    ?>
                    </div><!-- /.home-content -->
                </section>
            </div><!-- /.center -->
            <?php
                print '<br /><br /><br /><br /><br />';
                print'file tmp name : '.$gazou['tmp_name'];
                print '<br />';
                print'file name : '.$gazou['name'];
                print '<br />';
                print'file size : '.$gazou['size'].'Byte';
                print '<br />';
                print'error number : '.$gazou['error'];
            ?>
        </div><!-- /.main-wrapper -->
        <footer>日本工業大学　先進工学部　情報メディア工学科　シュガーマンズ</footer>
        <audio id="push" preload="auto">
            <source src="sounds/push.mp3" type="audio/mp3">
            <source src="sounds/push.wav" type="audio/wav">
        </audio>
        <script src="script.js"></script>

    </body>
</html>
