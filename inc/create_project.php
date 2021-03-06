<?php
/*
@Auther: Gabriel Rodriguez
Page: create project
Project: Collaborate
Date: 3/6/2018

Create project form was created to allow users the ability to upload up to
5 projects. More functionality will be added as suggestions are made.
Collaborate 2017-2018

*/
    include ("header.php");
	
  	if(!isset($_SESSION['username']))
	{
		Header("Location: index.php");
	}
?>
<div class="bgstyle">
    <div id="addProject">
        <table >
			<tr>
				<td id="newProject">
					<h1>Lets Collaborate</h1><br/><br/>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
						<label for="pro_name">Name of Project</label>
						<input type="text" name="pro_name" placeholder="Name" ><br /><br />
						<div id="select">
							<label for="Choices">Select a Category</label><br/>
							<select name="Choices">
								<option value="None">None</option>
								<option value="Music">Music</option>
								<option value="Art">Art</option>
								<option value="Apps">Applications</option>
								<option value="Web">Web</option>
								<option value="Writing">Writing</option>
								<option value="Building">Building</option>
								<option value="Growing">Growing</option>
								<option value="Other">Other</option>
							</select>
						</div>
						<div id="select2">
						    <label for="Choices">Enter Category (i.e. Application, Art)</label><br/>
							<input list="type" name="Choices">
							<datalist id="type">
								<option value="None">
								<option value="Music">
								<option value="Art">
								<option value="Applications">
								<option value="Web">
								<option value="Writing">
								<option value="Building">
								<option value="Growing">
								<option value="Other">
							</datalist>
						</div>
						<br/>
						<label for="projectAttach">Upload Image</label><br/>
						<input type="file" name="projectAttach" >
						<br/><br/>
						<label for="description">Description</label>
						<textarea id="desc" type="text" maxlength="255" name="description" placeholder="Tell us about your project" ></textarea><br /><br />
						<input class="btn" type="submit" name="project" value="Collaborate">
					    <a href="./profile.php?u=<?php print($username); ?>"><h4>Cancel</h4></a>
					</form>
				</td>
			</tr>
		</table>
    </div>
</div>
<?php
// define variables and set to empty values
$project = $description = "";
// Year - Month - Day
$date = date("Y/m/d");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["pro_name"]))
	{
        $nameErr = "Please add a name";
    }
    else
	{
        $project = test_input($_POST["pro_name"]);
    }
	if (empty($_POST["Choices"]))
	{
        $nameErr = "Please add a name";
    }
    else
	{
        $type = test_input($_POST["Choices"]);
    }
    if (empty($_POST["description"]))
	{
        $descErr = "Tell them a little about your project";
    }
    else
	{
        $description = test_input($_POST["description"]);
    }
    try
    {
        //open connection
        $con = Connect();
        $collaborate = mysqli_query($con, "INSERT INTO `collaborate`.`projects` (`username`, `project_name`, `description`, `type_of_project`, `state`, `city`, `date`) VALUES ('$username','$project','$description','$type','$user_state_','$user_city_','$date' )");
	}
	catch (\Exception $e)
	{
		print("OOPS.... An error occured.");
	}
	finally
	{
		//close database connection
		$con = NULL;
	}
	if(getimagesize($_FILES["projectAttach"]["tmp_name"]))
	{
		$query = "UPDATE `collaborate`.`projects` set `attachment`='$url' WHERE `username`='$username' AND `project_name`='$project'";
	
		UploadNewImage($query, $username);
	}
	else
	{
	    header("Location: profile.php?u=$username");
	}
}
    _html_end();
?>
