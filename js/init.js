(function($){
  $(function(){

    $('.button-collapse').sideNav({
    	menuWidth: 340, // Default is 240
      	edge: 'left', // Choose the horizontal origin
      	closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    });

    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });

    Materialize.fadeInImage('#objectifs');
    
  }); // end of document ready
})(jQuery); // end of jQuery name space
