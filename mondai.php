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
        <header >
            <div class="header-contents item">
                <h1>ことばあそび</h1>
                <h2>もんだい</h2>
            </div><!-- /.header-contents -->
        </header>

        <div class="main-wrapper">
            <a class="title-button" onclick="sound_push();href_sound('index.html')">タイトルへ</a>
                <div class="center">
                    <section>
                        <?php
                        try
                        {
                            require_once('./common/common.php');
                            $dbh=mondaidb();

                            $sql='SELECT code,kotoba,gazou FROM mondai WHERE 1';
                            $stmt=$dbh->prepare($sql);
                            $stmt->execute();

                            $dbh=null;

                            $i=0;
                            while(true)
                            {
                                $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                                if($rec==false)
                                {
                                    break;
                                }
                                $array[$i]=$rec['code'];
                                $i++;
                            }
                            print'</form>';
                        }

                        catch(Exception $e)
                        {
                            print'ただいま障害により大変ご迷惑をおかけしております。';
                            exit();
                        }

                        while(true)
                        {
                            if(isset($_SESSION['mcode'])==false)
                            {
                                $rand_count=rand(0,$i-1);
                                $_SESSION['mcode']=$rand_count;
                                break;
                            }
                            else
                            {
                                $rand_num=rand(0,$i-1);
                                if($_SESSION['mcode']!=$rand_num)
                                {
                                    $rand_count=$rand_num;
                                    $_SESSION['mcode']=$rand_num;
                                    break;
                                }
                            }
                        }

                        
                        $mondai_code=$array[$rand_count];
                        require_once('./common/common.php');
                        $dbh_m=mondaidb();

                        $sql_m='SELECT code,kotoba,gazou FROM mondai WHERE code=?';
                        $stmt_m=$dbh_m->prepare($sql_m);
                        $data_m[]=$mondai_code;
                        $stmt_m->execute($data_m);

                        $rec=$stmt_m->fetch(PDO::FETCH_ASSOC);
                        $kotoba=$rec['kotoba'];
                        $gazou_name=$rec['gazou'];

                        $dbh=null;

                        if($gazou_name=='')
                        {
                            $disp_gazou='';
                        }
                        else
                        {
                            $disp_gazou='<img class="mondai_gazou" src="./gazou/'.$gazou_name.'" >';
                        }
                        

                        $kotoba_str=preg_split("//u", $rec['kotoba'], -1, PREG_SPLIT_NO_EMPTY);
                        
                        $array_count=0;
                        foreach($kotoba_str as $c)
                        {
                            $array_count++;
                        }

                        print$disp_gazou;
                        print'<div class="tomei" id="kotoba">'.$rec['kotoba'].'</div>';
                        ?>

                        <div class="container">
                            <?php
                                for($j=0;$j<$array_count;$j++)
                                {
                                    $l=$j+1;
                                    print'<h1 class="item_a" id="ans'.$l.'">？</h1>';
                                }
                            ?>
                        </div>
                            
                        <div class="container">
                            <?php
                                for($a=0;$a<$array_count;$a++)
                                {
                                    $b=$a+1;
                                    print'<h1 class="item_b" id="kaito'.$b.'" onclick="sound_push();getId(this);" >　</h1>';
                                }

                            ?>
                        </div>
                    </section>
                    <div id="rma"style="display:flex;">
                        <h1 onclick="sound_push();reset();" class="button" style="margin-top:20px; margin-left:54px; padding:10px; width:120px; text-align:center;position:center;" >やりなおす</h1>
                        <h1 onclick="sound_push();moveAns();" class="button" style="margin-top:20px; margin-left:56px; padding:10px; width:120px; text-align:center;position:center;" >けってい！</h1>
                    </div>
                </div><!-- /.center -->
                
                <div id="maru">
                    <div class="kekka_background" >
                        <div>
                            <img src="./images/maru.png" class="maru_gazou">
                        </div>
                        <div class="maru_gamen">
                            <br/>
                            <br/>
                            <a class="button" onclick="sound_push();href_sound('index.html')">タイトルへ</a>
                            <a class="button" onclick="sound_push();href_sound('mondai.php')">次の問題！</a>  
                        </div>
                    </div>
                </div>

                <div id="batsu">
                    <div class="kekka_background" >
                        <div>
                            <img src="./images/batsu.png" class="batsu_gazou" style="margin-top:-10px;">
                        </div>
                        <div class="form-style"  >せいかいは</div>
                        <?php 
                            print '<div class="batsu_kotae" style="weight:449px;">';
                            $kotoba_check=preg_split("//u", $kotoba, -1, PREG_SPLIT_NO_EMPTY);
                            for($i=0;$i<count($kotoba_check);$i++)
                            {
                                print '<h1 class="item_a">'.$kotoba_check[$i].'</h1>';
                            }
                            print '</div>'; 
                            ?>
                        <div class="batsu_gamen">
                            <br/>
                            <a class="button" onclick="sound_push();href_sound('index.html')">タイトルへ</a>
                            <a class="button" onclick="sound_push();href_sound('mondai.php')">次の問題！</a>   
                        </div>
                    </div>
                </div>
        </div><!-- /.main-wrapper -->
        <footer>日本工業大学　先進工学部　情報メディア工学科　シュガーマンズ</footer>
        <audio id="seikai" preload="auto">
	            <source src="sounds/seikai.mp3" type="audio/mp3">
	            <source src="sounds/seikai.wav" type="audio/wav">
        </audio>
        <audio id="huseikai" preload="auto">
	            <source src="sounds/huseikai.mp3" type="audio/mp3">
	            <source src="sounds/huseikai.wav" type="audio/wav">
        </audio>
        <audio id="push" preload="auto">
	            <source src="sounds/push.mp3" type="audio/mp3">
	            <source src="sounds/push.wav" type="audio/wav">
        </audio>
        <script src="script.js"></script>

    </body>
</html>
