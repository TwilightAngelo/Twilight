<?php
	require_once 'core/model.php';
	require_once 'core/view.php';
	require_once 'core/controller.php';
	require_once 'core/route.php';
	require_once 'models/Repository/Repository.php';
	require_once 'models/Repository/UserRepository.php';
	require_once 'models/Repository/PostRepository.php';
	//require_once 'models/Repository/application.php';

	/*
		Временное решение для тестов, потом надо переписать!!!
	*/
	require_once 'other_temp/application.php';
	require_once 'models/Repository/User.php';
	Route::start();
?>