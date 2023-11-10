<?php

return [
    ['GET', '/', ['App\Controllers\ArticleController', 'index']],
    ['GET', '/country', ['App\Controllers\CountryController', 'index']],
    ['GET', '/filter', ['App\Controllers\FilterController', 'index']],
];
