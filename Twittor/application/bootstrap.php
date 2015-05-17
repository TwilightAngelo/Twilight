<?php
	require_once 'core/model.php';
	require_once 'core/view.php';
	require_once 'core/controller.php';
	require_once 'core/route.php';
	require_once 'models/Repository/Repository.php';
	require_once 'models/Repository/UserRepository.php';
	require_once 'models/Repository/PostRepository.php';

	/*
		Временное решение для тестов, потом надо переписать!!!
	*/
	require_once 'other_temp/application.php';
	require_once 'other_temp/Database.php';
	require_once 'other_temp/User.php';
	Route::start();
?>