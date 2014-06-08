<?php

function is_admin()
{
	$ci = &get_instance();
	return $ci->mdl_user->isAdmin();
}

function is_superAdmin()
{
	$ci = &get_instance();
	return $ci->mdl_user->isSuperAdmin();
}