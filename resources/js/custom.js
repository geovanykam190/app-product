$(document).ready(function(){

	//tooltip boostrap
	// $(function () {
		$('[data-toggle="tooltip"]').tooltip();
	// });

	console.log("ATIVOU");

	$("#allParticipantsCheck").on('click', function(){

		if($('#allParticipantsCheck').is(':checked')){

    		$(".sendAllPart").prop("checked", true);

    	} else {
    		$(".sendAllPart").prop("checked", false);

    	}

	});
	
});

function confirmSend(obj, type)
{
    swal({
		title: 'Deletar '+type,
		text: "Deseja realmente deletar esse registro?",
		icon: 'warning',
		dangerMode: true,
		buttons: {
		    cancel: "Cancelar",
		    confirm: "Deletar"
	  	},
	}).then((result) => {

	  	if (result) {
	   		$(obj).parent().find('form').submit();
	  	}
          
	})

}



function sortTable(obj,n, tableid = "tabledata") 
{

	if (obj)
	{
		if($(obj).find('span').hasClass('setaU'))
		{
			$(".stconf").removeClass('setaU').addClass('setaD');
		} else {
			$(".stconf").removeClass('setaU').addClass('setaD');
			$(obj).find('span').removeClass('setaD').addClass('setaU');
		}
	}

	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	table 		= document.getElementById(tableid);
	switching 	= true;
	dir 		= "asc";

	while (switching) 
	{
	  switching = false;
	  rows 		= table.rows;

	  for (i = 1; i < (rows.length - 1); i++) 
	  {
		shouldSwitch 	= false;
		x 				= rows[i].getElementsByTagName("TD")[n];
		y 				= rows[i + 1].getElementsByTagName("TD")[n];

		if (dir == "asc") {

		  if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }

		} else if (dir == "desc") {

		  if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }

		}

	  }

	  if (shouldSwitch) {

		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
		switchcount ++;

	  } else {

		if (switchcount == 0 && dir == "asc") {
		  dir = "desc";
		  switching = true;
		}

	  }
	  
	}

}

function searchContent(txt)
{
	txt = txt.toLowerCase();

    $(".table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(txt) > -1)
    });
}

function clearFIlter()
{
	//$("#filterData").val("");
}
