<?php

/**
* Scenario :Allow upload for music media types.
*/
    use Page\Login as LoginPage;
    use Page\Constants as ConstantsPage;
    use Page\UploadMedia as UploadMediaPage;
    use Page\DashboardSettings as DashboardSettingsPage;
    use Page\BuddypressSettings as BuddypressSettingsPage;

    $I = new AcceptanceTester($scenario);
    $I->wantTo('Allow upload for music media types');

    $loginPage = new LoginPage($I);
    $loginPage->loginAsAdmin(ConstantsPage::$userName,ConstantsPage::$password);

    $settings = new DashboardSettingsPage($I);
    $settings->gotoTab($I,ConstantsPage::$typesTab,ConstantsPage::$typesTabUrl);
    $settings->verifyEnableStatus($I,ConstantsPage::$musicLabel,ConstantsPage::$musicCheckbox);

    $buddypress = new BuddypressSettingsPage($I);
    $buddypress->gotoActivityPage($I,ConstantsPage::$userName);

    $uploadmedia = new UploadMediaPage($I);
    $uploadmedia->uploadMediaFromActivity($I,ConstantsPage::$audioName);

    $I->seeInSource('<li class="rtmedia-list-item media-type-music">');
    echo nl2br("Audio is uploaded.. \n");

?>
