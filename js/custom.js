$(document).ready(function(){
   
    var elem;
       var elementTextArr = [];
       var elementObjArr = [];
       var ParnClsArr   =   [];

       $(document).on("click", ".main", function (e) {
        elem = $(this);
        ParnClsArr.push($(this).parent().attr('class'));
        var tempText = $(this).text();
        $('.assignbtn').removeAttr("disabled");
       $(elem).removeClass('markednew');
        if (e.shiftKey) {
            elem.toggleClass("marked");
            elementTextArr += $(this).text()+" ";
             if($(this).hasClass('marked')){
                elementObjArr.push(tempText);
               
            }else{
                elementObjArr=elementObjArr.filter(function(item) { 
                        return item !== tempText
                    });
                
            }
            
        }else if(e.shiftKey == false)
        {
            $(".main").removeClass("marked");
            $(this).addClass("marked");
            elementTextArr = [];
            elementObjArr = [];
            elementTextArr += tempText+" ";
            if($(this).hasClass('marked')){
                elementObjArr.push(tempText);
              
            }else{
                elementObjArr=elementObjArr.filter(function(item) { 
                        return item !== tempText
                    });
                
            }
           
        }else{
            elementTextArr = [];
            elementObjArr = [];
        }

        console.log(elementObjArr);
    });



    $(document).on("click", ".assignbtn", function(e){
        $('#myModal').modal('show');

        
    });
   
    // var existingJson = <?php echo $commingJson; ?>;
   // console.log(existingJson.ref_items[0].refout[0]);
    var newJsonArr = {};
    
    $(document).on('click', '.button_example', function(){
        var labelList = [];
        var txt = $(this).attr('name');
         labelList.push(txt);
         //console.log(labelList);
         $('#getBtnJson').removeAttr("disabled");
         $('#myModal').modal('hide');
          $('.marked').remove();


         var tempLbl;
         var htmlData = '';
         var putSpace = '';
         for(var i=0;i<labelList.length;i++){
             
             tempLbl = labelList[i];
             
             console.log(tempLbl);
            
            var ParntRmndr =    $("."+tempLbl).find('.chip').length/7;
            console.log(ParntRmndr);
            var DisStus     =   0;
            var k=0;
            for(j=0;j<elementObjArr.length;j++){
                    htmlData +='<span class="chip main markednew">'+elementObjArr[j]+'</span>';
                    putSpace = '';
                    // if(j%7==0 && ParntRmndr!=0){
                    //      putSpace +=  '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    // }
                    // else if(j%15==0 && ParntRmndr!=0){
                    //     putSpace +=  '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    // }else if(j%23==0 && ParntRmndr!=0)
                    // {
                    //    putSpace +=  '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    // }
                    
                }
            console.log(ParnClsArr);
            
            var uniqueArray = ParnClsArr.filter(function(item, pos) {
                return ParnClsArr.indexOf(item) == pos;
            });
            console.log(uniqueArray);
            if($('#operationContent').find("."+tempLbl).length)
            {
                console.log('hai');
                var PantCnt = $('#operationContent').find("."+tempLbl).length;
                PantCnt = PantCnt-1;
                $("."+tempLbl+":eq("+PantCnt+")").append(htmlData+putSpace)

                // console.log($('.author:eq(0)')[0]);
                //     console.log($('.author:eq(1)')[0]);

                // if($('#operationContent').find("."+tempLbl).length == 2){
                    // console.log('in');
                    //console.log($("."+tempLbl).eq(2).append(htmlData+putSpace));
                    // console.log($('.author:eq(0)')[0]);
                    // console.log($('.author:eq(1)')[0]);
                    //$("."+tempLbl+":nth-child(2)").append(htmlData+putSpace);
                // }else{
                //     console.log('out');
                //     $("."+tempLbl).append(htmlData+putSpace);
                // }
                
                
                 
                
             
                for(var j=0; j<uniqueArray.length; j++){
                    if($("."+uniqueArray[j]).find(".chip").length==0){
                        console.log($("."+uniqueArray[j]).next()[0]);
                      
                            $("."+uniqueArray[j]).next().remove();
                        
                        $("."+uniqueArray[j]).remove();
                    }
                }
                 uniqueArray=[];

             }else{
                
                var firstCabtitle;
                firstCabtitle = tempLbl.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });
                htmlData = '<div class="'+tempLbl+'"><span class="titled">'+firstCabtitle+'</span>'+htmlData+'</div><br>';

               

                $("#operationContent").append(htmlData+putSpace);
                var hclass = $(elem).parent().attr('class');
                
                $(elem).remove();

                // if($("."+hclass).find(".chip").length==0){
                //     ($("."+hclass).next()[0].tagName=="BR") ? $("."+hclass).next().remove() : '';
                //     $("."+hclass).remove();
                // }
                // $('.marked').remove();

                for(var j=0; j<uniqueArray.length; j++){
                    if($("."+uniqueArray[j]).find(".chip").length==0){
                        console.log($("."+uniqueArray[j]).next()[0]);
                       $("."+uniqueArray[j]).next().remove();
                        $("."+uniqueArray[j]).remove();
                    }
                }
                 uniqueArray=[];
                
                
                //console.log($(elem).parents().html());
             }
           
            uniqueArray=[];
            elementObjArr= [];
         }
     //    $("."+tempLbl).append(htmlData);
        
         
        
         


         $("#listview").append("<li>"+txt+"</li>");


    });



    $(document).on('click', '#getBtnJson', function(){
        var refout = [];
        var tagdata;
        var tagdataUpper;
        var datastr="";
        var datacontentstr = "";
        var td;
        $('#operationContent').find('div').each(function(){
                tagdata = $(this).attr('class');
                tagdataUpper = tagdata.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        });
                //console.log();
                datastr += '<'+tagdata+'>';
                $('.'+tagdata).find('span').each(function(){
                       var t = $(this).text();
                       //console.log(tagdataUpper);
                        if(tagdataUpper != t){
                            datacontentstr += t+" ";
                        }
                });
                var st = datacontentstr.replace(/^[ ]+|[ ]+$/g,'')
                datastr+= st+'</'+tagdata+'>';
                datacontentstr = "";
            //        tagdata = $(this).attr('class');
            //         
                    
            //    // console.log(elementTextArr);
                // datastr +='<'+tagdata+'>'+tagdata+'</'+tagdata+'>';

            //         //refout.push(item);
        });
        console.log(datastr);

        if(datastr.length >0){
          $.ajax({
            type: "POST",
            url: "fadatawrite.php",
            data: {data:datastr},
           // cache: false,
            success: function(data){
              alert('Changes Added Successfully !');
            }
          });
        }
      
    });
   
      
   });

