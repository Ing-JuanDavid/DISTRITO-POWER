<?php

use Core\Admin;

requireRole('admin');

Admin::takeAsist($_GET['id']);