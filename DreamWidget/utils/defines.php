<?php
function addDefine($a,$b) {
	 if (!defined($a)) {
	    define($a,$b);
	    }
}

addDefine("PROTOCOL","http");