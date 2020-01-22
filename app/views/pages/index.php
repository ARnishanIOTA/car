<?php
    require_once APPROOT . '/views/inc/navbar.php';

    $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

?>

<!-- success message -->
<div id="success">
    Your Appointment Has Been Set.
</div>


    <!-- hero section -->
<section id='hero'>
    <div class='container'>
        <h1>Car Workshop</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quidem quod sint, culpa  <br>quasi blanditiis assumenda labore iste officiis eligendi!</p>
        <a href="#appointment-form" class='btn btn-yellow'><i class="fas fa-calendar-check"></i> Make an Appointment</a>
    </div>
</section>

<!-- appointment form -->
<section id='appointment-form'>
    <div class='form-div'>
        <h2>Make an Appointment</h2>
        <form action="/appointments/create" method="post">
            <input type="text" name="name" placeholder='Name'> <br>
            <input type="text" name="address" placeholder='Address'> <br>
            <input type="text" name="phone" placeholder='Phone Number'> <br>
            <input type="text" name="engineNo" placeholder='Car Engine Number'> <br>
            <input type="text" name="licenseNo" placeholder='Car License Number'> <br>
            <p>Appointment Date</p>
            <div class='appointment-date'>
                <select name="appointmentDay">
                    <?php for($i=1; $i<=31; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                    <?php endfor; ?>
                </select>
                <select name="appointmentMonth">
                    <?php for($i=date('m')-1, $counter=1; $counter<=2; $i=($i+1)%12, $counter++): ?>
                        <option value="<?php echo $i+1; ?>"><?php echo $month[$i]; ?></option>
                    <?php endfor; ?>
                </select>
                <select name="appointmentYear">
                    <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                    <?php if(date('m')==12): ?>
                        <option value="<?php echo date('Y')+1; ?>"><?php echo date('Y')+1; ?></option>
                    <?php endif; ?>
                </select>
            </div>
            <select name="mechanic">
                <option value="">Select Mechanic</option>
                <option value="John">John</option>
                <option value="Sam">Sam</option>
                <option value="Jane">Jane</option>
                <option value="Will">Will</option>
                <option value="Kevin">Kevin</option>
            </select> <br>
            <button type="submit" name='insert' class='btn btn-yellow'><i class="fas fa-car-side"></i> Submit</button>
        </form>
    </div>
</section>

<script type="module" src="<?php echo URLROOT;?>/js/main.js"></script>
<?php
    require_once APPROOT . '/views/inc/footer.php';
?>
