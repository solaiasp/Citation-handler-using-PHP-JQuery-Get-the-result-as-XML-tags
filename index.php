<!DOCTYPE html>
<html>
<head>
<title>Mapping</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script><!-- Jquery Version 3.2.1 -->
<script src="js/bootstrap.min.js"></script><!-- Version /3.3.7 -->
<link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="col-md-12">
<h2 class="text-center">
<em>1. Parse</em>
</h2>
<!-- ngIf: error -->
<!-- ngIf: excessive -->
<form class=""  action="<?=$_SERVER['PHP_SELF'];?>" method="post">
<div class="form-group" role="form">
<textarea class="form-control" name="inputText" id="txtdatac" placeholder="Paste your references here …" rows="10" spellcheck="false"></textarea>
</div>
<button name="SubmitButton" class="btn btn-primary btn-lg btn-block">
Parse one reference
</button>
</form>
</div>
<div class="row col-md-12">
<h2 class="text-center edittxt hidecustom"><em>2. Edit</em></h2><br>
<div class="col-md-12">
 
            <div class="col-md-8" id="operationContent">
              

<?php

 
if(isset($_POST['SubmitButton'])){ //check if form was submitted
 

  $input = $_POST['inputText']; //get input text
  $curl = curl_init();
  
  $data = '{
                 "refOutFormat":"hash",
                 "ref_items":[
                 {"id":"1","refin":"'.$input.'"}
                 ]
  }';
  
  $b64texText = base64_encode("$data");
  
      curl_setopt($curl, CURLOPT_URL, "http://localhost/refconv");//Your citaion handler Server Name
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $b64texText);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                 curl_setopt($curl, CURLOPT_HTTPHEADER, array(  
                                               'Content-Type: application/json',
                                               'Content-Length: ' . strlen($data))
                 );
  
      $result= curl_exec($curl);
      $commingJson = base64_decode ($result);
                // echo "\nRESULT: ". base64_decode ($result);
      $jsonArray = json_decode(base64_decode ($result));
  
// echo '<pre>';
// print_r($jsonArray);
// exit();
  
  foreach($jsonArray->ref_items[0]->refout[0] as $key => $product)
  {
   
  
    if (is_array($product)){
      $pcount =0;
      for($a=0;$a<count($product);$a++){

        $strValArray = explode(" ",$product[$a]);
        $countBr = 0;
        if($pcount >0){
          echo '</div><br>';
        }
        echo '<div class="'.strtolower($key).'"><span class="titled">'.ucfirst($key).'</span>';
        for($i=0;$i<count($strValArray);$i++){
         echo '<span class="chip main">'.$strValArray[$i].'</span>';
         if($countBr == 8){
           echo '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
         }else if($countBr == 16){
           echo '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
         }else if($countBr == 24){
           echo '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
         }
         $countBr++;
        }

        $pcount++;
       
      }
      //  echo '</div><br/>';
    }     
    else  {
      $strValArray = explode(" ",$product);
       $countBr = 0;
       echo '<div class="'.strtolower($key).'"><span class="titled">'.ucfirst($key).'</span>';
       for($i=0;$i<count($strValArray);$i++){
        echo '<span class="chip main">'.$strValArray[$i].'</span>';
        if($countBr == 8){
          echo '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }else if($countBr == 16){
           echo '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
         }else if($countBr == 24){
           echo '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
         }
        $countBr++;
       }
    }
  
     echo '</div><br/>';
     
  }

   //echo '</table>';
  

  echo '</div><div class="col-md-4"><button class="btn assignbtn" disabled="true"> Assign Label </button><ul id="listview"></ul></div><div class="col-md-12"><center><h2 class="text-center"><em>3. Save</em></h2>
  <br><button class="btn btn-primary" id="getBtnJson" disabled="true">SAVE YOUR CHANGES</button></center>';
}    

?>



  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div> -->
        <div class="modal-body ">
        <div class="row">
        <div class="col-md-4">
            <button class="btn btn-block button_example label-accessed" name="accessed">Accessed</button>
            </div>
              <div class="col-md-4">
            <button class="btn btn-block button_example label-author" name="author">Author</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-title" name="title">Title</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-chtitle" name="chtitle">Chapter Title</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-editor" name="editor">Editor</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-booktitle" name="booktitle">Book Title</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-publisher" name="publisher">Publisher</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-location" name="location">Location</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-date" name="date">Date</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-pages" name="pages">Pages</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-doi" name="doi">DOI</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-journal" name="journal">Journal</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-volume" name="volume">Volume</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-edition" name="edition">Edition</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-conf_loc" name="conf_loc">Conf. Location</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-conf_name" name="conf_name">Conf. Name</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-conf_date" name="conf_date">Conf. Date</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-note" name="note">Note</button>
            </div>
            <div class="col-md-4">
            <button class="btn btn-block button_example label-url" name="url">Url</button>
            </div>
           
           
		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>




</body>

<?php
if(isset($_POST['SubmitButton'])){
 
  echo '<script>$(".edittxt").removeClass("hidecustom");</script>';
  echo '<script>var textareaVal =$("textarea#txtdatac").val("'.$_POST['inputText'].'");</script>';
  echo '<script>var existingJson ='.$commingJson.'</script>';
  echo '<script src="js/custom.js"></script>';
}

?>
</html>

