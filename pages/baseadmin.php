<?php
function declareusermgmt(){
 global $pdo;
 $user_stmt = $pdo->query("SELECT * FROM members");
 $rows = $user_stmt->fetchAll(PDO::FETCH_BOTH);
 $types = [
    ["Non enabled user", "0"],
    ["Superadmin", "1"],
    ["Admin", "2"],
    ["Common user", "3"],
];
 while ($row = array_shift($rows)) {
  if($_SESSION["usertype"] == 1 || (($row["usertype"] > $_SESSION["usertype"] || $row["usertype"] == "0") && $row["sid"] == $_SESSION["sid"])){

   if($row['verifyemail'] == 1) { $vemail = "yes"; } else { $vemail = "no"; };

   foreach($types as list($text, $ut)){
    if($_SESSION["usertype"] == 1 || ($ut > $_SESSION["usertype"] || $ut == "0")){

     if($ut == $row["usertype"]) { $sel = "selected"; } else { $sel = ""; };
     $options = "$options
                                            <option value=\"$ut\" $sel>$text</option>
";
    };

   };
   $tr = "
$tr
                                <tr>
                                    <th>".$row['id']."</th>
                                    <th>".$row['username']."</th>
                                    <th>".$row['name']."</th>
                                    <th>".$row['sid']."</th>
                                    <th>".$row['email']."</th>
                                    <th>".$vemail."</th>
                                    <th>
                                        <select id=\"".$row['id']."type\" onChange=\"changeusertype('".$row['id']."')\">
".$options."
                                        </select>
                                    </th>
                                    <th><input class=\"btn\" type=\"button\" name=\"delete\" onClick=\"deleteuser('".$row['id']."')\" value=\"Delete\"></th>
                                    <th><input class=\"form-control\" type=\"password\" name=\"newname\" id=\"".$row['id']."pass\" Placeholder=\"New password\" onChange=\"changeuserpass('".$row['id']."')\"><input class=\"btn\" type=\"button\" value=\"go\"></th>
                                </tr>
";
  $options = "";
  };
 };
 echo "
        <div class=\"row\">
            <div class=\"box\">
                <div class=\"col-lg-12\">

                    <hr>
                    <h2 class=\"intro-text text-center\">Manage
                        <strong>users</strong>.
                    </h2>
                    <hr class=\"visible-xs\">
                    <div class=\"table-responsive\">          
                        <table class=\"table\">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Structure id</th>
                                    <th>Email</th>
                                    <th>Email verified?</th>
                                    <th>User type</th>
                                    <th>Delete user</th>
                                    <th>Change password</th>
                                </tr>
                            </thead>
                            <tbody>
$tr
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
";

};
?>
