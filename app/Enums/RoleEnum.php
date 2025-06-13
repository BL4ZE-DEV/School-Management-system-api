<?php

namespace App\Enums;

enum RoleEnum:string
{
    case Teacher = 'Teacher';
    case Admin = 'Admin';
    case Non_Academic = "Non_Academic";
}