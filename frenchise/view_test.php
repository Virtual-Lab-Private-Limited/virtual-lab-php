<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}function string_limit_words($string, $word_limit) {
   $words = explode(' ', $string);
   return implode(' ', array_slice($words, 0, $word_limit));
}
$id=$_GET['id'];
$test_list=mysqli_query($con,"select * from tests where id='$id' limit 1") or die (mysqli_error());
while($data=mysqli_fetch_array($test_list)){
	$pid=$data['pid'];
	$gid=$data['gid'];
    $catid=$data['catid'];
	$organid=$data['organid'];
	$disid=$data['disid'];
	$test_title=$data['title'];
	$sample=$data['sample'];
	$test_cost=$data['cost'];
	$test_price=$data['price'];
	$test_remarks=$data['remarks'];	
	$test_type=$data['type'];
	$unit=$data['unit'];
	$gender=$data['gender'];

	$batch_day=$data['batch_day'];
	$duration=$data['duration'];
	$discount_type=$data['discount_type'];
	
	
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

$title=mysqli_real_escape_string($con,$_POST['title']);
$price=mysqli_real_escape_string($con,$_POST['price']);
$cost=mysqli_real_escape_string($con,$_POST['cost']);
$remarks=mysqli_real_escape_string($con,$_POST['remarks']);
$tid=mysqli_real_escape_string($con,$_POST['tid']);
$catid=mysqli_real_escape_string($con,$_POST['catid']);
$test_sample=mysqli_real_escape_string($con,$_POST['sample']);
$test_duration=mysqli_real_escape_string($con,$_POST['duration']);
$test_unit=mysqli_real_escape_string($con,$_POST['unit']);
$batchday=mysqli_real_escape_string($con,$_POST['batch_day']);
$newtitle=string_limit_words($title, 6);
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",$newtitle);
$url=$newurltitle;
$discount_type=mysqli_real_escape_string($con,$_POST['discount_type']);
$gender = mysqli_real_escape_string($con,$_POST['gender']);
$test_type = mysqli_real_escape_string($con,$_POST['type']);
$parent_test = mysqli_real_escape_string($con,$_POST['pid']);
$group_test = mysqli_real_escape_string($con,$_POST['gid']);

echo($group_test);

mysqli_query($con,"update tests set title='$title', catid='$catid', pid='$parent_test', gid='$group_test',gender='$gender', discount_type='$discount_type', type='$test_type',slug='$url', cost='$cost', price='$price', remarks='$remarks', sample='$test_sample',duration='$test_duration',unit='$test_unit',batch_day='$batchday' where id='$tid' limit 1") or die (mysqli_error($con));
header("location:".$baseurl."addtest.html");


}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $test_title;?> | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/codemirror/theme/duotone-dark.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css"> 
 
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
              <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Test</h4>
                    
                  </div>
                  <div class="card-body">
<form method="post" action="<?php echo $baseurl;?>view_test/<?php echo $id;?>.html">

                  <div class="row">
              		<div class="col-lg-4 col-md-12 col-sm-12">
                  <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Test Parent</label>
</strong>
                          </div>
                        </div>
                  
<select name="pid" class="form-control">
<?php
if ($pid == 0){ ?>
<option value="0" selected>Select Parent Test</option>
<?php } else { 
 
    $tests = mysqli_query($con,"select * from tests where id = $pid limit 1") or die (mysqli_error());
    $pt=mysqli_fetch_array($tests)
?>
<option value="<?php echo $pt['id'];?>" selected><?php echo $pt['title'];?></option>

<?php } ?>

<?php
$tests=mysqli_query($con,"select * from tests") or die (mysqli_error());
while($pt=mysqli_fetch_array($tests)){
?>
<option value="<?php echo $pt['id'];?>"><?php echo $pt['title'];?></option>
<option value="0" >Select Parent Test</option>

<?php
}
?>

</select>
  </div>
 </div>
 <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Test Group</label>
</strong>
                          </div>
                        </div>
<select name="gid" class="form-control">
    
<?php
if ($gid == 0){ ?>
<option value="0" selected>Select Group</option>
<?php } else { 
 

 $groups=mysqli_query($con,"select * from groups where id='$gid'  " ) or die (mysqli_error());
    while($g=mysqli_fetch_array($groups)){
        $id = $g['group_id'];
    }
     $tests=mysqli_query($con,"select * from tests where id='$id'  " ) or die (mysqli_error());
    while($t=mysqli_fetch_array($tests)){
        $name = $t['title'];
    }
?>
<option value="<?php echo $gid;?>"><?php echo $name;?></option>
<option value="0" >Select Group</option>

<?php
}
?>   
    

