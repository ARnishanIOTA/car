<?php
require_once APPROOT . '/views/inc/navbar.php';
?>

    <section id='appointment-form'>
        <div class='form-div'>
            <h2>Login</h2>
            <form action="/admin/login" method="post">
                <input type="email" name="email" placeholder='Email' class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email']; ?>"> <br>
                <?php echo (!empty($data['email_err'])) ? '<span class="invalid-feedback"> '.$data['email_err'] .'</span><br>' : ''; ?>

                <input type="password" name="pass"  placeholder='Password' class="<?php echo (!empty($data['pass_err'])) ? 'is-invalid' : '' ?>" ><br>
                <?php echo (!empty($data['pass_err'])) ? '<span class="invalid-feedback"> '.$data['pass_err'] .'</span><br>' : ''; ?>

                <button type="submit" name='login' class='btn btn-yellow'>Login</button>
            </form>
<!--            --><?php //if(isset($_GET['error'])): ?>
<!--                <p class='error-msg'>Email or password is incorrect.</p>-->
<!--            --><?php //endif; ?>
        </div>
    </section>
