<tr>
    
                    <?php
                    $db_results = mysqli_query($con, "select * from value_based_result where bdid='$id' and testid='$testid' ") or die(mysqli_error());
                    $count_results = mysqli_num_rows($db_results);
                    $value = '';
                    
                    if($count_results > 0) {
                        while ($res = mysqli_fetch_array($db_results)) {
                            $value = $res['value'];
                            $priority = $res['priority'];
                        }
                        
                    }
    
                    ?>
                    <td width="10%"><input type="number" value="<?php echo ($priority > 0 ? $priority : $a++); ?>" class="form-control" name="priority[]" ></td>
                    <td><?php echo $title; ?></td>
                    <td><?php
                    $rid = 0;
                            $references = mysqli_query($con, "select * from test_reference where testid='$testid' and gender='$gender'  limit 1") or die(mysqli_error($con));
                          
                            $rows = mysqli_num_rows($references);
                          
                            if ( $rows > 0)
                            {
                     
                                while ($ref1 = mysqli_fetch_array($references)) {
                                    $refrence_value = $ref1['minimum_value'] . ' - ' . $ref1['maximum_value'] ;
                                    echo $refrence_value;
                                    $rid = $ref1['id'];
                                }
                        
                            } else {
                               
                                $reference = mysqli_query($con, "select * from test_reference where testid='$testid' and additional_data != ''  limit 1") or die(mysqli_error($con));
                                while ($ref2 = mysqli_fetch_array($reference)) {
                                    $refrence_value = $ref2['additional_data']  ;
                                    echo $refrence_value;
                                    $rid = $ref2['id'];
                                }
                        
                            }    
                            ?></td>
                       <?php
                    $references = mysqli_query($con, "select * from tests where id=$testid ") or die(mysqli_error());
                            while ($ref = mysqli_fetch_array($references)) {
                                $unit = $ref['unit'];
                            }?>
                    <td><?php echo $unit; ?></td>
                    <td>
                        
                    <?php
              
                    $dropdowns = mysqli_query($con, "select * from test_dropdowns where refid='$testid'") or die(mysqli_error());
                    $count_drop = mysqli_num_rows($dropdowns);
                    if ($count_drop > 0) {
                    ?>
               
                    <select class="form-control"  name="result[]" >
                        <option value="<?php echo $value; ?>" > <?php echo $value; ?></option>
                        <?php
                        while ($drop = mysqli_fetch_array($dropdowns)) { ?>
                        <option value="<?php echo $drop['value']; ?>">
                          <?php echo $drop['value']; ?>
                        </option>
                        
                        <?php
                        }
                        ?>
                    </select>
                    <input type="hidden" name="tid[]" value="<?php echo  $testid; ?>" class="form-control">
                    <input type="hidden" name="gid[]" value="<?php echo  $gid; ?>" class="form-control">
                  
                    
                    
                    <?php
                    } else {
                                ?>
                    <input type="text" name="result[]" value="<?php echo $value; ?>" class="form-control" placeholder=" Enter Result ">
                    <input type="hidden" name="tid[]" value="<?php echo  $testid; ?>" class="form-control">
                    <input type="hidden" name="gid[]" value="<?php echo  $gid; ?>" class="form-control">
                  
                    <?php } ?>
                    </td>
</tr>