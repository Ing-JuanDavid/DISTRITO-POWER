<?php

use Core\Admin;

requireRole('admin');

Admin::destroyUser();