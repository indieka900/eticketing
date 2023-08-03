

function showDescr() {
  var probSel1 = document.getElementById("probSel");
  var descr1 = document.getElementById("descr");
  descr.style.display = probSel.value == "Other - Describe" ? "block" : "none";
}





$( '.complaintS' ).on( "submit", function(e) {

  if ( confirm("Please review the information, Submit ticket?") == false ) {
  return false ;
} else {


   var dataString = $(this).serialize();

                  //alert(dataString); return false;

  $.ajax({

    type: "POST",

    url: "../commons/inc/complaintsend.php",

    data: dataString,

    success: function(jqXHR, textStatus, errorThrown) {
      alert('Ticket submitted successfully')
      window.location.reload();
                                   // window.location.href = 'index.php#D2';
                                   // $('.complaintS').load('.complaintS');
    }
  });

  e.preventDefault();
  
}

 

});






$( '.markSolve' ).on( "submit", function(e) {

  var dataString = $(this).serialize();

     //alert(dataString); return false;

  $.ajax({

    type: "POST",

    url: "../commons/inc/data.php",

    data: dataString,

    success: function(jqXHR, textStatus, errorThrown) {
      alert('Successful')
      $('#admindash').load(document.URL + ' #admindash');
      window.location.reload();
         //window.location.href = 'index.php#D0';
    }
  });

  e.preventDefault();

});

$( '.userConfirm' ).on( "submit", function(e) {

  var dataString = $(this).serialize();

     // alert(dataString); return false;

  $.ajax({

    type: "POST",

    url: "../commons/inc/dataConfirm.php",

    data: dataString,

    success: function(jqXHR, textStatus, errorThrown) {
      alert('Confirmed Successfully')
      $('#userConfirmT').load(document.URL + ' #userConfirmT');
      window.location.reload();
         //window.location.href = 'index.php#D1';
    }
  });

  e.preventDefault();

});

$( '.userEdit' ).on( "submit", function(e) {

  var dataString = $(this).serialize();

      //alert(dataString); return false;

  $.ajax({

    type: "POST",

    url: "../commons/inc/dataEdit.php",

    data: dataString,

    success: function(jqXHR, textStatus, errorThrown) {
      alert('Saved successfully')
      $('#userEditT').load(document.URL + ' #userEditT');
      window.location.reload();
         //window.location.href = 'index.php#D1';
    }
  });

  e.preventDefault();

});

$( '.userDelete' ).on( "submit", function(e) {

  var dataString = $(this).serialize();

      // alert(dataString); return false;

  $.ajax({

    type: "POST",

    url: "../commons/inc/dataDelete.php",

    data: dataString,

    success: function(jqXHR, textStatus, errorThrown) {
      alert('Deleted successfully')
      $('#userDeleteT').load(document.URL + ' #userDeleteT');
      window.location.reload();
         // window.location.href = 'index.php#D1';
    }
  });

  e.preventDefault();

});

$( '.assignT' ).on( "submit", function(e) {

  var dataString = $(this).serialize();

     //alert(dataString); return false;

  $.ajax({

    type: "POST",

    url: "../commons/inc/assign.php",

    data: dataString,

    success: function(jqXHR, textStatus, errorThrown) {
      alert('Assigned successfully')
      window.location.reload();
        // window.location.href = 'index.php#D2';
    }
  });

  e.preventDefault();

});

$( '.transferT' ).on( "submit", function(e) {

  var dataString = $(this).serialize();

                        // alert(dataString); return false;

  $.ajax({

    type: "POST",

    url: "../commons/inc/assign.php",

    data: dataString,

    success: function(jqXHR, textStatus, errorThrown) {
      alert('Transfered successfully')
      window.location.reload();
                             // window.location.href = 'index.php#D2';
    }
  });

  e.preventDefault();

});

 /*var options = $('select.problemDescription option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
    });
    options.each(function(i, o) {
        console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    }); */




