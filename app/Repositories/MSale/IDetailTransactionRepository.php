<?php

namespace App\Repositories\MSale;

interface IDetailTransactionRepository {
    function store($request, $transaction);
}