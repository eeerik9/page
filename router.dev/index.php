<?php 
echo('The value of LINE and FILE respectively is  '.__LINE__.' of ['.__FILE__.'] '.'Dirname is '.dirname( __FILE__ ));
echo nl2br("\n\n");

require_once(dirname(__FILE__) . '/router.php');

?>
<html>
<head>
	<title>MySite</title>
</head>
<body>
<a href="login.php">Login</a>	
</br>
</br>
<?php echo "**********************************************************\n\n";
echo nl2br("\n\n");
$router = new Router();
$router->route('/^\/blog\/(\w+)\/(\d+)\/?$/', function($category, $id){
            print "category={$category}, id={$id}";
             });
$router->execute($_SERVER['REQUEST_URI']);
?>

</body>
</html>
