<?php

it('tests that there are no console logs and errors', function () {
    $pages = visit(['/','/login','/register']);
    [$home, $login, $register] = $pages;
    $home->assertTitle('Welcome - Laravel');
    $login->assertTitle('Log in - Laravel');
    $register->assertTitle('Register - Laravel');
    $pages->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->debug();
});
