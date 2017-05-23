<?php

class View {
	function generate($content_view, $template_view, $data = null) {
		require_once REAL_PATH.'/views/'.$template_view;
	}
}
