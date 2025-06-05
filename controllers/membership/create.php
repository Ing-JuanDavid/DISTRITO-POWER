<?php
use Core\Services\AdminService;
use Core\Services\UserService;

if(getRole()=='admin') AdminService::addPay();

UserService::addPay();
