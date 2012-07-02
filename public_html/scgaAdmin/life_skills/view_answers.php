<div class="pop_container" >
    <h1><?=$_kid['fname']?> <?=$_kid['lname']?> Grade: <?=$_kid['grade']?></h1>
    <table>
    <?
    for($i = $_min; $i <= $_max; $i++){
        $num = $i + 1;
        $_answersArray[$i] = str_replace("\'", "'", $_answersArray[$i]);
		$_answersArray[$i] = str_replace('\"', '"', $_answersArray[$i]);
		$answer = preg_replace("/\\\+r\\\+n/", '<br />', $_answersArray[$i]);
        ?>
        <tr>
            <td><strong><?= $num ?>) <?= $lifeSkillsQuestions[$i] ?></strong><br /><br /></td>
        </tr>
        <tr>
            <td><?= $answer ?><br /><br /></td>
        </tr>
    
        <?
    }
    ?>
    </table>
</div>