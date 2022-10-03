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

if($_SERVER["REQUEST_METHOD"] == "POST"){
$title=mysqli_real_escape_string($con,$_POST['title']);
$price=mysqli_real_escape_string($con,$_POST['price']);
$cost=mysqli_real_escape_string($con,$_POST['cost']);
$test_type=mysqli_real_escape_string($con,$_POST['test_type']);
$sample=mysqli_real_escape_string($con,$_POST['sample']);
$information=mysqli_real_escape_string($con,$_POST['information']);
$catid=$_POST['catid'];
$organid=$_POST['organid'];
$disid=$_POST['disid'];
$gender=$_POST['gender'];
$pid=$_POST['pid'];
$gid=$_POST['gid'];
$duration=$_POST['duration'];
$unit=$_POST['unit'];
$batch_day=$_POST['batch_day'];
$remakrs=mysqli_real_escape_string($con,$_POST['remarks']);
$discount_type=$_POST['discount_type'];


$newtitle=string_limit_words($title, 6);
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",$newtitle);
$url=$newurltitle;

$query_tests=mysqli_query($con,"select * from tests where title='$title' and pid='$pid' and gid='$gid' limit 1") or die (mysqli_error());

$count_test=mysqli_num_rows($query_tests);
if($count_test>0){
$message='<font color="red"><p align="center">The Following Test is already Exist</p></font>';	
}else{

mysqli_query($con,"insert into tests(pid,gid,catid,organid,disid,title,slug,sample,price,cost,remarks,type,unit,gender,batch_day,duration,discount_type,information) values ('$pid','$gid','$catid','$organid','$disid','$title','$url','$sample','$price','$cost','$remakrs','$test_type','$unit','$gender','$batch_day','$duration','$discount_type','$information')") or die (mysqli_error($con));
$testid=mysqli_insert_id($con);
echo '<script language="javascript">window.location = "'.$baseurl.'reference/'.$testid.'.html"</script>';


$message='<font color="green"><p align="center">Your Test has been added successfully</p>
</font>
'; 

}
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Test List | <?php echo $basetitle;?></title>
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
                    <h4>Add Test</h4>
                    
                  </div>
                  <div class="card-body">
<form method="post" action="<?php echo $baseurl;?>addtest.html">

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
<select name="pid" class="form-control" id="parent">
<option value="0" selected>Select Parent Test</option>

<?php
$tests=mysqli_query($con,"select * from tests") or die (mysqli_error());
while($pt=mysqli_fetch_array($tests)){
?>
<option value="<?php echo $pt['id'];?>"><?php echo $pt['title'];?></option>
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
<select name="gid" class="form-control" id="group">
<option value="0" selected>Select Group</option>

// <?php
// $tests=mysqli_query($con,"select * from groups") or die (mysqli_error());
// while($pt=mysqli_fetch_array($tests)){
//     $group_id = $pt['group_id'];
//  $parent=mysqli_query($con,"select * from tests where id='$group_id'  " ) or die (mysqli_error());
//     while($p=mysqli_fetch_array($parent)){
//     $name = $p['title'];
//     }
// ?>
// <option value="<?php echo $pt['id'];?>"><?php echo $name;?></option>
// <?php
// }
// ?>

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
<select name="discount_type" class="form-control" >
<option value="" selected>Select Discount Type</option>
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
<input type="text" class="form-control" name="title" value="">

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
<input type="text" class="form-control" name="cost" value="">
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
<input type="text" class="form-control" name="price" value="">
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
<input type="text" class="form-control" name="sample" value="">
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
<option value="Male" selected>Male</option>
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
<select name="test_type" class="form-control">

<option value="vb" selected>Value Based</option>
<option value="screening">Screening</option>
<option value="pcr_quantitative">PCR Quantitative</option>
<option value="pcr_qualitative">PCR Qualitative</option>
<option value="culture">Culture & Sensitivety</option>
<option value="radiology_home">Radiology (Home Visit)</option>
<option value="radiology_lab">Radiology (Lab Visit)</option>
<option value="histopathology">Histopathology </option>
<option value="cross_match_eliza"> Cross Match Eliza </option>
<option value="cross_match_screening"> Cross Match Screening </option>
<option value="eliza" >Eliza</option>
<option value="bg" >Blood Group</option>
<option value="cog(pt)">Coagulation (APTT)</option>
<option value="cog(aptt)">Coagulation (PT/INR)</option>
<option value="smear">Smear</option>
<option value="analysis">Analysis</option>
</select>
                      </div>

                    </div>

                   <div class="form-group">
                      <textarea name="information" class="form-control" placeholder="Other Information.."></textarea>
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
<input type="number" class="form-control" name="duration" value="" placeholder="Enter Hours">
                      </div>

                    </div>

                   
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Category</label>
</strong>
                          </div>
                        </div>
<select name="catid" class="form-control" required>
<option value="" selected>Select Category</option>
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
<input type="text" class="form-control" name="unit" value="">
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
<input type="text" class="form-control" name="batch_day" value="">
                      </div>

                    </div>

                    </div>
                    
                    </div>
                    <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Remarks</label>
<textarea name="remarks" class="ckeditor"></textarea>
	                    </div>
	                                            <div class="form-group">
<input type="submit" name="submit" value=" Add Test " class="btn btn-block btn-info">                    </div>
                  
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
<th>Parent</th>
<th>Group</th>
<th>Cost</th>
<th>Retail</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$tests=mysqli_query($con,"select * from tests order by id") or die (mysqli_error($con));
while($info=mysqli_fetch_array($tests)){
    $poid = $info['pid'];
    $goid = $info['gid'];
?>
                          <tr>
<td><?php echo $info['id'];?></td>
<td><?php echo $info['title'];?></td>
<td>
<?php
if( $poid > 0 ) {
$parent = mysqli_query($con,"select * from tests where id= $poid  ") or die (mysqli_error($con));
while($pinfo=mysqli_fetch_array($parent)){
    echo $pinfo['title'];
}}
?>
</td>
<td>
<?php
if( $goid>0 ) {
    $groups = mysqli_query($con,"select * from groups where id ='$goid' ") or die (mysqli_error());
    while($pt = mysqli_fetch_array($groups)){
        $group_id = $pt['group_id'];
        $parent=mysqli_query($con,"select * from tests where id='$group_id'  " ) or die (mysqli_error());
        while($p=mysqli_fetch_array($parent)){
         echo $p['title'];
        }
    }
}
?>
</td>
<td><?php echo $info['cost'];?></td>
<td><?php echo $info['price'];?></td>
<td width="25%">
    
    <select class="form-control" onChange="window.location.href=this.value" >
        <option value=""> </option>
        <option value="<?php echo $baseurl;?>test_list/<?php echo $info['id'];?>.html" class="btn btn-default" >List</option>
        <option value="<?php echo $baseurl;?>reference/<?php echo $info['id'];?>.html"  class="btn btn-success">Reference</option>
        <option value="<?php echo $baseurl;?>add_dropdown.php?id=<?php echo $info['id'];?>"  class="btn btn-info"> Add Dropdowns</option>
        <option value="<?php echo $baseurl;?>groups.php?id=<?php echo $info['id'];?>"  class="btn btn-primary"> Add Groups</option>
        <option value="<?php echo $baseurl.'view_test.php?id='.$info['id'];?>"  class="btn btn-warning">Edit</option>
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
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
    
    $(document).on("change", "#parent", function () {
    var parent_id = $(this).val();
  
    console.log('parent: ', parent_id);
    $.ajax ({
            method: "POST",
            url : 'get_groups.php',
            data:"parent="+parent_id,  
            success : function(data){
                console.log(data);
                $('#group').html(data);
            }
        });  
    });

</script>
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


</html>