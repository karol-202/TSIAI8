<?php
include 'detectLanguage.php';

getRequestedLanguage();

$languageCode = getLanguage();
$languageName = $allLanguages[$languageCode];
echo '<h2>Język: '.$languageName.'</h2>';

echo '
<form method="post">
    <select name="set-lang">';

foreach ($allLanguages as $lang => $name)
{
    $selected = $lang == $languageCode ? 'selected' : '';
    echo '<option value="'.$lang.'" '.$selected.'>'.$name.'</option>';
}

echo '
    </select>
    <button type="submit">Zmień język</button>
</form>';