<?php
$tests=mysqli_query($con,"select * from groups") or die (mysqli_error());
while($pt=mysqli_fetch_array($tests)){
    $group_id = $pt['group_id'];
 $parent=mysqli_query($con,"select * from tests where id='$group_id'  " ) or die (mysqli_error());
    while($p=mysqli_fetch_array($parent)){
    $name = $p['title'];
    }
?>
<option value="<?php echo $pt['id'];?>"><?php echo $name;?></option>
<?php
}
?>

</select>
                      </div>

                    </div>
 
 <div class="form-group">

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Discount Type</label>
</strong>
                          </div>
                        </div>
<select name="discount_type" class="form-control" required>
<?php
if ($discount_type == ""){ ?>
<option value="" selected>Select Discount Type</option>
<?php } else { 
 
    $group = mysqli_query($con,"select * from discounts where id = $discount_type limit 1") or die (mysqli_error());
    $pt=mysqli_fetch_array($group)
?>
<option value="<?php echo $pt['id'];?>" selected><?php echo $pt['title'];?></option>
<?php } ?>

<?php
$discounts=mysqli_query($con,"select * from discounts") or die (mysqli_error());
while($row=mysqli_fetch_array($discounts)){
?>
<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
<?php
}
?>

</select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Test Title</label>
</strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="title" value="<?php echo $test_title;?>">
<input type="hidden" class="form-control" name="tid" value="<?php echo $id;?>">

                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Cost Price</label>
</strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="cost" value="<?php echo $test_cost;?>">
                      </div>

                    </div>
                   
                    </div>
                     
                    <div class="col-lg-4 col-md-12 col-sm-12">
                         <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Rate</label>
</strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="price" value="<?php echo $test_price;?>">
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <strong><label>Sample</label>
                            </strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="sample" value="<?php echo $sample;?>">
                      </div>

                    </div>
                   
                         <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Gender</label>
</strong>
                          </div>
                        </div>
<select name="gender" class="form-control">
<option value="<?php echo $gender ?>" selected><?php echo $gender ?></option>
<br>
<option value="Male" >Male</option>
<option value="Female">Female</option>
<option value="Both">Both</option>

</select>
                      </div>

                    </div>
                     <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                          <strong><label>Test Type</label>
                          </strong>
                          </div>
                        </div>
                        
               
                        
                        
                     <select name="type" class="form-control">
                         
                         
                        <?php if ($test_type == "eliza"){ ?>
                          <option value="vb" >Eliza</option>
                        <?php } else if ($test_type == "screening"){ ?> 
                          <option value="screening">Screening</option>
                        <?php } else if ($test_type == "pcr_quantitative"){ ?> 
                          <option value="pcr_quantitative">PCR Quantitative</option>
                        <?php } else if ($test_type == "pcr_qualitative"){ ?> 
                          <option value="pcr_qualitative">PCR Qualitative</option>
                        <?php } else if ($test_type == "culture"){ ?> 
                          <option value="culture">Culture</option>
                        <?php } else if ($test_type == "radiology"){ ?> 
                          <option value="radiology">Radiology</option>
                        <?php } else if ($test_type == "eliza"){ ?> 
                          <option value="eliza">Eliza</option>
                        <?php } else if ($test_type == "histopathology"){ ?> 
                        <option value="histopathology ">Histopathology </option>
                        <?php } else if ($test_type == "cross_match"){ ?> 
                        <option value="cross_match ">Cross Match </option>
                        <?php } else if ($test_type == "bg"){ ?> 
                        <option value="bg ">Blood Group </option>
                        <?php } else if ($test_type == "cog(pt)"){ ?> 
                        <option value="cog(pt) ">Coagulation (PT/INR) </option>
                        <?php }  else if ($test_type == "cog(aptt)"){ ?> 
                        <option value="cog(aptt) ">Coagulation (APTT) </option>
                        <?php } else if ($test_type == "smear"){ ?> 
                        <option value="smear">Smear </option>
                        <?php }  else if ($test_type == "analysis"){ ?> 
                        <option value="analysis">Analysis </option>
                        <?php } ?>  
                        
                                                  
                        <option value="vb">Value Based</option>
                        <option value="screening">Screening</option>
                        <option value="pcr_quantitative">PCR Quantitative</option>
                        <option value="pcr_qualitative">PCR Qualitative</option>
                        <option value="culture">Culture & Sensitivety</option>
                        <option value="radiology">Radiology</option>
                        <option value="histopathology">Histopathology </option>
                        <option value="cross_match"> Cross Match </option>
                        <option value="eliza" >Eliza</option>
                        <option value="bg" >Blood Group</option>
                        <option value="cog(pt)">Coagulation (PT/INR)</option>
                        <option value="cog(aptt)">Coagulation (APTT)</option>
                        <option value="smear">Smear</option>
                         <option value="analysis">Analysis</option>

                        
                        </select>
                      </div>

                    </div>

            
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
                        
                  <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <strong><label>Reporting Duration</label>
                            </strong>
                          </div>
                        </div>
