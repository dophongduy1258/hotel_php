<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="#" />
    <meta name="description" content="#" />
    <link rel="shortcut icon" href="{$domain}/public/images/favicon.png?{$version}" type="imagpublicon">
    <title>{$title} - {$setup.webtitle}</title>
    
    <script type="text/javascript" src="{$domain}/public/bootstrap/js/jquery.min.js?{$version}"></script>
	<script type="text/javascript" src="{$domain}/public/jquery-ui/jquery-ui.min.js?{$version}"></script>
    <script type="text/javascript" src="{$domain}/public/bootstrap/js/bootstrap.min.js?{$version}"></script>
    <script type="text/javascript" src="{$domain}/public/js/global.js?{$version}"></script>
    <script type="text/javascript" src="{$domain}/public/js/lang/vi.js?{$version}"></script>
    <link href="{$domain}/public/bootstrap/css/bootstrap.min.css?{$version}" rel="stylesheet"/>
    <link href="{$domain}/public/font-awesome/css/font-awesome.min.css?{$version}" rel="stylesheet"/>
    <link href="{$domain}/public/jquery-ui/jquery-ui.min.css?{$version}" rel="stylesheet"/>
    <link href="{$domain}/public/css/main.css?{$version}" rel="stylesheet"/>
</head>
<body>
    
	{if $m != 'user' }
	{include file="sidebar.tpl" }
    <div id="page-wrapper" class="page-wrapper-1111">
    	<div class="primary">
            {include  file= "page_header.tpl"}
	{else}
	<div>
	{/if}