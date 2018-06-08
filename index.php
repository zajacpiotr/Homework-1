<?php
include_once("layoutHeader.php");
include_once("Class/Validation.php");
include_once("Class/Core.php");

$description= $errorMsg= $insertMsg= $deviceErr= $error= $descriptionErr=$checkboxErr= "";
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&(isset($_POST['deviceCheckbox']))){
    
    $validation = new Validation();
    $core = new Core();
    
    $device = $_POST['device'];
    $checkbox = $_POST['deviceCheckbox'];
    $description = htmlspecialchars(strip_tags($_POST['description']));
    
    $msg = $validation->checkEmpty($_POST, array('deviceCheckbox','description'));
    $checkDescription = $validation->isValid($_POST['description']);
    $string = $validation->makeString($checkbox);
    
    if($msg != null) {
        $errorMsg= $msg; 
    } elseif (!$checkDescription) {
        $descriptionErr = 'Description field must contain minimum 30 characters';
    } elseif ($device == -1) {
        $deviceErr = 'Please choose device model.';
    } else {
        if(empty($errorMsg) && (empty($descriptionErr)) && (empty($deviceErr))) {
            $stmt = $core->insert($device, $string, $description);
            if($stmt){
                $insertMsg= "Malfunction added to database";
            }
        }
    }
} elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
    $checkboxErr= "Select at least one type of malfuntion";
}
?>
    <div class="conteiner">
        <form action="index.php" method="post">
            <div class="form-group">
                <h3>Add malfunction to the database.</h3>
                <p>
                    <label for="selectDevice">Device model:<sup>*</sup></label>
                    <select id="selectDevice" name="device">
                    <option value="-1">Choose device</option>
                    <option value="A">Device A</option>
                    <option value="B">Device B</option>
                </select>
                    <span class="error"><?php echo $deviceErr; ?></span>
                </p>
                <p>
                    <label>Check the problems</label>
                    <div class="conteinerCh"></div>
                    <span class="error"><?php echo $checkboxErr; ?></span>
                </p>
                <p>
                    <label for="inputDescription">Malfunction description:<sup>*</sup></label>
                    <textarea name="description" class="form-control" id="inputDescription" rows="5" cols="50"><?php echo $description; ?></textarea>
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
    <script>
        const $selectD = $('#selectDevice');
        const $list = $('.conteinerCh');
        $selectD.on('change', function() {
            const selectVal = $(this).find('option:selected').val();

            if (selectVal != -1) {
                $.ajax({
                        type: 'post',
                        url: 'devices.php',
                        dataType: 'json',
                        data: {
                            device: selectVal
                        }
                    })
                    .done(function(json) {
                        $list.empty();
                        $.each(json, function(i, ob) {
                            $list.append('<input type="checkbox" name="deviceCheckbox[]" value="' + ob.value + '"/> ' + ob.name + '<br/>');
                        });
                    })
                    .fail(function() {
                        console.warn('error');
                    })
            } else {
                $list.empty();
            }
        });

    </script>
