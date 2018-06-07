<?php
include_once("layoutHeader.php");
include_once("Class/Validation.php");
include_once("Class/Core.php");

$description= $errorMsg= $insertMsg= $deviceErr= $error= $descriptionErr=  "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $validation = new Validation();
    $core = new Core();
    
    $device = $_POST['device'];
    $description = htmlspecialchars(strip_tags($_POST['description']));
    
    $msg = $validation->checkEmpty($_POST, array('description'));
    $checkDescription = $validation->isValid($_POST['description']);
    
    if($msg != null) {
        $errorMsg= $msg; 
    } elseif (!$checkDescription) {
        $descriptionErr = 'Description field must contain minimum 30 characters';
    } elseif ($device == -1) {
        $deviceErr = 'Please choose device model.';
    } else {
        if(empty($errorMsg) && (empty($descriptionErr)) && (empty($deviceErr))) {
            $stmt = $core->insert($device, $description);
            if($stmt){
                $insertMsg= "This person added to database";
            }
        }
    }
}
?>
<div class="conteiner">
    <form action="index.php" method="post">
        <div class="form-group">
            <p>Add malfunction to the database.</p>
            <p>
                <label for="selectDevice">Device model:<sup>*</sup></label>
                <select id="selectDevice" name="device">
                    <option value="-1">Choose device</option>
                    <option value="Device A">Device A</option>
                    <option value="Device B">Device B</option>
                </select>
                <span class="error"><?php echo $deviceErr; ?></span>
            </p>
            <p>
                <label for="inputDescription">Malfunction description:<sup>*</sup></label>
                <textarea name="description" class="form-control" id="inputDescription" rows="5" cols="50" ><?php echo $description; ?></textarea>
                <span class="error"><?php echo $descriptionErr; ?></span>
            </p>
            <input type="submit" value="Add" class="btn btn-primary">
            <p class="success">
                <?php echo $insertMsg; ?>
            </p>
            <p class="error">
                <?php echo $error;
                        echo $errorMsg?>
            </p>
            <a href="table.php">Show added malfunctions</a>
        </div>
    </form>
</div>