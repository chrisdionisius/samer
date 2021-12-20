<?PHP

include ("php/connect.php");
	
	function getLastTransMerk($querycount)
	{
	$result=mysqli_query($id_mysql,$querycount) or die(mysql_error());
	$row=mysqli_fetch_array($result, MYSQL_ASSOC); return substr($row['LastID']);
	}
	
	function FormatNoTransMerk($num)
	{
	$num=$num+1;
	switch (strlen($num)) {
		case 1 : $NoTrans = "000".$num; break;
		case 2 : $NoTrans = "00".$num; break;
		case 3 : $NoTrans = "0".$num; break;
		default: $NoTrans = $num;}
	return $NoTrans;
	}
	
	
	function getLastTrans($querycount)
	{
	$result=mysqli_query($id_mysql,$querycount) or die(mysql_error());
	$row=mysqli_fetch_array($result, MYSQL_ASSOC); return $row['LastID'];
	}
	
	function FormatNoTrans($num)
	{
//	$num=$num+1;
	//switch (strlen($num)) {
		//case 1 : $NoTrans = "000".$num; break;
		//case 2 : $NoTrans = "00".$num; break;
		//case 3 : $NoTrans = "0".$num; break;
		//default: $NoTrans = $num;}
	//return $NoTrans;
	$num=$num+1;
	return $num;

	}
	
			function getLastTransServ($querycount)
			{
			$result=mysqli_query($id_mysql,$querycount) or die(mysql_error());
			$row=mysqli_fetch_array($result, MYSQL_ASSOC); return substr($row['LastID'],15,8);
			}
			
			function FormatNoTransServ($num)
			{
			$num=$num+1;
			switch (strlen($num)) {
				case 1 : $NoTrans = "0000000".$num; break;
				case 2 : $NoTrans = "000000".$num; break;
				case 3 : $NoTrans = "00000".$num; break;
				case 4 : $NoTrans = "0000".$num; break;
				case 5 : $NoTrans = "000".$num; break;
				case 6 : $NoTrans = "00".$num; break;
				case 7 : $NoTrans = "0".$num; break;
				default: $NoTrans = $num;}
			return $NoTrans;
			}
	
	function getLastTransRet($querycount)
	{
	$result=mysqli_query($id_mysql,$querycount) or die(mysql_error());
	$row=mysqli_fetch_array($result, MYSQL_ASSOC); return $row['LastID'];
	}
	
	function FormatNoTransRet($num)
	{
	$num=$num+1;
	switch (strlen($num)) {
		case 1 : $NoTrans = "0000000".$num; break;
		case 2 : $NoTrans = "000000".$num; break;
		case 3 : $NoTrans = "00000".$num; break;
		case 4 : $NoTrans = "0000".$num; break;
		case 5 : $NoTrans = "000".$num; break;
		case 6 : $NoTrans = "00".$num; break;
		case 7 : $NoTrans = "0".$num; break;
		default: $NoTrans = $num;}
	return $NoTrans;
	}
	
		function getLastTransRef($querycount)
		{
		$result=mysqli_query($id_mysql,$querycount) or die(mysql_error());
		$row=mysqli_fetch_array($result, MYSQL_ASSOC); return $row['LastID'];
		}
		
		function FormatNoTransRef($num)
		{
		$num=$num+1;
		switch (strlen($num)) {
			case 1 : $NoTrans = "0000000".$num; break;
			case 2 : $NoTrans = "000000".$num; break;
			case 3 : $NoTrans = "00000".$num; break;
			case 4 : $NoTrans = "0000".$num; break;
			case 5 : $NoTrans = "000".$num; break;
			case 6 : $NoTrans = "00".$num; break;
			case 7 : $NoTrans = "0".$num; break;
			default: $NoTrans = $num;}
		return $NoTrans;
		}
?>