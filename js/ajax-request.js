
  function getTopic() {
    setTimeout(function(){
      var imgs = $('.topic-content').find('img');
      $( imgs ).each(function( index ) {
        $( imgs ).eq( index ).css( "width", "90%" );
        $( imgs ).eq( index ).css( "margin", "auto" );
        $( imgs ).eq( index ).css( "display", "block" );
        $( imgs ).eq( index ).css( "border-radius", "2px" );
      });
    $('.list-group-item').click(function(){
      var imgs = $('.topic-content').find('img');
      $( imgs ).each(function( index ) {
        $( imgs ).eq( index ).css( "width", "90%" );
        $( imgs ).eq( index ).css( "margin", "auto" );
        $( imgs ).eq( index ).css( "display", "block" );
        $( imgs ).eq( index ).css( "border-radius", "2px" );
      });

    });
  }, 10);
};

getTopic();
