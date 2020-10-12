<?php

namespace App\Models\Traits;

trait UserMethod
{
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}