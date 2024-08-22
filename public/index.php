<?php
	require_once '../core.php';
?>
<!DOCTYPE html>
<!--
	Developed by Matthew Alan Estock
	Website -	https://www.mattyalanestock.com
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="noindex">
	<title>Movie Ratings</title>
	<base href="<?=base_url()?>">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sandstone/bootstrap.min.css" integrity="sha384-zEpdAL7W11eTKeoBJK1g79kgl9qjP7g84KfK3AZsuonx38n8ad+f5ZgXtoSDxPOh" crossorigin="anonymous">
	<link href="<?=base_url('style.css')?>" rel="stylesheet" type="text/css">
	
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script defer src="<?=base_url('main.js')?>"></script>
</head>
<body>
<main role="main" class="flex-shrink-0">
	<div class="jumbotron shadow-dark">
		<div class="container">
			<h1 class="display-3">Movie Ratings</h1>
			<p><?php include '../prompt.txt'; ?></p>
			<p><button id="reload" class="btn btn-primary btn-lg">Reload</button></p>
		</div>
	</div>
	<div class="container">
		<div id="movielist" class="row">
			<div class="spinner col text-center">
				<div class="spinner-border" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
	</div>
</main>
<template id="moviecard-template">
	<div class="moviecard col-md-6">
		<div class="card mb-4 shadow-dark">
			<div class="card-body">
				<h4 class="card-title"></h4>
				<div class="d-flex justify-content-between align-items-center">
					<div class="btn-group">
						<button type="button" class="upvote btn btn-sm btn-success">👍 <span class="votes"></span></button>
						<button type="button" class="downvote btn btn-sm btn-danger">👎 <span class="votes"></span></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
</body>
</html>
