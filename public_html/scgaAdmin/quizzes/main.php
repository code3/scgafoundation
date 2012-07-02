<?
ini_set('display_errors', 1);


require ('parts/update_alert.php');

?>

<style type = "text/css">

    input.text {

        margin-right : 10px;

        width        : 110px;

    }

    input.scga-number {

        width : 55px;

    }

    input.email_tf {

        width : 170px;

    }

    div.spacer {

        height : 30px;

    }

    .my-listing td {

        padding : 8px;

    }

</style>



<h1>Yoc Quizzes Panel</h1>

<form id = "quizzes_search_form" name = "quizzes_search_form"
      action = "./" method = "get">

    <input type = "hidden" name = "sort_field" id = "sort_field"
           value = "<?= $_GET['sort_field'] ?>" />

    <input type = "hidden" name = "sort_desc" id = "sort_desc"
           value = "<?= $_GET['sort_desc'] ?>" />

    <input type = "hidden" name = "search" id = "search" value = "1" />

    <label for = "scga">SCGA #:</label>

    <input type = "text" name = "scga" id = "scga"
           value = "<?= $_GET['scga'] ?>" class = "text" />

    <br />

    <label for = "fname">First Name:</label>

    <input type = "text" name = "first_name" id = "fname"
           value = "<?= $_GET['first_name'] ?>" class = "text" />

    <br />

    <label for = "lname">Last Name:</label>

    <input type = "text" name = "last_name" id = "lname"
           value = "<?= $_GET['last_name'] ?>" class = "text" />

    <br />
    <input type = "submit" value = "Search" class = "submit-button" />

    <p class = "clear-fields"><a
            href = "javascript: clearForm('quizzes_search_form');"
            class = "customTitle" title = "Clear the search form fields">Clear
                                                                         Filters</a>
    </p>

</form>

<?php



if (isset($_SESSION['error_type']))

{

    switch ($_SESSION['error_type'])

    {

        case 1:

            $error_message = 'SCGA/GHIN# cannot be empty';

            break;

    }

}


echo $message_location = !empty($_SESSION['error_type'])

        ? '<div style="color:red; margin:10px;"><h2>' . $error_message . '</h2></div>' : '';


unset($_SESSION['error_type']);

if ($quizzes)
{
    ?>

<br />

<?php $_pl->show(); ?>

<form id = "quizzes_reset_form"
      action = "<?= CLIENTROOT ?>/action/quizzes/reset-quizzes/"
      method = "post">

<table class = "listing my-listing">

    <?php

    $_headerClasses = array();

    if ($_isAdmin)

    {

        $_sortFields = array(''

        , 'quiz.scga'

        , 'kids.fname'

        , 'kids.lname'

        , ''

        );


        $_sortTitles = array(''

        , 'SCGA #'

        , 'First'

        , 'Last'

        , 'Action'

        );

    } else

    {

        $_sortFields = array(''

                , 'quiz.scga'

                , 'kids.fname'

                , 'kids.lname'

                , ''

                );


                $_sortTitles = array(''

                , 'SCGA #'

                , 'First'

                , 'Last'

                , 'Action'

                );

    }
    $_sortForm = 'quizzes_search_form';

    require 'parts/sort_header.php';

    $i = 0;

    $rowCount = 1;

    ?>

    <tbody>

        <?php
        foreach ($quizzes as $quiz)

        {

            //            $kidsql = "SELECT k.scga AS kscga from kids k INNER JOIN yoc_membership yoc "
            //
            //                    . "ON k.scga = yoc.scga_ghin_number "
            //
            //                    . "WHERE k.scga = '" . $result['scga_ghin_number'] . "'";
            //
            //            $kid = $_mysql->get($kidsql);

            ?>



        <tr <? if ($i % 2 == 1)

        {

            ?> class = "bg"<? } ?>>

            <td>

                <input type = "checkbox" id = "checkBox_<?= $i ?>"

                       value = "<?= $quiz['scga']?>"
                       name = "checked_quizzes[]" />

            </td>

            <td><?php echo $quiz['scga'] ?></td>

            <td><?php echo $quiz['fname'] ?></td>

            <td><?php echo $quiz['lname'] ?></td>

            <td>

                <a onclick = "confirm2(event, 'Reset quiz?', '$(\'checkBox_<?= $i?>\').checked = true; $(\'quizzes_reset_form\').submit()')"
                                   class = "customTitle" title = "Reset">

                                    Reset

                                </a>

            </td>

        </tr>

            <?php
            $i++;

            $rowCount++;
        } //foreach loop
        ?>

    </tbody>

</table>
<br />
<input type = "checkbox" id = "checkAllBtn"
       onclick = "checkAll('checked_quizzes[]', this.checked);"
       class = "checkbox" />

<label for = "checkAllBtn">Check All</label>

<br />

<a onclick = "confirm2(event, 'Reset all checked quizzes?', '$(\'quizzes_reset_form\').submit()')"
   class = "customTitle" title = "Reset Checked">Reset Checked</a>

</form>
<div style = "clear:both;"></div>
<?php
} else
{
    ?>
<div style = "margin-top:60px;">
    No quizzes found
</div>
<?php
}
?>