<?php require_once('../tracker01.php');

set_visit('Korean Ladder Game - Play');

function vd($var) {
   echo"<pre>";
      var_dump($var);
   echo"</pre>";
}


if( isset( $_POST['user'] ) && isset( $_POST['value'] ) ) {
   if( 
      ( count( $_POST['user'] ) > 10 && count( $_POST['user'] ) < 2 ) &&
      ( count( $_POST['value'] ) > 10 && count( $_POST['value']) < 2 )
   ) {
      exit("Value error");
   }
}else{
   exit("Page error.");
}

$iUserCount = count($_POST['user']);
$aUser = $_POST['user'];
$aValue = $_POST['value'];

shuffle($aValue);


$aColumn = array();
$aColumnNumFlag = array();
$sStatus = 'off';
$iTotalUser = $iUserCount - 1;
$iTotalRows = ( $iTotalUser * 2 ) + ( 5 + $iTotalUser );
$iColumn = $iTotalUser - 1;

$iTotalRange = ceil ( $iColumn / 2 );

for ( $i = 0 ; $i < $iTotalUser ; $i++ ) {
   $aColumn[] = $i + 1;
}

shuffle($aColumn);

$j = 0;
for ( $i = 0 ; $i < $iTotalRows ; $i++ ) {

   if ( $j > $iTotalUser - 1 ) {
      $j = 0;
   }
   $aColumnNumFlag[] = $aColumn[$j];
   $j++;
}
shuffle($aColumnNumFlag);
?>
<!DOCTYPE html>
<html>
<head>
<title>Korean Ladder Game -> Play | John Adrian P. Tan</title>
<style type="text/css">
body{margin:0;font-family:tahoma;margin:0;background:url(assets/images/bg-body.gif)}
.wrapper{padding:20px 15px 10px 15px;}
table{width: 100%;border-collapse: collapse;border-bottom:none;}
table tr td{border-left: solid 4px black;border-right: solid 4px transparent;border-bottom:solid 4px transparent;border-top:solid 4px transparent;height: 16px;padding: 0px;}
.container{height: 35px;border:solid 2px transparent;position: relative;padding:0px;}

.left-static{position: absolute;width: 0px;border-left: solid 4px #ADA96E  ;top: -6px;bottom: -6px;left: -6px;
	-moz-box-shadow: 0 0 30px gray;
	-webkit-box-shadow: 0 0 30px gray;
	box-shadow: 0 0 30px gray;   
}
.left-dynamic{position: absolute;width: 0px;border-left: solid 4px black;top: -6px;left: -6px;height: 0px;}

.right-static{position: absolute;width: 0px;border-right: solid 4px #ADA96E;top: -6px;bottom: -6px;right: -6px;
	-moz-box-shadow: 0 0 30px gray;
	-webkit-box-shadow: 0 0 30px gray;
	box-shadow: 0 0 30px gray;  
}
.right-dynamic{position: absolute;width: 0px;border-right: solid 4px black;top: -6px;right: -6px;}

.right-static-dummy{position: absolute;width: 0px;border-right: solid 4px blue;top: -6px;bottom: -6px;right: -6px;}

.bottom-static{position: absolute;height: 0px;left: -6px;right: -6px;bottom:-6px;border-bottom: solid 4px transparent;}
.bottom-dynamic-to-right{position: absolute;height: 0px; left:-6px;bottom:-6px;border-bottom:solid 4px green;}
.bottom-dynamic-to-left{position: absolute;height: 0px; right:-6px;bottom:-6px;border-bottom:solid 4px violet;}

.flag-x{position:absolute;border:solid 2px transparent;top:-6px;bottom:-6px;left:50%;}
.flag-y{position:absolute;border:solid 2px transparent;left:-6px;right:-6px;top:50%;}

