<?php
namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;

final class MeQuery
{
    public function __invoke($_, array $args)
    {
        return Auth::user();
    }
}
