<?php
include 'contentLanguage.php';

// Handles POST request used for overwriting language. Sets appropriate cookie and returns language.
function getRequestedLanguage()
{
    global $allLanguages;

    $languageRequest = $_POST['set-lang'];
    if($languageRequest != null && $allLanguages[$languageRequest])
    {
        setcookie('Language', $languageRequest);
        return $languageRequest;
    }
    return null;
}

// Returns language to be used on the site.
// Uses language from cookie or detects language and writes it to cookie if no cookie provided.
function getLanguage()
{
    global $allLanguages;

    $requestedLanguage = getRequestedLanguage();
    if($requestedLanguage) return $requestedLanguage;

    $languageOverride = $_COOKIE['Language'];
    if($allLanguages[$languageOverride]) return $languageOverride;

    $detectedLanguage = detectLanguage();
    setcookie('Language', $detectedLanguage);
    return $detectedLanguage;
}

// Detects and returns language based on HTTP headers. No side effects
function detectLanguage()
{
    global $allLanguages;
    global $defaultLanguage;

    $languageHeader = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $languages = explode(',', $languageHeader);
    foreach ($languages as $language) {
        $languageCode = explode(';', $language)[0];
        if ($allLanguages[$languageCode]) return $languageCode;
    }
    return $defaultLanguage;
}


