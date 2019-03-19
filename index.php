<!DOCTYPE html>
<html>
<title>表格內容轉換成 Wikidata QuickStatements</title>
<meta charset="utf-8">
<head>
    <style type="text/css">
        .small {
            height: 20px;
            overflow:hidden;
            display: none;
        }

        .big {
            height: auto;
            background-color: whitesmoke;
        }


    </style>
</head>
<body>
<?php

$debug = false;
//$debug = true;

$outputString = '';
//$inputFocus = ' autofocus ';
$inputFocus = ' ';
$outputFocus = '';
if( isset($_POST['input']) ){

    $inputFocus = '';
    $outputFocus = ' autofocus ';
    //$outputFocus = ' ';
}


//-------
require_once __DIR__ .'/WikiData.php';

use Summer;
$wiki_data = new Summer\WikiData();

?>


<table style="width:90%">
<tr>
  <td>
        <span title="跳至輸入框的快速鍵為 Alt-I"><span style="cursor:help; Border-bottom-style:dotted; Border-bottom-width:thin;">輸入表格內容 [I]</span>
        </span>
  </td>
  <td>
          <!-- <span title="跳至輸出框的快速鍵為 Alt-O">Result [B] for FB & [P] for PTT</span>: -->
  </td>   
</tr>
<tr>
  <td valign="top">
          <form name="input" method="post">
            <!-- 關鍵字 -->
            <?php

            $input = <<<EOT

Lzh-tw	Lzh-hant
磺溪流域	磺溪流域
小坑溪流域	小坑溪流域

EOT;

            $input = trim($input);

                  if( isset($_POST['input']) && strlen(trim($_POST['input'])) > 0 ){
                      $input = trim($_POST['input']);
                  }
              ?>

            <textarea rows="5" cols="180" name="input" <?php echo $inputFocus?> ACCESSKEY="I"><?php echo $input;?></textarea>
            <br />

            <span title="提交按鈕的快速鍵為 Alt-G"> <input type="submit" value="Submit" ACCESSKEY="G"> [G]</span>
        </form>
  </td> 
    <td valign="top">
    </td>
</tr>
</table>

<?php

if($debug){
    if(isset($_POST)){
        var_dump($_POST);
    }
}




?>

<div class="converted_result">

<p><span title="跳至輸出框的快速鍵為 Alt-O"><span style="cursor:help; Border-bottom-style:dotted; Border-bottom-width:thin;">轉換後的 Wikidata QuickStatements [O]</span
<br />

<?php
$converted = '';
if( isset($_POST['input']) && strlen(trim($_POST['input'])) > 0 ){
    //有輸入關鍵字
    $converted = $wiki_data->readFile($_POST['input']);
}
echo '<textarea id="selectable" onFocus="this.select()" '. $outputFocus .' rows="7" cols="180" ACCESSKEY="O">'. $converted . "</textarea>";

?>
</div>

<div class="info">鍵盤快速鍵說明： Windows 作業系統請按 Alt + 按鍵。 Mac 作業系統請按 control + alt + 按鍵。</div>
Source code are available on <a href='https://github.com/planetoid/convert-table-to-wikidata-quickstatements/'>Gitlab</a>.

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

    <?php
    if(file_exists(__DIR__ . "/../js/select_text.js")){
        require_once (__DIR__ . "/../js/select_text.js");
    }
    ?>


    $('.wrapper').find('a[href="#"]').on('click', function (e) {
        e.preventDefault();
        this.expand = !this.expand;
        //$(this).text(this.expand?"Click to collapse":"Click to expand");
        $(this).closest('.wrapper').find('.small, .big').toggleClass('small big');
    });
</script>



</body>
</html>