
jQuery(document).ready(function ($) {

   $("#accordion").accordion(
	   {collapsible: true,
	   active:null,
		   animate:100,
           classes: {
               "ui-accordion": "highlight"
           }
	   }
   );
   $("input[type='submit']").on('click',function () {
           $("#accordion").accordion("refresh");
   });
});

