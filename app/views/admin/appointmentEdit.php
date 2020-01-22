<?php
require_once APPROOT . '/views/inc/navbar.php';
$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

$date = explode('-', $client->appointmentDate);
?>

    <section id='appointment-form'>
        <div class='form-div'>
            <h2>Edit</h2>
            <form action="/appointments/update/<?php echo $client->id; ?>" method="post">
                <input type="name" name="name" value=<?php echo $client->name; ?> disabled> <br>
                <input type="text" name="address" value=<?php echo $client->address; ?> disabled> <br>
                <p>Appointment Date</p>
                <div class='appointment-date'>
                    <select name="appointmentDay">
                        <?php for($i=1; $i<=31; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo ($i==$date[2]) ? 'selected' : '' ?>><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="appointmentMonth">
                        <?php for($i=0; $i<count($month); $i++): ?>
                            <option value="<?php echo $i+1; ?>" <?php echo ($i+1==$date[1]) ? 'selected' : '' ?>><?php echo $month[$i]; ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="appointmentYear">
                        <option value="<?php echo date('Y'); ?>" <?php echo ($i==$date[0]) ? 'selected' : '' ?>><?php echo date('Y'); ?></option>
                        <?php if(date('m')==12): ?>
                            <option value="<?php echo date('Y')+1; ?>" <?php echo ($i==$date[0]) ? 'selected' : '' ?>><?php echo date('Y')+1; ?></option>
                        <?php endif; ?>
                    </select>
                </div>
                <?php echo (!empty($client->date_err)) ? '<span class="invalid-feedback"> '.$client->date_err .'</span><br>' : ''; ?>

                <select name="mechanic">
                    <option value="">Select Mechanic</option>
                    <option value="John" <?php echo ('John'==$client->mechanic)? 'selected' : ''; ?>>John</option>
                    <option value="Sam" <?php echo ('Sam'==$client->mechanic)? 'selected' : ''; ?>>Sam</option>
                    <option value="Jane" <?php echo ('Jane'==$client->mechanic)? 'selected' : ''; ?>>Jane</option>
                    <option value="Will" <?php echo ('Will'==$client->mechanic)? 'selected' : ''; ?>>Will</option>
                    <option value="Kevin" <?php echo ('Kevin'==$client->mechanic)? 'selected' : ''; ?>>Kevin</option>
                </select> <br>
                <button type="submit" name='update' class='btn btn-yellow'>Update</button>
            </form>
            <?php if(isset($_GET['error'])): ?>
                <p class='error-msg'>This mechanic is not available. Choose another one mechanic or date.</p>
            <?php endif; ?>
        </div>
    </section>

<?php
require_once APPROOT . '/views/inc/footer.php';
?>