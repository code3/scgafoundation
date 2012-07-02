<?
if (!is_array($_POST['checked_quizzes']))
{
    died(CLIENTROOT . '/quizzes/main');
}

foreach ($_POST['checked_quizzes'] as $scga)
{
    $fields = array(
        'etiquette',
        'handicap',
        'rules',
        'lifeSkills',
        'etiquettePercent',
        'handicapPercent',
        'rulesPercent',
        'lifeSkillsStatus'
    );
    $values = array(
        '',
        '',
        '',
        '',
        0,
        0,
        0,
        'Pending'
    );
    $_mysql->update('quiz',
        $fields,
        $values,
            'scga = "' . $scga . '"');
}

$_SESSION['updated'] = 'Quiz resetted';
died(CLIENTROOT . '/quizzes/main');
?>