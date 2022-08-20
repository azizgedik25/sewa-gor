<div class="row">
    <div class="col-sm-6 col-lg-4">
        <div class="widget-simple text-center card-box bg-success">
            <h3 class="text-white counter">
                <?php  
                    if($level=="user"){
                        $user_id = $_SESSION['user_id'];
                        $set1 = "WHERE user_id='$user_id'";
                    }
                    $result1 = mysqli_query($conn,"SELECT * FROM booking $set");
                    echo mysqli_num_rows($result1);
                ?>
            </h3>
            <p class="text-white">Total Penyewa</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="widget-simple text-center card-box bg-warning">
            <h3 class="text-white counter">
                <?php 
                    if($level=="user"){
                        $user_id = $_SESSION['user_id'];
                        $set2 = "WHERE user_id='$user_id'";
                    }
                    $result2 = mysqli_query($conn,"SELECT * FROM lapangan $set2");
                    echo mysqli_num_rows($result2);
                ?>
            </h3>
            <p class="text-white">Total Lapangan</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="widget-simple text-center card-box bg-purple">
            <h3 class="text-white counter">
                <?php 
                    if($level=="user"){
                        $user_id = $_SESSION['user_id'];
                        $set2 = "WHERE user_id='$user_id'";
                    }
                    $result3 = mysqli_query($conn,"SELECT SUM(tot) as jml FROM booking WHERE status='sudah' $set2");
                    $data = mysqli_fetch_array($result3);
                    echo "Rp. ".$data['jml'].",-";
                ?>
            </h3>
            <p class="text-white">Total Pendapatan</p>
        </div>
    </div>
</div>