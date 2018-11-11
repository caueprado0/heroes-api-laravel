<?php

Route::any('/', function () {
    return redirect()->route('v1_index');
});
