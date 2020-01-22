<?php
require_once APPROOT . '/views/inc/navbar.php';
?>
<section id='appointment-info-table'>
        <div class="container">
            <h2><i class="far fa-file-alt"></i> Appointment Info</h2>
            <table>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Engine No</th>
                    <th>License No</th>
                    <th>Appointment Date</th>
                    <th>Mechanic</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>

                <?php
                $i=1;
                foreach($appointments as $client):
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $client->name ?></td>
                        <td><?php echo $client->address ?></td>
                        <td><?php echo $client->phone ?></td>
                        <td><?php echo $client->engineNumber ?></td>
                        <td><?php echo $client->licenseNumber ?></td>
                        <td><?php echo $client->appointmentDate ?></td>
                        <td><?php echo $client->mechanic ?></td>
                        <td><?php echo $client->createdAt ?></td>
                        <td><a href='/appointments/edit/<?php echo $client->id; ?>' class='btn btn-yellow'>Edit</a></td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </table>
        </div>
</section>


<?php
require_once APPROOT . '/views/inc/footer.php';
?>