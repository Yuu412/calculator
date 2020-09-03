
    <?php
    //POSTされた値を取り出す
    if(isset($_POST['result'])){
      $result = (int)$_POST['result'];
      $input = $_POST['input'];
      $preResult = $_POST['preResult'];
      $preButton = $_POST['preButton'];
      $button = $_POST['button'];
      $cal = $_POST['cal'];
    }
    else {
      $result = '';
      $input = '';
      $preResult = '';
      $button = '';
      $preButton = '';
    }

    //"\d"は半角数字
    if(preg_match('/(\d|\.)/', $button) || empty($button)){
      if(preg_match('/(\+|-|×|÷)/', $preButton)){

        $preResult = (int)$result;
        $result = $button;
      }
      else{
        //"."で前後を繋げる
        $result = $result . $button;
        $result = ltrim($result, '0');
      }

      $input = $result;
    }
    else{

      switch ($button) {
        case 'AC':
        $result = '';
            break;
        case '+/-':
            $result = -$result;
            break;
        case '%':
            $result = $result / 100;
            break;
        default:
              if(preg_match('/=/', $button)){

              switch ($cal) {
                case '+':
                  $result =  $result + $preResult;
                  break;
                case '-':
                  $result = $preResult - $result;
                  break;
                case '×':
                  $result = $preResult * $result;
                  break;
                case '÷':
                  $result = $preResult / $result;
                  break;
                default:

                  break;
              }
            }
              $preResult = $input;

              if($button == '='){
                $cal = $cal;
              }
              else {
                $cal = $button;
              }

              break;
            }

          }


        $preButton = $button;

        ?>

        <DOCTYPE html>
          <!--Web上での電卓の作成-->
          <html lang="ja">

          <head>
            <meta charset="utf-8">
            <title>Web電卓</title>
            <link rel="stylesheet" type="text/css" href="/style.css">
          </head>

          <body>
            <div>


              <!--入力フォームの作成-->
              <div class="Box">

                <!--現在開いているページにPOSTする-->

                <form method="POST" action="?">
                  <ul class="form">

                    <!--立ってなければ$result表示-->
                    <?php echo '<div class="result-Box">', $result, '</div>' ?>
                    <input type="hidden" name="result" value="<?php echo $result ?>">
                    <input type="hidden" name="preResult" value="<?php echo $preResult ?>">
                    <input type="hidden" name="preButton" value="<?php echo $preButton ?>">
                    <input type="hidden" name="input" value="<?php echo $input ?>">
                    <input type="hidden" name="button" value="<?php echo $button ?>">
                    <input type="hidden" name="cal" value="<?php echo $cal ?>">


                    <ul>
                      <li class="cal"><input type="submit" name="button" value="AC"></li>
                      <li class="cal"><input type="submit" name="button" value="+/-"></li>
                      <li class="cal"><input type="submit" name="button" value="%"></li>
                      <li class="cal2"><input type="submit" name="button" value="÷"></li>
                    </ul>
                    <ul>
                      <li><input type="submit" name="button" value="7"></li>
                      <li><input type="submit" name="button" value="8"></li>
                      <li><input type="submit" name="button" value="9"></li>
                      <li class="cal2"><input type="submit" name="button" value="×"></li>
                    </ul>
                    <ul>
                      <li><input type="submit" name="button" value="4"></li>
                      <li><input type="submit" name="button" value="5"></li>
                      <li><input type="submit" name="button" value="6"></li>
                      <li class="cal2"><input type="submit" name="button" value="-"></li>
                    </ul>
                    <ul>
                      <li><input type="submit" name="button" value="1"></li>
                      <li><input type="submit" name="button" value="2"></li>
                      <li><input type="submit" name="button" value="3"></li>
                      <li class="cal2"><input type="submit" name="button" value="+"></li>
                    </ul>
                    <div class="zero"><input type="submit" name="button" value="0"></div>
                    <div class="point"><input type="submit" name="point" value="."></div>
                  </ul>
                  <div class="equal"><input type="submit" name="button" value="="></div>

                </form>
              </div>


          </body>

          </html>