.user-label{border:none;}
.user-label-container{position:relative;height:100%;}
.left-label{position:absolute;left:-6px;top:-7px;font-weight:bold;color:#000;font-size:19px;}
.right-label{position:absolute;right:-6px;top:-7px;font-weight:bold;color:#000;font-size:19px;}
</style>
<script  type="text/javascript" src="http://devjohnph.com/jquery-1.7.1.min.js"></script>
</head>
<body>
<div class="wrapper">
<table>
<?php foreach ( $aColumnNumFlag as $key => $val ):?>
   <?php 
      if( $key == 0 ){
   ?>
   <tr>
      <?php for ( $k = 1; $k <= $iTotalUser; $k++ ){ ?>
      <td class="user-label">
         <div class="user-label-container">
            <div class="left-label">
            <?php echo $aUser[ $k - 1 ]; ?>
            </div>
            <?php if( $k == $iTotalUser){?>
            <div class="right-label">
            <?php echo $aUser[ $k ]; ?>
            </div>            
            <?php }?>
         </div>
      </td>
      <?php }?>
   </tr>
   <?php
      }
   ?>
   <tr>
      <?php for ( $i = 1; $i <= $iTotalUser; $i++ ):?>
         <?php 
            $sBorderCss = 'style="border-bottom:solid 4px transparent;"';
            $sStatus = 'off';
            
            if ( $aColumnNumFlag[$key] == $i ) {
               $sStatus = 'on';
               $sBorderCss = 'style="border-bottom:dotted 4px #ADA96E;"';
            }
            
            if ( $key == $iTotalRows - 1) {
               $sStatus = 'off';
               $sBorderCss = 'style="border-bottom:none"';
            }
         ?>
      <td>
         <div class="container container-<?php echo $i;?>-<?php echo $key+1;?>" alt="<?php echo $sStatus;?>">
            <div class="left-static left-static-<?php echo $i;?>-<?php echo $key+1;?>"></div>
            <div class="left-dynamic left-dynamic-<?php echo $i;?>-<?php echo $key+1;?>"></div>
            <div class="flag-x"></div>
            <div class="flag-y"></div>
            <?php if( $i == $iTotalUser ):?>
            <div class="right-static right-static-<?php echo $i;?>-<?php echo $key+1;?>"></div>
            <div class="right-dynamic right-dynamic-<?php echo $i;?>-<?php echo $key+1;?>"></div>            
            <?php endif;?>
            <div class="bottom-static bottom-static-<?php echo $i;?>-<?php echo $key+1;?>" <?php echo $sBorderCss;?> ></div>
            <div class="bottom-dynamic-to-right b-d-to-right-<?php echo $i;?>-<?php echo $key+1;?>"></div>
            <div class="bottom-dynamic-to-left b-d-to-left-<?php echo $i;?>-<?php echo $key+1;?>"></div>
         </div>
      </td>
         
      <?php endfor;?>
   </tr>
<?php endforeach;?>
   <tr>
      <?php for ( $k = 1; $k <= $iTotalUser; $k++ ){ ?>
      <td class="user-label">
         <div class="user-label-container">
            <div class="left-label">
            <?php echo $aValue[ $k - 1 ]; ?>
            </div>
            <?php if( $k == $iTotalUser){?>
            <div class="right-label">
            <?php echo $aValue[ $k ]; ?>
            </div>            
            <?php }?>
         </div>
      </td>
      <?php }?>
   </tr>
</table>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){   
   var aColors = [
      'pink','red','blue','orange','yellow',
      'green','#808000','#4C787E','#7A5DC7',
      '#F6358A','#F9B7FF','#387C44','#41A317',
      '#57E964','#00FF00','#FBB917','#ADA96E',
      '#151B8D','#ECD672','#C48189','#E77471',
      'royalblue','yellowgreen','#EAC117','#F660AB',
      '#F62817','#FFF8C6','#CCFB5D','#8AFB17','#87F717',
      '#C3FDB8','#6698FF','#F433FF'
      ];
   var aRandomColors = arrayRand(aColors);
   var color = aRandomColors[0];
   var iStartColumn = 1;
   var iTotalRealColumn = <?php echo $iTotalUser + 1;?>;
   var iTotalRows = <?php echo $iTotalRows;?>;
   
   // This will be the first function to run it. This will be controlling
   // function of the application
   function goLeft( col, row) {
      var counter = 1;
      var timer = setInterval( function() {
         if( counter >= $(".flag-x").height() ) {
            setTimeout(function(){
               $(".left-static-"+col+"-"+row).attr('style', 'border-left: solid 4px '+color+'; z-index:'+iStartColumn);     
               $(".left-dynamic-"+col+"-"+row).height('0px');
            
            },5);

            if ( row <= iTotalRows ) {
               if( col > 1 ) {
                  if( $(".container-"+ ( col ) + "-" + row ).attr('alt') ==='on' ) {
                     goBottomRight(col, row);
                  }else if($(".container-"+ ( col - 1) + "-" + row ).attr('alt') ==='on'){
                     goBottomLeft(col - 1,row);
                  }else{
                     skip(col, row + 1);
                  }
               } else {

                  if( $(".container-"+ col + "-" + row ).attr('alt') ==='on' ) {
                     goBottomRight(col,row);
                  }else{
                     skip( col, row + 1);
                  }
               }
            }else{
               if(iStartColumn < iTotalRealColumn){
                  iStartColumn += 1;
                  color = aRandomColors[iStartColumn - 1];
                  goLeft(iStartColumn,1);
               }
            }

            clearInterval(timer);
         }
         if ( col < iTotalRealColumn ) {
            $(".left-dynamic-"+col+"-"+row).attr('style', 'border-left: solid 4px '+color+'; z-index:'+iStartColumn).height(counter+'px');         
         }else if(col === iTotalRealColumn){
            $(".right-dynamic-"+ (col - 1 ) + "-"+row).attr('style', 'border-right: solid 4px '+color+'; z-index:'+iStartColumn).height(counter+'px');         
         }
         counter += 5;
      },10);
   };

   
   function goBottomLeft( col, row ) {
      var counter = 1;
      var timer = setInterval(function(){
         if( counter > $(".flag-y").width() ) {
            setTimeout(function(){
               $(".bottom-static-"+col+"-"+row).attr('style', 'border-bottom: solid 4px '+color+'; z-index:'+iStartColumn);     
               $(".b-d-to-left-"+col+"-"+row).width('0px');
            },5);
            goLeft( col, row + 1 );
            clearInterval(timer);
         }
         $(".b-d-to-left-"+col+"-"+row).attr('style', 'border-bottom: solid 4px '+color+'; z-index:'+iStartColumn).width(counter+'px');
         counter += 5;
      },5);
   };
   
   function goBottomRight( col, row ) {
      var counter = 1;
      var timer = setInterval(function(){
         if( counter > $(".flag-y").width() ) {
            setTimeout(function(){
               $(".bottom-static-"+col+"-"+row).attr('style', 'border-bottom: solid 4px '+color+'; z-index:'+iStartColumn);     
               $(".b-d-to-right-"+col+"-"+row).width('0px');
            },5);
         
            goLeft( col + 1, row + 1 );
            clearInterval(timer);
         }
         $(".b-d-to-right-"+col+"-"+row).attr('style', 'border-bottom: solid 4px '+color+'; z-index:'+iStartColumn).width(counter+'px');
         counter += 5;
      },5);
   };
   
   function skip( col, row ) {
      goLeft(col,row);
   }
   
   function arrayRand ( myArray ) {
      var i = myArray.length;
      if ( i == 0 ) {
         return false;
      }
      while ( --i ) {
         var j = Math.floor( Math.random() * ( i + 1 ) );
         var tempi = myArray[i];
         var tempj = myArray[j];
         myArray[i] = tempj;
         myArray[j] = tempi;
      }
      return myArray;
   };
      
   goLeft(iStartColumn,1);

});

</script>
</body>
</html>