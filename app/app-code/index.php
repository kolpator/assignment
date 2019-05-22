<html>

  <head>
   <title>Test</title>
  </head>

  <body bgcolor="white">

  <?php
  $conn = pg_connect("host=postgredb-postgresql port=5432 dbname=mylist user=postgres password=passw0rd");

  $redis = new Redis();
  $redis->connect('my-redis-master', 6379);
  $redis->auth("T11lvmJc8Y");

  function getData(){
    global $redis;
    if($redis->exists("person5")){
      echo "Person exist in redis.<br>";
      return dataFromRedis();
    }
    else{
      echo "Person not exist in Redis. Fallback to PostgreSQL.<br>";
      global $conn;
      $result = pg_exec($conn, "select * from person");
      $rows = array();
      echo "<tr>";
      while($row = pg_fetch_row($result)) {
        echo "<td>", $row["name"], "</td>";
        echo "<td>", $row["surname"], "</td>";
        echo "<td>", $row["age"], "</td>";
        echo "<td>", $row["national_id"], "</td>";
        $rows[] = $row;
      }
      echo "</tr>";

      echo "Populate data from PostgreSQL to Redis.<br>";
      global $redis;
      $redis->set('person5',json_encode($rows));
      return $rows;
    }
  }
  function dataFromRedis(){
    echo "Retrieve data from Redis...<br>";
    global $redis;
    $data = json_decode($redis->get('person5'),true);
    echo "Redis data:<br>";
    for($i = 0; $i < sizeof($data); $i++){
      echo implode(" ", $data[$i]), "<br>";
    }
    return $data;
  }

  $printData = getData();

  pg_close($conn);

  ?>

  </body>
</html>
