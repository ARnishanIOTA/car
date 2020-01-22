<?php
require_once APPROOT . '/views/inc/navbar.php';
?>
<section id="appointment-form">
    <div class="form-div">
        <h2>Signup Form</h2>
        <form action="/admin/register" method='POST'>
            <input type="text" name="name" placeholder='Name' class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['name']; ?>"><br>
            <?php echo (!empty($data['email_err'])) ? '<span class="invalid-feedback"> '.$data['name_err'] .'</span><br>' : ''; ?>

            <input type="email" name="email"  placeholder='Email' class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email']; ?>""><br>
            <?php echo (!empty($data['email_err'])) ? '<span class="invalid-feedback"> '.$data['email_err'] .'</span><br>' : ''; ?>

            <input type="password" name="pass"  placeholder='Password' class="<?php echo (!empty($data['pass_err'])) ? 'is-invalid' : '' ?>" ><br>
            <?php echo (!empty($data['pass_err'])) ? '<span class="invalid-feedback"> '.$data['pass_err'] .'</span><br>' : ''; ?>

            <button type="submit" name='signup' class='btn btn-yellow'>Sign Up</button>
        </form>
    </div>
</section>
