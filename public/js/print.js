   window.print();
   window.onafterprint = function(){
        location.href = window.location.pathname;
        // window.history.back();
  }
