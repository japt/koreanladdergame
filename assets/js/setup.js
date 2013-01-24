function Setup() {
   var sHtml = "";
   var iTotalRow = 2;
   var self = this;   
   var userRef, valueRef;
   this.addRow = function(iRow) {
      for(var i = 1; i <= iRow; i++) {
         sHtml += '<div class="user-input-textbox user-1">\
            <div class="input-prepend input-append">\
              <span class="add-on"><b>'+i+'.</b></span>\
              <input class="span3" name="user[]" type="text">\
            </div>\
            <div class="input-prepend input-append">\
              <input class="span3" name="value[]" type="text">';
              if( i === iRow && i !== 2 ){
                 sHtml +='<span class="add-on btn btn-danger remove-usr-btn"><i class="icon-remove icon-white"></i></span>';
              } else {
                 sHtml +='<span class="add-on btn btn-success disabled"><i class="icon-ok"></i></span>';              
              }
         sHtml +='\
            </div>\
         </div>';
      }
      userRef = $("[name='user[]']");
      valueRef = $("[name='value[]']");
      $(".user-input-append").html(sHtml);
      $("[name='user[]']").each(function( i, v ) {
         $(this).val( ( $(userRef[i]).val() !== undefined) ? $(userRef[i]).val() : "" );
      });
      $("[name='value[]']").each(function( i, v ) {
         $(this).val( ( $(valueRef[i]).val() !== undefined) ? $(valueRef[i]).val() : "" );
      });      
      sHtml = "";
   };
   
   // Add user row with the maximum of 10 user
   this.addUser = function() {
      if( iTotalRow < 10 ) {
         iTotalRow += 1;
         self.addRow( iTotalRow );
         if( iTotalRow == 10 ) {
            $(".add-user-btn").attr('disabled',true);
         }
      }
   };
   
   // Remove user with the minimum of two user
   this.removeUser = function() {
      if( iTotalRow > 2 ) {
         iTotalRow -= 1;
         self.addRow( iTotalRow );
         if( iTotalRow == 9 ) {
            $(".add-user-btn").attr('disabled',false);         
         }
      }
   }
}

jQuery(document).ready(function($){
   var error = 0;
   var setup = new Setup();
   
   setup.addRow(2);
   $(".add-user-btn").click(function(){
      setup.addUser();
   });
   
   $(".remove-usr-btn").live('click',function(){
      setup.removeUser();
   });
   
   $(".add-user-form").submit(function(){
      error = 0;
      $("[name='user[]']").each(function(i,v){
         $(this).removeClass('border-error');         
         if( $.trim( $(this).val())==="" ) {
            error += 1;
            $(this).addClass('border-error');
         }         
      });

      if( error > 0 ) {
         return false;
      }
   });
});