(function($){
  $(function(){

    $('.button-collapse').sideNav({
    	menuWidth: 340, // Default is 240
      	edge: 'left', // Choose the horizontal origin
      	closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    });

    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal(
    {
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .4, // Opacity of modal background
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
    });

});

    Materialize.fadeInImage('#objectifs');
    
    $(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
  });

    $(document).ready(function() {
    $('select').material_select();
  });
    
  }); // end of document ready
})(jQuery); // end of jQuery name space
