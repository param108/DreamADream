<?php


function addDefine($a,$b) {
	if (!defined($a)) {
		define($a,$b);
	}
}

addDefine('DB_HOST','localhost');
addDefine('DB_USER','dreamer');
addDefine('DB_NAME','dreamadream');
addDefine('DB_PASSWORD','dream');
addDefine('DB_TABLE_LOGIN','login');
