<?php

namespace App;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


Class Breadcrumbs {

	private $_trail;
	private $route_uri;
	private $route_name;

	function  __construct() {
		$this->reset();
	}

	function reset() {
		$this->_trail = [];
	}

  public function add($title, $link='') {
		$this->_trail[] = ['title' => $title, 'link' => $link];
	}

  public function trail($separator = ' &raquo; ') {
		$pos = 1;
		$trail_string = '<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">';

		for ($i = 0, $n = sizeof($this->_trail); $i < $n; $i++) {
		  if (isset($this->_trail[$i]['link']) && ($this->_trail[$i]['link'] !== NULL)) {
		    $trail_string .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . $this->_trail[$i]['link'] . '" itemprop="item"><span itemprop="name">' . ucfirst(mb_strtolower($this->_trail[$i]['title'], 'UTF-8')) . '</span></a>';
		  } else {
		    $trail_string .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . ucfirst(mb_strtolower($this->_trail[$i]['title'], 'UTF-8')) . '</span>';
		  }
		  $trail_string .= '<meta itemprop="position" content="' . (int)$pos . '" /></li>' . PHP_EOL;
			
		  $pos++;
		}

		$trail_string .= '</ol>';

		return $trail_string;
  }
}
