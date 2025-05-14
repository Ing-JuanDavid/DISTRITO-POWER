<?php

use Core\Admin;

requireRole('admin');

Admin::destroyMemBershipType();