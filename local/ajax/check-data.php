<?
	define('STOP_STATISTICS', true);
	define('NOT_CHECK_PERMISSIONS', true);
	require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
?>

<?

	if(isset($_GET['login']))
	{
		$login = htmlspecialcharsEx($_GET['login']);

		if(CUser::GetByLogin($login)->fetch())
		{
			echo true;
		}
		else
		{
			echo false;
		}
	}
	else if(isset($_GET['email']))
	{
		$email = htmlspecialcharsEx($_GET['email']);
		
		$by = 'id';
		$order = 'desc';
		$filter = array
		(
			'EMAIL' => $email
		);
		
		if(CUser::GetList($by, $desc, $filter)->fetch())
		{
			echo true;
		}
		else
		{
			echo false;
		}
	}
?>