<?php

namespace FrameWork;

interface Routes
{
    public function getRoutes(): array;
    public function getAuthentication(): \FrameWork\Authentication;
    public function checkPermission($permission): bool;
}