<input type="number" class="form-control" name="duration" value="<?php echo $duration;?>">
                      </div>

                    </div>
                <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                    <strong><label>Department</label>
                    </strong>
                          </div>
                        </div>
                  <select name="catid" class="form-control" required>
  
                  <?php
                  if ($catid == ""){ ?>
                  <option value="" selected>Select Category</option>
                  <?php } else { 
                  
                      $group = mysqli_query($con,"select * from categories where id = $catid limit 1") or die (mysqli_error());
                      $pt=mysqli_fetch_array($group)
                  ?>
                  <option value="<?php echo $pt['id'];?>" selected><?php echo $pt['category'];?></option>

                  <?php } ?>
                  <?php
                  $categories=mysqli_query($con,"select * from categories") or die(mysqli_error());
                  while($cat=mysqli_fetch_array($categories)){
                  ?>
                  <option value="<?php echo $cat['id'];?>"><?php echo $cat['category'];?></option>
                  <?php
                  }
                  ?>

                      </select>
                    </div>
                  </div>    
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Unit</label>
</strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="unit" value="<?php echo $unit;?>">
                      </div>

                    </div>
	                <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Carry Out</label>
</strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="batch_day" value="<?php echo $batch_day;?>">
                      </div>

                    </div>
	                   
                  
	                </div>



	                </div>
	                
	                       <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Remarks</label>
<textarea name="remarks" class="summernote"><?php echo $test_remarks;?></textarea>
	                    </div>
	                                            <div class="form-group">
<input type="submit" name="submit" value=" Update Test " class="btn btn-block btn-info">                    </div>
                   
	                </div>
<?php echo $message;?>


	                </div>
</form>
                    
                  </div>
                </div>
              </div>
           </div>
          
            <div class="row">
              <div class="col-12">
           <div class="section-body">
          <div class="row">
          
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th width="5%"> Test ID</th>
<th>Test Title</th>
<th>Cost</th>
<th>Retail</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$tests=mysqli_query($con,"select * from tests order by id") or die (mysqli_error($con));
while($info=mysqli_fetch_array($tests)){
?>
                          <tr>
<td><?php echo $info['id'];?></td>
<td><?php echo $info['title'];?></td>
<td><?php echo $info['cost'];?></td>
<td><?php echo $info['price'];?></td>
<td width="25%">
    <select class="form-control" onChange="window.location.href=this.value" >
        <option value=""> </option>
        <option value="<?php echo $baseurl;?>test_list/<?php echo $info['id'];?>.html" class="btn btn-default" >List</option>
        <option value="<?php echo $baseurl;?>reference/<?php echo $info['id'];?>.html"  class="btn btn-success">Reference</option>
        <option value="<?php echo $baseurl;?>add_dropdown.php?id=<?php echo $info['id'];?>"  class="btn btn-info"> Add Dropdowns</option>
        <option value="<?php echo $baseurl;?>groups.php?id=<?php echo $info['id'];?>"  class="btn btn-primary"> Add Groups</option>
        <option value="<?php echo $baseurl.'view_test/'.$info['id'];?>.html"  class="btn btn-warning">Edit</option>
        <option value="<?php echo $baseurl.'delete_test.php?id='.$info['id'];?>" class="btn btn-danger" >Delete</option>
 
    </select>
                            </td>
                          </tr>
<?php
}
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
          </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php include("includes/footer.php");?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/summernote/summernote-bs4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/codemirror/mode/javascript/javascript.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/ckeditor/ckeditor.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/ckeditor.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>

</body>


<!-- Mirrored from radixtouch.in/templates/snkthemes/grexsan/source/light/forms-editor.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Jul 2020 08:24:06 GMT -->
</html>